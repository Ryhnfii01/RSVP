<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Invitation;
use App\Support\Csv;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Daftar orang yang diundang ke acara yang sedang dikelola,
 * masing-masing dengan link personal.
 */
class InvitationListController extends Controller
{
    /** Batas baris per file impor, supaya satu upload tidak membebani server. */
    private const IMPORT_LIMIT = 2000;

    private function currentEvent(): Event
    {
        $event = Event::managedBy(auth()->user());

        abort_unless($event, 404, 'Belum ada acara. Isi data acara di Settings terlebih dahulu.');

        return $event;
    }

    /** Pilihan filter status: kunci => label. */
    public const STATUS_FILTERS = [
        'not_sent' => 'Not sent yet',
        'not_opened' => 'Not opened yet',
        'no_reply' => 'No RSVP reply',
        'attending' => 'Attending',
        'not_attending' => 'Not attending',
    ];

    /**
     * Daftar tamu dengan pencarian, filter status, dan filter kelompok.
     * Dipakai halaman daftar dan export, supaya hasil export sama dengan yang terlihat.
     */
    private function filteredQuery(Request $request, Event $event)
    {
        return $event->invitations()
            ->with('guest')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->input('search');
                $query->where(fn ($q) => $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('group', 'like', "%{$search}%"));
            })
            ->when($request->filled('group'), fn ($query) => $query->where('group', $request->input('group')))
            ->when($request->input('status'), function ($query, $status) {
                match ($status) {
                    'not_sent' => $query->whereNull('sent_at'),
                    'not_opened' => $query->whereNull('opened_at'),
                    'no_reply' => $query->whereNull('guest_id'),
                    'attending' => $query->whereHas('guest', fn ($q) => $q->where('attendance', 'hadir')),
                    'not_attending' => $query->whereHas('guest', fn ($q) => $q->where('attendance', 'tidak_hadir')),
                    default => null,
                };
            })
            ->orderBy('name');
    }

    public function index(Request $request)
    {
        $event = $this->currentEvent();

        $invitations = $this->filteredQuery($request, $event)
            ->paginate(50)
            ->withQueryString();

        $groups = $event->invitations()
            ->whereNotNull('group')
            ->distinct()
            ->orderBy('group')
            ->pluck('group');

        $statusFilters = self::STATUS_FILTERS;

        $stats = [
            'total' => $event->invitations()->count(),
            'opened' => $event->invitations()->whereNotNull('opened_at')->count(),
            'replied' => $event->invitations()->whereNotNull('guest_id')->count(),
            'sent' => $event->invitations()->whereNotNull('sent_at')->count(),
        ];

        // Contoh pesan memakai tamu pertama, atau tamu contoh jika daftar masih kosong
        $previewInvitation = $event->invitations()->orderBy('name')->first()
            ?? $event->invitations()->make(['name' => 'Bapak Ahmad & Keluarga'])->forceFill(['code' => 'contoh12']);

        $preview = $event->waMessageFor($previewInvitation);

        return view('admin.invitations.index', compact('event', 'invitations', 'stats', 'preview', 'groups', 'statusFilters'));
    }

    public function edit(Invitation $invitation)
    {
        $this->authorizeInvitation($invitation);

        return view('admin.invitations.edit', compact('invitation'));
    }

    public function update(Request $request, Invitation $invitation)
    {
        $this->authorizeInvitation($invitation);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'group' => 'nullable|string|max:50',
        ]);

        // Kode link personal tidak berubah, jadi link yang sudah dikirim tetap berlaku
        $invitation->update($validated);

        return redirect()->route('admin.invitations.index')
            ->with('success', "Data {$invitation->name} diperbarui.");
    }

    /**
     * Export CSV (bisa dibuka di Excel / Google Sheets), mengikuti filter yang aktif.
     */
    public function export(Request $request)
    {
        $event = $this->currentEvent();
        $invitations = $this->filteredQuery($request, $event)->get();
        $filename = 'daftar-undangan-' . $event->slug . '-' . now()->format('Y-m-d') . '.csv';
        $time = fn ($value) => $value?->format('Y-m-d H:i') ?? '';

        $text = fn ($value) => Csv::text($value);

        // 6281234567890 -> 0812-3456-7890: tetap teks di Excel dan bisa diimpor ulang
        $phone = fn ($value) => $value
            ? implode('-', str_split('0' . preg_replace('/^62/', '', $value), 4))
            : '';

        return response()->streamDownload(function () use ($invitations, $time, $text, $phone) {
            $out = fopen('php://output', 'w');

            // BOM supaya huruf non-ASCII terbaca benar di Excel;
            // titik koma = pemisah kolom Excel dengan format regional Indonesia
            fwrite($out, "\xEF\xBB\xBF");
            fputcsv($out, ['Nama', 'Nomor HP', 'Kelompok', 'Link Undangan', 'Dikirim', 'Dibuka', 'RSVP', 'Jumlah Orang', 'Ucapan'], ';');

            foreach ($invitations as $invitation) {
                $guest = $invitation->guest;

                fputcsv($out, [
                    $text($invitation->name),
                    $phone($invitation->phone),
                    $text($invitation->group),
                    $invitation->personalUrl(),
                    $time($invitation->sent_at),
                    $time($invitation->opened_at),
                    match ($guest?->attendance) {
                        'hadir' => 'Hadir',
                        'tidak_hadir' => 'Tidak hadir',
                        default => 'Belum menjawab',
                    },
                    $guest?->number_of_guests ?? '',
                    $text($guest?->message),
                ], ';');
            }

            fclose($out);
        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    /**
     * Tamu undangan hanya bisa diubah dari acara pemiliknya.
     */
    private function authorizeInvitation(Invitation $invitation): void
    {
        abort_unless($invitation->event_id === $this->currentEvent()->id, 404);
    }

    /**
     * Simpan template pesan WhatsApp. Kosong = kembali ke pesan bawaan.
     */
    public function updateMessage(Request $request)
    {
        $validated = $request->validate([
            'wa_message' => ['nullable', 'string', 'max:2000', function ($attribute, $value, $fail) {
                if (filled($value) && ! str_contains($value, '{link}')) {
                    $fail('Pesan harus memuat {link} supaya tamu bisa membuka undangannya.');
                }
            }],
        ]);

        $this->currentEvent()->update(['wa_message' => $validated['wa_message'] ?? null]);

        return redirect()->route('admin.invitations.index')
            ->with('success', filled($validated['wa_message'] ?? null)
                ? 'Pesan WhatsApp disimpan.'
                : 'Pesan WhatsApp dikembalikan ke pesan bawaan.');
    }

    /**
     * Catat waktu kirim lalu buka WhatsApp dengan pesan untuk tamu ini.
     */
    public function whatsapp(Invitation $invitation)
    {
        abort_unless($invitation->event_id === $this->currentEvent()->id, 404);

        $invitation->forceFill(['sent_at' => now()])->save();

        return redirect()->away($invitation->whatsappUrl());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'group' => 'nullable|string|max:50',
        ]);

        $this->currentEvent()->invitations()->create($validated);

        return redirect()->route('admin.invitations.index')
            ->with('success', "{$validated['name']} ditambahkan ke daftar undangan.");
    }

    /**
     * Impor CSV: kolom nama, nomor HP, kelompok. Baris judul dan duplikat dilewati.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ], [
            'file.mimes' => 'File harus berformat CSV.',
        ]);

        $event = $this->currentEvent();
        $lines = preg_split('/\r\n|\r|\n/', ltrim(file_get_contents($request->file('file')->getRealPath()), "\xEF\xBB\xBF"));
        $lines = array_values(array_filter($lines, fn ($line) => trim($line) !== ''));

        if (! $lines) {
            return back()->withErrors(['file' => 'File CSV kosong.']);
        }

        // Excel versi Indonesia sering memakai titik koma sebagai pemisah
        $delimiter = substr_count($lines[0], ';') > substr_count($lines[0], ',') ? ';' : ',';

        // Lewati baris judul seperti "nama,nomor_hp,kelompok"
        $first = Str::lower(str_getcsv($lines[0], $delimiter)[0] ?? '');
        if (in_array(trim($first), ['nama', 'name', 'nama tamu'], true)) {
            array_shift($lines);
        }

        if (count($lines) > self::IMPORT_LIMIT) {
            return back()->withErrors(['file' => 'Maksimal ' . self::IMPORT_LIMIT . ' baris per file. Pecah file menjadi beberapa bagian.']);
        }

        // Kunci duplikat: nama (huruf kecil) + nomor HP
        $key = fn ($name, $phone) => Str::lower(trim($name)) . '|' . Invitation::normalizePhone($phone);
        $existing = $event->invitations()->get(['name', 'phone'])
            ->mapWithKeys(fn ($inv) => [$key($inv->name, $inv->phone) => true])
            ->all();

        $added = 0;
        $skipped = 0;

        foreach ($lines as $line) {
            $columns = array_map('trim', str_getcsv($line, $delimiter));
            $name = Str::limit($columns[0] ?? '', 255, '');
            $phone = Str::limit($columns[1] ?? '', 20, '');
            $group = Str::limit($columns[2] ?? '', 50, '');

            if ($name === '' || isset($existing[$key($name, $phone)])) {
                $skipped++;
                continue;
            }

            $event->invitations()->create([
                'name' => $name,
                'phone' => $phone ?: null,
                'group' => $group ?: null,
            ]);

            $existing[$key($name, $phone)] = true;
            $added++;
        }

        $message = "{$added} tamu ditambahkan dari CSV.";
        if ($skipped) {
            $message .= " {$skipped} baris dilewati (kosong atau sudah ada).";
        }

        return redirect()->route('admin.invitations.index')->with('success', $message);
    }

    /**
     * Contoh file CSV untuk diisi.
     */
    public function template()
    {
        $csv = "nama,nomor_hp,kelompok\n"
            . "Bapak Ahmad Fauzi,081234567890,Keluarga\n"
            . "Siti Nurhaliza,081298765432,Teman Kantor\n";

        return response($csv, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="contoh-daftar-undangan.csv"',
        ]);
    }

    public function destroy(Invitation $invitation)
    {
        // Hanya undangan milik acara yang sedang dikelola
        abort_unless($invitation->event_id === $this->currentEvent()->id, 404);

        $invitation->delete();

        return redirect()->route('admin.invitations.index')
            ->with('success', "{$invitation->name} dihapus dari daftar undangan.");
    }
}
