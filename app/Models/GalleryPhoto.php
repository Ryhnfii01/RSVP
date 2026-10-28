<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

/**
 * Satu foto di galeri undangan.
 */
class GalleryPhoto extends Model
{
    protected $fillable = [
        'path',
        'width',
        'height',
        'size',
        'sort_order',
    ];

    protected static function booted(): void
    {
        // File ikut terhapus saat fotonya dihapus
        static::deleted(function (GalleryPhoto $photo) {
            Storage::disk('public')->delete([
                $photo->path,
                // Gambar preview link (ShareImage) dari foto ini, kalau pernah dibuat
                "og/event-{$photo->event_id}-photo-{$photo->id}.jpg",
            ]);
        });
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * URL foto mengikuti alamat situs yang sedang diakses (bukan APP_URL),
     * lewat symlink public/storage.
     */
    public function url(): string
    {
        return asset('storage/' . $this->path);
    }
}
