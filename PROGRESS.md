# Catatan Progress

Catatan kerja pengembangan website undangan. Selalu diperbarui setiap ada pekerjaan selesai, supaya bisa dilanjutkan kapan saja (misalnya setelah kena limit).

PRD: https://claude.ai/artifact/W3MAMWJpLsoLDq4ygAcNG8

## Terakhir dikerjakan

**2026-10-27**
- Setup lokal selesai: Composer + npm install, `.env`, database `invitation` di MySQL XAMPP, migrate + seed (Admin, Event, Guest).
- PRD dibuat (4 fase, tanpa sprint).
- Roadmap dipadatkan jadi 8 minggu: tiap fase 2 minggu, MVP di minggu ke-6, rilis penuh minggu ke-8.
- Landing page baru di `resources/views/home.blade.php`: hero + mockup HP, fitur, 4 template, cara pesan, harga, FAQ, CTA WhatsApp, link login admin. Sudah dicek di desktop dan HP (375 px).
- Konten landing (brand, nomor WA, harga, testimoni, FAQ) ada di `config/landing.php`; nomor WA dan nama brand di `.env` (`LANDING_BRAND`, `LANDING_WHATSAPP`).
- F-08 selesai: data acara (nama, nama panggilan, orang tua, Instagram, tanggal, jam akad & resepsi, zona waktu WIB/WITA/WIT, lokasi akad & resepsi, peta, rekening/e-wallet, alamat kado) diatur dari Admin > Settings > Event Settings dan dipakai di keempat template. Migrasi baru: `2026_10_27_000001_*`, `2026_10_27_000002_*`.

**2026-10-28**
- F-03 selesai: tiap acara punya `slug` unik + pilihan `template`; undangan publik di `/u/{slug}` (contoh: `/u/rina-dimas`). Tamu/RSVP terikat ke acara (`guests.event_id`), email unik per acara dan sekarang opsional. `/template-1` s/d `/template-4` tetap jadi demo memakai acara aktif.
- Admin: dashboard, daftar tamu, dan export hanya menampilkan tamu acara aktif. Form Event Settings punya field link (slug) + template; halaman Settings menampilkan link undangan.
- Perbaikan: form RSVP template 4 sebelumnya menampilkan JSON mentah, sekarang menampilkan pesan sukses/error. Pesan validasi sebelumnya tampil sebagai kode (`validation.unique`) karena locale `id` tanpa file terjemahan; ditambah `lang/id/validation.php` dan `APP_FALLBACK_LOCALE=en`.

- F-04 selesai: user punya role `super_admin` (pemilik bisnis) atau `client` (pasangan); acara punya pemilik (`events.user_id`). Client hanya melihat & mengubah acaranya sendiri; super admin memilih acara lewat dropdown "Acara" di sidebar admin dan bisa menetapkan pemilik di Event Settings. Middleware `role:super_admin` tersedia untuk route khusus super admin.
- Akun uji: `admin@example.com` (super admin) dan `klien@example.com` (client, pemilik Rina & Dimas), password keduanya `password`.
- Test otomatis: `tests/Feature/EventAccessTest.php` (10 test akses acara/RSVP). Jalankan `C:\xampp\php\php.exe artisan test`; semua lolos.

- Panel super admin selesai: menu **Events** (daftar semua acara + jumlah tamu, tombol Manage, form Create Event dengan pilihan pemilik: client lama / akun client baru / tanpa pemilik) dan **Clients** (tambah akun client, ganti password). Hanya untuk role `super_admin`.
- Perbaikan: semua halaman admin sebelumnya melebar ke samping (`<main>` memakai `w-full` + margin sidebar); sekarang `min-w-0`.
- Test otomatis: `tests/Feature/SuperAdminPanelTest.php` (8 test). Total 19 test, semua lolos.

- Fase 2 selesai: uji ulang 4 template di `/u/{slug}`. Semua tampil tanpa error JS, data acara benar, RSVP lewat form asli tersimpan ke acara yang tepat. Test otomatis `tests/Feature/TemplateRenderTest.php` (8 test); total 27 test lolos.
- Perbaikan: template 4 bisa digeser ke samping di HP (animasi fade-in-right) -> `overflow-x-hidden` di body. Landing page sebelumnya mengklaim semua template punya semua fitur; teksnya diperbaiki.

