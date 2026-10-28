<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * Setiap template harus menampilkan data acara dari database dan
 * mengirim RSVP ke acara pemilik link /u/{slug}.
 */
class TemplateRenderTest extends TestCase
{
    use RefreshDatabase;

    public static function templates(): array
    {
        return [
            // [template, punya amplop digital, menampilkan ucapan tamu]
            'Elegant Modern' => ['template-1', true, true],
            'Classic Romantic' => ['template-2', true, true],
            'Elegant Nature' => ['template-3', true, true],
            'Bugis Emerald' => ['template-4', true, true],
        ];
    }

    private function makeEvent(string $template): Event
    {
        return Event::create([
            'slug' => 'uji',
            'template' => $template,
            'bride_name' => 'Rina Amelia Putri',
            'bride_nickname' => 'Rina',
            'bride_father' => 'Bapak Hasan Basri',
            'groom_name' => 'Dimas Pratama Saputra',
            'groom_nickname' => 'Dimas',
            'groom_father' => 'Bapak Ahmad Fauzi',
            'event_date' => '2027-02-14',
            'akad_time_start' => '08:00',
            'akad_time_end' => '10:00',
            'event_time_start' => '11:00',
            'time_zone' => 'WITA',
            'venue_name' => 'Gedung Serbaguna Al-Ikhlas',
            'venue_address' => 'Jl. Perintis Kemerdekaan No. 45, Makassar',
            'gift_accounts' => [
                ['type' => 'bank', 'provider' => 'BCA', 'number' => '5550001111', 'holder' => 'Dimas Pratama Saputra'],
            ],
        ]);
    }

    #[DataProvider('templates')]
    public function test_template_shows_event_data(string $template, bool $hasGiftSection, bool $showsWishes): void
    {
        $this->makeEvent($template);

        $response = $this->get('/u/uji')->assertOk();

        $response->assertSee('Rina')
            ->assertSee('Dimas')
            ->assertSee('Dimas Pratama Saputra')
            ->assertSee('Bapak Ahmad Fauzi')
            ->assertSee('14 Februari 2027')
            ->assertSee('08.00 - 10.00 WITA')
            ->assertSee('Gedung Serbaguna Al-Ikhlas')
            ->assertSee(url('/u/uji/rsvp'), false);

        // Tidak ada sisa teks contoh dari template asli
        foreach (['Nama Lengkap Pria', 'Nama Lengkap Wanita', '[Nama]', '31 Desember 2025', 'Jl. Contoh', '@username', 'Sarah Johnson'] as $placeholder) {
            $response->assertDontSee($placeholder, false);
        }

        if ($hasGiftSection) {
            $response->assertSee('5550001111');
        }
    }

    #[DataProvider('templates')]
    public function test_rsvp_from_template_is_saved_to_the_event(string $template, bool $hasGiftSection, bool $showsWishes): void
    {
        $event = $this->makeEvent($template);

        $payload = [
            'name' => 'Tamu Uji',
            'email' => 'tamu@example.com',
            'number_of_guests' => 2,
            'attendance' => 'hadir',
            'message' => 'Selamat menempuh hidup baru',
        ];

        if ($template === 'template-4') {
            // Template 4 memakai form biasa, bukan fetch
            $this->from('/u/uji')
                ->post('/u/uji/rsvp', $payload)
                ->assertRedirect()
                ->assertSessionHas('rsvp_success');
        } else {
            $this->postJson('/u/uji/rsvp', $payload)->assertCreated();
        }

        $this->assertSame(1, $event->guests()->count());

        // Ucapan tamu muncul kembali di undangan (template dengan buku tamu)
        if ($showsWishes) {
            $this->get('/u/uji')->assertOk()->assertSee('Selamat menempuh hidup baru');
        }
    }

    #[DataProvider('templates')]
    public function test_every_template_has_countdown_and_gallery(string $template): void
    {
        $event = $this->makeEvent($template);

        // Galeri tersembunyi sampai ada foto
        $this->get('/u/uji')
            ->assertOk()
            ->assertSee('2027-02-14T08:00:00')
            ->assertSee('id="countdown"', false)
            ->assertDontSee('id="gallery"', false);

        $photo = $event->photos()->create(['path' => 'gallery/1/foto.webp', 'sort_order' => 1]);

        $this->get('/u/uji')
            ->assertOk()
            ->assertSee('id="gallery"', false)
            ->assertSee($photo->url(), false);
    }

    #[DataProvider('templates')]
    public function test_music_player_follows_event_settings(string $template): void
    {
        $event = $this->makeEvent($template);

        // Tanpa musik: tombol tidak tampil
        $this->get('/u/uji')->assertOk()->assertDontSee('wedding-music-toggle', false);

        // File tidak ada di public/music: tombol tetap disembunyikan
        $event->update(['background_music' => 'tidak-ada.mp3']);
        $this->get('/u/uji')->assertOk()->assertDontSee('wedding-music-toggle', false);

        // Link langsung ke file audio
        $event->update(['background_music' => 'https://example.com/lagu.mp3']);
        $this->get('/u/uji')
            ->assertOk()
            ->assertSee('wedding-music-toggle', false)
            ->assertSee('https://example.com/lagu.mp3', false);
    }
}
