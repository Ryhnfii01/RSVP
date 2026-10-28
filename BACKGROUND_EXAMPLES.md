# Contoh Penggunaan Background - Lengkap & Praktis

## 📸 Persiapan: Upload Background Images

### 1. Buat Folder
```bash
mkdir -p public/images/backgrounds
```

### 2. Upload Images
Simpan gambar-gambar berikut ke `public/images/backgrounds/`:

```
public/images/backgrounds/
├── hero-wedding.jpg       (1920x1080px) - Foto romantis couple
├── gallery-bg.jpg         (1920x1080px) - Foto landscape/nature
├── gift-bg.jpg            (1600x900px)  - Foto bunga/elegant
├── event-bg.jpg           (1600x900px)  - Foto venue/masjid
├── guestbook-bg.jpg       (1600x900px)  - Foto soft/pastel
└── maps-bg.jpg            (1600x900px)  - Foto location/city
```

## 🎨 Contoh 1: Hero/Opening Section dengan Background Image

### File: `resources/views/invitation/index.blade.php`

```blade
<!-- Hero Section with Background Image -->
<section id="opening" class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Image dengan overlay dark -->
    <x-animated-background
        image="{{ asset('images/backgrounds/hero-wedding.jpg') }}"
        overlay="dark"
    />

    <!-- Content di atas background -->
    <div class="relative z-10 container mx-auto px-4 text-center text-white">
        <div class="animate-fade-in-down">
            <p class="text-lg tracking-widest uppercase mb-4 opacity-90">
                THE WEDDING OF
            </p>
        </div>

        <div class="animate-fade-in-up my-12">
            <h1 class="font-script text-7xl mb-4">
                Ahmad & Siti
            </h1>
            <div class="flex items-center justify-center my-6">
                <div class="h-px w-24 bg-white/50"></div>
                <span class="mx-4 text-3xl">&</span>
                <div class="h-px w-24 bg-white/50"></div>
            </div>
        </div>

        <div class="animate-zoom-in">
            <p class="text-xl mb-2">Minggu, 31 Desember 2025</p>
            <p class="opacity-90">Pukul 19.00 WIB</p>
        </div>
    </div>
</section>
```

**Hasil:**
- ✅ Background image full screen dengan Ken Burns effect (zoom smooth)
- ✅ Overlay dark 40% agar text tetap jelas
- ✅ Text putih di atas background gelap
- ✅ Floating blobs & sparkles untuk efek magical

---

## 🎨 Contoh 2: Gallery Section dengan Background Image Terang

### File: `resources/views/invitation/sections/gallery.blade.php`

```blade
<!-- Gallery Section -->
<section id="gallery" class="relative py-20 overflow-hidden">
    <!-- Background Image dengan overlay light -->
    <x-animated-background
        image="{{ asset('images/backgrounds/gallery-bg.jpg') }}"
        overlay="light"
    />

    <!-- Wave Divider -->
    <x-wave-divider position="top" color="white" />

    <!-- Decorative Ornaments -->
    <x-decorative-ornament position="top-right" type="geometric" color="primary" />
    <x-decorative-ornament position="bottom-left" type="floral" color="gold" />

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4">
        <!-- Heading dengan animasi -->
        <div class="text-center mb-16 animate-on-scroll" data-animation="fade-in-up">
            <h2 class="text-5xl font-serif text-gray-800 mb-4">
                Our Moments
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-transparent via-gold-500 to-transparent mx-auto mb-6"></div>
            <p class="text-gray-700 max-w-2xl mx-auto">
                Beberapa momen indah yang telah kami lalui bersama
            </p>
        </div>

        <!-- Photo Grid dengan stagger animation -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-5 stagger-animation">
            @for($i = 1; $i <= 9; $i++)
            <div class="group relative overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 cursor-pointer aspect-square border-4 border-white hover:border-white/80"
                 onclick="openLightbox({{ $i - 1 }})">
                <!-- Photo placeholder atau actual image -->
                <img src="{{ asset('images/gallery/photo-' . $i . '.jpg') }}"
                     alt="Gallery Photo {{ $i }}"
                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700"
                     loading="lazy">

                <!-- Overlay on hover -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10"></div>

                <!-- Zoom Icon -->
                <div class="absolute inset-0 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 z-20">
                    <div class="w-14 h-14 bg-white/95 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                        </svg>
                    </div>
                    <p class="text-white text-sm font-semibold mt-2">Lihat Foto</p>
                </div>
            </div>
            @endfor
        </div>
    </div>

    <!-- Wave Divider Bottom -->
    <x-wave-divider position="bottom" color="white" />
</section>
```