- Fitur keempat template disamakan: countdown, galeri, amplop digital, buku tamu (ucapan tampil), dan musik latar ada di semua template. Partial bersama: `resources/views/templates/partials/music.blade.php` dan `wishes.blade.php`. Template 4 dapat countdown, galeri, amplop digital, menu Galeri/Ucapan.
- Musik latar sekarang memakai field Background Music di Event Settings (nama file di `public/music/` atau link langsung); tombol musik hanya tampil jika file ada. Tombol musik lama di template 1-3 ternyata palsu (ikon berganti tanpa suara) dan sudah dihapus.
- Total 35 test lolos.

**2026-10-28 (lanjutan)**
- F-05 selesai: tabel `invitations` (daftar orang yang diundang; terpisah dari `guests` yang berisi jawaban RSVP). Tiap tamu punya kode acak 8 karakter dan link personal `/u/{slug}/{kode}`; waktu pertama dibuka dicatat (`opened_at`). Nomor HP otomatis dinormalisasi ke format `62...`.
- Admin > **Invitations**: tambah tamu, impor CSV (koma atau titik koma, baris judul & duplikat dilewati, maks 2000 baris; contoh file bisa diunduh), cari, salin link, hapus, dan ringkasan berapa yang sudah membuka link.
- Data contoh: 1 tamu undangan "Bapak Ahmad Fauzi & Keluarga" di acara Rina & Dimas.
- Test otomatis: `tests/Feature/InvitationListTest.php` (8 test). Total 43 test lolos.
- F-07 selesai: sampul keempat template menampilkan nama tamu dari link personal (tanpa link personal: `?to=Nama`, atau "Bapak/Ibu/Saudara/i"; sebelumnya "Dear Special Guest"). Form RSVP otomatis terisi nama tamu + kode undangan tersembunyi; jawaban RSVP terhubung ke tamu (`invitations.guest_id`) dan kirim ulang dari link yang sama memperbarui jawaban lama (bukan data ganda).
- Admin > Invitations menampilkan kolom RSVP (Attending + jumlah orang / Not attending / No reply) dan kartu "Replied (RSVP)".
- Data contoh: Bapak Ahmad Fauzi & Keluarga sudah RSVP hadir 3 orang.
- Test otomatis: `tests/Feature/PersonalInvitationTest.php` (13 test). Total 56 test lolos.
- F-06 selesai: Admin > Invitations punya editor **WhatsApp Message** (template per acara, penanda `{nama}` `{link}` `{mempelai}` `{tanggal}` `{lokasi}`, `*teks*` = tebal; wajib memuat `{link}`; tombol Reset to Default) dengan pratinjau gelembung chat. Tiap tamu punya tombol **WhatsApp** yang membuka `wa.me/{nomor}?text=...` dengan pesan terisi dan mencatat `sent_at` (status "Sent", kartu "Sent via WhatsApp"; tombol berubah jadi "Resend"). Tanpa nomor, WhatsApp meminta memilih kontak.
- Pengiriman tetap 1 klik per tamu: kirim otomatis massal butuh WhatsApp Business API (berbayar).
- Test otomatis: `tests/Feature/WhatsappInvitationTest.php` (8 test). Total 64 test lolos.
- Keputusan: pengiriman WhatsApp otomatis nanti memakai **Baileys** (gateway Node.js terpisah). Untuk sekarang `config/whatsapp.php`: `WHATSAPP_DRIVER=link` (tombol wa.me), `WHATSAPP_SENDER_NUMBER=6280000000000` = nomor admin **dummy** (tampil dengan label "dummy" di editor pesan), `WHATSAPP_BAILEYS_URL` kosong. Integrasi Baileys belum ditulis.
- F-12 selesai (Fase 3 selesai): Admin > Invitations punya filter status (belum dikirim / belum dibuka / belum RSVP / hadir / tidak hadir) + filter kelompok + pencarian, halaman **Edit** tamu (link personal tidak berubah), dan **Export CSV** yang mengikuti filter aktif. CSV memakai titik koma + BOM (rapi di Excel format Indonesia), nomor ditulis `0812-3456-7890` supaya tetap teks, sel berawalan `= + - @` dinetralkan (anti CSV injection), dan file export bisa diimpor ulang.
- Test otomatis: `tests/Feature/InvitationManageTest.php` (7 test). Total 71 test lolos.
- F-09 selesai: Admin > **Gallery** (upload banyak foto sekaligus, maks. 30 per acara & 10 MB per file, urutkan dengan panah, hapus). File di `storage/app/public/gallery/{event_id}`, tabel `gallery_photos`. Keempat template memakai partial bersama `templates/partials/gallery.blade.php` dengan lightbox (panah, keyboard, geser di HP); galeri disembunyikan jika belum ada foto. File galeri placeholder lama (`template-1/2/3/sections/gallery.blade.php`) dihapus.
- Kompresi (`app/Support/PhotoStorage.php`): jika ekstensi GD aktif, foto diperkecil ke sisi terpanjang 1600 px + WebP/JPEG kualitas 80 + koreksi orientasi EXIF. **GD belum aktif di XAMPP** (`;extension=gd` di `C:\xampp\php\php.ini`), jadi sekarang foto disimpan asli; admin menampilkan label "Auto-resize off".
- Perbaikan: script gift template 1/2 dan galeri memakai `@push('scripts')`, tapi template 2 & 3 tidak punya `@stack`, sehingga tombol Copy rekening di template 2 tidak pernah berfungsi. Sekarang script inline.
- Data contoh: 4 gambar gradasi warna di galeri Rina & Dimas (bukan foto asli; hapus lewat Admin > Gallery).
- Test otomatis: `tests/Feature/GalleryTest.php` (7 test, 1 dilewati sampai GD aktif). Total 77 lolos + 1 dilewati.

