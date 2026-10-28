<?php

namespace App\Support;

class Csv
{
    /**
     * Teks yang diawali = + - @ (atau tab/enter) bisa dijalankan Excel sebagai rumus
     * (CSV injection). Diberi tanda petik di depan supaya tetap dibaca sebagai teks.
     */
    public static function text($value): string
    {
        $value = (string) $value;

        return preg_match('/^[=+\-@\t\r]/', $value) ? "'" . $value : $value;
    }
}
