<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Simpan foto upload ke disk "public". Dengan ekstensi GD, foto diperkecil
 * (sisi terpanjang maks. 1600 px) dan dikompres ke WebP/JPEG kualitas 80.
 * Tanpa GD, file asli disimpan apa adanya.
 */
class PhotoStorage
{
    public const MAX_EDGE = 1600;
    public const QUALITY = 80;

    public static function canCompress(): bool
    {
        return function_exists('imagecreatefromstring');
    }

    /**
     * @return array{path: string, width: int|null, height: int|null, size: int}
     */
    public static function store(UploadedFile $file, string $directory): array
    {
        if (self::canCompress() && ($compressed = self::compress($file, $directory))) {
            return $compressed;
        }

        [$width, $height] = @getimagesize($file->getRealPath()) ?: [null, null];
        $path = $file->storeAs($directory, Str::uuid() . '.' . $file->extension(), 'public');

        return ['path' => $path, 'width' => $width, 'height' => $height, 'size' => $file->getSize()];
    }

    private static function compress(UploadedFile $file, string $directory): ?array
    {
        $image = @imagecreatefromstring(file_get_contents($file->getRealPath()));

        if (! $image) {
            return null;
        }

        $image = self::applyExifOrientation($image, $file);

        $width = imagesx($image);
        $height = imagesy($image);
        $scale = min(1, self::MAX_EDGE / max($width, $height));

        if ($scale < 1) {
            $newWidth = (int) round($width * $scale);
            $newHeight = (int) round($height * $scale);
            $resized = imagecreatetruecolor($newWidth, $newHeight);
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
            imagecopyresampled($resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            imagedestroy($image);
            [$image, $width, $height] = [$resized, $newWidth, $newHeight];
        }

        $useWebp = function_exists('imagewebp');
        $tmp = tempnam(sys_get_temp_dir(), 'photo');
        $useWebp ? imagewebp($image, $tmp, self::QUALITY) : imagejpeg($image, $tmp, self::QUALITY);
        imagedestroy($image);

        $path = $directory . '/' . Str::uuid() . ($useWebp ? '.webp' : '.jpg');
        Storage::disk('public')->put($path, file_get_contents($tmp));
        $size = filesize($tmp);
        @unlink($tmp);

        return ['path' => $path, 'width' => $width, 'height' => $height, 'size' => $size];
    }

    /**
     * Foto dari HP sering tersimpan miring dengan penanda orientasi EXIF.
     */
    private static function applyExifOrientation($image, UploadedFile $file)
    {
        if (! function_exists('exif_read_data') || ! in_array($file->getMimeType(), ['image/jpeg', 'image/jpg'], true)) {
            return $image;
        }

        $orientation = @exif_read_data($file->getRealPath())['Orientation'] ?? 1;

        $rotated = match ($orientation) {
            3 => imagerotate($image, 180, 0),
            6 => imagerotate($image, -90, 0),
            8 => imagerotate($image, 90, 0),
            default => null,
        };

        if ($rotated) {
            imagedestroy($image);
            return $rotated;
        }

        return $image;
    }
}
