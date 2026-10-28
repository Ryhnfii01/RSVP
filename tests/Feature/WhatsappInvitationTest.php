<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * F-06: kirim undangan lewat WhatsApp dengan template pesan yang bisa diubah.
 */
class WhatsappInvitationTest extends TestCase
{
    use RefreshDatabase;

    private User $client;
    private Event $event;
    private Invitation $invitation;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = User::factory()->create(['role' => User::ROLE_CLIENT]);
        $this->event = Event::create([
            'user_id' => $this->client->id,
            'bride_name' => 'Rina Amelia',
            'groom_name' => 'Dimas Pratama',
            'event_date' => '2027-02-14',
            'venue_name' => 'Gedung Al-Ikhlas',
            'venue_city' => 'Makassar',
        ]);
        $this->invitation = $this->event->invitations()->create(['name' => 'Bapak Ahmad & Keluarga', 'phone' => '0812-3456-7890']);
    }

    public function test_default_message_fills_in_guest_and_event_details(): void
    {
        $message = $this->event->waMessageFor($this->invitation);

        $this->assertStringContainsString('*Bapak Ahmad & Keluarga*', $message);
        $this->assertStringContainsString('*Rina & Dimas*', $message);
        $this->assertStringContainsString('Minggu, 14 Februari 2027', $message);
        $this->assertStringContainsString('Gedung Al-Ikhlas, Makassar', $message);
        $this->assertStringContainsString($this->invitation->personalUrl(), $message);
        $this->assertStringNotContainsString('{', $message);
    }

    public function test_whatsapp_button_records_sent_time_and_opens_chat_with_message(): void
    {
        $response = $this->actingAs($this->client)->get("/admin/invitations/{$this->invitation->id}/whatsapp");

        $location = $response->assertRedirect()->headers->get('Location');
        $this->assertStringStartsWith('https://wa.me/6281234567890?text=', $location);

        parse_str(parse_url($location, PHP_URL_QUERY), $query);
        $this->assertStringContainsString($this->invitation->personalUrl(), $query['text']);
        $this->assertNotNull($this->invitation->fresh()->sent_at);
    }

    public function test_guest_without_number_opens_contact_picker(): void
    {
        $noPhone = $this->event->invitations()->create(['name' => 'Tamu Tanpa Nomor']);

        $this->assertStringStartsWith('https://wa.me/?text=', $noPhone->whatsappUrl());
    }

    public function test_custom_message_is_saved_and_used(): void
    {
        $this->actingAs($this->client)
            ->put('/admin/invitations/message', ['wa_message' => "Halo {nama}, datang ya ke nikahan {mempelai}: {link}"])
            ->assertRedirect(route('admin.invitations.index'));

        $this->assertSame(
            'Halo Bapak Ahmad & Keluarga, datang ya ke nikahan Rina & Dimas: ' . $this->invitation->personalUrl(),
            $this->event->fresh()->waMessageFor($this->invitation)
        );
    }

    public function test_message_without_link_is_rejected(): void
    {
        $this->actingAs($this->client)
            ->put('/admin/invitations/message', ['wa_message' => 'Halo {nama}, datang ya'])
            ->assertSessionHasErrors('wa_message');

        $this->assertNull($this->event->fresh()->wa_message);
    }

    public function test_empty_message_resets_to_default(): void
    {
        $this->event->update(['wa_message' => 'Halo {nama} {link}']);

        $this->actingAs($this->client)
            ->put('/admin/invitations/message', ['wa_message' => ''])
            ->assertSessionHas('success', 'Pesan WhatsApp dikembalikan ke pesan bawaan.');

        $this->assertSame(Event::DEFAULT_WA_MESSAGE, $this->event->fresh()->waMessageTemplate());
    }

    public function test_admin_page_shows_preview_and_sent_status(): void
    {
        $this->invitation->forceFill(['sent_at' => now()])->save();

        $this->actingAs($this->client)
            ->get('/admin/invitations')
            ->assertOk()
            ->assertSee('Sent via WhatsApp')
            ->assertSee('Resend')
            ->assertSee($this->invitation->personalUrl());
    }

    public function test_client_cannot_send_other_events_invitation(): void
    {
        $other = Event::create(['bride_name' => 'Sari', 'groom_name' => 'Budi'])
            ->invitations()->create(['name' => 'Tamu Sari', 'phone' => '081111111111']);

        $this->actingAs($this->client)->get("/admin/invitations/{$other->id}/whatsapp")->assertNotFound();
        $this->assertNull($other->fresh()->sent_at);
    }
}
