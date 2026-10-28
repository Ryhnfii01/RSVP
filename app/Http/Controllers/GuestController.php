<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GuestController extends Controller
{
    public function index()
    {
        $guests = Guest::latest()->paginate(20);
        return view('admin.guests.index', compact('guests'));
    }

    /**
     * Simpan RSVP. Dari /u/{slug}/rsvp acaranya ikut route;
     * dari halaman demo /template-N RSVP masuk ke acara aktif.
     */
    public function store(Request $request, ?Event $event = null)
    {
        if (! $event?->exists) {
            $event = Event::getActive();
        }

        abort_unless($event, 404);

        // Template 1-3 mengirim body JSON lewat fetch tanpa header Accept;
        // pastikan error validasi juga dibalas sebagai JSON
        $wantsJson = $request->isJson() || $request->expectsJson();
        if ($wantsJson) {
            $request->headers->set('Accept', 'application/json');
        }

        // Dikirim dari link personal: hubungkan ke tamu undangan.
        // Kirim ulang dari link yang sama memperbarui jawaban lama, bukan menambah baru.
        $invitation = $request->filled('invitation')
            ? $event->invitations()->where('code', $request->input('invitation'))->first()
            : null;
        $existingGuest = $invitation?->guest;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'nullable',
                'email',
                Rule::unique('guests', 'email')->where('event_id', $event->id)->ignore($existingGuest?->id),
            ],
            'phone' => 'nullable|string|max:20',
            'number_of_guests' => 'required|integer|min:1|max:5',
            'message' => 'nullable|string|max:1000',
            'attendance' => 'required|in:hadir,tidak_hadir,masih_ragu',
        ], [
            'email.unique' => 'Email ini sudah mengirim RSVP untuk acara ini.',
        ]);

        $guest = $existingGuest ?? $event->guests()->make();
        $guest->fill($validated);

        // Status ucapan ditentukan ulang hanya jika teksnya baru atau berubah
        if (! $guest->exists || $guest->isDirty('message')) {
            $guest->message_status = $guest->wishStatusAfterChange($event);
        }

        $guest->save();

        $message = $existingGuest
            ? 'Terima kasih! Jawaban RSVP Anda telah diperbarui.'
            : 'Terima kasih! RSVP Anda telah berhasil dikirim.';

        if (filled($guest->message) && $guest->message_status === Guest::WISH_PENDING) {
            $message .= ' Ucapan Anda akan tampil setelah disetujui.';
        }

        if ($invitation && $invitation->guest_id !== $guest->id) {
            $invitation->forceFill(['guest_id' => $guest->id])->save();
        }

        // Template 1-3 mengirim lewat fetch (JSON); template 4 memakai form biasa
        if ($wantsJson) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $guest
            ], $existingGuest ? 200 : 201);
        }

        return redirect()->to(url()->previous() . '#rsvp')->with('rsvp_success', $message);
    }

    public function show(Guest $guest)
    {
        return response()->json($guest);
    }

    public function update(Request $request, Guest $guest)
    {
        $validated = $request->validate([
            'is_confirmed' => 'boolean',
        ]);

        $guest->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Guest updated successfully',
            'data' => $guest
        ]);
    }

    public function destroy(Guest $guest)
    {
        $guest->delete();

        return response()->json([
            'success' => true,
            'message' => 'Guest deleted successfully'
        ]);
    }
}
