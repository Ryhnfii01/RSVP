<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Support\PhotoStorage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Preview link undangan saat dibagikan (Open Graph).
 */
class OpenGraphTest extends TestCase
{
    use RefreshDatabase;

    private Event $event;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
        $this->event = Event::create([
            'bride_name' => 'Rina',
            'groom_name' => 'Dimas',
            'template' => 'template-4',
            'event_date' => '2027-02-14',
            'venue_name' => 'Gedung Serbaguna',
        ]);
    }

    public function test_every_template_has_title_description_and_image(): void
    {
        foreach (array_keys(Event::TEMPLATES) as $template) {
            $this->event->update(['template' => $template]);

            $this->get('/u/rina-dimas')
                ->assertOk()
                ->assertSee('<title>Undangan Pernikahan Rina &amp; Dimas</title>', false)
                ->assertSee('<meta property="og:title" content="Undangan Pernikahan Rina &amp; Dimas">', false)
                ->assertSee('Minggu, 14 Februari 2027 di Gedung Serbaguna.')
                ->assertSee(asset('images/og-default.jpg'), false)
                ->assertSee('<meta name="robots" content="noindex, nofollow">', false);
        }
    }

    public function test_personal_link_preview_names_the_guest(): void
    {
        $invitation = $this->event->invitations()->create(['name' => 'Bapak Budi']);

        $this->get($invitation->personalUrl())
            ->assertSee('content="Kepada Bapak Budi. Minggu, 14 Februari 2027', false)
            ->assertSee('<meta property="og:url" content="' . $invitation->personalUrl() . '">', false);
    }

    public function test_first_gallery_photo_becomes_a_jpeg_preview(): void
    {
        if (! PhotoStorage::canCompress()) {
            $this->markTestSkipped('Ekstensi GD tidak aktif.');
        }

        $image = imagecreatetruecolor(1600, 1200);
        ob_start();
        imagepng($image);
        Storage::disk('public')->put('gallery/foto.png', ob_get_clean());
        $photo = $this->event->photos()->create(['path' => 'gallery/foto.png', 'sort_order' => 1]);

        $expected = "og/event-{$this->event->id}-photo-{$photo->id}.jpg";

        $this->get('/u/rina-dimas')->assertSee(asset('storage/' . $expected), false);

        Storage::disk('public')->assertExists($expected);
        [$width, $height, $type] = getimagesize(Storage::disk('public')->path($expected));
        $this->assertSame([1200, 630, IMAGETYPE_JPEG], [$width, $height, $type]);

        // Foto dihapus -> preview ikut dihapus, kembali ke gambar bawaan
        $photo->delete();
        Storage::disk('public')->assertMissing($expected);
        $this->get('/u/rina-dimas')->assertSee(asset('images/og-default.jpg'), false);
    }
}