**2026-10-29**
- Ekstensi GD diaktifkan di `C:\xampp\php\php.ini` (baris 931 `;extension=gd` -> `extension=gd`, akhiran baris CRLF dipertahankan). Cadangan: `C:\xampp\php\php.ini.bak-sebelum-gd`. GD bundled 2.1.0, mendukung WebP & JPEG. Kompresi foto galeri sekarang aktif (label "Auto-resize on" di Admin > Gallery). Foto yang diupload sebelum GD aktif tetap tersimpan asli.
- Uji nyata: foto 4000x3000 JPEG 5.813 KB -> 1600x1200 WebP 498 KB (sekitar 12x lebih kecil).
- Total 78 test lolos (test kompresi tidak lagi dilewati).
- Akun client diperbaiki: password tidak lagi diketik manual. Saat super admin membuat client (Admin > Clients atau Create Event > New client account) atau menekan "New temporary password", sistem membuat password sementara (format `xxxx-xxxx-xxxx`, tanpa huruf mirip) dan menampilkan **panel kredensial sekali saja** berisi link login, email, password, tombol **Send to client on WhatsApp** (wa.me ke nomor client) dan **Copy message**. `app/Support/ClientCredentials.php`.
- User punya kolom `phone` (format `62...`) dan `must_change_password`. Selama masih password sementara, muncul pengingat kuning di semua halaman admin + titik di menu.
- Halaman **My Account** (`/admin/account`, semua user): ganti password (wajib password lama, min. 8 karakter, konfirmasi) dan profil (nama, email login, nomor WhatsApp). Ganti password mengeluarkan sesi di perangkat lain (middleware `auth.session` ditambahkan ke route admin).
- Catatan keamanan: password sementara ikut tersimpan di riwayat browser admin (link wa.me) dan di chat WhatsApp; karena itu ditandai sementara dan client diingatkan menggantinya.
- Test otomatis: `tests/Feature/ClientAccountTest.php` (9 test), `SuperAdminPanelTest` disesuaikan. Total 87 test lolos.
- F-10 selesai: menu Admin > **Wishes** (moderasi ucapan). Status ucapan `guests.message_status`: Shown / Waiting / Hidden, dengan filter, tombol Approve/Show, Hide, **Delete message** (hanya teks ucapan, data RSVP tetap), dan "Approve all". Pengaturan per acara **Review before showing** (`events.moderate_wishes`, bawaan Off): jika On, ucapan baru menunggu persetujuan dan tamu diberi tahu "Ucapan Anda akan tampil setelah disetujui". Angka penanda di menu Wishes saat ada ucapan menunggu.
- Undangan (buku tamu + jumlah ucapan) hanya menampilkan ucapan berstatus Shown. Ucapan yang disembunyikan tetap tersembunyi walau tamu mengubahnya lewat link personal; mengubah kehadiran saja tidak mengubah status ucapan.
- Test otomatis: `tests/Feature/WishModerationTest.php` (9 test). Total 96 test lolos.
- F-11 selesai: dashboard admin berisi ringkasan acara (nama, tanggal, hitung mundur hari, tombol lihat undangan), angka utama (perkiraan tamu = jumlah orang yang hadir, RSVP masuk, % link dibuka, % link dibalas), grafik kehadiran + tabel (RSVP, orang, persen), alur link personal (dibuat > dikirim > dibuka > dibalas), dan grafik RSVP per hari 14 hari terakhir dengan tooltip. Test: `tests/Feature/DashboardTest.php` (4 test).
- Perbaikan login: membuka /login saat sudah login sekarang ke dashboard (sebelumnya ke homepage, terkesan halaman login tidak bisa dibuka). Tombol "Masuk" di homepage jadi "Dashboard" saat sudah login. Test: `tests/Feature/LoginPageTest.php`. Total 102 test lolos.
- Open Graph selesai: semua template memakai `templates/partials/meta.blade.php` (judul "Undangan Pernikahan Rina & Dimas", deskripsi tanggal + tempat, gambar 1200x630). Link personal menyebut nama tamu ("Kepada Bapak Budi. ..."). Gambar preview = foto galeri pertama, dipotong ke 1200x630 JPEG oleh `App\Support\ShareImage` dan disimpan di `storage/app/public/og/` (ikut terhapus saat fotonya dihapus); tanpa foto memakai `public/images/og-default.jpg`. Halaman undangan diberi `noindex` supaya tidak masuk Google. Homepage juga punya og:image. Test: `tests/Feature/OpenGraphTest.php` (3 test). Total 105 test lolos.
- Preview WhatsApp baru bisa dicoba setelah online dengan domain HTTPS (server WhatsApp tidak bisa membuka localhost). WhatsApp menyimpan preview lama; untuk uji ulang, kirim link dengan tambahan `?v=2`.
- Keamanan selesai (batas di `AppServiceProvider::configureRateLimiting`):
  - RSVP/ucapan: maks. 10 per menit dan 100 per jam per IP (longgar karena banyak tamu berbagi IP seluler/Wi-Fi gedung). Lewat batas: pesan "Terlalu banyak kiriman ..." (JSON 429 atau kembali ke form).
  - Login: maks. 5 percobaan per menit per email+IP dan 20 per menit per IP.
  - Link personal: maks. 60 per menit per IP (menghalangi menebak kode).
  - Header keamanan di semua halaman (`App\Http\Middleware\SecurityHeaders`): X-Frame-Options, nosniff, Referrer-Policy, Permissions-Policy, HSTS saat production + HTTPS.
  - Bug diperbaiki: pilihan "Masih Ragu" di template 2-4 dulu ditolak validasi dan kolom enum MySQL (500 error). Sekarang diterima (migrasi `2026_10_29_000003`).
  - Link Google Maps hanya menerima alamat http(s) (validasi + pengaman di model).
  - Ekspor CSV tamu (menu Guests) sekarang juga aman dari CSV injection (`App\Support\Csv`).
  - Dicek dan sudah aman: semua `{!! !!}` memakai `e()`, akses data antar-acara (test), upload galeri, CSRF.
  - Test: `tests/Feature/SecurityTest.php` (8 test). Total 113 test lolos.

