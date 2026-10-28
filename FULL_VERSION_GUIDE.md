# 🎊 Wedding Invitation - Full Version Guide

## 📋 Complete Section List

Berikut adalah daftar lengkap semua section yang akan ditambahkan, diadaptasi dari AFU Nagara untuk undangan pernikahan:

### 1. **Opening Cover** ✅ (Sudah Ada)
- Hero image dengan overlay
- Tombol "Open Invitation"
- Nama pengantin & tanggal

### 2. **Opening/Hero** ✅ (Sudah Ada)
- Nama pengantin besar
- Tanggal & waktu acara
- Scroll indicator

### 3. **Salam/Greeting** ✅ (Sudah Ada)
- Salam pembuka
- Profile pengantin (foto & nama orang tua)
- Instagram links

### 4. **Gallery/Photos** 🆕
**ID:** `#gallery`
**Konten:**
- Grid 3x3 foto pre-wedding
- Lightbox untuk zoom
- Lazy loading images

**Struktur File:**
```
public/images/gallery/
├── photo-1.jpg
├── photo-2.jpg
└── ... photo-9.jpg
```

### 5. **Love Story Timeline** 🆕
**ID:** `#story`
**Konten:**
- Timeline vertical dengan milestone
- Icon untuk setiap moment
- Tanggal & deskripsi

**Data:**
```php
$timeline = [
    ['date' => '2020-01-15', 'title' => 'Pertama Bertemu', 'desc' => '...'],
    ['date' => '2021-06-20', 'title' => 'Jadian', 'desc' => '...'],
    ['date' => '2024-12-01', 'title' => 'Lamaran', 'desc' => '...'],
];
```

### 6. **Event Details** ✅ (Sudah Ada)
- Countdown timer
- Akad nikah info
- Resepsi info

### 7. **Live Streaming** 🆕
**ID:** `#streaming`
**Konten:**
- YouTube/Instagram embed
- Jadwal live
- Link alternatif

### 8. **Maps/Location** ✅ (Sudah Ada)
- Google Maps embed
- Alamat lengkap
- Button "Buka di Maps"

### 9. **Wedding Party** 🆕
**ID:** `#party`
**Konten:**
- Foto & nama orang tua kedua mempelai
- Saksi nikah
- Best man & bridesmaids
- Wedding organizer contact

**Struktur:**
```
- Parents Section
  - Groom's Parents
  - Bride's Parents
- Witnesses
- Best Man & Bridesmaids
- Wedding Organizer
```

### 10. **Gift/Hadiah** 🆕
**ID:** `#gift`
**Konten:**
- Nomor rekening (BCA, Mandiri, dll)
- Copy button
- QR Code payment (QRIS)
- Alamat kirim hadiah fisik

**Data:**
```php
$gifts = [
    ['bank' => 'BCA', 'number' => '1234567890', 'name' => 'Nama Pria'],
    ['bank' => 'Mandiri', 'number' => '0987654321', 'name' => 'Nama Wanita'],
];
```

### 11. **Dress Code & Protocol** 🆕
**ID:** `#protocol`
**Konten:**
- Theme color acara
- Dress code untuk tamu
- Protokol kesehatan
- Do's & Don'ts

### 12. **RSVP Form** ✅ (Sudah Ada)
- Form konfirmasi
- Jumlah tamu
- Ucapan & doa

### 13. **Guest Book/Ucapan** 🆕
**ID:** `#wishes`
**Konten:**
- Display ucapan dari database
- Real-time updates
- Love/Like button
- Pagination

**Database Query:**
```php
$wishes = Guest::where('message', '!=', null)
    ->orderBy('created_at', 'desc')
    ->paginate(10);
```

### 14. **Thanks/Closing** 🆕
**ID:** `#thanks`
**Konten:**
- Ucapan terima kasih
- Credit & copyright
- Social media links
- Optional: Sponsor logos

---

## 🎨 Bottom Navigation Update

Bottom nav akan diupdate dengan menu baru:

```
1. Opening  (Home icon)
2. Salam    (Book icon)
3. Gallery  (Photo icon) 🆕
4. Story    (Heart icon) 🆕
5. Event    (Calendar icon)
6. Stream   (Video icon) 🆕
7. Maps     (Location icon)
8. Party    (Users icon) 🆕
9. Gift     (Gift icon) 🆕
10. RSVP    (Document icon)
11. Wishes  (Message icon) 🆕
```

**Implementasi:** Scrollable horizontal nav untuk accommodate semua menu

---

## 📁 File Structure

```
resources/views/invitation/
├── index-full.blade.php          # Main file (semua section)
├── index.blade.php                # Simple version (current)
└── sections/
    ├── gallery.blade.php
    ├── story.blade.php
    ├── streaming.blade.php
    ├── party.blade.php
    ├── gift.blade.php
    ├── protocol.blade.php
    └── wishes.blade.php
```

```
public/images/
├── gallery/
│   ├── photo-1.jpg ... photo-9.jpg
├── couple/
│   ├── groom.jpg
│   ├── bride.jpg
│   ├── groom-parents.jpg
│   └── bride-parents.jpg
└── qr-code/
    ├── qris.png
    └── bank-qr.png
```

---

## 🚀 Implementation Plan

### Phase 1: Core Sections
1. ✅ Update bottom nav (scrollable)
2. 🔨 Gallery section
3. 🔨 Gift section
4. 🔨 Guest Book section

### Phase 2: Additional Sections
5. 🔨 Love Story timeline
6. 🔨 Wedding Party
7. 🔨 Live Streaming

### Phase 3: Polish
8. 🔨 Protocol section
9. 🔨 Thanks section
10. 🔨 Animations & interactions

---

## 💻 Usage Instructions

### Switching Between Versions

**Option 1: Use Full Version**
```php
// routes/web.php
Route::get('/', [InvitationController::class, 'indexFull'])->name('invitation');
```

**Option 2: Use Simple Version**
```php
// routes/web.php
Route::get('/', [InvitationController::class, 'index'])->name('invitation');
```

### Customization

**1. Update Gallery Photos**
- Upload 9 photos to `public/images/gallery/`
- Nama file: `photo-1.jpg` sampai `photo-9.jpg`
- Recommended size: 1200x800px

**2. Update Love Story**
Edit controller:
```php
$timeline = [
    [
        'date' => '2020-01-15',
        'title' => 'First Meet',
        'description' => 'We met at...',
        'icon' => 'heart'
    ],
    // ... more timeline items
];
```

**3. Update Gift Info**
Edit controller:
```php
$gifts = [
    [
        'bank' => 'BCA',
        'account_number' => '1234567890',
        'account_name' => 'John Doe',
        'qr_code' => 'qr-code/bca.png'
    ],
];
```

**4. Update Wedding Party**
Upload photos dan edit data di controller

---

## 🎯 Next Steps

1. Saya akan buat semua section tersebut
2. Update controller untuk passing data
3. Update bottom navigation
4. Testing & refinement

**Estimated Time:**
- Development: 2-3 hours
- Testing: 30 minutes
- Total: ~3-4 hours

**Total Lines of Code:** ~2500-3000 lines

---

Ready to proceed? 🚀
