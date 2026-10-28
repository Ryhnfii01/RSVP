<?php

/*
|--------------------------------------------------------------------------
| Konten Landing Page
|--------------------------------------------------------------------------
|
| Semua teks yang sering diubah (nomor WhatsApp, harga paket, testimoni,
| FAQ) dikumpulkan di sini supaya tidak perlu mengedit file Blade.
|
*/

return [

    'brand' => env('LANDING_BRAND', 'Undangan Kita'),

    // Format internasional tanpa tanda + atau spasi, contoh: 6281234567890
    'whatsapp' => env('LANDING_WHATSAPP', '6281234567890'),

    'whatsapp_message' => 'Halo, saya tertarik membuat undangan pernikahan digital.',

    'packages' => [
        [
            'name' => 'Basic',
            'price' => 'Rp 99.000',
            'note' => 'Untuk acara sederhana',
            'featured' => false,
            'features' => [
                'Pilih 1 dari 4 template',
                'Data mempelai, acara & peta lokasi',
                'Hitung mundur hari H',
                'RSVP online',
                'Aktif 3 bulan',
            ],
        ],
        [
            'name' => 'Premium',
            'price' => 'Rp 179.000',
            'note' => 'Paling banyak dipilih',
            'featured' => true,
            'features' => [
                'Semua fitur Basic',
                'Galeri foto hingga 20 foto',
                'Musik latar',
                'Amplop digital (rekening & e-wallet)',
                'Buku tamu & ucapan',
                'Aktif 6 bulan',
            ],
        ],
        [
            'name' => 'Eksklusif',
            'price' => 'Rp 299.000',
            'note' => 'Dibantu penuh oleh tim',
            'featured' => false,
            'features' => [
                'Semua fitur Premium',
                'Love story & timeline',
                'Data diinput oleh tim kami',
                'Revisi tanpa batas sampai hari H',
                'Aktif 12 bulan',
            ],
        ],
    ],

    /*
    | Testimoni hanya tampil jika daftar ini diisi. Gunakan testimoni asli
    | dari klien, contoh format:
    |
    | ['name' => 'Rina & Dimas', 'city' => 'Makassar', 'quote' => '...'],
    */
    'testimonials' => [],

    'faqs' => [
        [
            'q' => 'Berapa lama undangan selesai dibuat?',
            'a' => 'Setelah data dan foto lengkap, undangan biasanya siap dalam 1x24 jam.',
        ],
        [
            'q' => 'Apakah bisa ganti template setelah jadi?',
            'a' => 'Bisa. Data Anda tetap tersimpan, jadi pindah template tidak perlu input ulang.',
        ],
        [
            'q' => 'Bagaimana tamu mengonfirmasi kehadiran?',
            'a' => 'Tamu mengisi form RSVP langsung di undangan. Anda bisa melihat rekapnya di dashboard admin dan mengunduhnya sebagai CSV.',
        ],
        [
            'q' => 'Apakah undangan bisa dibuka di semua HP?',
            'a' => 'Bisa. Undangan berupa halaman web, jadi cukup dibuka dari link di WhatsApp tanpa perlu install aplikasi.',
        ],
        [
            'q' => 'Bagaimana cara pembayaran?',
            'a' => 'Pembayaran melalui transfer bank. Detailnya kami kirim lewat WhatsApp setelah Anda memilih paket.',
        ],
    ],

];
