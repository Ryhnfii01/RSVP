<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * F-11: ringkasan dan grafik RSVP di dashboard.
 */
class DashboardTest extends TestCase
{
    use RefreshDatabase;

    private User $client;
    private Event $event;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = User::factory()->create(['role' => User::ROLE_CLIENT]);
        $this->event = Event::create([
            'user_id' => $this->client->id,
            'bride_name' => 'Rina',
            'groom_name' => 'Dimas',
            'event_date' => now()->addDays(10),
        ]);
    }

    public function test_summary_counts_responses_and_people(): void
    {
        $this->event->guests()->create(['name' => 'A', 'attendance' => 'hadir', 'number_of_guests' => 2]);
        $this->event->guests()->create(['name' => 'B', 'attendance' => 'hadir', 'number_of_guests' => 3]);
        $this->event->guests()->create(['name' => 'C', 'attendance' => 'tidak_hadir', 'number_of_guests' => 1]);

        // Tamu acara lain tidak ikut dihitung
        Event::create(['bride_name' => 'Sari', 'groom_name' => 'Budi'])
            ->guests()->create(['name' => 'X', 'attendance' => 'hadir', 'number_of_guests' => 9]);

        $this->actingAs($this->client)->get('/admin')
            ->assertOk()
            ->assertViewHas('totalResponses', 3)
            ->assertViewHas('attendance', fn ($a) => $a['hadir'] === ['responses' => 2, 'people' => 5]
                && $a['tidak_hadir'] === ['responses' => 1, 'people' => 1]
                && $a['masih_ragu'] === ['responses' => 0, 'people' => 0])
            ->assertViewHas('daysLeft', 10)
            ->assertSee('days to go');
    }

    public function test_funnel_counts_sent_opened_and_replied_links(): void
    {
        $guest = $this->event->guests()->create(['name' => 'A', 'attendance' => 'hadir']);

        $this->event->invitations()->create(['name' => 'A'])
            ->forceFill(['sent_at' => now(), 'opened_at' => now(), 'guest_id' => $guest->id])->save();
        $this->event->invitations()->create(['name' => 'B'])
            ->forceFill(['sent_at' => now(), 'opened_at' => now()])->save();
        $this->event->invitations()->create(['name' => 'C'])
            ->forceFill(['sent_at' => now()])->save();
        $this->event->invitations()->create(['name' => 'D']);

        $this->actingAs($this->client)->get('/admin')
            ->assertViewHas('funnel', ['created' => 4, 'sent' => 3, 'opened' => 2, 'replied' => 1])
            ->assertSee('50%');
    }

    public function test_daily_chart_covers_14_days_including_empty_ones(): void
    {
        $this->event->guests()->create(['name' => 'A', 'attendance' => 'hadir']);
        $old = $this->event->guests()->create(['name' => 'B', 'attendance' => 'hadir']);
        $old->forceFill(['created_at' => now()->subDays(3)])->save();
        $tooOld = $this->event->guests()->create(['name' => 'C', 'attendance' => 'hadir']);
        $tooOld->forceFill(['created_at' => now()->subDays(30)])->save();

        $this->actingAs($this->client)->get('/admin')
            ->assertViewHas('daily', function ($daily) {
                return $daily->count() === 14
                    && $daily->last()['total'] === 1
                    && $daily[10]['total'] === 1
                    && $daily->sum('total') === 2;
            });
    }

    public function test_empty_event_shows_friendly_empty_states(): void
    {
        $this->actingAs($this->client)->get('/admin')
            ->assertOk()
            ->assertSee('No personal links yet')
            ->assertSee('No RSVP yet');
    }
}
