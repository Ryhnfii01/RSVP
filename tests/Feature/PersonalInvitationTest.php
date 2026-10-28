<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * F-07: nama tamu di sampul dan RSVP yang terhubung ke link personal.
 */
class PersonalInvitationTest extends TestCase
{
    use RefreshDatabase;

    public static function templates(): array
    {
        return [
            'Elegant Modern' => ['template-1'],
            'Classic Romantic' => ['template-2'],
            'Elegant Nature' => ['template-3'],
            'Bugis Emerald' => ['template-4'],
        ];
    }

    private function makeInvitation(string $template = 'template-1'): Invitation
    {
        $event = Event::create(['bride_name' => 'Rina', 'groom_name' => 'Dimas', 'template' => $template]);

        return $event->invitations()->create(['name' => 'Bapak Ahmad & Keluarga', 'phone' => '081234567890']);
    }

    private function rsvp(Invitation $invitation, array $overrides = [])
    {
        return $this->postJson('/u/rina-dimas/rsvp', array_merge([
            'invitation' => $invitation->code,
            'name' => 'Bapak Ahmad & Keluarga',
            'number_of_guests' => 3,
            'attendance' => 'hadir',
            'message' => 'Selamat ya',
        ], $overrides));
    }

    #[DataProvider('templates')]
    public function test_personal_link_shows_guest_name_and_prefills_rsvp(string $template): void
    {
        $invitation = $this->makeInvitation($template);

        $this->get($invitation->personalUrl())
            ->assertOk()
            ->assertSee('Bapak Ahmad &amp; Keluarga', false)
            ->assertDontSee('Dear Special Guest')
            ->assertSee('value="Bapak Ahmad &amp; Keluarga"', false)
            ->assertSee('name="invitation" value="' . $invitation->code . '"', false);
    }

    #[DataProvider('templates')]
    public function test_public_link_uses_generic_greeting_or_to_parameter(string $template): void
    {
        $this->makeInvitation($template);

        $this->get('/u/rina-dimas')
            ->assertOk()
            ->assertSee('Bapak/Ibu/Saudara/i')
            ->assertDontSee('name="invitation"', false);

        // ?to= di-escape, tidak bisa menyisipkan HTML
        $this->get('/u/rina-dimas?to=' . urlencode('Keluarga Besar <b>Budi</b>'))
            ->assertOk()
            ->assertSee('Keluarga Besar &lt;b&gt;Budi&lt;/b&gt;', false);
    }

    public function test_rsvp_from_personal_link_is_linked_to_the_invitation(): void
    {
        $invitation = $this->makeInvitation();

        $this->rsvp($invitation)->assertCreated();

        $guest = $invitation->fresh()->guest;
        $this->assertNotNull($guest);
        $this->assertSame(3, $guest->number_of_guests);
    }

    public function test_resubmitting_updates_the_same_answer(): void
    {
        $invitation = $this->makeInvitation();

        $this->rsvp($invitation, ['email' => 'ahmad@example.com'])->assertCreated();
        $this->rsvp($invitation, ['email' => 'ahmad@example.com', 'attendance' => 'tidak_hadir', 'number_of_guests' => 1])
            ->assertOk()
            ->assertJsonPath('message', 'Terima kasih! Jawaban RSVP Anda telah diperbarui.');

        $this->assertSame(1, $invitation->event->guests()->count());
        $this->assertSame('tidak_hadir', $invitation->fresh()->guest->attendance);
    }

    public function test_unknown_or_other_event_code_is_saved_as_plain_rsvp(): void
    {
        $invitation = $this->makeInvitation();
        $other = Event::create(['bride_name' => 'Sari', 'groom_name' => 'Budi'])
            ->invitations()->create(['name' => 'Tamu Sari']);

        $this->rsvp($invitation, ['invitation' => $other->code])->assertCreated();
        $this->rsvp($invitation, ['invitation' => 'tidakada', 'name' => 'Orang Lain'])->assertCreated();

        $this->assertNull($invitation->fresh()->guest_id);
        $this->assertNull($other->fresh()->guest_id);
        $this->assertSame(2, $invitation->event->guests()->count());
    }

    public function test_form_based_template_redirects_back_to_personal_link(): void
    {
        $invitation = $this->makeInvitation('template-4');

        $this->from($invitation->personalUrl())
            ->post('/u/rina-dimas/rsvp', [
                'invitation' => $invitation->code,
                'name' => 'Bapak Ahmad & Keluarga',
                'number_of_guests' => 2,
                'attendance' => 'hadir',
            ])
            ->assertRedirect($invitation->personalUrl() . '#rsvp');

        $this->assertNotNull($invitation->fresh()->guest_id);
    }

    public function test_admin_sees_rsvp_status_per_invitation(): void
    {
        $invitation = $this->makeInvitation();
        $invitation->event->update(['user_id' => ($client = User::factory()->create(['role' => User::ROLE_CLIENT]))->id]);
        $invitation->event->invitations()->create(['name' => 'Belum Jawab']);

        $this->rsvp($invitation)->assertCreated();

        $this->actingAs($client)
            ->get('/admin/invitations')
            ->assertOk()
            ->assertSee('Attending &middot; 3 people', false)
            ->assertSee('No reply');
    }
}
