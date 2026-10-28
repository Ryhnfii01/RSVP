<?php

/*
| Pesan validasi Bahasa Indonesia untuk aturan yang dipakai aplikasi ini.
| Aturan lain jatuh ke bahasa Inggris (APP_FALLBACK_LOCALE=en).
*/

return [
    'accepted' => ':attribute harus disetujui.',
    'alpha_dash' => ':attribute hanya boleh berisi huruf, angka, tanda hubung, dan garis bawah.',
    'array' => ':attribute harus berupa daftar.',
    'boolean' => ':attribute harus bernilai benar atau salah.',
    'date' => ':attribute bukan tanggal yang valid.',
    'date_format' => ':attribute harus berformat :format.',
    'email' => ':attribute harus berupa alamat email yang valid.',
    'in' => ':attribute yang dipilih tidak valid.',
    'integer' => ':attribute harus berupa bilangan bulat.',
    'max' => [
        'array' => ':attribute maksimal berisi :max item.',
        'numeric' => ':attribute maksimal :max.',
        'string' => ':attribute maksimal :max karakter.',
    ],
    'min' => [
        'array' => ':attribute minimal berisi :min item.',
        'numeric' => ':attribute minimal :min.',
        'string' => ':attribute minimal :min karakter.',
    ],
    'numeric' => ':attribute harus berupa angka.',
    'required' => ':attribute wajib diisi.',
    'string' => ':attribute harus berupa teks.',
    'unique' => ':attribute sudah dipakai.',
    'url' => ':attribute harus berupa URL yang valid.',

    'attributes' => [
        'name' => 'Nama',
        'email' => 'Email',
        'password' => 'Kata sandi',
        'phone' => 'Nomor HP',
        'number_of_guests' => 'Jumlah tamu',
        'message' => 'Ucapan',
        'attendance' => 'Kehadiran',
        'slug' => 'Link undangan',
        'template' => 'Template',
        'event_date' => 'Tanggal acara',
        'akad_time_start' => 'Jam mulai akad',
        'akad_time_end' => 'Jam selesai akad',
        'event_time_start' => 'Jam mulai resepsi',
        'event_time_end' => 'Jam selesai resepsi',
        'time_zone' => 'Zona waktu',
        'venue_maps_url' => 'URL Google Maps',
        'akad_maps_url' => 'URL Google Maps akad',
    ],
];
