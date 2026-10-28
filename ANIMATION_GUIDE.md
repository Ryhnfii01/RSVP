# Panduan Animasi & Background Image

## 🎬 Fitur Animasi Baru

Website undangan sekarang dilengkapi dengan sistem animasi modern yang responsif dan performa tinggi.

## 1. Scroll-Triggered Animations

### Cara Menggunakan

Tambahkan class `animate-on-scroll` ke elemen yang ingin diberi animasi saat scroll:

```html
<div class="animate-on-scroll" data-animation="fade-in-up" data-delay="0">
    <!-- Konten yang akan di-animasikan -->
</div>
```

### Tipe Animasi Tersedia

| Animation | Efek |
|-----------|------|
| `fade-in-up` | Muncul dari bawah dengan fade |
| `fade-in-down` | Muncul dari atas dengan fade |
| `fade-in-left` | Muncul dari kiri dengan fade |
| `fade-in-right` | Muncul dari kanan dengan fade |
| `zoom-in` | Muncul dengan efek zoom/scale |

### Parameter

- **`data-animation`**: Tipe animasi yang digunakan (default: `fade-in-up`)
- **`data-delay`**: Delay dalam milliseconds sebelum animasi dimulai (default: `0`)

### Contoh Implementasi

```html
<!-- Heading dengan fade in dari atas -->
<h2 class="animate-on-scroll" data-animation="fade-in-down" data-delay="0">
    Judul Section
</h2>

<!-- Paragraf dengan fade in dari bawah dan delay 100ms -->
<p class="animate-on-scroll" data-animation="fade-in-up" data-delay="100">
    Deskripsi section
</p>

<!-- Card dengan zoom in dan delay 200ms -->
<div class="animate-on-scroll" data-animation="zoom-in" data-delay="200">
    <!-- Card content -->
</div>
```

## 2. Stagger Animations

Animasi bertahap untuk multiple child elements.

### Cara Menggunakan

Tambahkan class `stagger-animation` ke parent container:

```html
<div class="grid grid-cols-2 gap-8 stagger-animation">
    <div>Card 1</div> <!-- Animasi delay: 0.1s -->
    <div>Card 2</div> <!-- Animasi delay: 0.2s -->
    <div>Card 3</div> <!-- Animasi delay: 0.3s -->
    <div>Card 4</div> <!-- Animasi delay: 0.4s -->
</div>
```

### Delay Pattern

- Child 1: 0.1s
- Child 2: 0.2s
- Child 3: 0.3s
- Child 4: 0.4s
- Child 5: 0.5s
- Child 6: 0.6s
- Child 7+: 0.7s

### Contoh

```html
<!-- Bride & Groom Cards dengan stagger -->
<div class="grid md:grid-cols-2 gap-8 stagger-animation">
    <div class="card">Groom</div>
    <div class="card">Bride</div>
</div>

<!-- Event Cards -->
<div class="grid md:grid-cols-2 gap-8 stagger-animation">
    <div class="card">Akad Nikah</div>
    <div class="card">Resepsi</div>
</div>
```

## 3. Parallax Effect

Efek parallax pada background elements.

### Cara Menggunakan

```html
<div class="parallax" data-speed="0.5">
    <!-- Element yang akan bergerak parallax -->
</div>
```

### Parameter

- **`data-speed`**: Kecepatan parallax (0.1 - 1.0)
  - `0.1`: Very slow
  - `0.5`: Medium (recommended)
  - `1.0`: Fast

### Contoh

```html
<div class="absolute top-0 left-0 parallax" data-speed="0.3">
    <img src="decoration.png" alt="Decoration">
</div>
```

## 4. Background Image Support

Komponen `animated-background` sekarang mendukung background image dengan overlay.

### Cara Menggunakan

```blade
<!-- Background dengan image -->
<x-animated-background
    image="/images/hero-bg.jpg"
    overlay="dark"
/>

<!-- Background dengan gradient (tanpa image) -->
<x-animated-background
    variant="gold"
/>
```

### Parameter

#### `image` (optional)
Path ke background image. Jika diisi, gradient background tidak akan digunakan.

```blade
<x-animated-background image="{{ asset('images/bg.jpg') }}" />
```

#### `overlay` (optional)
Overlay untuk background image:

| Overlay | Class | Efek |
|---------|-------|------|
| `dark` | `bg-black/40` | Overlay hitam 40% (default) |
| `light` | `bg-white/40` | Overlay putih 40% |
| `primary` | `bg-primary-900/40` | Overlay biru 40% |
| `gold` | `bg-gold-900/40` | Overlay emas 40% |
| `none` | - | Tanpa overlay |

#### `variant` (optional)
Untuk gradient background (jika `image` tidak diisi):

