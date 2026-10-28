<?php

namespace App\Support;

use App\Models\User;

/**
 * Password sementara untuk akun client dan pesan kredensial yang dikirim ke client.
 */
class ClientCredentials
{
    /** Tanpa karakter yang mirip (0/o, 1/l/i) supaya mudah diketik dari HP. */
    private const ALPHABET = 'abcdefghjkmnpqrstuvwxyz23456789';

    /**
     * Contoh: "kd7m-p2xq-9fhb" (12 karakter acak, ~59 bit).
     */
    public static function generatePassword(): string
    {
        $groups = [];

        for ($g = 0; $g < 3; $g++) {
            $group = '';
            for ($i = 0; $i < 4; $i++) {
                $group .= self::ALPHABET[random_int(0, strlen(self::ALPHABET) - 1)];
            }
            $groups[] = $group;
        }

        return implode('-', $groups);
    }

    /**
     * Data untuk panel kredensial yang ditampilkan sekali ke super admin (lewat session flash).
     */
    public static function forFlash(User $user, string $password): array
    {
        $message = self::message($user, $password);

        return [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $password,
            'login_url' => route('login'),
            'message' => $message,
            'whatsapp_url' => 'https://wa.me/' . ($user->phone ?? '') . '?text=' . rawurlencode($message),
            'has_phone' => (bool) $user->phone,
        ];
    }

    public static function message(User $user, string $password): string
    {
        return "Halo {$user->name},\n\n"
            . "Akun untuk mengatur undangan digital Anda sudah siap.\n\n"
            . "Login: " . route('login') . "\n"
            . "Email: {$user->email}\n"
            . "Password sementara: {$password}\n\n"
            . "Setelah login, silakan ganti password di menu Akun Saya.";
    }
}
