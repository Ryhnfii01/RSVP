<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SuperAdminPanelTest extends TestCase
{
    use RefreshDatabase;

    private User $superAdmin;
    private User $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->superAdmin = User::factory()->create(['role' => User::ROLE_SUPER_ADMIN]);
        $this->client = User::factory()->create(['role' => User::ROLE_CLIENT, 'name' => 'Klien Lama']);
    }

    public function test_client_cannot_open_super_admin_pages(): void
    {
        $this->actingAs($this->client)->get('/admin/events')->assertForbidden();
        $this->actingAs($this->client)->get('/admin/events/create')->assertForbidden();
        $this->actingAs($this->client)->get('/admin/clients')->assertForbidden();
        $this->actingAs($this->client)->post('/admin/clients', [
            'name' => 'X', 'email' => 'x@example.com',
        ])->assertForbidden();
    }

    public function test_event_list_shows_all_events_with_guest_counts(): void
    {
        $event = Event::create(['bride_name' => 'Rina', 'groom_name' => 'Dimas', 'user_id' => $this->client->id]);
        $event->guests()->create(['name' => 'Tamu', 'attendance' => 'hadir']);
        Event::create(['bride_name' => 'Sari', 'groom_name' => 'Budi']);

        $this->actingAs($this->superAdmin)
            ->get('/admin/events')
            ->assertOk()
            ->assertSee('Rina &amp; Dimas', false)
            ->assertSee('Sari &amp; Budi', false)
            ->assertSee('Klien Lama');
    }

    public function test_create_event_with_new_client_account(): void
    {
        $this->actingAs($this->superAdmin)
            ->post('/admin/events', [
                'bride_name' => 'Ayu Lestari',
                'groom_name' => 'Fajar Nugroho',
                'event_date' => '2027-05-01',
                'template' => 'template-3',
                'owner' => 'new',
                'client_name' => 'Ayu & Fajar',
                'client_email' => 'ayu@example.com',
                'client_phone' => '0812-1111-2222',
            ])
            ->assertRedirect(route('admin.event-settings.edit'))
            ->assertSessionHas('client_credentials');

        $event = Event::where('slug', 'ayu-fajar')->firstOrFail();
        $owner = User::where('email', 'ayu@example.com')->firstOrFail();

        $this->assertSame('template-3', $event->template);
        $this->assertSame($owner->id, $event->user_id);
        $this->assertSame(User::ROLE_CLIENT, $owner->role);
        // Password sementara digenerate sistem dan ditampilkan sekali lewat session
        $password = session('client_credentials')['password'];
        $this->assertMatchesRegularExpression('/^[a-z2-9]{4}-[a-z2-9]{4}-[a-z2-9]{4}$/', $password);
        $this->assertTrue(Hash::check($password, $owner->password));
        $this->assertTrue($owner->must_change_password);
        $this->assertSame('6281211112222', $owner->phone);

        // Super admin langsung mengelola acara baru
        $this->assertSame($event->id, session('admin_event_id'));

        // Client baru bisa login dan hanya mengelola acaranya
        $this->assertSame($event->id, Event::managedBy($owner)->id);
    }

    public function test_create_event_with_existing_client_or_without_owner(): void
    {
        $this->actingAs($this->superAdmin)->post('/admin/events', [
            'bride_name' => 'Rina', 'groom_name' => 'Dimas', 'template' => 'template-1',
            'owner' => 'existing', 'user_id' => $this->client->id,
        ])->assertRedirect();

        $this->actingAs($this->superAdmin)->post('/admin/events', [
            'bride_name' => 'Sari', 'groom_name' => 'Budi', 'template' => 'template-1',
            'owner' => 'none', 'slug' => 'Sari Budi 2027',
        ])->assertRedirect();

        $this->assertSame($this->client->id, Event::where('slug', 'rina-dimas')->value('user_id'));
        $this->assertNull(Event::where('slug', 'sari-budi-2027')->value('user_id'));
    }

    public function test_create_event_validates_new_client_fields_and_duplicate_slug(): void
    {
        Event::create(['bride_name' => 'Rina', 'groom_name' => 'Dimas']);

        $this->actingAs($this->superAdmin)
            ->post('/admin/events', [
                'bride_name' => 'Rina', 'groom_name' => 'Dimas', 'template' => 'template-1',
                'slug' => 'rina-dimas',
                'owner' => 'new',
                'client_email' => $this->client->email,
            ])
            ->assertSessionHasErrors(['slug', 'client_name', 'client_email']);

        $this->assertSame(1, Event::count());
    }

    public function test_manage_switches_the_current_event(): void
    {
        $event = Event::create(['bride_name' => 'Sari', 'groom_name' => 'Budi']);

        $this->actingAs($this->superAdmin)
            ->post("/admin/events/{$event->id}/manage")
            ->assertRedirect(route('admin.dashboard'));

        $this->assertSame($event->id, session('admin_event_id'));
    }

    public function test_super_admin_can_add_client_and_reset_password(): void
    {
        $this->actingAs($this->superAdmin)
            ->post('/admin/clients', ['name' => 'Baru', 'email' => 'baru@example.com'])
            ->assertRedirect(route('admin.clients.index'));

        $client = User::where('email', 'baru@example.com')->firstOrFail();
        $this->assertSame(User::ROLE_CLIENT, $client->role);

        $this->actingAs($this->superAdmin)
            ->put("/admin/clients/{$client->id}/password")
            ->assertRedirect(route('admin.clients.index'));

        $this->assertTrue(Hash::check(session('client_credentials')['password'], $client->fresh()->password));
    }

    public function test_super_admin_password_cannot_be_reset_from_client_page(): void
    {
        $this->actingAs($this->superAdmin)
            ->put("/admin/clients/{$this->superAdmin->id}/password")
            ->assertNotFound();
    }
}
