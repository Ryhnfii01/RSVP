<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Guest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'number_of_guests',
        'message',
        'attendance',
        'is_confirmed',
    ];

    protected $casts = [
        'is_confirmed' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /** Status ucapan: tampil di undangan / menunggu persetujuan / disembunyikan admin. */
    public const WISH_VISIBLE = 'visible';
    public const WISH_PENDING = 'pending';
    public const WISH_HIDDEN = 'hidden';

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Tamu yang menulis ucapan (apa pun statusnya).
     */
    public function scopeWithWish(Builder $query): Builder
    {
        return $query->whereNotNull('message')->where('message', '!=', '');
    }

    /**
     * Ucapan yang boleh tampil di undangan.
     */
    public function scopeVisibleWish(Builder $query): Builder
    {
        return $query->withWish()->where('message_status', self::WISH_VISIBLE);
    }

    /**
     * Status untuk ucapan yang baru dikirim atau diubah tamu.
     * Ucapan yang sudah disembunyikan admin tetap tersembunyi walau tamu mengubahnya.
     */
    public function wishStatusAfterChange(Event $event): string
    {
        if ($this->message_status === self::WISH_HIDDEN) {
            return self::WISH_HIDDEN;
        }

        return $event->moderate_wishes ? self::WISH_PENDING : self::WISH_VISIBLE;
    }
}
