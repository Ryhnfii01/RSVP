# 💍 Wedding Invitation Builder - Laravel 12

Sistem undangan pernikahan digital dengan 4 template yang dapat di-customize. Dibangun dengan Laravel 12, Tailwind CSS v4, dan fitur admin panel lengkap.

[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel)](https://laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-v4-38B2AC?logo=tailwind-css)](https://tailwindcss.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?logo=php)](https://php.net)

---

## 📋 Daftar Isi

1. [Features](#features)
2. [Requirements](#requirements)
3. [Installation](#installation)
4. [Configuration](#configuration)
5. [Usage](#usage)
6. [Template Overview](#template-overview)
7. [Template Customization](#template-customization)
8. [Advanced Customization](#advanced-customization)
9. [Troubleshooting](#troubleshooting)
10. [Support](#support)

---

## ✨ Features

- 🎨 **4 Template Designs**: Elegant Modern, Classic Romantic, Elegant Nature, Bugis Emerald
- 🎭 **Scroll Animations**: Smooth animations triggered by scroll (IntersectionObserver)
- 📱 **Fully Responsive**: Mobile-first design, perfect on all devices
- 🎵 **Background Music**: Auto-play music with toggle control
- 🎯 **RSVP System**: Guest confirmation with database storage
- 💬 **Wishes & Messages**: Guest book for wedding wishes
- 🔐 **Admin Panel**: Complete admin dashboard for managing guests and settings
- 🗺️ **Google Maps Integration**: Embed maps for event locations
- 📊 **Guest Analytics**: View confirmed guests, attendance statistics
- 🎨 **Customizable Colors**: Easy color scheme customization
- ⚡ **Fast Performance**: Optimized with Vite and modern CSS
- 🌐 **SEO Ready**: Meta tags and Open Graph support

---

## 📦 Requirements

Pastikan sistem Anda memenuhi requirements berikut:

- **PHP** >= 8.2
- **Composer** >= 2.0
- **Node.js** >= 18.x
- **NPM** atau **Yarn**
- **MySQL** >= 8.0 atau **PostgreSQL** >= 13
- **Web Server**: Apache atau Nginx

**Extensions PHP yang diperlukan**:
- OpenSSL
- PDO
- Mbstring
- Tokenizer
- XML
- Ctype
- JSON
- BCMath
- Fileinfo

---

## 🚀 Installation

### Step 1: Clone Repository

```bash
git clone https://github.com/username/wedding-invitation.git
cd wedding-invitation
```

### Step 2: Install Dependencies

**Install PHP dependencies dengan Composer**:
```bash
composer install
```

**Install JavaScript dependencies dengan NPM**:
```bash
npm install
```

### Step 3: Environment Configuration

**Copy file `.env.example` ke `.env`**:
```bash
cp .env.example .env
```

**Generate application key**:
```bash
php artisan key:generate
```

**Edit file `.env` dan sesuaikan konfigurasi database**:
```env
APP_NAME="Wedding Invitation"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wedding_invitation
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Step 4: Database Setup

**Buat database baru**:
```sql
CREATE DATABASE wedding_invitation;
```

**Jalankan migrations**:
```bash
php artisan migrate
```

**Jalankan seeders (optional, untuk data dummy)**:
```bash
php artisan db:seed
```

Ini akan membuat:
- Admin user (email: admin@example.com, password: password)
- Sample event data
- Sample guest data

### Step 5: Build Assets

**Build frontend assets dengan Vite**:
```bash
npm run build
```

**Untuk development dengan hot reload**:
```bash
npm run dev
```

### Step 6: Storage Link

**Buat symbolic link untuk storage**:
```bash
php artisan storage:link
```

### Step 7: Serve Application

**Jalankan development server**:
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

---

## ⚙️ Configuration

### Admin Panel Access

**URL**: `http://localhost:8000/admin`

**Default Credentials**:
- **Email**: `admin@example.com`
- **Password**: `password`

⚠️ **PENTING**: Ganti password default setelah instalasi pertama!

### Event Settings

1. Login ke admin panel
2. Klik **Settings** di sidebar
3. Klik **Edit Event**
4. Isi form dengan data event Anda:
   - Event Type (Wedding, Seminar, Aqiqah, Birthday)
   - Bride & Groom Names
   - Parents Names
   - Event Date & Time
   - Venue Information
   - Google Maps URL
   - Instagram Accounts
   - Love Story (optional)
   - Background Music filename

### Upload Music

1. Upload file musik ke `public/music/`
2. Format yang didukung: MP3, OGG, WAV
3. Recommended size: < 5MB
4. Ubah filename di Event Settings

### Upload Images

**Gallery Images**:
```bash
public/images/gallery/
```

**Couple Photos**:
```bash
public/images/couple/
```

Recommended image size:
- Gallery: 800x600px
- Couple photos: 500x500px
- Format: JPG atau PNG
- Max size: 200KB per image

---

## 📖 Usage

### Viewing Templates

1. Buka homepage: `http://localhost:8000`
2. Browse semua template yang tersedia
3. Klik **Gunakan Template Ini** untuk preview
4. Share link template ke tamu undangan

### Managing Guests

**Via Admin Panel**:
1. Login ke `/admin`
2. Klik **Guests** di sidebar
3. View semua guest yang sudah RSVP
4. Filter by attendance status
5. Export data ke CSV

### Guest RSVP Flow

1. Tamu membuka link undangan
2. Klik tombol **Open Invitation**
3. Scroll ke section **RSVP**
4. Isi form:
   - Nama Lengkap
   - Email (optional)
   - Phone (optional)
   - Konfirmasi Kehadiran (Hadir/Tidak Hadir)
   - Jumlah Tamu
   - Pesan/Ucapan
5. Submit form
6. Data tersimpan di database dan bisa dilihat di admin panel

---

## 🎯 Template Overview

Sistem undangan pernikahan ini memiliki 4 template yang dapat di-customize:
- **Template 1**: Elegant Modern - Modern dengan glassmorphism dan smooth animations
- **Template 2**: Classic Romantic - Klasik dengan nuansa romantis dan floral design
- **Template 3**: Elegant Nature - Natural dan earthy dengan parallax effects
- **Template 4**: Bugis Emerald - Traditional Bugis dengan Islamic elements

---

## 🎨 Template Customization

### Struktur File

```
resources/views/
├── layouts/
│   └── app.blade.php                    # Main layout untuk semua template
├── templates/
│   ├── template-1/
│   │   ├── index.blade.php              # Template 1 main file
│   │   └── sections/                    # Template 1 sections (gallery, gift, dll)
│   ├── template-2/
│   │   ├── index.blade.php              # Template 2 main file
│   │   └── sections/                    # Template 2 sections
│   ├── template-3/
│   │   ├── index.blade.php              # Template 3 main file
│   │   └── sections/                    # Template 3 sections
│   └── template-4/
│       └── index.blade.php              # Template 4 main file (standalone)
└── home.blade.php                       # Template selector page
```

---

## 🎨 Template 1 - Elegant Modern

**File**: `/resources/views/templates/template-1/index.blade.php`

### 1. Mengubah Warna Tema

Template 1 menggunakan warna **Primary (Blue)** dan **Gold**. Untuk mengubahnya:

**Lokasi**: `tailwind.config.js`

```js
module.exports = {
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#f0f9ff',
          100: '#e0f2fe',
          // ... ubah sesuai warna yang diinginkan
          600: '#0284c7',  // Warna utama
          700: '#0369a1',
        },
        gold: {
          300: '#fcd34d',
          400: '#fbbf24',
          500: '#f59e0b',
          600: '#d97706',
        }
      }
    }
  }
}
```

### 2. Mengubah Nama Pengantin

**Lokasi**: `index.blade.php` - Line 22-29 (Opening Cover)

```blade
<h2 class="font-script text-4xl sm:text-5xl md:text-6xl text-white mb-4">
    Nama Pria & Nama Wanita  <!-- UBAH DI SINI -->
</h2>
```

**Lokasi**: Line 63-72 (Hero Section)

```blade
<h1 class="font-script text-5xl sm:text-6xl md:text-7xl lg:text-8xl mb-4 leading-tight">
    Nama Pria  <!-- UBAH DI SINI -->
</h1>
<!-- ... -->
<h1 class="font-script text-5xl sm:text-6xl md:text-7xl lg:text-8xl mb-8 leading-tight">
    Nama Wanita  <!-- UBAH DI SINI -->
</h1>
```

**Lokasi**: Line 113-154 (Bride & Groom Cards)

```blade
<!-- Groom Card -->
<h3 class="font-script text-3xl sm:text-4xl text-primary-700 mb-2">
    Nama Lengkap Pria  <!-- UBAH DI SINI -->
</h3>
<p class="text-gray-600 mb-1">Putra dari</p>
<p class="font-medium text-gray-800">
    Bapak [Nama] & Ibu [Nama]  <!-- UBAH DI SINI -->
</p>
<a href="https://instagram.com/username" target="_blank">
    @username  <!-- UBAH DI SINI -->
</a>

<!-- Bride Card -->
<h3 class="font-script text-3xl sm:text-4xl text-gold-700 mb-2">
    Nama Lengkap Wanita  <!-- UBAH DI SINI -->
</h3>
<p class="text-gray-600 mb-1">Putri dari</p>
<p class="font-medium text-gray-800">
    Bapak [Nama] & Ibu [Nama]  <!-- UBAH DI SINI -->
</p>
<a href="https://instagram.com/username" target="_blank">
    @username  <!-- UBAH DI SINI -->
</a>
```

### 3. Mengubah Tanggal & Waktu Acara

**Lokasi Controller**: `/app/Http/Controllers/InvitationController.php` - Line 59

```php
private function getInvitationData()
{
    $eventDate = '2025-12-31 19:00:00';  // UBAH DI SINI (Format: Y-m-d H:i:s)
    // ...
}
```

**Lokasi View**: `index.blade.php` - Line 32, 77-80, 229-235

```blade
<!-- Opening Cover -->
<p class="text-white/90 text-lg mb-2">Minggu, 31 Desember 2025</p>  <!-- UBAH -->

<!-- Hero Section -->
<p class="text-base sm:text-lg md:text-xl mb-2">
    Minggu, 31 Desember 2025  <!-- UBAH -->
</p>
<p class="text-sm sm:text-base opacity-90">
    Pukul 19.00 WIB  <!-- UBAH -->
</p>

<!-- Event Cards -->
<p>Minggu, 31 Desember 2025</p>  <!-- UBAH -->
<p>08.00 - 10.00 WIB</p>  <!-- UBAH (Akad) -->
<p>11.00 - 14.00 WIB</p>  <!-- UBAH (Resepsi) -->
```

### 4. Mengubah Lokasi Acara

**Lokasi**: `index.blade.php` - Line 240-243, 270-273

```blade
<!-- Akad Nikah -->
<p>Gedung Serbaguna</p>  <!-- UBAH -->
<p>Jl. Contoh No. 123, Jakarta</p>  <!-- UBAH -->

<!-- Resepsi -->
<p>Grand Ballroom Hotel</p>  <!-- UBAH -->
<p>Jl. Contoh No. 456, Jakarta</p>  <!-- UBAH -->
```

### 5. Menambahkan Google Maps

**Lokasi**: `index.blade.php` - Setelah event cards

```blade
<!-- Map Section -->
<div class="mt-12 rounded-2xl overflow-hidden shadow-xl animate-on-scroll" data-delay="400">
    <iframe
        src="https://www.google.com/maps/embed?pb=YOUR_EMBED_CODE"
        width="100%"
        height="450"
        style="border:0;"
        allowfullscreen=""
        loading="lazy">
    </iframe>
</div>
```

**Cara mendapatkan embed code**:
1. Buka Google Maps
2. Cari lokasi acara
3. Klik "Share" → "Embed a map"
4. Copy code iframe
5. Paste di section map

### 6. Mengubah Background Music

**Lokasi**: `index.blade.php` - Line ~600

```blade
<audio id="background-music" loop>
    <source src="/music/wedding-bg.mp3" type="audio/mpeg">  <!-- UBAH -->
</audio>
```

**Langkah-langkah**:
1. Upload file musik ke `public/music/`
2. Ubah path di `<source src="...">`
3. Format yang didukung: MP3, OGG, WAV

### 7. Customize Gallery

**File**: `/resources/views/templates/template-1/sections/gallery.blade.php`

```blade
<!-- Ubah path gambar -->
<img src="{{ asset('images/gallery/photo1.jpg') }}" alt="Gallery 1">
<img src="{{ asset('images/gallery/photo2.jpg') }}" alt="Gallery 2">
<!-- ... -->
```

**Langkah-langkah**:
1. Upload foto ke `public/images/gallery/`
2. Ubah path di section gallery
3. Recommended size: 800x600px, format JPG/PNG

### 8. Customize Animations

**Lokasi**: `index.blade.php` - Bagian `<style>` di akhir file

```css
/* Ubah durasi animasi */
.animate-on-scroll {
    transition: opacity 0.8s ease-out, transform 0.8s ease-out;  /* Ubah 0.8s */
}

/* Ubah jarak gerakan animasi */
.fade-in-left {
    transform: translateX(-50px);  /* Ubah -50px untuk jarak lebih jauh/dekat */
}
```

**Tipe animasi yang tersedia**:
- `animate-on-scroll` - Fade in dari bawah
- `fade-in-left` - Slide dari kiri
- `fade-in-right` - Slide dari kanan
- `scale-in` - Zoom in
- `slide-up` - Slide dari bawah

**Cara menggunakan**:
```blade
<div class="fade-in-left" data-delay="200">
    <!-- Content -->
</div>
```

### 9. Mengubah Font

**Lokasi**: `resources/css/app.css`

```css
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Great+Vibes&display=swap');

@layer base {
  .font-script {
    font-family: 'Great Vibes', cursive;  /* Ubah font script */
  }

  .font-serif {
    font-family: 'Playfair Display', serif;  /* Ubah font serif */
  }
}
```

**Font Recommendations**:
- **Script**: Great Vibes, Pacifico, Dancing Script, Sacramento
- **Serif**: Playfair Display, Merriweather, Lora, Crimson Text

---

## 💕 Template 2 - Classic Romantic

**File**: `/resources/views/templates/template-2/index.blade.php`

### 1. Mengubah Warna Tema

Template 2 menggunakan warna **Rose/Pink**.

**Lokasi**: `tailwind.config.js`

```js
colors: {
  rose: {
    100: '#ffe4e6',
    500: '#f43f5e',  // Warna utama - UBAH DI SINI
    600: '#e11d48',
  }
}
```

**Atau ubah langsung di CSS**:

Lokasi: `index.blade.php` - Bagian `@push('styles')`

```css
:root {
  --color-primary: #f43f5e;  /* Pink/Rose - UBAH */
  --color-secondary: #ec4899;  /* UBAH */
}
```

### 2. Mengubah Ornamen Floral

**Lokasi**: `sections/couple.blade.php`

```blade
<!-- Ubah SVG ornamen -->
<svg class="floral-ornament">
  <!-- Edit path SVG sesuai design yang diinginkan -->
</svg>
```

### 3. Customize Timeline/Love Story

**Lokasi**: `sections/timeline.blade.php`

```blade
<!-- Timeline Item -->
<div class="timeline-item">
    <div class="timeline-date">2020</div>  <!-- UBAH tahun -->
    <div class="timeline-content">
        <h3>Pertama Bertemu</h3>  <!-- UBAH judul -->
        <p>Cerita singkat tentang pertemuan pertama...</p>  <!-- UBAH cerita -->
    </div>
</div>

<!-- Tambah item baru -->
<div class="timeline-item">
    <div class="timeline-date">2023</div>
    <div class="timeline-content">
        <h3>Lamaran</h3>
        <p>Cerita tentang lamaran...</p>
    </div>
</div>
```

### 4. Menambah/Mengurangi Section

**Untuk menambah section baru**:

1. Buat file di `sections/nama-section.blade.php`
2. Include di `index.blade.php`:

```blade
@include('templates.template-2.sections.nama-section')
```

**Untuk menghilangkan section**:

Comment atau hapus baris include:

```blade
{{-- @include('templates.template-2.sections.timeline') --}}
```

---

## 🌿 Template 3 - Elegant Nature

**File**: `/resources/views/templates/template-3/index.blade.php`

### 1. Mengubah Warna Tema

Template 3 menggunakan warna **Brown/Earth tones**.

**Lokasi**: `tailwind.config.js`

```js
colors: {
  brown: {
    100: '#fef3c7',
    600: '#92400e',  // Brown - UBAH
    700: '#78350f',
  },
  cream: {
    200: '#fef3c7',
    300: '#fde68a',
  }
}
```

### 2. Mengubah Parallax Effect

**Lokasi**: `index.blade.php` - JavaScript section

```js
// Parallax speed
document.querySelectorAll('.parallax').forEach(el => {
    const speed = el.dataset.speed || 0.5;  // UBAH 0.5 untuk speed berbeda
    const yPos = -(scrolled * speed);
    el.style.transform = `translateY(${yPos}px)`;
});
```

**Cara menggunakan**:

```blade
<div class="parallax" data-speed="0.3">
    <!-- Semakin kecil speed, semakin lambat gerakan -->
</div>
```

### 3. Customize Nature Elements

**Lokasi**: `index.blade.php` - Decorative elements

```blade
<!-- Ubah SVG daun/elemen nature -->
<svg class="leaf-ornament">
  <path d="..." />  <!-- Edit path untuk bentuk berbeda -->
</svg>
```

---

## 🕌 Template 4 - Bugis Emerald

**File**: `/resources/views/templates/template-4/index.blade.php`

### 1. Mengubah Warna Tema

Template 4 menggunakan warna **Emerald/Green** dengan **Cream/Gold**.

**Lokasi**: `index.blade.php` - Bagian `<style>` (Line 24-55)

```css
/* Bugis Emerald Color Scheme */
.bg-emerald-dark {
    background-color: #003f30;  /* UBAH - Emerald gelap */
}

.bg-emerald {
    background-color: #059669;  /* UBAH - Emerald terang */
}

.bg-cream {
    background-color: #f9e7bc;  /* UBAH - Cream */
}

.text-emerald-dark {
    color: #003f30;  /* UBAH */
}

.text-emerald {
    color: #059669;  /* UBAH */
}

.text-cream {
    color: #f9e7bc;  /* UBAH */
}
```

**Color Scheme Alternatives**:
- **Ruby Red**: `#7C2D2D`, `#C85A54`, `#FFE5B4`
- **Sapphire Blue**: `#0F4C75`, `#3282B8`, `#F5F5F5`
- **Amethyst Purple**: `#4A148C`, `#7B1FA2`, `#F3E5F5`

### 2. Mengubah Ayat Al-Quran

**Lokasi**: `index.blade.php` - Line 313-320

```blade
<p class="font-serif text-2xl sm:text-3xl mb-6 leading-relaxed" dir="rtl">
    وَمِنْ آيَاتِهِ أَنْ خَلَقَ لَكُم مِّنْ أَنفُسِكُمْ أَزْوَاجًا  <!-- UBAH ayat -->
</p>
<p class="text-xs sm:text-sm opacity-90 leading-relaxed">
    "Dan di antara tanda-tanda (kebesaran)-Nya..."  <!-- UBAH terjemahan -->
</p>
<p class="mt-4 font-serif text-lg">— QS. Ar-Rum: 21 —</p>  <!-- UBAH surat -->
```

### 3. Mengubah Mappatabe' (Pesan Traditional)

**Lokasi**: `index.blade.php` - Line 484-495

```blade
<h2 class="font-serif text-3xl mb-8">Mappatabe'</h2>  <!-- UBAH judul -->
<p class="font-serif text-base sm:text-lg leading-relaxed italic mb-6">
    "Rebba sipatokkong, mali siparappe, sipakalebbi..."  <!-- UBAH pesan Bugis -->
</p>
<p class="text-xs sm:text-sm opacity-90 leading-relaxed">
    (Artinya: Jatuh saling menopang...)  <!-- UBAH terjemahan -->
</p>
```

**Alternative Messages**:
- Pesan adat Jawa
- Pesan adat Sunda
- Quotes pernikahan
- Doa pernikahan

### 4. Customize Bugis Ornaments

**Lokasi**: `index.blade.php` - CSS section (Line 57-62)

```css
/* Bugis Ornament Pattern */
.bugis-ornament {
    background-image:
        repeating-linear-gradient(45deg, transparent, transparent 10px,
                                   rgba(249, 231, 188, 0.1) 10px,
                                   rgba(249, 231, 188, 0.1) 20px);  /* UBAH pattern */
}
```

**Ornament Symbols**:

Lokasi: Line 304, 331

```blade
<span class="text-3xl text-cream">✤</span>  <!-- UBAH symbol (✤, ❋, ✿, ❈) -->
```

### 5. Mengubah Decorative Frames

**Lokasi**: `index.blade.php` - CSS (Line 120-200)

```css
/* Section Frame Ornaments */
.section-frame::before,
.section-frame::after {
    content: '✤';  /* UBAH symbol */
    font-size: 3rem;  /* UBAH ukuran */
    opacity: 0.4;  /* UBAH opacity */
}

/* Four Corner Frame */
.four-corner-frame::before,
.four-corner-frame::after {
    width: 80px;  /* UBAH ukuran frame */
    height: 80px;
    border: 3px solid #f9e7bc;  /* UBAH ketebalan & warna */
    opacity: 0.3;  /* UBAH opacity */
}
```

### 6. Customize Bottom Navigation

**Lokasi**: `index.blade.php` - Line 599-649

```blade
<!-- Ubah item navigation -->
<a href="#opening" class="nav-item">
    <svg>...</svg>
    <span>Home</span>  <!-- UBAH label -->
</a>

<!-- Tambah item baru -->
<a href="#new-section" class="nav-item">
    <svg class="w-6 h-6">
        <!-- SVG icon baru -->
    </svg>
    <span>New Section</span>
</a>
```

**Menambah/mengurangi dots indicator**:

```blade
<!-- Tambah/kurangi sesuai jumlah nav items -->
<div id="nav-dots" class="flex justify-center items-center gap-1.5 pb-2 pt-1">
    <div class="dot w-1.5 h-1.5 rounded-full bg-cream"></div>
    <div class="dot w-1.5 h-1.5 rounded-full bg-cream/30"></div>
    <div class="dot w-1.5 h-1.5 rounded-full bg-cream/30"></div>
    <!-- Tambah dot baru untuk section baru -->
</div>
```

---

## 🌐 Global Customization

Customization yang berlaku untuk semua template.

### 1. Mengubah Event Data via Admin Panel

**URL**: `/admin/event-settings`

**Fields yang bisa diubah**:
- Event Type (Wedding, Seminar, Aqiqah, Birthday, Other)
- Bride Name, Father, Mother
- Groom Name, Father, Mother
- Event Title & Description
- Event Date, Time Start, Time End
- Venue Name, Address, City
- Google Maps URL
- Coordinates (Latitude, Longitude)
- Instagram Bride & Groom
- Love Story
- Background Music filename

**Cara menggunakan**:
1. Login ke `/admin`
2. Klik "Settings" di sidebar
3. Klik "Edit Event"
4. Isi form sesuai kebutuhan
5. Klik "Save"

### 2. Mengganti Layout Wrapper

**File**: `/resources/views/layouts/app.blade.php`

```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Undangan Pernikahan')</title>  <!-- UBAH title -->

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100">  <!-- UBAH background -->
    @yield('content')
    @stack('scripts')
</body>
</html>
```

### 3. Mengubah Metadata SEO

**Lokasi**: Setiap template - Bagian `@section('title')`

```blade
@section('title', 'Wedding Invitation - Nama Pengantin')  <!-- UBAH -->

<!-- Tambahkan meta description -->
<meta name="description" content="Undangan pernikahan Nama Pria & Nama Wanita">
<meta name="keywords" content="undangan, pernikahan, wedding">

<!-- Open Graph untuk social media -->
<meta property="og:title" content="Wedding Invitation - Nama Pengantin">
<meta property="og:description" content="31 Desember 2025">
<meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
```

### 4. Mengubah Favicon

**Lokasi**: `public/favicon.ico`

1. Generate favicon dari https://favicon.io/
2. Replace file `public/favicon.ico`
3. Tambahkan di `layouts/app.blade.php`:

```blade
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
```

### 5. RSVP Form Customization

**Fields default**:
- Nama Lengkap
- Email (optional)
- Nomor Telepon (optional)
- Konfirmasi Kehadiran (Hadir/Tidak Hadir)
- Jumlah Tamu
- Pesan/Ucapan

**Untuk menambah field**:

1. **Migration**: Tambah kolom di tabel `guests`

```bash
php artisan make:migration add_custom_field_to_guests_table
```

```php
public function up()
{
    Schema::table('guests', function (Blueprint $table) {
        $table->string('custom_field')->nullable();
    });
}
```

2. **Model**: Update `$fillable` di `app/Models/Guest.php`

```php
protected $fillable = [
    'name', 'email', 'phone', 'attendance', 'number_of_guests',
    'message', 'custom_field'  // Tambah di sini
];
```

3. **View**: Tambah input di form RSVP

```blade
<div>
    <label class="block text-sm font-medium mb-2">Custom Field</label>
    <input type="text" name="custom_field" class="w-full px-4 py-3...">
</div>
```

4. **Validation**: Update di `GuestController.php`

```php
$validated = $request->validate([
    // ...
    'custom_field' => 'nullable|string|max:255',
]);
```

---

## 🚀 Advanced Customization

### 1. Membuat Template Baru

**Langkah-langkah**:

1. **Copy template existing**:
```bash
cp -r resources/views/templates/template-1 resources/views/templates/template-5
```

2. **Rename file** sesuai kebutuhan

3. **Tambahkan route** di `routes/web.php`:
```php
Route::prefix('template-5')->name('template5.')->group(function () {
    Route::get('/', [InvitationController::class, 'template5'])->name('index');
    Route::post('/rsvp', [GuestController::class, 'store'])->name('rsvp.store');
});
```

4. **Tambahkan method di controller** `InvitationController.php`:
```php
public function template5()
{
    $data = $this->getInvitationData();
    return view('templates.template-5.index', $data);
}
```

5. **Tambahkan di home page** `home.blade.php`:
```blade
<!-- Template 5 Card -->
<div class="...">
    <!-- Template preview -->
    <a href="{{ route('template5.index') }}">Gunakan Template Ini</a>
</div>
```

### 2. Menambahkan Custom Animation

**Lokasi**: Template file - Bagian `<style>`

```css
/* Custom animation keyframes */
@keyframes customFadeIn {
    from {
        opacity: 0;
        transform: translateY(50px) rotate(5deg);
    }
    to {
        opacity: 1;
        transform: translateY(0) rotate(0deg);
    }
}

/* Custom animation class */
.custom-fade-in {
    opacity: 0;
    animation: customFadeIn 1s ease-out forwards;
}

/* Dengan scroll trigger */
.custom-fade-in.animated {
    animation-play-state: running;
}
```

**JavaScript untuk trigger**:

```js
document.querySelectorAll('.custom-fade-in').forEach(el => {
    animateOnScroll.observe(el);
});
```

### 3. Integrasi dengan Payment Gateway

**Untuk digital gift/angpao online**:

1. **Install package** (contoh: Midtrans)
```bash
composer require midtrans/midtrans-php
```

2. **Buat migration** untuk transactions
```bash
php artisan make:migration create_transactions_table
```

3. **Buat controller**
```bash
php artisan make:controller PaymentController
```

4. **Tambahkan button di gift section**:
```blade
<button onclick="openPayment()">
    Kirim Angpao Digital
</button>
```

5. **Implementasi payment flow** sesuai dokumentasi provider

### 4. Menambahkan WhatsApp Share

**Lokasi**: Setiap template - Tambahkan button share

```blade
<button onclick="shareWhatsApp()" class="btn-share">
    <svg><!-- WhatsApp icon --></svg>
    Share ke WhatsApp
</button>

<script>
function shareWhatsApp() {
    const text = 'Undangan Pernikahan Nama Pria & Nama Wanita - 31 Desember 2025';
    const url = window.location.href;
    const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(text + ' ' + url)}`;
    window.open(whatsappUrl, '_blank');
}
</script>
```

### 5. Add to Calendar Integration

```blade
<button onclick="addToCalendar()" class="btn-calendar">
    <svg><!-- Calendar icon --></svg>
    Tambah ke Kalender
</button>

<script>
function addToCalendar() {
    const event = {
        title: 'Pernikahan Nama Pria & Nama Wanita',
        description: 'Undangan pernikahan',
        location: 'Grand Ballroom Hotel, Jakarta',
        start: '2025-12-31T19:00:00',
        end: '2025-12-31T22:00:00'
    };

    // Google Calendar URL
    const googleCalUrl = `https://calendar.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(event.title)}&dates=${event.start.replace(/[-:]/g, '')}/${event.end.replace(/[-:]/g, '')}&details=${encodeURIComponent(event.description)}&location=${encodeURIComponent(event.location)}`;

    window.open(googleCalUrl, '_blank');
}
</script>
```

### 6. Live Streaming Integration

**Untuk acara hybrid (offline + online)**:

```blade
<!-- YouTube Embed -->
<section id="live-streaming" class="py-20">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-serif text-center mb-8">Live Streaming</h2>

        <div class="max-w-4xl mx-auto">
            <div class="aspect-w-16 aspect-h-9">
                <iframe
                    src="https://www.youtube.com/embed/VIDEO_ID"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>

            <div class="mt-4 text-center">
                <p class="text-gray-600">
                    Live streaming akan dimulai pada:<br>
                    <strong>31 Desember 2025, 19:00 WIB</strong>
                </p>
            </div>
        </div>
    </div>
</section>
```

### 7. Photo Booth / Upload Photo

**Fitur untuk tamu upload foto**:

1. **Create migration**:
```bash
php artisan make:migration create_guest_photos_table
```

2. **Create upload form**:
```blade
<form action="{{ route('photo.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="photo" accept="image/*" capture="camera">
    <input type="text" name="caption" placeholder="Caption...">
    <button type="submit">Upload</button>
</form>
```

3. **Display photos gallery**:
```blade
<div class="photo-gallery">
    @foreach($guestPhotos as $photo)
        <div class="photo-item">
            <img src="{{ asset('storage/' . $photo->path) }}">
            <p>{{ $photo->caption }}</p>
        </div>
    @endforeach
</div>
```

---

## 📱 Responsive Customization

### Breakpoints Tailwind CSS

```
- sm: 640px   (Mobile landscape)
- md: 768px   (Tablet)
- lg: 1024px  (Desktop)
- xl: 1280px  (Large desktop)
```

### Customize untuk Mobile

```blade
<!-- Desktop: 3 kolom, Mobile: 1 kolom -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <!-- Content -->
</div>

<!-- Hide di mobile -->
<div class="hidden md:block">
    <!-- Content hanya tampil di desktop -->
</div>

<!-- Show hanya di mobile -->
<div class="block md:hidden">
    <!-- Content hanya tampil di mobile -->
</div>
```

---

## 🎨 Color Scheme Ideas

### Pastel Theme
```css
:root {
  --primary: #FFB6C1;   /* Light Pink */
  --secondary: #E6E6FA; /* Lavender */
  --accent: #FFDAB9;    /* Peach */
}
```

### Bold & Modern
```css
:root {
  --primary: #FF6B6B;   /* Coral Red */
  --secondary: #4ECDC4; /* Turquoise */
  --accent: #FFE66D;    /* Yellow */
}
```

### Classic Elegant
```css
:root {
  --primary: #2C3E50;   /* Navy Blue */
  --secondary: #ECF0F1; /* Light Gray */
  --accent: #C0A080;    /* Gold */
}
```

### Rustic Natural
```css
:root {
  --primary: #8B4513;   /* Saddle Brown */
  --secondary: #DEB887; /* Burlywood */
  --accent: #F5DEB3;    /* Wheat */
}
```

---

## 🔧 Troubleshooting

### Animations Tidak Berjalan

**Solusi**:
1. Pastikan JavaScript loaded:
```blade
@push('scripts')
<script>
    console.log('Script loaded');
</script>
@endpush
```

2. Check IntersectionObserver support:
```js
if ('IntersectionObserver' in window) {
    // Code here
} else {
    console.log('IntersectionObserver not supported');
}
```

### Warna Tidak Berubah

**Solusi**:
1. Rebuild Tailwind:
```bash
npm run build
```

2. Clear cache:
```bash
php artisan cache:clear
php artisan view:clear
```

### Background Music Tidak Autoplay

**Solusi**:

Browser modern memblock autoplay. Gunakan user interaction:

```js
// Play music setelah user click button
openButton.addEventListener('click', function() {
    backgroundMusic.play().catch(e => {
        console.log('Autoplay prevented:', e);
    });
});
```

### Gambar Tidak Muncul

**Solusi**:
1. Check path:
```blade
{{ asset('images/photo.jpg') }}  <!-- Correct -->
```

2. Create symbolic link:
```bash
php artisan storage:link
```

3. Check file permissions:
```bash
chmod -R 755 public/images
```

### Installation Issues

**Error: "composer install" gagal**

Solusi:
```bash
# Clear composer cache
composer clear-cache

# Install ulang dengan verbose
composer install -vvv

# Atau gunakan --ignore-platform-reqs jika ada masalah dengan PHP version check
composer install --ignore-platform-reqs
```

**Error: "npm install" gagal**

Solusi:
```bash
# Clear npm cache
npm cache clean --force

# Hapus node_modules dan package-lock.json
rm -rf node_modules package-lock.json

# Install ulang
npm install
```

**Error: "SQLSTATE[HY000] [1045] Access denied"**

Solusi:
1. Periksa credentials database di `.env`
2. Pastikan database sudah dibuat
3. Test koneksi:
```bash
php artisan tinker
DB::connection()->getPdo();
```

**Error: "Mix file does not exist" atau "Vite manifest not found"**

Solusi:
```bash
# Build assets
npm run build

# Atau run dev server
npm run dev
```

**Error: "Class 'Vite' not found"**

Solusi:
```bash
# Clear cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Rebuild autoload
composer dump-autoload
```

**Permission Issues (Linux/Mac)**

Solusi:
```bash
# Set correct permissions
sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

---

## 📚 Resources

### Fonts
- **Google Fonts**: https://fonts.google.com/
- **Font Awesome Icons**: https://fontawesome.com/

### Images
- **Unsplash**: https://unsplash.com/ (Free stock photos)
- **Pexels**: https://www.pexels.com/
- **Pixabay**: https://pixabay.com/

### Icons
- **Heroicons**: https://heroicons.com/
- **Feather Icons**: https://feathericons.com/
- **Flaticon**: https://www.flaticon.com/

### Colors
- **Coolors**: https://coolors.co/ (Color palette generator)
- **Adobe Color**: https://color.adobe.com/

### Music
- **YouTube Audio Library**: https://www.youtube.com/audiolibrary
- **Free Music Archive**: https://freemusicarchive.org/

---

## 💡 Tips & Best Practices

1. **Performance**
   - Optimize images (max 200KB per image)
   - Use lazy loading untuk images
   - Minify CSS/JS untuk production

2. **Accessibility**
   - Gunakan semantic HTML
   - Add alt text untuk images
   - Ensure good color contrast

3. **Testing**
   - Test di berbagai devices (mobile, tablet, desktop)
   - Test di berbagai browsers (Chrome, Firefox, Safari)
   - Test loading speed dengan Google PageSpeed Insights

4. **Backup**
   - Selalu backup before customize
   - Use version control (Git)
   - Document your changes

5. **Security**
   - Sanitize user input
   - Use CSRF protection (Laravel default)
   - Keep dependencies updated

---

## 📞 Support

Jika ada pertanyaan atau butuh bantuan:
- **Email**: support@example.com
- **Documentation**: Check README.md
- **Issues**: Create issue di GitHub repository

---

## ☕ Buy Me a Coffee

Jika project ini bermanfaat untuk Anda, dukung pengembangan selanjutnya:

**[☕ Buy Me a Coffee via Saweria](https://saweria.co/yusril713)**

Dukungan Anda sangat berarti untuk pengembangan fitur-fitur baru! 🙏

---

**Last Updated**: {{ date('Y-m-d') }}
**Version**: 1.0.0

---

Happy Customizing! 🎉💍
