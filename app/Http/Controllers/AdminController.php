<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Event;
use App\Models\User;
use App\Support\Csv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Acara yang sedang dikelola user yang login.
     */
    private function currentEvent(): ?Event
    {
        return Event::managedBy(auth()->user());
    }

    /**
     * Tamu milik acara yang sedang dikelola.
     */
    private function guestQuery()
    {
        $event = $this->currentEvent();

        return $event ? $event->guests()->getQuery() : Guest::query()->whereRaw('1 = 0');
    }

    /**
     * Show admin dashboard.
     */
    public function dashboard()
    {
        $event = $this->currentEvent();

        // Jawaban RSVP per status kehadiran: jumlah jawaban dan jumlah orang
        $byAttendance = $this->guestQuery()
            ->select('attendance', DB::raw('count(*) as responses'), DB::raw('coalesce(sum(number_of_guests), 0) as people'))
            ->groupBy('attendance')
            ->get()
            ->keyBy('attendance');

        $attendance = [];
        foreach (['hadir', 'tidak_hadir', 'masih_ragu'] as $status) {
            $attendance[$status] = [
                'responses' => (int) ($byAttendance[$status]->responses ?? 0),
                'people' => (int) ($byAttendance[$status]->people ?? 0),
            ];
        }
        $totalResponses = array_sum(array_column($attendance, 'responses'));

        // Perjalanan link personal: dibuat -> dikirim -> dibuka -> dibalas
        $funnel = ['created' => 0, 'sent' => 0, 'opened' => 0, 'replied' => 0];
        if ($event) {
            $funnel = [
                'created' => $event->invitations()->count(),
                'sent' => $event->invitations()->whereNotNull('sent_at')->count(),
                'opened' => $event->invitations()->whereNotNull('opened_at')->count(),
                'replied' => $event->invitations()->whereNotNull('guest_id')->count(),
            ];
        }

        // RSVP masuk per hari, 14 hari terakhir (hari tanpa RSVP tetap ditampilkan sebagai 0)
        $from = now()->subDays(13)->startOfDay();
        $perDay = $this->guestQuery()
            ->where('created_at', '>=', $from)
            ->select(DB::raw('DATE(created_at) as day'), DB::raw('count(*) as total'))
            ->groupBy('day')
            ->pluck('total', 'day');

        $daily = collect(range(0, 13))->map(function ($i) use ($from, $perDay) {
            $day = $from->copy()->addDays($i);

            return ['date' => $day, 'total' => (int) ($perDay[$day->toDateString()] ?? 0)];
        });

        $daysLeft = $event?->event_date
            ? (int) now()->startOfDay()->diffInDays($event->event_date->copy()->startOfDay(), false)
            : null;

        $recentGuests = $this->guestQuery()->latest()->limit(10)->get();

        return view('admin.dashboard', compact(
            'event',
            'attendance',
            'totalResponses',
            'funnel',
            'daily',
            'daysLeft',
            'recentGuests'
        ));
    }

    /**
     * Show all guests.
     */
    public function guests(Request $request)
    {
        $query = $this->guestQuery();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Attendance filter
        if ($request->filled('attendance')) {
            $query->where('attendance', $request->input('attendance'));
        }

        // Sort
        $sortBy = $request->input('sort', 'created_at');
        $sortOrder = $request->input('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Paginate
        $guests = $query->paginate(20);

        return view('admin.guests.index', compact('guests'));
    }

    /**
     * Show guest details.
     */
    public function showGuest($id)
    {
        $guest = $this->guestQuery()->findOrFail($id);
        return view('admin.guests.show', compact('guest'));
    }

    /**
     * Delete a guest.
     */
    public function deleteGuest($id)
    {
        $guest = $this->guestQuery()->findOrFail($id);
        $guest->delete();

        return redirect()->route('admin.guests')
            ->with('success', 'Tamu berhasil dihapus.');
    }

    /**
     * Export guests to CSV.
     */
    public function exportGuests()
    {
        $guests = $this->guestQuery()->orderBy('created_at', 'desc')->get();

        $filename = 'guests_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($guests) {
            $file = fopen('php://output', 'w');

            // Header
            fputcsv($file, [
                'ID',
                'Nama',
                'Email',
                'Kehadiran',
                'Jumlah Tamu',
                'Pesan',
                'Tanggal Konfirmasi'
            ]);

            // Data
            foreach ($guests as $guest) {
                // Nama, email, dan pesan diisi tamu sendiri: amankan dari CSV injection
                fputcsv($file, [
                    $guest->id,
                    Csv::text($guest->name),
                    Csv::text($guest->email),
                    $guest->attendance,
                    $guest->number_of_guests,
                    Csv::text($guest->message),
                    $guest->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Show settings page.
     */
    public function settings()
    {
        $event = $this->currentEvent();
        return view('admin.settings', compact('event'));
    }

    /**
     * Show event settings edit form.
     */
    public function editEventSettings()
    {
        $event = $this->currentEvent();

        if (!$event) {
            $event = new Event();
        }

        // Pilihan pemilik acara (hanya untuk super admin)
        $clients = auth()->user()->isSuperAdmin()
            ? User::where('role', User::ROLE_CLIENT)->orderBy('name')->get()
            : collect();

        return view('admin.event-settings', compact('event', 'clients'));
    }

    /**
     * Update event settings.
     */
    public function updateEventSettings(Request $request)
    {
        // Hanya super admin yang boleh menentukan pemilik acara
        if (! auth()->user()->isSuperAdmin()) {
            $request->request->remove('user_id');
        }

        // "Rina Dimas 2027" -> "rina-dimas-2027"
        if ($request->filled('slug')) {
            $request->merge(['slug' => Str::slug($request->input('slug'))]);
        }

        $validated = $request->validate([
            'event_type' => 'required|in:wedding,seminar,aqiqah,birthday,other',
            'template' => ['required', Rule::in(array_keys(Event::TEMPLATES))],
            'slug' => [
                'nullable',
                'alpha_dash',
                'max:100',
                Rule::unique('events', 'slug')->ignore($this->currentEvent()?->id),
            ],
            'bride_name' => 'nullable|string|max:255',
            'bride_nickname' => 'nullable|string|max:255',
            'bride_father' => 'nullable|string|max:255',
            'bride_mother' => 'nullable|string|max:255',
            'groom_name' => 'nullable|string|max:255',
            'groom_nickname' => 'nullable|string|max:255',
            'groom_father' => 'nullable|string|max:255',
            'groom_mother' => 'nullable|string|max:255',
            'event_title' => 'nullable|string|max:255',
            'event_description' => 'nullable|string',
            'event_date' => 'nullable|date',
            'akad_time_start' => 'nullable|date_format:H:i',
            'akad_time_end' => 'nullable|date_format:H:i',
            'event_time_start' => 'nullable|date_format:H:i',
            'event_time_end' => 'nullable|date_format:H:i',
            'time_zone' => 'required|in:WIB,WITA,WIT',
            'venue_name' => 'nullable|string|max:255',
            'venue_address' => 'nullable|string',
            'venue_city' => 'nullable|string|max:255',
            'venue_maps_url' => 'nullable|url:http,https|max:2000',
            'venue_latitude' => 'nullable|numeric',
            'venue_longitude' => 'nullable|numeric',
            'akad_venue_name' => 'nullable|string|max:255',
            'akad_venue_address' => 'nullable|string',
            'akad_maps_url' => 'nullable|url:http,https|max:2000',
            'instagram_bride' => 'nullable|string|max:255',
            'instagram_groom' => 'nullable|string|max:255',
            'love_story' => 'nullable|string',
            'gift_accounts' => 'nullable|array|max:10',
            'gift_accounts.*.type' => 'required|in:bank,ewallet',
            'gift_accounts.*.provider' => 'nullable|string|max:50',
            'gift_accounts.*.number' => 'nullable|string|max:50',
            'gift_accounts.*.holder' => 'nullable|string|max:255',
            'gift_recipient' => 'nullable|string|max:255',
            'gift_address' => 'nullable|string',
            'background_music' => 'nullable|string|max:255',
            'user_id' => [
                'nullable',
                Rule::exists('users', 'id')->where('role', User::ROLE_CLIENT),
            ],
        ]);

        if (! auth()->user()->isSuperAdmin()) {
            unset($validated['user_id']);
        }

        // Baris rekening tanpa nomor dianggap kosong dan tidak disimpan
        $validated['gift_accounts'] = collect($validated['gift_accounts'] ?? [])
            ->filter(fn ($account) => filled($account['number'] ?? null))
            ->values()
            ->all();

        $event = $this->currentEvent();

        if (!$event) {
            $event = new Event($validated);

            // Client yang belum punya acara otomatis menjadi pemiliknya
            if (! auth()->user()->isSuperAdmin()) {
                $event->user_id = auth()->id();
            }

            $event->save();
            session(['admin_event_id' => $event->id]);
        } else {
            $event->update($validated);
        }

        return redirect()->route('admin.settings')
            ->with('success', 'Pengaturan event berhasil disimpan!');
    }

    /**
     * Super admin memilih acara yang dikelola di panel admin.
     */
    public function switchEvent(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);

        session(['admin_event_id' => (int) $validated['event_id']]);

        return redirect()->back();
    }
}
