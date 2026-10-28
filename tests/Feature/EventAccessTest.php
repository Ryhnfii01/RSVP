<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventAccessTest extends TestCase
{
    use RefreshDatabase;

    private User $superAdmin;
    private User $client;
    private Event $ownEvent;
    private Event $otherEvent;

    protected function setUp(): void
    {
        parent::setUp();

        $this->superAdmin = User::factory()->create(['role' => User::ROLE_SUPER_ADMIN]);
        $this->client = User::factory()->create(['role' => User::ROLE_CLIENT]);

        $this->ownEvent = Event::create([
            'user_id' => $this->client->id,
            'bride_name' => 'Rina Amelia',
            'groom_name' => 'Dimas Pratama',
            'template' => 'template-2',
            'is_active' => true,
        ]);

        $this->otherEvent = Event::create([
            'bride_name' => 'Sari Wulandari',
            'groom_name' => 'Budi Hartono',
            'template' => 'template-4',
            'is_active' => false,
        ]);

        $this->ownEvent->guests()->create(['name' => 'Tamu Rina', 'email' => 'a@example.com', 'attendance' => 'hadir']);
        $this->otherEvent->guests()->create(['name' => 'Tamu Sari', 'email' => 'b@example.com', 'attendance' => 'hadir']);
    }

    public function test_slug_is_generated_from_nicknames(): void
    {
        $this->assertSame('rina-dimas', $this->ownEvent->slug);
        $this->assertSame('sari-budi', $this->otherEvent->slug);
    }

    public function test_public_invitation_uses_the_event_template(): void
    {
        $this->get('/u/rina-dimas')->assertOk()->assertViewIs('templates.template-2.index');
        $this->get('/u/sari-budi')->assertOk()->assertViewIs('templates.template-4.index');
        $this->get('/u/tidak-ada')->assertNotFound();
    }

    public function test_rsvp_is_stored_on_the_event_of_the_link(): void
    {
        $this->postJson('/u/sari-budi/rsvp', [
            'name' => 'Tamu Baru',
            'email' => 'a@example.com',
            'number_of_guests' => 1,
            'attendance' => 'hadir',
        ])->assertCreated();

        $this->assertSame(2, $this->otherEvent->guests()->count());

        // Email yang sama di acara yang sama ditolak
        $this->postJson('/u/sari-budi/rsvp', [
            'name' => 'Tamu Baru',
            'email' => 'a@example.com',
            'number_of_guests' => 1,
            'attendance' => 'hadir',
        ])->assertUnprocessable();
    }

    public function test_client_only_sees_own_guests(): void
    {
        $this->actingAs($this->client)
            ->get('/admin/guests')
            ->assertOk()
            ->assertSee('Tamu Rina')
            ->assertDontSee('Tamu Sari');

        $otherGuestId = $this->otherEvent->guests()->value('id');

        $this->actingAs($this->client)->get("/admin/guests/{$otherGuestId}")->assertNotFound();
        $this->actingAs($this->client)->delete("/admin/guests/{$otherGuestId}")->assertNotFound();
    }

    public function test_client_cannot_switch_event(): void
    {
        $this->actingAs($this->client)
            ->post('/admin/switch-event', ['event_id' => $this->otherEvent->id])
            ->assertForbidden();
    }

    public function test_client_settings_update_own_event_and_cannot_change_owner(): void
    {
        $this->actingAs($this->client)
            ->put('/admin/event-settings', [
                'event_type' => 'wedding',
                'template' => 'template-3',
                'time_zone' => 'WITA',
                'bride_name' => 'Rina Amelia',
                'groom_name' => 'Dimas Pratama',
                'user_id' => $this->superAdmin->id,
            ])
            ->assertRedirect(route('admin.settings'));

        $this->assertSame('template-3', $this->ownEvent->fresh()->template);
        $this->assertSame($this->client->id, $this->ownEvent->fresh()->user_id);
        $this->assertSame('template-4', $this->otherEvent->fresh()->template);
    }

    public function test_super_admin_can_switch_between_events(): void
    {
        $this->actingAs($this->superAdmin)
            ->get('/admin/guests')
            ->assertSee('Tamu Rina')
            ->assertDontSee('Tamu Sari');

        $this->actingAs($this->superAdmin)
            ->from('/admin/guests')
            ->post('/admin/switch-event', ['event_id' => $this->otherEvent->id])
            ->assertRedirect('/admin/guests');

        $this->actingAs($this->superAdmin)
            ->get('/admin/guests')
            ->assertSee('Tamu Sari')
            ->assertDontSee('Tamu Rina');
    }

    public function test_super_admin_can_assign_owner(): void
    {
        $this->actingAs($this->superAdmin)
            ->withSession(['admin_event_id' => $this->otherEvent->id])
            ->put('/admin/event-settings', [
                'event_type' => 'wedding',
                'template' => 'template-4',
                'time_zone' => 'WIB',
                'bride_name' => 'Sari Wulandari',
                'groom_name' => 'Budi Hartono',
                'user_id' => $this->client->id,
            ])
            ->assertRedirect(route('admin.settings'));

        $this->assertSame($this->client->id, $this->otherEvent->fresh()->user_id);
    }

    public function test_client_without_event_sees_empty_dashboard(): void
    {
        $newClient = User::factory()->create(['role' => User::ROLE_CLIENT]);

        $this->actingAs($newClient)
            ->get('/admin/guests')
            ->assertOk()
            ->assertDontSee('Tamu Rina')
            ->assertDontSee('Tamu Sari');
    }
}
