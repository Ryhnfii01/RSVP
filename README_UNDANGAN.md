# 💒 Wedding Invitation - Laravel 12

Website undangan pernikahan modern dan responsive yang dibangun dengan Laravel 12 dan Tailwind CSS v4.

## ✨ Fitur Utama

- **Modern & Responsive Design** - Tampilan modern yang mobile-friendly
- **Countdown Timer** - Timer real-time menuju hari pernikahan
- **RSVP System** - Sistem konfirmasi kehadiran tamu
- **Google Maps Integration** - Integrasi lokasi acara
- **Admin Panel** - Dashboard untuk mengelola daftar tamu
- **Animated UI** - Animasi smooth dan menarik
- **Multi-Section Layout** - Hero, Greeting, Event Details, Map, RSVP

## 🛠️ Tech Stack

- **Laravel 12** - PHP Framework
- **Tailwind CSS v4** - Modern CSS Framework
- **Vite** - Modern build tool
- **MySQL** - Database
- **Alpine.js ready** - Untuk interaktivitas tambahan

## 📋 Prerequisites

- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL/MariaDB
- Docker (jika menggunakan Laradock)

## 🚀 Installation

### 1. Clone Repository

```bash
cd /var/www
git clone <repository-url> undangan
cd undangan
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install NPM dependencies
npm install
```

### 3. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration

Edit file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=invitation
DB_USERNAME=root
DB_PASSWORD=root
```

### 5. Run Migration

```bash
php artisan migrate:fresh
```

### 6. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Start Development Server

```bash
php artisan serve
```

Website akan berjalan di `http://localhost:8000`

## 📱 Struktur Halaman

### 1. Landing Page (/)
- Hero section dengan nama pengantin
- Greeting section dengan informasi pengantin
- Event details dengan countdown timer
- Lokasi acara dengan Google Maps
- Form RSVP

### 2. Admin Panel (/admin/guests)
- Dashboard statistik tamu
- Daftar tamu dengan filter
- Konfirmasi kehadiran
- Hapus tamu
- Lihat pesan dari tamu

## 🎨 Customization

### Mengubah Informasi Pengantin

Edit file `resources/views/invitation/index.blade.php`:

```blade
<!-- Line 24-26 -->
<h1 class="font-script text-5xl sm:text-6xl md:text-7xl lg:text-8xl mb-4 leading-tight">
    Nama Pria  <!-- Ganti dengan nama pria -->
</h1>

<!-- Line 33-35 -->
<h1 class="font-script text-5xl sm:text-6xl md:text-7xl lg:text-8xl mb-8 leading-tight">
    Nama Wanita  <!-- Ganti dengan nama wanita -->
</h1>
```

### Mengubah Tanggal Acara

Edit file `app/Http/Controllers/InvitationController.php`:

```php
public function index()
{
    $eventDate = '2025-12-31 19:00:00'; // Format: YYYY-MM-DD HH:MM:SS
    // ...
}
```

### Mengubah Lokasi Acara

Edit file `resources/views/invitation/index.blade.php`:

1. Update alamat (line ~295)
2. Update link Google Maps
3. Embed Google Maps iframe

### Mengubah Warna Tema

Edit file `resources/css/app.css`:

```css
@theme {
    /* Primary Colors */
    --color-primary-500: #0ea5e9; /* Ubah sesuai keinginan */

    /* Gold Colors */
    --color-gold-500: #eab308; /* Ubah sesuai keinginan */
}
```

### Mengubah Font

Edit file `resources/css/app.css` bagian @import:

```css
@import url('https://fonts.googleapis.com/css2?family=NamaFont:wght@...&display=swap');
```

## 🗄️ Database Structure

### Table: guests

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| name | string | Nama tamu |
| email | string | Email tamu (unique) |
| phone | string | Nomor WhatsApp (nullable) |
| number_of_guests | integer | Jumlah tamu (1-5) |
| message | text | Ucapan & doa (nullable) |
| attendance | enum | 'hadir' atau 'tidak_hadir' |
| is_confirmed | boolean | Status konfirmasi admin |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diupdate |

## 🔧 API Endpoints

### RSVP Submission

```
POST /rsvp
Content-Type: application/json

{
  "name": "string (required)",
  "email": "string (required, email format)",
  "phone": "string (optional)",
  "number_of_guests": "integer (required, 1-5)",
  "message": "string (optional)",
  "attendance": "enum (required: hadir|tidak_hadir)"
}
```

### Admin - Get Guests List

```
GET /admin/guests
```

### Admin - Update Guest

```
PUT /admin/guests/{id}
Content-Type: application/json

{
  "is_confirmed": "boolean"
}
```

### Admin - Delete Guest

```
DELETE /admin/guests/{id}
```

## 🎯 Features Breakdown

### Countdown Timer
- Real-time countdown ke tanggal acara
- Display: Hari, Jam, Menit, Detik
- Auto-update setiap detik

### RSVP Form
- Validasi real-time
- Konfirmasi kehadiran
- Jumlah tamu yang hadir
- Ucapan & doa untuk pengantin
- Alert sukses/error

### Admin Panel
- Statistik: Total, Hadir, Tidak Hadir, Terkonfirmasi
- Tabel daftar tamu
- Toggle konfirmasi
- Hapus tamu
- View pesan dari tamu
- Pagination

## 📦 Production Deployment

### 1. Optimize Aplikasi

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev
```

### 2. Build Assets untuk Production

```bash
npm run build
```

### 3. Set Environment

Update `.env`:

```env
APP_ENV=production
APP_DEBUG=false
```

### 4. Security

- Pastikan `.env` tidak accessible dari web
- Setup SSL certificate (HTTPS)
- Configure proper file permissions
- Setup database backup

## 🔒 Security Considerations

1. **CSRF Protection** - Sudah terintegras i dengan Laravel
2. **Input Validation** - Validasi di controller
3. **SQL Injection Protection** - Menggunakan Eloquent ORM
4. **XSS Protection** - Blade template engine auto-escape

## 🐛 Troubleshooting

### CSS tidak muncul
```bash
npm run build
php artisan cache:clear
```

### Migration error
```bash
php artisan migrate:fresh
```

### Permission error
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## 📝 License

This project is open-sourced software licensed under the MIT license.

## 👨‍💻 Developer

Developed with ❤️ using Laravel 12 & Tailwind CSS

---

**Happy Wedding! 💍**