## Langkah berikutnya

- Ganti nomor WhatsApp contoh (`6281234567890`) dan cek ulang harga paket di `config/landing.php`.
- Isi testimoni asli di `config/landing.php` (bagian testimoni tersembunyi selama kosong).
- Hapus akun `test@example.com` (dibuat `DatabaseSeeder`, sekarang super admin) sebelum online.
- Server produksi juga perlu ekstensi GD (dengan dukungan WebP) supaya foto galeri dikompres.
- Fase 4 berikutnya: uji Lighthouse, deploy.
- Nanti: integrasi Baileys (ganti `WHATSAPP_DRIVER=baileys`, isi `WHATSAPP_BAILEYS_URL` dan nomor admin asli).
- Sebelum online: di `.env` server set `APP_ENV=production`, `APP_DEBUG=false` (kalau true, pesan error menampilkan isi query dan data), `SESSION_SECURE_COOKIE=true`, dan jalankan `php artisan migrate`.
- Sebelum online: set `APP_URL` ke domain asli, karena link personal di pesan WhatsApp memakai alamat situs.

## Cara menjalankan

1. Nyalakan MySQL di XAMPP.
2. `C:\xampp\php\php.exe artisan serve`
3. Buka http://localhost:8000 — admin di `/login` (`admin@example.com` / `password`, atau client `klien@example.com` / `password`).

