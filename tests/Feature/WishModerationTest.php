<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Guest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * F-10: moderasi ucapan tamu.
 */
class WishModerationTest extends TestCase
{
    use RefreshDatabase;

    private User $client;
    private Event $event;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = User::factory()->create(['role' => User::ROLE_CLIENT]);
        $this->event = Event::create(['user_id' => $this->client->id, 'bride_name' => 'Rina', 'groom_name' => 'Dimas', 'template' => 'template-2']);
    }

    private function rsvp(string $message, array $extra = [])
    {
        return $this->postJson('/u/rina-dimas/rsvp', array_merge([
            'name' => 'Tamu Uji',
            'number_of_guests' => 1,
            'attendance' => 'hadir',
            'message' => $message,
        ], $extra));
    }

    public function test_without_review_wishes_appear_immediately(): void
    {
        $this->rsvp('Selamat menempuh hidup baru')->assertCreated();

        $this->assertSame(Guest::WISH_VISIBLE, $this->event->guests()->value('message_status'));
        $this->get('/u/rina-dimas')->assertSee('Selamat menempuh hidup baru');
    }

    public function test_with_review_wishes_wait_for_approval(): void
    {
        $this->event->update(['moderate_wishes' => true]);

        $this->rsvp('Barakallah semoga sakinah')
            ->assertCreated()
            ->assertJsonPath('message', 'Terima kasih! RSVP Anda telah berhasil dikirim. Ucapan Anda akan tampil setelah disetujui.');

        $this->get('/u/rina-dimas')->assertDontSee('Barakallah semoga sakinah');

        $guest = $this->event->guests()->first();
        $this->actingAs($this->client)->put("/admin/wishes/{$guest->id}", ['status' => 'visible'])->assertRedirect();

        $this->get('/u/rina-dimas')->assertSee('Barakallah semoga sakinah');
    }

    public function test_hidden_wish_disappears_but_rsvp_counts_stay(): void
    {
        $this->rsvp('Ucapan tidak pantas')->assertCreated();
        $guest = $this->event->guests()->first();

        $this->actingAs($this->client)->put("/admin/wishes/{$guest->id}", ['status' => 'hidden'])->assertRedirect();

        $this->get('/u/rina-dimas')->assertOk()->assertDontSee('Ucapan tidak pantas');
        $this->assertSame('hadir', $guest->fresh()->attendance);
    }

    public function test_hidden_wish_stays_hidden_when_guest_edits_it_via_personal_link(): void
    {
        $invitation = $this->event->invitations()->create(['name' => 'Tamu Uji']);
        $this->rsvp('Ucapan pertama', ['invitation' => $invitation->code])->assertCreated();
        $guest = $invitation->fresh()->guest;

        $this->actingAs($this->client)->put("/admin/wishes/{$guest->id}", ['status' => 'hidden']);

        $this->rsvp('Ucapan diubah', ['invitation' => $invitation->code])->assertOk();

        $this->assertSame(Guest::WISH_HIDDEN, $guest->fresh()->message_status);
        $this->get('/u/rina-dimas')->assertDontSee('Ucapan diubah');
    }

    public function test_changing_attendance_only_keeps_wish_status(): void
    {
        $this->event->update(['moderate_wishes' => true]);
        $invitation = $this->event->invitations()->create(['name' => 'Tamu Uji']);
        $this->rsvp('Ucapan', ['invitation' => $invitation->code]);
        $guest = $invitation->fresh()->guest;
        $guest->forceFill(['message_status' => Guest::WISH_VISIBLE])->save();

        // Ubah kehadiran saja, ucapan sama: tidak kembali ke "menunggu"
        $this->rsvp('Ucapan', ['invitation' => $invitation->code, 'attendance' => 'tidak_hadir'])->assertOk();

        $this->assertSame(Guest::WISH_VISIBLE, $guest->fresh()->message_status);
    }

    public function test_delete_message_keeps_rsvp(): void
    {
        $this->rsvp('Hapus aku')->assertCreated();
        $guest = $this->event->guests()->first();

        $this->actingAs($this->client)->delete("/admin/wishes/{$guest->id}")->assertRedirect();

        $guest->refresh();
        $this->assertNull($guest->message);
        $this->assertSame('hadir', $guest->attendance);
        $this->assertSame(1, $this->event->guests()->count());
    }

    public function test_settings_toggle_and_approve_all(): void
    {
        $this->actingAs($this->client)->put('/admin/wishes/settings', ['moderate_wishes' => 1])->assertRedirect();
        $this->assertTrue($this->event->fresh()->moderate_wishes);

        $this->rsvp('Satu', ['email' => 'a@example.com']);
        $this->rsvp('Dua', ['email' => 'b@example.com']);

        $this->actingAs($this->client)->get('/admin/wishes')->assertSee('Approve all 2 waiting');

        $this->actingAs($this->client)->post('/admin/wishes/approve-all')
            ->assertSessionHas('success', '2 ucapan disetujui dan ditampilkan.');

        $this->get('/u/rina-dimas')->assertSee('Satu')->assertSee('Dua');
    }

    public function test_admin_list_filters_by_status(): void
    {
        $this->rsvp('Tampil', ['email' => 'a@example.com']);
        $this->rsvp('Disembunyikan', ['email' => 'b@example.com']);
        $this->event->guests()->where('message', 'Disembunyikan')->update(['message_status' => Guest::WISH_HIDDEN]);

        $this->actingAs($this->client)->get('/admin/wishes?status=hidden')
            ->assertSee('Disembunyikan')
            ->assertDontSee('>Tampil<', false);
    }

    public function test_client_cannot_moderate_other_events_wishes(): void
    {
        $other = Event::create(['bride_name' => 'Sari', 'groom_name' => 'Budi']);
        $guest = $other->guests()->create(['name' => 'Tamu Sari', 'attendance' => 'hadir', 'message' => 'Halo']);

        $this->actingAs($this->client)->put("/admin/wishes/{$guest->id}", ['status' => 'hidden'])->assertNotFound();
        $this->actingAs($this->client)->delete("/admin/wishes/{$guest->id}")->assertNotFound();
        $this->assertSame('Halo', $guest->fresh()->message);
    }
}
