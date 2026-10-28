<?php

/*
|--------------------------------------------------------------------------
| Pengiriman WhatsApp
|--------------------------------------------------------------------------
|
| driver:
|   - "link"    : tombol di admin membuka wa.me dengan pesan terisi, admin
|                 menekan kirim sendiri (dipakai sekarang).
|   - "baileys" : direncanakan; pesan dikirim otomatis lewat gateway Baileys
|                 (server Node.js terpisah) memakai nomor admin di bawah.
|
| sender_number: nomor WhatsApp admin yang nanti disambungkan ke Baileys.
| Masih DUMMY, ganti dengan nomor asli lewat WHATSAPP_SENDER_NUMBER.
|
*/

return [

    'driver' => env('WHATSAPP_DRIVER', 'link'),

    'sender_number' => env('WHATSAPP_SENDER_NUMBER', '6280000000000'),

    // Tandai nomor di atas sebagai contoh supaya terlihat jelas di admin
    'sender_is_dummy' => (bool) env('WHATSAPP_SENDER_IS_DUMMY', true),

    // Alamat gateway Baileys (belum dipakai)
    'baileys_url' => env('WHATSAPP_BAILEYS_URL'),

];
