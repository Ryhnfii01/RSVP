<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Guest;
use Illuminate\Http\Request;

/**
 * Moderasi ucapan tamu (F-10) untuk acara yang sedang dikelola.
 */
class WishController extends Controller
{
    public const FILTERS = [
        Guest::WISH_PENDING => 'Waiting for approval',
        Guest::WISH_VISIBLE => 'Shown',
        Guest::WISH_HIDDEN => 'Hidden',
    ];

    private function currentEvent(): Event
    {
        $event = Event::managedBy(auth()->user());

        abort_unless($event, 404, 'Belum ada acara. Isi data acara di Settings terlebih dahulu.');

        return $event;
    }

    private function authorizeGuest(Guest $guest): void
    {
        abort_unless($guest->event_id === $this->currentEvent()->id, 404);
    }

    public function index(Request $request)
    {
        $event = $this->currentEvent();
        $status = array_key_exists($request->input('status'), self::FILTERS) ? $request->input('status') : null;

        $wishes = $event->guests()
            ->withWish()
            ->when($status, fn ($query) => $query->where('message_status', $status))
            ->latest()
            ->paginate(30)
            ->withQueryString();

        $counts = $event->guests()->withWish()
            ->selectRaw('message_status, count(*) as total')
            ->groupBy('message_status')
            ->pluck('total', 'message_status');

        $filters = self::FILTERS;

        return view('admin.wishes.index', compact('event', 'wishes', 'counts', 'status', 'filters'));
    }

    /**
     * Aktif/nonaktifkan "periksa dulu sebelum tampil".
     */
    public function updateSettings(Request $request)
    {
        $moderate = $request->boolean('moderate_wishes');
        $this->currentEvent()->update(['moderate_wishes' => $moderate]);

        return back()->with('success', $moderate
            ? 'Ucapan baru sekarang menunggu persetujuan sebelum tampil.'
            : 'Ucapan baru sekarang langsung tampil di undangan.');
    }

    /**
     * Ubah status satu ucapan: tampilkan (setujui) atau sembunyikan.
     */
    public function updateStatus(Request $request, Guest $guest)
    {
        $this->authorizeGuest($guest);

        $status = $request->validate(['status' => 'required|in:visible,hidden'])['status'];
        $guest->forceFill(['message_status' => $status])->save();

        return back()->with('success', $status === Guest::WISH_VISIBLE
            ? "Ucapan dari {$guest->name} ditampilkan."
            : "Ucapan dari {$guest->name} disembunyikan.");
    }

    /**
     * Setujui semua ucapan yang menunggu.
     */
    public function approveAll()
    {
        $count = $this->currentEvent()->guests()
            ->withWish()
            ->where('message_status', Guest::WISH_PENDING)
            ->update(['message_status' => Guest::WISH_VISIBLE]);

        return back()->with('success', "{$count} ucapan disetujui dan ditampilkan.");
    }

    /**
     * Hapus teks ucapan. Jawaban RSVP tamu (kehadiran, jumlah orang) tetap disimpan.
     */
    public function destroy(Guest $guest)
    {
        $this->authorizeGuest($guest);

        $guest->forceFill(['message' => null, 'message_status' => Guest::WISH_VISIBLE])->save();

        return back()->with('success', "Ucapan dari {$guest->name} dihapus. Data RSVP-nya tetap tersimpan.");
    }
}