## Daftar tugas

### Fase 1 — Fondasi & Landing (minggu 1–2)
- [x] Setup environment lokal (XAMPP, Composer, .env, migrate, seed)
- [x] Desain landing page
- [x] Landing page: hero, keunggulan, preview template (F-01)
- [x] Paket harga, testimoni, FAQ, tombol WhatsApp (F-01)
- [x] Link ke halaman admin di homepage
- [x] Data acara diatur dari admin, bukan dari `.env` (F-08)

### Fase 2 — Multi-acara & Role (minggu 3–4)
- [x] Skema multi-acara: tabel acara + slug unik (F-03)
- [x] Relasi tamu ke acara, route `/u/{slug}` untuk 4 template
- [x] Role super admin & admin acara + middleware (F-04)
- [x] Panel super admin: daftar & buat acara
- [x] Uji ulang 4 template

### Fase 3 — Link Tamu Personal (minggu 5–6, rilis MVP)
- [x] Daftar tamu undangan + impor CSV (F-05)
- [x] Kode unik link personal per tamu (F-05)
- [x] Nama tamu di sampul, RSVP terisi otomatis (F-07)
- [x] Tombol kirim via WhatsApp + template pesan (F-06)
- [x] Pencarian, filter, edit tamu, export Excel (F-12)

### Fase 4 — Lanjutan & Rilis (minggu 7–8, rilis penuh)
- [x] Upload & kelola galeri foto, kompres otomatis (F-09)
- [x] Ucapan tamu + moderasi (F-10)
- [x] Grafik RSVP & ringkasan dashboard (F-11)
- [x] Meta Open Graph per acara
- [x] Rate limit RSVP/ucapan & cek keamanan
- [ ] Uji di HP + Lighthouse mobile ≥ 85
- [ ] Deploy produksi + backup harian

### Nanti (P2)
- [ ] QR code check-in tamu (F-13)
- [ ] Form pemesanan dari landing page (F-14)

## Catatan teknis

- PHP: `C:\xampp\php\php.exe` (8.2). Perintah `composer` di PATH adalah MosaicML (Python), bukan Composer PHP.
- Composer PHP diunduh ke folder sementara; jalankan `C:\xampp\php\php.exe composer.phar ...` atau install Composer resmi.
- Data acara dibaca lewat helper di `app/Models/Event.php` (mis. `$event->dateLong()`, `akadTime()`, `bankAccounts()`); template menerima `$event` dari `InvitationController`.
- Menu navigasi bawah tiap template tetap punya tombol Galeri walau galeri tersembunyi (belum ada foto).
- Belum ada hapus acara / hapus akun client dari panel (sengaja, karena tidak bisa dibatalkan).
- Mengganti slug membuat link lama 404 (belum ada redirect dari slug lama).
- Belum dinamis: isi love story/timeline masih ditulis di template.
- Setelah mengubah php.ini, server `artisan serve` harus di-restart. `preview_stop` / mematikan `artisan serve` bisa meninggalkan proses `php -S` di port 8000/8001 (terjadi lagi 2026-10-29); cek dengan `netstat -ano | findstr :8000` lalu `taskkill /PID <pid> /F`.
- `DatabaseSeeder` hanya membuat Test User; jalankan `AdminSeeder`, `EventSeeder`, `GuestSeeder` secara terpisah.
