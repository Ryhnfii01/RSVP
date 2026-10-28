<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Batas kiriman (rate limit) dan pengamanan dasar.
 */
class SecurityTest extends TestCase
{
    use RefreshDatabase;

    private Event $event;

    protected function setUp(): void
    {
        parent::setUp();

        $this->event = Event::create(['bride_name' => 'Rina', 'groom_name' => 'Dimas', 'template' => 'template-2']);
    }

    private function rsvp(int $i)
    {
        return $this->postJson('/u/rina-dimas/rsvp', [
            'name' => "Tamu {$i}",
            'number_of_guests' => 1,
            'attendance' => 'hadir',
        ]);
    }

    public function test_rsvp_is_limited_per_minute(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $this->rsvp($i)->assertCreated();
        }

        $this->rsvp(11)
            ->assertStatus(429)
            ->assertJsonPath('message', 'Terlalu banyak kiriman dari jaringan Anda. Silakan coba lagi beberapa menit lagi.');

        $this->assertSame(10, $this->event->guests()->count());
    }

    public function test_rsvp_form_limit_returns_to_the_form_with_a_message(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $this->rsvp($i);
        }

        $this->from('/u/rina-dimas')
            ->post('/u/rina-dimas/rsvp', ['name' => 'Tamu', 'number_of_guests' => 1, 'attendance' => 'hadir'])
            ->assertRedirect('/u/rina-dimas#rsvp')
            ->assertSessionHasErrors('rsvp');
    }

    public function test_login_is_limited_after_five_wrong_passwords(): void
    {
        $user = User::factory()->create(['email' => 'klien@example.com', 'password' => 'rahasia-benar']);

        for ($i = 0; $i < 5; $i++) {
            $this->post('/login', ['email' => 'klien@example.com', 'password' => 'salah'])
                ->assertSessionHasErrors(['email' => 'Email atau password salah.']);
        }

        // Percobaan ke-6, bahkan dengan password benar, ditahan dulu
        $this->post('/login', ['email' => 'klien@example.com', 'password' => 'rahasia-benar'])
            ->assertSessionHasErrors(['email' => 'Terlalu banyak percobaan masuk. Silakan coba lagi dalam 1 menit.']);
        $this->assertGuest();
    }

    public function test_guessing_personal_link_codes_is_limited(): void
    {
        for ($i = 0; $i < 60; $i++) {
            $this->get('/u/rina-dimas/tebak' . str_pad((string) $i, 3, '0', STR_PAD_LEFT))->assertNotFound();
        }

        $this->get('/u/rina-dimas/tebak999')->assertStatus(429);
    }

    public function test_undecided_answer_is_accepted(): void
    {
        $this->postJson('/u/rina-dimas/rsvp', [
            'name' => 'Tamu Ragu',
            'number_of_guests' => 1,
            'attendance' => 'masih_ragu',
        ])->assertCreated();

        $this->assertSame('masih_ragu', $this->event->guests()->value('attendance'));
    }

    public function test_map_links_only_allow_web_addresses(): void
    {
        $this->event->forceFill(['venue_name' => 'Gedung', 'venue_maps_url' => 'javascript:alert(1)'])->save();

        $this->assertStringStartsWith('https://', $this->event->mapsUrl());
        $this->get('/u/rina-dimas')->assertDontSee('javascript:alert(1)', false);
    }

    public function test_guest_export_neutralises_spreadsheet_formulas(): void
    {
        $client = User::factory()->create(['role' => User::ROLE_CLIENT]);
        $this->event->update(['user_id' => $client->id]);
        $this->event->guests()->create(['name' => '=HYPERLINK("http://jahat")', 'attendance' => 'hadir']);

        $csv = $this->actingAs($client)->get('/admin/guests/export/csv')->streamedContent();

        $this->assertStringContainsString("'=HYPERLINK", $csv);
    }

    public function test_pages_send_security_headers(): void
    {
        $this->get('/')
            ->assertHeader('X-Frame-Options', 'SAMEORIGIN')
            ->assertHeader('X-Content-Type-Options', 'nosniff')
            ->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
    }
}
