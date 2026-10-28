<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * Orang yang diundang ke sebuah acara, dengan link personal /u/{slug}/{code}.
 */
class Invitation extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'group',
    ];

    protected $casts = [
        'opened_at' => 'datetime',
        'sent_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Invitation $invitation) {
            $invitation->code ??= static::newCode();
        });

        static::saving(function (Invitation $invitation) {
            $invitation->phone = static::normalizePhone($invitation->phone);
        });
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    /**
     * Link personal yang dibagikan ke tamu ini.
     */
    public function personalUrl(): string
    {
        return route('invitation.personal', [$this->event, $this->code]);
    }

    /**
     * Link wa.me yang membuka chat ke tamu dengan pesan undangan sudah terisi.
     * Tanpa nomor HP, WhatsApp meminta pengirim memilih kontak sendiri.
     */
    public function whatsappUrl(): string
    {
        return 'https://wa.me/' . ($this->phone ?? '') . '?text=' . rawurlencode($this->event->waMessageFor($this));
    }

    /**
     * Kode acak 8 karakter (huruf kecil + angka, tanpa karakter yang mirip seperti 0/o, 1/l).
     */
    public static function newCode(): string
    {
        $alphabet = 'abcdefghjkmnpqrstuvwxyz23456789';

        do {
            $code = '';
            for ($i = 0; $i < 8; $i++) {
                $code .= $alphabet[random_int(0, strlen($alphabet) - 1)];
            }
        } while (static::where('code', $code)->exists());

        return $code;
    }

    /**
     * "0812-3456 7890" / "+62 812..." -> "6281234567890" (format wa.me).
     */
    public static function normalizePhone(?string $phone): ?string
    {
        $digits = preg_replace('/\D+/', '', (string) $phone);

        if ($digits === '') {
            return null;
        }

        if (Str::startsWith($digits, '0')) {
            $digits = '62' . substr($digits, 1);
        } elseif (Str::startsWith($digits, '8')) {
            $digits = '62' . $digits;
        }

        return $digits;
    }
}
