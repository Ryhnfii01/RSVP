<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * F-12: edit tamu undangan, filter status/kelompok, dan export.
 */
class InvitationManageTest extends TestCase
{
    use RefreshDatabase;

    private User $client;
    private Event $event;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = User::factory()->create(['role' => User::ROLE_CLIENT]);
        $this->event = Event::create(['user_id' => $this->client->id, 'bride_name' => 'Rina', 'groom_name' => 'Dimas']);

        // Satu tamu untuk tiap tahap: belum dikirim, dikirim, dibuka, hadir, tidak hadir
        $this->event->invitations()->create(['name' => 'A Belum Dikirim', 'group' => 'Keluarga']);
        $this->guest('B Sudah Dikirim', 'Teman', sent: true);
        $this->guest('C Sudah Dibuka', 'Teman', sent: true, opened: true);
        $this->guest('D Hadir', 'Keluarga', sent: true, opened: true, attendance: 'hadir');
        $this->guest('E Tidak Hadir', 'Kantor', sent: true, opened: true, attendance: 'tidak_hadir');
    }

    private function guest(string $name, string $group, bool $sent = false, bool $opened = false, ?string $attendance = null): Invitation
    {
        $invitation = $this->event->invitations()->create(['name' => $name, 'group' => $group, 'phone' => '081200000000']);
        $invitation->forceFill([
            'sent_at' => $sent ? now() : null,
            'opened_at' => $opened ? now() : null,
        ]);

        if ($attendance) {
            $guest = $this->event->guests()->create(['name' => $name, 'attendance' => $attendance, 'number_of_guests' => 2, 'message' => 'Selamat']);
            $invitation->guest_id = $guest->id;
        }

        $invitation->save();

        return $invitation;
    }

    private function names(array $query): array
    {
        return $this->actingAs($this->client)
            ->get('/admin/invitations?' . http_build_query($query))
            ->assertOk()
            ->viewData('invitations')
            ->pluck('name')
            ->all();
    }

    public function test_status_filters(): void
    {
        $this->assertSame(['A Belum Dikirim'], $this->names(['status' => 'not_sent']));
        $this->assertSame(['A Belum Dikirim', 'B Sudah Dikirim'], $this->names(['status' => 'not_opened']));
        $this->assertSame(['A Belum Dikirim', 'B Sudah Dikirim', 'C Sudah Dibuka'], $this->names(['status' => 'no_reply']));
        $this->assertSame(['D Hadir'], $this->names(['status' => 'attending']));
        $this->assertSame(['E Tidak Hadir'], $this->names(['status' => 'not_attending']));
        $this->assertCount(5, $this->names(['status' => 'tidak-dikenal']));
    }

    public function test_group_filter_combines_with_status_and_search(): void
    {
        $this->assertSame(['A Belum Dikirim', 'D Hadir'], $this->names(['group' => 'Keluarga']));
        $this->assertSame(['D Hadir'], $this->names(['group' => 'Keluarga', 'status' => 'attending']));
        $this->assertSame(['C Sudah Dibuka'], $this->names(['group' => 'Teman', 'search' => 'Dibuka']));
    }

    public function test_edit_keeps_personal_link(): void
    {
        $invitation = $this->event->invitations()->where('name', 'A Belum Dikirim')->first();
        $link = $invitation->personalUrl();

        $this->actingAs($this->client)->get("/admin/invitations/{$invitation->id}/edit")->assertOk()->assertSee($link);

        $this->actingAs($this->client)
            ->put("/admin/invitations/{$invitation->id}", ['name' => 'Bapak Ahmad', 'phone' => '0813 1111 2222', 'group' => 'Tetangga'])
            ->assertRedirect(route('admin.invitations.index'));

        $invitation->refresh();
        $this->assertSame('Bapak Ahmad', $invitation->name);
        $this->assertSame('6281311112222', $invitation->phone);
        $this->assertSame('Tetangga', $invitation->group);
        $this->assertSame($link, $invitation->personalUrl());
    }

    public function test_client_cannot_edit_other_events_guest(): void
    {
        $other = Event::create(['bride_name' => 'Sari', 'groom_name' => 'Budi'])->invitations()->create(['name' => 'Tamu Sari']);

        $this->actingAs($this->client)->get("/admin/invitations/{$other->id}/edit")->assertNotFound();
        $this->actingAs($this->client)->put("/admin/invitations/{$other->id}", ['name' => 'Diubah'])->assertNotFound();
        $this->assertSame('Tamu Sari', $other->fresh()->name);
    }

    public function test_export_follows_filter_and_is_excel_friendly(): void
    {
        $this->event->invitations()->create(['name' => '=HYPERLINK("http://jahat")', 'group' => 'Keluarga']);

        $csv = $this->actingAs($this->client)
            ->get('/admin/invitations/export.csv?group=Keluarga')
            ->assertOk()
            ->assertHeader('Content-Type', 'text/csv; charset=UTF-8')
            ->streamedContent();

        $this->assertStringStartsWith("\xEF\xBB\xBFNama;\"Nomor HP\";Kelompok;\"Link Undangan\"", $csv);
        $this->assertStringContainsString('"D Hadir";0812-0000-0000;Keluarga;', $csv);
        $this->assertStringContainsString(';Hadir;2;Selamat', $csv);
        $this->assertStringContainsString('Belum menjawab', $csv);
        $this->assertStringNotContainsString('Teman', $csv);
        // Rumus Excel dinetralkan
        $this->assertStringContainsString("'=HYPERLINK", $csv);
    }

    public function test_exported_file_can_be_imported_back(): void
    {
        $csv = $this->actingAs($this->client)->get('/admin/invitations/export.csv')->streamedContent();

        $otherClient = User::factory()->create(['role' => User::ROLE_CLIENT]);
        $otherEvent = Event::create(['user_id' => $otherClient->id, 'bride_name' => 'Ayu', 'groom_name' => 'Fajar']);

        $this->actingAs($otherClient)
            ->post('/admin/invitations/import', ['file' => \Illuminate\Http\UploadedFile::fake()->createWithContent('export.csv', $csv)])
            ->assertSessionHas('success', '5 tamu ditambahkan dari CSV.');

        $this->assertSame('6281200000000', $otherEvent->invitations()->where('name', 'D Hadir')->value('phone'));
    }

    public function test_admin_shows_dummy_whatsapp_sender(): void
    {
        config(['whatsapp.sender_number' => '6280000000000', 'whatsapp.sender_is_dummy' => true]);

        $this->actingAs($this->client)
            ->get('/admin/invitations')
            ->assertSee('+6280000000000')
            ->assertSee('dummy');
    }
}
