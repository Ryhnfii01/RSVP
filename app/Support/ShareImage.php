<?php

namespace App\Support;

use App\Models\Event;
use Illuminate\Support\Facades\Storage;

/**
 * Gambar preview saat link undangan dibagikan (WhatsApp, Facebook, dll.).
 * Foto galeri pertama dipotong ke 1200x630 dan disimpan sebagai JPEG, karena
 * WhatsApp tidak selalu menampilkan WebP. Hasilnya disimpan dan dipakai ulang;
 * ganti foto pertama = nama file baru. Tanpa foto (atau tanpa GD): gambar bawaan.
 */
class ShareImage
{
    public const WIDTH = 1200;
    public const HEIGHT = 630;
    public const DEFAULT_PATH = 'images/og-default.jpg';

    /**
     * @return array{url: string, width: int, height: int}
     */
    public static function for(Event $event): array
    {
        $photo = $event->photos()->first();

        if ($photo && PhotoStorage::canCompress()) {
            $path = "og/event-{$event->id}-photo-{$photo->id}.jpg";

            if (Storage::disk('public')->exists($path) || self::render($photo->path, $path)) {
                return ['url' => asset('storage/' . $path), 'width' => self::WIDTH, 'height' => self::HEIGHT];
            }
        }

        return ['url' => asset(self::DEFAULT_PATH), 'width' => self::WIDTH, 'height' => self::HEIGHT];
    }

    private static function render(string $source, string $target): bool
    {
        $disk = Storage::disk('public');

        if (! $disk->exists($source) || ! ($image = @imagecreatefromstring($disk->get($source)))) {
            return false;
        }

        // Potong bagian tengah ke rasio 1200:630, lalu perkecil
        $width = imagesx($image);
        $height = imagesy($image);
        $ratio = self::WIDTH / self::HEIGHT;

        if ($width / $height > $ratio) {
            $cropHeight = $height;
            $cropWidth = (int) round($height * $ratio);
        } else {
            $cropWidth = $width;
            $cropHeight = (int) round($width / $ratio);
        }

        $canvas = imagecreatetruecolor(self::WIDTH, self::HEIGHT);
        imagecopyresampled(
            $canvas, $image, 0, 0,
            (int) (($width - $cropWidth) / 2), (int) (($height - $cropHeight) / 2),
            self::WIDTH, self::HEIGHT, $cropWidth, $cropHeight
        );
        imagedestroy($image);

        ob_start();
        imagejpeg($canvas, null, PhotoStorage::QUALITY);
        $disk->put($target, ob_get_clean());
        imagedestroy($canvas);

        return true;
    }
}