**Hasil:**
- ✅ Background image dengan overlay white 40% (lebih terang)
- ✅ Text gelap kontras dengan background terang
- ✅ Grid photos dengan stagger animation
- ✅ Wave dividers untuk transisi smooth

---

## 🎨 Contoh 3: Gift Section dengan Background Image & Overlay Gold

### File: `resources/views/invitation/sections/gift.blade.php`

```blade
<!-- Gift Section -->
<section id="gift" class="relative py-20 overflow-hidden">
    <!-- Background Image dengan overlay gold -->
    <x-animated-background
        image="{{ asset('images/backgrounds/gift-bg.jpg') }}"
        overlay="gold"
    />

    <!-- Decorative Hearts -->
    <x-decorative-ornament position="top-left" type="hearts" color="gold" />
    <x-decorative-ornament position="bottom-right" type="hearts" color="gold" />

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4">
        <!-- Heading -->
        <div class="text-center mb-16 animate-on-scroll" data-animation="fade-in-up">
            <h2 class="text-5xl font-serif text-white mb-4">
                Wedding Gift
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-transparent via-white to-transparent mx-auto mb-6"></div>
            <p class="text-white/90 max-w-2xl mx-auto">
                Doa restu Anda merupakan karunia yang sangat berarti bagi kami.
                Namun jika memberi adalah ungkapan tanda kasih, Anda dapat memberi kado secara cashless.
            </p>
        </div>

        <!-- Bank Cards dengan glassmorphism -->
        <div class="grid md:grid-cols-2 gap-8 mb-12 stagger-animation">
            <!-- BCA Card -->
            <div class="group relative bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl p-8 border border-white hover:shadow-3xl hover:-translate-y-1 transition-all duration-500">
                <div class="absolute inset-0 bg-gradient-to-br from-primary-500/10 via-primary-400/5 to-transparent rounded-3xl"></div>

                <div class="relative z-10">
                    <div class="w-14 h-14 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center shadow-lg mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 6h18v2H3V6zm0 4h18v2H3v-2zm0 4h18v2H3v-2zm0 4h18v2H3v-2z"/>
                        </svg>
                    </div>

                    <p class="text-2xl font-bold bg-gradient-to-r from-primary-600 to-primary-500 bg-clip-text text-transparent mb-2">
                        Bank BCA
                    </p>

                    <div class="space-y-1 mb-4">
                        <p class="text-xs uppercase tracking-wider text-gray-500">Nomor Rekening</p>
                        <p class="text-2xl font-bold text-gray-800" id="bca-number">1234567890</p>
                        <p class="text-sm text-gray-600">a.n. Ahmad Fauzi</p>
                    </div>

                    <button onclick="copyToClipboard('1234567890', 'bca')"
                            class="w-full bg-gradient-to-r from-primary-500 to-primary-600 text-white py-3 px-6 rounded-xl font-medium hover:shadow-lg active:scale-95 transition-all duration-200">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        Salin Nomor Rekening
                    </button>
                </div>
            </div>

            <!-- Mandiri Card -->
            <div class="group relative bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl p-8 border border-white hover:shadow-3xl hover:-translate-y-1 transition-all duration-500">
                <div class="absolute inset-0 bg-gradient-to-br from-gold-500/10 via-gold-400/5 to-transparent rounded-3xl"></div>

                <div class="relative z-10">
                    <div class="w-14 h-14 bg-gradient-to-br from-gold-500 to-gold-600 rounded-xl flex items-center justify-center shadow-lg mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 6h18v2H3V6zm0 4h18v2H3v-2zm0 4h18v2H3v-2zm0 4h18v2H3v-2z"/>
                        </svg>
                    </div>

                    <p class="text-2xl font-bold bg-gradient-to-r from-gold-600 to-gold-500 bg-clip-text text-transparent mb-2">
                        Bank Mandiri
                    </p>

                    <div class="space-y-1 mb-4">
                        <p class="text-xs uppercase tracking-wider text-gray-500">Nomor Rekening</p>
                        <p class="text-2xl font-bold text-gray-800" id="mandiri-number">9876543210</p>
                        <p class="text-sm text-gray-600">a.n. Siti Nurhaliza</p>
                    </div>

                    <button onclick="copyToClipboard('9876543210', 'mandiri')"
                            class="w-full bg-gradient-to-r from-gold-500 to-gold-600 text-white py-3 px-6 rounded-xl font-medium hover:shadow-lg active:scale-95 transition-all duration-200">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        Salin Nomor Rekening
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
```

**Hasil:**
- ✅ Background image dengan overlay gold (warm tone)
- ✅ Text putih untuk kontras
- ✅ Glassmorphism cards dengan backdrop-blur
- ✅ Hearts ornaments untuk romantic touch

