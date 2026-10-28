<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class InvitationListTest extends TestCase
{
    use RefreshDatabase;

    private User $client;
    private Event $event;
    private Event $otherEvent;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = User::factory()->create(['role' => User::ROLE_CLIENT]);
        $this->event = Event::create(['user_id' => $this->client->id, 'bride_name' => 'Rina', 'groom_name' => 'Dimas', 'is_active' => true]);
        $this->otherEvent = Event::create(['bride_name' => 'Sari', 'groom_name' => 'Budi']);
    }

    private function csv(string $content): UploadedFile
    {
        return UploadedFile::fake()->createWithContent('tamu.csv', $content);
    }

    public function test_add_guest_creates_unique_personal_link(): void
    {
        $this->actingAs($this->client)
            ->post('/admin/invitations', ['name' => 'Bapak Ahmad', 'phone' => '0812-3456-7890', 'group' => 'Keluarga'])
            ->assertRedirect(route('admin.invitations.index'));

        $invitation = $this->event->invitations()->firstOrFail();

        $this->assertSame('6281234567890', $invitation->phone);
        $this->assertMatchesRegularExpression('/^[a-z0-9]{8}$/', $invitation->code);
        $this->assertSame(url("/u/rina-dimas/{$invitation->code}"), $invitation->personalUrl());

        $this->actingAs($this->client)
            ->get('/admin/invitations')
            ->assertOk()
            ->assertSee('Bapak Ahmad')
            ->assertSee($invitation->personalUrl());
    }

    public function test_import_csv_with_header_semicolons_and_duplicates(): void
    {
        $this->event->invitations()->create(['name' => 'Siti', 'phone' => '081200000001']);

        $content = "\xEF\xBB\xBFNama;Nomor HP;Kelompok\n"
            . "Bapak Ahmad;0812 3456 7890;Keluarga\n"
            . "siti;+62 812-0000-0001;Teman\n"   // sudah ada (nama + nomor sama)
            . ";081111111111;Kosong\n"           // nama kosong
            . "Bapak Ahmad;081234567890;Keluarga\n" // duplikat di file yang sama
            . "Rudi;;Kantor\n";

        $this->actingAs($this->client)
            ->post('/admin/invitations/import', ['file' => $this->csv($content)])
            ->assertRedirect(route('admin.invitations.index'))
            ->assertSessionHas('success', '2 tamu ditambahkan dari CSV. 3 baris dilewati (kosong atau sudah ada).');

        $this->assertSame(['Bapak Ahmad', 'Rudi', 'Siti'], $this->event->invitations()->orderBy('name')->pluck('name')->all());
        $this->assertSame('Kantor', $this->event->invitations()->where('name', 'Rudi')->value('group'));
        $this->assertNull($this->event->invitations()->where('name', 'Rudi')->value('phone'));
    }

    public function test_example_csv_can_be_imported_as_is(): void
    {
        $example = $this->actingAs($this->client)->get('/admin/invitations/template.csv')->assertOk()->getContent();

        $this->actingAs($this->client)
            ->post('/admin/invitations/import', ['file' => $this->csv($example)])
            ->assertSessionHas('success', '2 tamu ditambahkan dari CSV.');
    }

    public function test_personal_link_opens_invitation_and_records_first_open(): void
    {
        $invitation = $this->event->invitations()->create(['name' => 'Bapak Ahmad']);

        $this->travelTo(now()->setDate(2026, 11, 1)->setTime(10, 0));
        $this->get($invitation->personalUrl())->assertOk()->assertSee('Rina');
        $firstOpen = $invitation->fresh()->opened_at;
        $this->assertNotNull($firstOpen);

        // Dibuka lagi: waktu pertama tidak berubah
        $this->travelTo(now()->addDay());
        $this->get($invitation->personalUrl())->assertOk();
        $this->assertTrue($firstOpen->equalTo($invitation->fresh()->opened_at));
    }

    public function test_personal_link_only_works_for_its_own_event(): void
    {
        $invitation = $this->event->invitations()->create(['name' => 'Bapak Ahmad']);

        $this->get("/u/sari-budi/{$invitation->code}")->assertNotFound();
        $this->get('/u/rina-dimas/salahkode')->assertNotFound();
    }

    public function test_client_cannot_see_or_remove_other_events_guests(): void
    {
        $other = $this->otherEvent->invitations()->create(['name' => 'Tamu Sari']);

        $this->actingAs($this->client)->get('/admin/invitations')->assertDontSee('Tamu Sari');
        $this->actingAs($this->client)->delete("/admin/invitations/{$other->id}")->assertNotFound();
        $this->assertNotNull($other->fresh());
    }

    public function test_remove_guest_from_list(): void
    {
        $invitation = $this->event->invitations()->create(['name' => 'Bapak Ahmad']);

        $this->actingAs($this->client)
            ->delete("/admin/invitations/{$invitation->id}")
            ->assertRedirect(route('admin.invitations.index'));

        $this->assertNull(Invitation::find($invitation->id));
        $this->get($invitation->personalUrl())->assertNotFound();
    }

    public function test_import_rejects_non_csv_file(): void
    {
        $this->actingAs($this->client)
            ->post('/admin/invitations/import', ['file' => UploadedFile::fake()->create('foto.png', 10, 'image/png')])
            ->assertSessionHasErrors('file');
    }
}