- `default` - Primary blue gradient
- `gold` - Gold gradient
- `rose` - Rose/pink gradient
- `purple` - Purple gradient
- `light` - Light/white gradient

### Contoh Lengkap

```blade
<!-- Hero dengan background image dan overlay dark -->
<section class="relative min-h-screen overflow-hidden">
    <x-animated-background
        image="{{ asset('images/hero-wedding.jpg') }}"
        overlay="dark"
    />

    <div class="relative z-10 container mx-auto">
        <h1>Wedding Title</h1>
    </div>
</section>

<!-- Section dengan gradient background -->
<section class="relative py-20 overflow-hidden">
    <x-animated-background variant="gold" />

    <div class="relative z-10 container mx-auto">
        <h2>Section Title</h2>
    </div>
</section>

<!-- Gallery dengan background image dan overlay terang -->
<section class="relative py-20 overflow-hidden">
    <x-animated-background
        image="{{ asset('images/gallery-bg.jpg') }}"
        overlay="light"
    />

    <div class="relative z-10 container mx-auto">
        <!-- Gallery content -->
    </div>
</section>
```

## 5. Ken Burns Effect

Animasi zoom smooth pada background image (30 detik loop).

Otomatis diterapkan ketika menggunakan background image:

```blade
<x-animated-background image="/images/bg.jpg" />
```

Image akan ter-animasi dengan:
- Zoom dari 100% → 110% → 100%
- Slight translate movement
- Duration: 30 detik
- Loop: infinite

## 6. CSS Animation Classes

### Immediate Animations (tanpa scroll trigger)

```html
<!-- Fade animations -->
<div class="animate-fade-in">...</div>
<div class="animate-fade-in-up">...</div>
<div class="animate-fade-in-down">...</div>
<div class="animate-fade-in-left">...</div>
<div class="animate-fade-in-right">...</div>

<!-- Other animations -->
<div class="animate-zoom-in">...</div>
<div class="animate-slide-up">...</div>
<div class="animate-slide-down">...</div>

<!-- Background animations -->
<div class="animate-gradient">...</div>
<div class="animate-ken-burns">...</div>
<div class="animate-blob">...</div>

<!-- Decorative animations -->
<div class="animate-float">...</div>
<div class="animate-float-slow">...</div>
<div class="animate-float-reverse">...</div>
<div class="animate-twinkle">...</div>
<div class="animate-pulse-soft">...</div>
<div class="animate-rotate-slow">...</div>
```

### Animation Delays

```html
<div class="animate-blob animation-delay-2000">...</div>
<div class="animate-float animation-delay-4000">...</div>
<div class="animate-twinkle animation-delay-6000">...</div>
```

## 7. Implementasi di Sections

### Hero Section

```blade
<section id="opening" class="relative min-h-screen overflow-hidden">
    <x-animated-background variant="default" />

    <div class="relative z-10 container mx-auto text-center text-white">
        <div class="animate-fade-in-down">
            <p>THE WEDDING OF</p>
        </div>

        <div class="animate-fade-in-up">
            <h1>Bride & Groom</h1>
        </div>

        <div class="animate-zoom-in">
            <p>Date & Time</p>
        </div>
    </div>
</section>
```

### Content Section

```blade
<section id="salam" class="py-20 bg-white">
    <div class="container mx-auto">
        <!-- Heading -->
        <div class="animate-on-scroll" data-animation="fade-in-up" data-delay="100">
            <h2>Assalamu'alaikum Wr. Wb.</h2>
        </div>

        <!-- Text -->
        <div class="animate-on-scroll" data-animation="zoom-in" data-delay="200">
            <p>Invitation text...</p>
        </div>

        <!-- Cards with stagger -->
        <div class="grid md:grid-cols-2 gap-8 stagger-animation">
            <div class="card">Groom</div>
            <div class="card">Bride</div>
        </div>
    </div>
</section>
```

### Section with Decorative Elements

```blade
<section id="event" class="relative py-20 overflow-hidden">
    <!-- Background -->
    <x-animated-background variant="light" />

    <!-- Decorations -->
    <x-decorative-ornament position="top-left" type="floral" color="gold" />
    <x-decorative-ornament position="bottom-right" type="geometric" color="primary" />

    <div class="relative z-10 container mx-auto">
        <!-- Content with animations -->
        <div class="animate-on-scroll" data-animation="fade-in-up">
            <h2>Section Title</h2>
        </div>

        <div class="grid grid-cols-2 gap-8 stagger-animation">
            <div>Item 1</div>
            <div>Item 2</div>
        </div>
    </div>
</section>
```

## 8. Upload Background Images

### Direktori

Simpan images di:
```
public/images/backgrounds/
```

### Recommended Sizes