---

## 🎨 Contoh 4: Event Section dengan Background Tanpa Image (Gradient)

### File: `resources/views/invitation/index.blade.php` (Event Section)

```blade
<!-- Event Section - Gradient Background -->
<section id="event" class="relative py-20 overflow-hidden">
    <!-- Gradient Background (tanpa image) -->
    <x-animated-background variant="light" />

    <!-- Decorative Ornaments -->
    <x-decorative-ornament position="top-left" type="floral" color="primary" />
    <x-decorative-ornament position="bottom-right" type="geometric" color="gold" />

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4">
        <!-- Heading -->
        <div class="text-center mb-16 animate-on-scroll" data-animation="fade-in-up">
            <h2 class="text-5xl font-serif text-gray-800 mb-4">
                Waktu & Tempat
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-transparent via-gold-500 to-transparent mx-auto"></div>
        </div>

        <!-- Countdown Timer -->
        <div class="mb-16 animate-on-scroll" data-animation="zoom-in" data-delay="100">
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-8 shadow-xl">
                <h3 class="text-center text-2xl font-serif text-gray-700 mb-6">Menuju Hari Bahagia</h3>
                <div id="countdown" class="grid grid-cols-4 gap-4 max-w-2xl mx-auto">
                    <!-- Countdown boxes -->
                </div>
            </div>
        </div>

        <!-- Event Cards -->
        <div class="grid md:grid-cols-2 gap-8 stagger-animation">
            <!-- Akad Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <div class="text-center">
                    <h3 class="text-2xl font-serif text-gray-800 mb-2">Akad Nikah</h3>
                    <p class="text-gray-600">Minggu, 31 Desember 2025</p>
                    <p class="text-gray-600">08.00 - 10.00 WIB</p>
                </div>
            </div>

            <!-- Resepsi Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <div class="text-center">
                    <h3 class="text-2xl font-serif text-gray-800 mb-2">Resepsi</h3>
                    <p class="text-gray-600">Minggu, 31 Desember 2025</p>
                    <p class="text-gray-600">11.00 - 14.00 WIB</p>
                </div>
            </div>
        </div>
    </div>
</section>
```

**Hasil:**
- ✅ Gradient background `light` (soft gray-white)
- ✅ Floating blobs & geometric shapes
- ✅ Cards dengan shadow untuk depth
- ✅ Ornaments untuk decorative touch

---

## 🎨 Contoh 5: Guest Book dengan Background Image & Overlay None

### File: `resources/views/invitation/sections/guestbook.blade.php`

```blade
<!-- Guest Book Section -->
<section id="wishes" class="relative py-20 overflow-hidden">
    <!-- Background Image TANPA overlay -->
    <x-animated-background
        image="{{ asset('images/backgrounds/guestbook-bg.jpg') }}"
        overlay="none"
    />

    <!-- Gradient overlay manual untuk text readability -->
    <div class="absolute inset-0 bg-gradient-to-b from-white/80 via-white/60 to-white/80"></div>

    <!-- Wave Divider -->
    <x-wave-divider position="top" color="white" />

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4">
        <!-- Heading -->
        <div class="text-center mb-16 animate-on-scroll" data-animation="fade-in-up">
            <h2 class="text-5xl font-serif text-gray-800 mb-4">
                Wedding Wishes
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-transparent via-gold-500 to-transparent mx-auto mb-6"></div>
            <p class="text-gray-700 max-w-2xl mx-auto">
                Berikan ucapan & doa untuk pernikahan kami
            </p>
        </div>

        <!-- Wish Cards -->
        <div class="grid gap-6 max-w-4xl mx-auto stagger-animation">
            <!-- Wish Card Example -->
            <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-lg p-6 border border-white">
                <div class="flex items-start space-x-4">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center shadow-md">
                        <span class="text-white text-xl font-bold">A</span>
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="font-semibold text-gray-800">Ahmad Abdullah</h4>
                            <span class="px-3 py-1 bg-gradient-to-r from-green-100 to-emerald-100 text-green-700 text-xs font-medium rounded-full shadow-sm">
                                Hadir
                            </span>
                        </div>

                        <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 mb-3">
                            <p class="text-gray-600 text-sm italic">
                                Selamat menempuh hidup baru! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah.
                            </p>
                        </div>

                        <p class="text-xs text-gray-400">2 jam yang lalu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
```

**Hasil:**
- ✅ Background image terlihat jelas (overlay none)
- ✅ Manual gradient overlay untuk ensure text readable
- ✅ Glassmorphism cards dengan backdrop-blur
- ✅ Soft, elegant appearance

