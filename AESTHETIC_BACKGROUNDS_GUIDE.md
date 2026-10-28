# Panduan Penggunaan Background Estetik

## Komponen yang Tersedia

### 1. Animated Background Component
Lokasi: `resources/views/components/animated-background.blade.php`

**Varian yang tersedia:**
- `default` - Gradient biru (primary)
- `gold` - Gradient emas
- `rose` - Gradient pink/rose
- `purple` - Gradient ungu
- `light` - Gradient terang/putih

**Cara Penggunaan:**
```blade
<section class="relative overflow-hidden">
    <!-- Background dengan varian default (primary blue) -->
    <x-animated-background />

    <!-- Background dengan varian gold -->
    <x-animated-background variant="gold" />

    <!-- Background dengan varian rose -->
    <x-animated-background variant="rose" />

    <!-- Konten section di sini -->
    <div class="relative z-10">
        <!-- Konten Anda -->
    </div>
</section>
```

**Fitur yang termasuk:**
- Animated gradient background (bergerak perlahan)
- Floating blobs (3 lingkaran besar yang melayang)
- Geometric shapes (lingkaran dan persegi kecil)
- Sparkle effects (bintang kecil yang berkedip)

### 2. Wave Divider Component
Lokasi: `resources/views/components/wave-divider.blade.php`

**Posisi yang tersedia:**
- `top` - Wave di bagian atas section
- `bottom` - Wave di bagian bawah section

**Warna yang tersedia:**
- `white` - Putih (default)
- `gray-50` - Abu-abu terang
- `primary-50` - Biru terang
- `gold-50` - Emas terang

**Cara Penggunaan:**
```blade
<section class="relative bg-white">
    <!-- Wave divider di atas -->
    <x-wave-divider position="top" color="primary-50" />

    <!-- Konten section -->
    <div class="container mx-auto py-16">
        <!-- Konten Anda -->
    </div>

    <!-- Wave divider di bawah -->
    <x-wave-divider position="bottom" color="white" />
</section>
```

### 3. Decorative Ornament Component
Lokasi: `resources/views/components/decorative-ornament.blade.php`

**Posisi yang tersedia:**
- `top-left` - Pojok kiri atas
- `top-right` - Pojok kanan atas
- `bottom-left` - Pojok kiri bawah
- `bottom-right` - Pojok kanan bawah

**Tipe ornamen:**
- `floral` - Motif bunga
- `geometric` - Pola geometris
- `hearts` - Pola hati

**Warna yang tersedia:**
- `gold` - Emas (default)
- `primary` - Biru
- `white` - Putih

**Cara Penggunaan:**
```blade
<section class="relative py-20">
    <!-- Ornamen bunga di pojok kiri atas dengan warna gold -->
    <x-decorative-ornament position="top-left" type="floral" color="gold" />

    <!-- Ornamen geometris di pojok kanan atas -->
    <x-decorative-ornament position="top-right" type="geometric" color="primary" />

    <!-- Ornamen hati di pojok kanan bawah -->
    <x-decorative-ornament position="bottom-right" type="hearts" color="gold" />

    <!-- Konten section -->
    <div class="container mx-auto">
        <!-- Konten Anda -->
    </div>
</section>
```

## Animasi CSS yang Tersedia

Lokasi: `resources/css/app.css`

### Gradient Animation
```html
<div class="bg-gradient-to-r from-blue-500 to-purple-500 animate-gradient">
    <!-- Gradient akan bergerak perlahan -->
</div>
```

### Float Animations
```html
<!-- Float biasa (6 detik) -->
<div class="animate-float">...</div>

<!-- Float lambat dengan rotasi (8 detik) -->
<div class="animate-float-slow">...</div>

<!-- Float terbalik (7 detik) -->
<div class="animate-float-reverse">...</div>
```

### Twinkle & Pulse
```html
<!-- Berkedip seperti bintang -->
<div class="animate-twinkle">...</div>

<!-- Pulse lembut -->
<div class="animate-pulse-soft">...</div>
```

### Slide & Fade
```html
<!-- Slide dari atas -->
<div class="animate-slide-down">...</div>

<!-- Slide dari bawah -->
<div class="animate-slide-up">...</div>

<!-- Fade in -->
<div class="animate-fade-in">...</div>
```

### Rotation
```html
<!-- Rotasi lambat (20 detik) -->
<div class="animate-rotate-slow">...</div>
```

## Contoh Implementasi Per Section

### Hero Section
```blade
<section id="hero" class="relative min-h-screen overflow-hidden">
    <!-- Animated background dengan variant gold -->
    <x-animated-background variant="gold" />

    <!-- Ornamen di pojok -->
    <x-decorative-ornament position="top-left" type="floral" color="white" />
    <x-decorative-ornament position="bottom-right" type="hearts" color="white" />

    <!-- Konten -->
    <div class="relative z-10 container mx-auto">
        <h1 class="text-6xl font-script animate-fade-in">Nama Pengantin</h1>
    </div>

    <!-- Wave divider di bawah -->
    <x-wave-divider position="bottom" color="white" />
</section>
```

### Gallery Section
```blade
<section id="gallery" class="relative py-20 bg-gradient-to-br from-gray-50 to-white overflow-hidden">
    <!-- Wave divider di atas -->
    <x-wave-divider position="top" color="gray-50" />

    <!-- Ornamen -->
    <x-decorative-ornament position="top-right" type="geometric" color="primary" />

    <!-- Konten gallery -->
    <div class="relative z-10 container mx-auto">
        <!-- Grid foto -->
    </div>

    <!-- Wave divider di bawah -->
    <x-wave-divider position="bottom" color="white" />
</section>
```

### Gift Section
```blade
<section id="gift" class="relative py-20 overflow-hidden">
    <!-- Animated background variant rose -->
    <x-animated-background variant="rose" />

    <!-- Ornamen hati di pojok -->
    <x-decorative-ornament position="top-left" type="hearts" color="gold" />
    <x-decorative-ornament position="bottom-right" type="hearts" color="gold" />

    <!-- Konten -->
    <div class="relative z-10 container mx-auto">
        <!-- Bank accounts dan QR codes -->
    </div>
</section>
```

### Guest Book Section
```blade
<section id="wishes" class="relative py-20 overflow-hidden">
    <!-- Background variant light -->
    <x-animated-background variant="light" />

    <!-- Wave divider -->
    <x-wave-divider position="top" color="white" />

    <!-- Konten wishes -->
    <div class="relative z-10 container mx-auto">
        <!-- List wishes -->
    </div>
</section>
```

## Tips Penggunaan

1. **Selalu gunakan `relative` dan `overflow-hidden`** pada section yang menggunakan animated background
2. **Tambahkan `relative z-10`** pada konten agar berada di atas background
3. **Gunakan wave divider** di antara section untuk transisi yang smooth
4. **Pilih warna ornamen** yang kontras dengan background untuk efek maksimal
5. **Jangan terlalu banyak ornamen** pada satu section (maksimal 2-3)
6. **Kombinasikan animasi** untuk efek yang lebih menarik

## Performance Tips

1. Batasi jumlah animated element per halaman
2. Gunakan `will-change` CSS property untuk optimasi jika perlu
3. Test performance di mobile device
4. Pertimbangkan untuk disable beberapa animasi di mobile jika perlu

## Browser Support

Semua animasi dan efek mendukung browser modern:
- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+

Untuk browser lama, animasi akan gracefully degrade (tampil tanpa animasi).
