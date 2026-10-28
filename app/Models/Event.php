<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    /**
     * Template undangan yang tersedia: kunci => nama tampilan.
     */
    public const TEMPLATES = [
        'template-1' => 'Elegant Modern',
        'template-2' => 'Classic Romantic',
        'template-3' => 'Elegant Nature',
        'template-4' => 'Bugis Emerald',
    ];

    /**
     * Pesan WhatsApp bawaan. Penanda {nama}, {link}, {mempelai}, {tanggal}, {lokasi}
     * diganti per tamu. *teks* = tebal di WhatsApp.
     */
    public const DEFAULT_WA_MESSAGE = <<<'TEXT'
Kepada Yth.
*{nama}*

Dengan penuh sukacita, kami mengundang Bapak/Ibu/Saudara/i untuk hadir di acara pernikahan kami:

*{mempelai}*
{tanggal}
{lokasi}

Undangan lengkap dan konfirmasi kehadiran:
{link}

Merupakan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu.

Terima kasih.
TEXT;

    public const WA_PLACEHOLDERS = ['{nama}', '{link}', '{mempelai}', '{tanggal}', '{lokasi}'];

    protected $fillable = [
        'user_id',
        'wa_message',
        'moderate_wishes',
        'slug',
        'template',
        'event_type',
        'bride_name',
        'bride_nickname',
        'bride_father',
        'bride_mother',
        'groom_name',
        'groom_nickname',
        'groom_father',
        'groom_mother',
        'event_title',
        'event_description',
        'event_date',
        'akad_time_start',
        'akad_time_end',
        'event_time_start',
        'event_time_end',
        'time_zone',
        'venue_name',
        'venue_address',
        'venue_city',
        'venue_maps_url',
        'venue_latitude',
        'venue_longitude',
        'akad_venue_name',
        'akad_venue_address',
        'akad_maps_url',
        'instagram_bride',
        'instagram_groom',
        'love_story',
        'gift_accounts',
        'gift_recipient',
        'gift_address',
        'gallery_folder',
        'background_music',
        'is_active',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'is_active' => 'boolean',
        'venue_latitude' => 'decimal:8',
        'venue_longitude' => 'decimal:8',
        'gift_accounts' => 'array',
        'moderate_wishes' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function (Event $event) {
            $event->slug = $event->slug ? Str::slug($event->slug) : null;

            if (! $event->slug) {
                $event->slug = static::uniqueSlug(Str::slug($event->brideNickname() . ' ' . $event->groomNickname()), $event->id);
            }
        });
    }

    /**
     * Get the active event
     */
    public static function getActive()
    {
        return self::where('is_active', true)->first() ?? self::first();
    }

    /**
     * Acara yang sedang dikelola user di panel admin.
     * Client: acara miliknya. Super admin: acara yang dipilih di pemilih acara
     * (disimpan di session), atau acara aktif jika belum memilih.
     */
    public static function managedBy(?User $user): ?self
    {
        if (! $user) {
            return null;
        }

        if (! $user->isSuperAdmin()) {
            return $user->events()->orderBy('id')->first();
        }

        $selectedId = session('admin_event_id');

        return ($selectedId ? self::find($selectedId) : null) ?? self::getActive();
    }

    /**
     * Daftar acara yang boleh dipilih user di pemilih acara.
     */
    public static function selectableBy(User $user): Collection
    {
        $query = $user->isSuperAdmin() ? self::query() : $user->events();

        return $query->orderByDesc('event_date')->get();
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function guests(): HasMany
    {
        return $this->hasMany(Guest::class);
    }

    /**
     * Foto galeri, urut sesuai pengaturan di admin.
     */
    public function photos(): HasMany
    {
        return $this->hasMany(GalleryPhoto::class)->orderBy('sort_order')->orderBy('id');
    }

    /**
     * Daftar orang yang diundang, masing-masing dengan link personal.
     */
    public function invitations(): HasMany
    {
        return $this->hasMany(Invitation::class);
    }

    /**
     * Alamat publik undangan, contoh: https://domain.com/u/rina-dimas
     */
    public function publicUrl(): string
    {
        return route('invitation.show', $this);
    }

    /**
     * Judul preview saat link dibagikan, contoh: "Undangan Pernikahan Rina & Dimas"
     */
    public function shareTitle(): string
    {
        return 'Undangan Pernikahan ' . $this->coupleNames();
    }

    /**
     * Deskripsi preview: untuk siapa (link personal), kapan, dan di mana.
     */
    public function shareDescription(?string $guestName = null): string
    {
        $parts = array_filter([
            $guestName ? 'Kepada ' . $guestName . '.' : null,
            $this->dateLong() ? $this->dateLong() . ($this->venue_name ? ' di ' . $this->venue_name : '') . '.' : null,
            'Buka undangan untuk detail acara dan konfirmasi kehadiran.',
        ]);

        return implode(' ', $parts);
    }

    /**
     * Nama view template; template yang tidak dikenal kembali ke template-1.
     */
    public function templateView(): string
    {
        $template = array_key_exists($this->template, self::TEMPLATES) ? $this->template : 'template-1';

        return 'templates.' . $template . '.index';
    }

    /**
     * Slug yang belum dipakai acara lain: "rina-dimas", lalu "rina-dimas-2", dst.
     */
    public static function uniqueSlug(string $base, ?int $ignoreId = null): string
    {
        $base = $base ?: 'acara';
        $slug = $base;
        $n = 2;

        while (static::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $n++;
        }

        return $slug;
    }

    /**
     * Nama panggilan; jika kosong, pakai kata pertama dari nama lengkap.
     */
    public function brideNickname(): string
    {
        return $this->bride_nickname ?: (Str::before((string) $this->bride_name, ' ') ?: 'Mempelai Wanita');
    }

    public function groomNickname(): string
    {
        return $this->groom_nickname ?: (Str::before((string) $this->groom_name, ' ') ?: 'Mempelai Pria');
    }

    /**
     * Contoh: "Rina & Dimas"
     */
    public function coupleNames(): string
    {
        return $this->brideNickname() . ' & ' . $this->groomNickname();
    }

    /**
     * Contoh: "Minggu, 31 Desember 2025"
     */
    public function dateLong(): string
    {
        return $this->event_date ? $this->event_date->locale('id')->translatedFormat('l, j F Y') : '';
    }

    /**
     * Bagian tanggal untuk sampul, contoh: datePart('l') = "Minggu", datePart('j') = "31"
     */
    public function datePart(string $format): string
    {
        return $this->event_date ? $this->event_date->locale('id')->translatedFormat($format) : '';
    }

    /**
     * Contoh: "31 Desember 2025"
     */
    public function dateMedium(): string
    {
        return $this->event_date ? $this->event_date->locale('id')->translatedFormat('j F Y') : '';
    }

    /**
     * Tanggal + jam acara untuk countdown JavaScript, contoh: "2025-12-31T08:00:00"
     */
    public function countdownTarget(): string
    {
        if (! $this->event_date) {
            return now()->addMonth()->format('Y-m-d\TH:i:s');
        }

        $start = $this->akad_time_start ?: $this->event_time_start;
        $date = $this->event_date->copy();

        if ($start) {
            [$hour, $minute] = explode(':', $start);
            $date->setTime((int) $hour, (int) $minute);
        }

        return $date->format('Y-m-d\TH:i:s');
    }

    /**
     * Contoh: "08.00 - 10.00 WIB"
     */
    public function akadTime(): string
    {
        return $this->timeRange($this->akad_time_start, $this->akad_time_end);
    }

    public function receptionTime(): string
    {
        return $this->timeRange($this->event_time_start, $this->event_time_end);
    }

    public function akadVenueName(): string
    {
        return (string) ($this->akad_venue_name ?: $this->venue_name);
    }

    public function akadVenueAddress(): string
    {
        return (string) ($this->akad_venue_name ? $this->akad_venue_address : $this->venue_address);
    }

    public function akadMapsUrl(): string
    {
        if ($this->akad_venue_name) {
            return self::webUrl($this->akad_maps_url) ?: $this->searchMapsUrl($this->akad_venue_name . ' ' . $this->akad_venue_address);
        }

        return $this->mapsUrl();
    }

    public function mapsUrl(): string
    {
        return self::webUrl($this->venue_maps_url) ?: $this->searchMapsUrl($this->venue_name . ' ' . $this->venue_address);
    }

    /**
     * Hanya alamat http(s); skema lain (mis. javascript:) dibuang supaya tidak bisa dipakai di link.
     */
    private static function webUrl(?string $url): ?string
    {
        return $url && Str::startsWith(Str::lower(trim($url)), ['https://', 'http://']) ? trim($url) : null;
    }

    public function instagramUrl(string $who): ?string
    {
        $handle = ltrim((string) $this->{'instagram_' . $who}, '@ ');

        return $handle ? 'https://instagram.com/' . $handle : null;
    }

    public function instagramHandle(string $who): string
    {
        $handle = ltrim((string) $this->{'instagram_' . $who}, '@ ');

        return $handle ? '@' . $handle : '';
    }

    /**
     * URL musik latar: link langsung (https://...) atau nama file di public/music/.
     * Null jika kosong atau filenya tidak ada, supaya pemutar tidak ditampilkan.
     */
    public function musicUrl(): ?string
    {
        $music = trim((string) $this->background_music);

        if ($music === '') {
            return null;
        }

        if (Str::startsWith($music, ['https://', 'http://'])) {
            return $music;
        }

        $path = 'music/' . basename($music);

        return is_file(public_path($path)) ? asset($path) : null;
    }

    /**
     * Template pesan WhatsApp acara ini (bawaan jika belum diubah).
     */
    public function waMessageTemplate(): string
    {
        return trim((string) $this->wa_message) !== '' ? $this->wa_message : self::DEFAULT_WA_MESSAGE;
    }

    /**
     * Pesan WhatsApp untuk satu tamu, penanda sudah diganti.
     */
    public function waMessageFor(Invitation $invitation): string
    {
        $location = trim(implode(', ', array_filter([$this->venue_name, $this->venue_city])));

        return strtr($this->waMessageTemplate(), [
            '{nama}' => $invitation->name,
            '{link}' => $invitation->personalUrl(),
            '{mempelai}' => $this->coupleNames(),
            '{tanggal}' => $this->dateLong(),
            '{lokasi}' => $location,
        ]);
    }

    /**
     * Rekening bank untuk amplop digital.
     */
    public function bankAccounts(): Collection
    {
        return $this->giftAccountsOfType('bank');
    }

    /**
     * Dompet digital (GoPay, OVO, DANA, dll) untuk amplop digital.
     */
    public function ewallets(): Collection
    {
        return $this->giftAccountsOfType('ewallet');
    }

    private function giftAccountsOfType(string $type): Collection
    {
        return collect($this->gift_accounts ?? [])
            ->filter(fn ($account) => ($account['type'] ?? null) === $type && ! empty($account['number']))
            ->values();
    }

    private function timeRange(?string $start, ?string $end): string
    {
        if (! $start) {
            return '';
        }

        $format = fn ($time) => Carbon::parse($time)->format('H.i');

        return $format($start) . ($end ? ' - ' . $format($end) : ' - Selesai') . ' ' . ($this->time_zone ?: 'WIB');
    }

    private function searchMapsUrl(string $query): string
    {
        return 'https://www.google.com/maps/search/?api=1&query=' . urlencode(trim($query));
    }
}