---

## 🎨 Contoh 6: Kombinasi - Section dengan Parallax Elements

```blade
<!-- Custom Section dengan Parallax -->
<section id="story" class="relative py-20 overflow-hidden">
    <!-- Background Image -->
    <x-animated-background
        image="{{ asset('images/backgrounds/story-bg.jpg') }}"
        overlay="primary"
    />

    <!-- Parallax Decorative Elements -->
    <div class="parallax absolute top-20 left-10 opacity-30" data-speed="0.3">
        <svg class="w-32 h-32 text-white" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
        </svg>
    </div>

    <div class="parallax absolute bottom-20 right-10 opacity-20" data-speed="0.5">
        <svg class="w-24 h-24 text-white" fill="currentColor" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"/>
        </svg>
    </div>

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4 text-center text-white">
        <div class="animate-on-scroll" data-animation="fade-in-up">
            <h2 class="text-5xl font-script mb-8">Our Love Story</h2>
        </div>

        <div class="max-w-3xl mx-auto space-y-8">
            <!-- Timeline items dengan stagger -->
            <div class="stagger-animation">
                <div class="bg-white/20 backdrop-blur-md rounded-2xl p-6 border border-white/30">
                    <h3 class="text-2xl font-serif mb-2">2020 - First Meet</h3>
                    <p class="text-white/90">Kami pertama kali bertemu di kampus...</p>
                </div>

                <div class="bg-white/20 backdrop-blur-md rounded-2xl p-6 border border-white/30">
                    <h3 class="text-2xl font-serif mb-2">2022 - Engaged</h3>
                    <p class="text-white/90">Akhirnya kami memutuskan untuk menikah...</p>
                </div>

                <div class="bg-white/20 backdrop-blur-md rounded-2xl p-6 border border-white/30">
                    <h3 class="text-2xl font-serif mb-2">2025 - Wedding</h3>
                    <p class="text-white/90">Dan hari bahagia kami pun tiba...</p>
                </div>
            </div>
        </div>
    </div>
</section>
```

**Hasil:**
- ✅ Background image dengan primary overlay
- ✅ Parallax decorative elements (bergerak smooth saat scroll)
- ✅ Glassmorphism timeline cards
- ✅ Stagger animation untuk timeline items

---

## 🎯 Tips Memilih Background & Overlay

### Background Image + Overlay Combinations

| Section | Background Type | Overlay | Text Color | Use Case |
|---------|----------------|---------|------------|----------|
| **Hero** | Romantic couple photo | `dark` | White | Dramatic, focus on names |
| **Gallery** | Nature/landscape | `light` | Dark | Bright, cheerful |
| **Gift** | Flowers/elegant | `gold` | White | Warm, luxurious |
| **Event** | Gradient (no image) | - | Dark | Clean, minimal |
| **Guest Book** | Soft texture | `none` + manual | Dark | Subtle, elegant |
| **Story** | Memorable place | `primary` | White | Emotional, romantic |

### Kapan Pakai Image vs Gradient?

**Gunakan Background Image:**
- ✅ Hero section (impactful)
- ✅ Gallery (add context)
- ✅ Gift (add elegance)
- ✅ Story/Timeline (emotional connection)

**Gunakan Gradient:**
- ✅ Event (focus on information)
- ✅ Form sections (less distraction)
- ✅ Salam/Couple intro (clean & minimal)

---

## 📱 JavaScript Helper untuk Copy Button

Tambahkan di bagian `<script>` untuk fitur copy rekening:

```javascript
function copyToClipboard(text, bank) {
    navigator.clipboard.writeText(text).then(() => {
        // Show success feedback
        const btn = event.target.closest('button');
        const originalText = btn.innerHTML;

        btn.innerHTML = `
            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Berhasil Disalin!
        `;

        setTimeout(() => {
            btn.innerHTML = originalText;
        }, 2000);
    });
}
```

---

## ✨ Summary

**Background Image:**
```blade
<x-animated-background
    image="{{ asset('images/backgrounds/hero.jpg') }}"
    overlay="dark|light|primary|gold|none"
/>
```

**Gradient Background:**
```blade
<x-animated-background variant="default|gold|rose|purple|light" />
```

**Dengan semua contoh di atas, Anda bisa:**
- ✅ Mix & match background images dengan overlay
- ✅ Kombinasi dengan animations
- ✅ Tambahkan parallax elements
- ✅ Gunakan glassmorphism untuk modern look
- ✅ Create beautiful, engaging sections

Pilih yang sesuai dengan style dan kebutuhan wedding website Anda! 🎉