| Section | Recommended Size | Format |
|---------|-----------------|--------|
| Hero | 1920x1080px | JPG/WebP |
| Gallery | 1920x1080px | JPG/WebP |
| Gift | 1920x1080px | JPG/WebP |
| Others | 1600x900px | JPG/WebP |

### Optimization Tips

1. **Compress images** menggunakan tools seperti:
   - TinyPNG
   - ImageOptim
   - Squoosh

2. **Use WebP format** untuk ukuran lebih kecil:
   ```blade
   <x-animated-background image="{{ asset('images/bg.webp') }}" />
   ```

3. **Lazy loading** untuk images di bawah fold

### Contoh Upload & Usage

```bash
# Upload ke public/images/backgrounds/
public/images/backgrounds/
├── hero.jpg
├── gallery.webp
├── gift.jpg
└── event.jpg
```

```blade
<!-- Hero -->
<x-animated-background
    image="{{ asset('images/backgrounds/hero.jpg') }}"
    overlay="dark"
/>

<!-- Gallery -->
<x-animated-background
    image="{{ asset('images/backgrounds/gallery.webp') }}"
    overlay="light"
/>
```

## 9. Performance Tips

### Best Practices

1. **Limit Animations**: Jangan terlalu banyak animasi dalam 1 viewport
2. **Use CSS Animations**: Lebih performa daripada JavaScript
3. **Optimize Images**: Compress dan gunakan format modern (WebP)
4. **Lazy Load**: Background images di bawah fold

### Mobile Optimization

Untuk disable animasi di mobile jika diperlukan:

```css
@media (max-width: 768px) {
    .animate-on-scroll {
        opacity: 1 !important;
    }

    .animate-ken-burns {
        animation: none !important;
    }
}
```

### Browser Support

✅ Chrome 90+
✅ Firefox 88+
✅ Safari 14+
✅ Edge 90+

Graceful degradation untuk browser lama (tampil tanpa animasi).

## 10. Troubleshooting

### Animasi tidak muncul

1. Pastikan JavaScript sudah loaded
2. Check console untuk errors
3. Pastikan elemen visible di viewport

### Background image tidak muncul

1. Check path image benar
2. Pastikan file exists di `public/images/`
3. Clear browser cache

### Animasi tersendat (laggy)

1. Reduce jumlah animasi
2. Optimize background images
3. Disable parallax di mobile

## 11. Contoh Lengkap Section

```blade
<section id="custom-section" class="relative py-20 overflow-hidden">
    <!-- Background dengan image -->
    <x-animated-background
        image="{{ asset('images/backgrounds/section-bg.jpg') }}"
        overlay="dark"
    />

    <!-- Decorative ornaments -->
    <x-decorative-ornament position="top-right" type="hearts" color="gold" />

    <!-- Wave divider -->
    <x-wave-divider position="top" color="white" />

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4">
        <!-- Animated heading -->
        <div class="text-center mb-12 animate-on-scroll" data-animation="fade-in-up">
            <h2 class="text-4xl font-serif text-white mb-4">
                Section Title
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-transparent via-gold-500 to-transparent mx-auto"></div>
        </div>

        <!-- Animated content with delay -->
        <div class="animate-on-scroll" data-animation="zoom-in" data-delay="200">
            <p class="text-white text-center max-w-2xl mx-auto">
                Section description text...
            </p>
        </div>

        <!-- Stagger animated cards -->
        <div class="grid md:grid-cols-3 gap-8 mt-12 stagger-animation">
            <div class="card bg-white/90 backdrop-blur-sm p-6 rounded-xl">
                Card 1
            </div>
            <div class="card bg-white/90 backdrop-blur-sm p-6 rounded-xl">
                Card 2
            </div>
            <div class="card bg-white/90 backdrop-blur-sm p-6 rounded-xl">
                Card 3
            </div>
        </div>
    </div>

    <!-- Wave divider bottom -->
    <x-wave-divider position="bottom" color="gray-50" />
</section>
```

## 🎯 Summary

**Fitur Baru:**
- ✅ Scroll-triggered animations dengan 5 tipe animasi
- ✅ Stagger animations untuk multiple children
- ✅ Parallax effect
- ✅ Background image support dengan overlay
- ✅ Ken Burns effect untuk background images
- ✅ 15+ CSS animation classes
- ✅ Intersection Observer API untuk performance
- ✅ Mobile responsive
- ✅ Graceful degradation untuk browser lama

**Components:**
- `<x-animated-background>` - Support image & gradient
- `<x-wave-divider>` - Section transitions
- `<x-decorative-ornament>` - Decorative elements

Selamat menggunakan! Website undangan Anda sekarang lebih hidup dan engaging! 🎉
