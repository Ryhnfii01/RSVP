<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\GalleryPhoto;
use App\Support\PhotoStorage;
use Illuminate\Http\Request;

/**
 * Foto galeri acara yang sedang dikelola: upload, urutkan, hapus.
 */
class GalleryController extends Controller
{
    /** Batas foto per acara. */
    public const MAX_PHOTOS = 30;

    /** Batas ukuran per file sebelum dikompres (KB). */
    public const MAX_UPLOAD_KB = 10240;

    private function currentEvent(): Event
    {
        $event = Event::managedBy(auth()->user());

        abort_unless($event, 404, 'Belum ada acara. Isi data acara di Settings terlebih dahulu.');

        return $event;
    }

    private function authorizePhoto(GalleryPhoto $photo): Event
    {
        $event = $this->currentEvent();
        abort_unless($photo->event_id === $event->id, 404);

        return $event;
    }

    public function index()
    {
        $event = $this->currentEvent();
        $photos = $event->photos()->get();
        $canCompress = PhotoStorage::canCompress();
        $maxPhotos = self::MAX_PHOTOS;

        return view('admin.gallery.index', compact('event', 'photos', 'canCompress', 'maxPhotos'));
    }

    public function store(Request $request)
    {
        $event = $this->currentEvent();
        $remaining = self::MAX_PHOTOS - $event->photos()->count();

        if ($remaining <= 0) {
            return back()->withErrors([
                'photos' => 'Galeri sudah penuh (maks. ' . self::MAX_PHOTOS . ' foto). Hapus foto lama terlebih dahulu.',
            ]);
        }

        $request->validate([
            'photos' => ['required', 'array', 'min:1', 'max:' . $remaining],
            'photos.*' => 'image|mimes:jpeg,jpg,png,webp|max:' . self::MAX_UPLOAD_KB,
        ], [
            'photos.required' => 'Pilih minimal satu foto.',
            'photos.max' => "Sisa kuota galeri {$remaining} foto (maks. " . self::MAX_PHOTOS . ' per acara).',
            'photos.*.image' => 'Semua file harus berupa foto.',
            'photos.*.mimes' => 'Foto harus berformat JPG, PNG, atau WebP.',
            'photos.*.max' => 'Ukuran tiap foto maksimal 10 MB.',
        ]);

        $nextOrder = (int) $event->photos()->max('sort_order');

        foreach ($request->file('photos') as $file) {
            $stored = PhotoStorage::store($file, 'gallery/' . $event->id);
            $event->photos()->create($stored + ['sort_order' => ++$nextOrder]);
        }

        $count = count($request->file('photos'));

        return redirect()->route('admin.gallery.index')
            ->with('success', "{$count} foto ditambahkan ke galeri.");
    }

    /**
     * Geser foto satu posisi ke kiri (up) atau ke kanan (down).
     */
    public function move(Request $request, GalleryPhoto $photo)
    {
        $event = $this->authorizePhoto($photo);
        $direction = $request->validate(['direction' => 'required|in:up,down'])['direction'];

        $photos = $event->photos()->get()->values();
        $index = $photos->search(fn ($p) => $p->id === $photo->id);
        $swapIndex = $direction === 'up' ? $index - 1 : $index + 1;

        if ($swapIndex >= 0 && $swapIndex < $photos->count()) {
            // Tulis ulang urutan 1..n supaya tidak ada nilai ganda
            $ordered = $photos->all();
            [$ordered[$index], $ordered[$swapIndex]] = [$ordered[$swapIndex], $ordered[$index]];

            foreach ($ordered as $position => $item) {
                $item->update(['sort_order' => $position + 1]);
            }
        }

        return redirect()->route('admin.gallery.index');
    }

    public function destroy(GalleryPhoto $photo)
    {
        $this->authorizePhoto($photo);

        $photo->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Foto dihapus dari galeri.');
    }
}
