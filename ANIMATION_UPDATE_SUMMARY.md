# Summary: Animation & Background Image Update

## 🎬 Update yang Telah Dilakukan

Sistem animasi dan background yang lebih advanced telah ditambahkan ke website undangan.

## 📝 File yang Dimodifikasi

### 1. **resources/views/components/animated-background.blade.php**
**Perubahan:**
- ✅ Menambahkan parameter `image` untuk background image support
- ✅ Menambahkan parameter `overlay` dengan 4 varian (dark, light, primary, gold, none)
- ✅ Conditional rendering: jika ada image, gunakan image; jika tidak, gunakan gradient
- ✅ Menambahkan class `animate-ken-burns` untuk smooth zoom effect pada background image

**Fitur Baru:**
```blade
<!-- Sebelum: Hanya gradient -->
<x-animated-background variant="gold" />

<!-- Sekarang: Bisa pakai image dengan overlay -->
<x-animated-background
    image="{{ asset('images/bg.jpg') }}"
    overlay="dark"
/>
```

### 2. **resources/css/app.css**
**Perubahan:**
- ✅ Menambahkan 6 animasi baru:
  - `@keyframes ken-burns` - Smooth zoom untuk background images (30s)
  - `@keyframes blob` - Organic floating blobs (7s)
  - `@keyframes fade-in-up` - Fade dari bawah
  - `@keyframes fade-in-down` - Fade dari atas
  - `@keyframes fade-in-left` - Fade dari kiri
  - `@keyframes fade-in-right` - Fade dari kanan
  - `@keyframes zoom-in` - Zoom scale effect

- ✅ Menambahkan animation classes:
  - `.animate-ken-burns`
  - `.animate-blob`
  - `.animate-fade-in-up/down/left/right`
  - `.animate-zoom-in`
  - `.animation-delay-2000/4000/6000`

- ✅ Menambahkan scroll-triggered animation system:
  - `.animate-on-scroll` - Base class
  - `.animate-on-scroll.animated` - Triggered state
  - Support untuk semua fade & zoom animations

- ✅ Menambahkan stagger animation system:
  - `.stagger-animation` - Parent container
  - Auto delay untuk 7+ children (0.1s increment)

- ✅ Menambahkan parallax support:
  - `.parallax` - Smooth parallax effect

**Total Animasi:** 15+ animations dengan variants

### 3. **resources/views/invitation/index.blade.php**
**Perubahan:**

#### Hero Section (lines 51-93)
- ✅ Replace background inline dengan `<x-animated-background variant="default" />`
- ✅ Update animations:
  - Title: `animate-fade-in-down`
  - Names: `animate-fade-in-up`
  - Date: `animate-zoom-in`

#### Salam Section (lines 98-157)
- ✅ Heading: `animate-on-scroll` dengan `data-animation="fade-in-up"` dan `data-delay="100"`
- ✅ Text: `animate-on-scroll` dengan `data-animation="zoom-in"` dan `data-delay="200"`
- ✅ Bride & Groom cards: `stagger-animation` untuk sequential reveal

#### Event Section (lines 167-214)
- ✅ Tambahkan `relative` dan `overflow-hidden` classes
- ✅ Tambahkan decorative ornaments:
  - Top-left: Floral (primary)
  - Bottom-right: Geometric (gold)
- ✅ Heading: `animate-on-scroll` dengan `data-animation="fade-in-up"`
- ✅ Countdown: `animate-on-scroll` dengan `data-animation="zoom-in"` dan `data-delay="100"`
- ✅ Event cards: `stagger-animation`

#### JavaScript (lines 722-775)
- ✅ Menambahkan Intersection Observer untuk scroll-triggered animations:
  ```javascript
  const animateOnScroll = new IntersectionObserver(...)
  ```
- ✅ Observer untuk `.animate-on-scroll` elements
- ✅ Observer untuk `.stagger-animation` containers
- ✅ Parallax effect dengan `requestAnimationFrame` untuk smooth performance
- ✅ Support untuk `data-animation` dan `data-delay` attributes

### 4. **resources/views/components/section-animated.blade.php** (NEW)
**File Baru:**
- ✅ Komponen wrapper untuk section dengan animasi built-in
- ✅ Integrated `<x-animated-background>` component
- ✅ Props: `id`, `bgVariant`, `bgImage`, `overlay`, `animation`, `delay`, `class`

**Usage:**
```blade
<x-section-animated
    id="my-section"
    bgImage="{{ asset('images/bg.jpg') }}"
    overlay="dark"
    animation="fade-in-up"
    delay="100"
    class="py-20"
>
    <!-- Section content -->
</x-section-animated>
```

## 🎨 Fitur Baru yang Ditambahkan

### 1. Scroll-Triggered Animations
Elemen muncul dengan animasi saat di-scroll ke viewport.

**5 Tipe Animasi:**
- `fade-in-up` - Default, dari bawah
- `fade-in-down` - Dari atas
- `fade-in-left` - Dari kiri
- `fade-in-right` - Dari kanan
- `zoom-in` - Zoom scale

**Usage:**
```html
<div class="animate-on-scroll" data-animation="fade-in-up" data-delay="100">
    Content here
</div>
```

### 2. Stagger Animations
Children di-animasikan secara berurutan dengan delay incremental.

**Usage:**
```html
<div class="grid grid-cols-3 gap-8 stagger-animation">
    <div>Item 1</div> <!-- delay: 0.1s -->
    <div>Item 2</div> <!-- delay: 0.2s -->
    <div>Item 3</div> <!-- delay: 0.3s -->
</div>
```

### 3. Background Image Support
Animated background component sekarang support image dengan overlay.

**Variants:**
- Gradient background (existing)
- Image background with overlay (NEW)
- Ken Burns zoom effect (NEW)

**Overlays:**
- `dark` - Black 40%
- `light` - White 40%
- `primary` - Primary color 40%
- `gold` - Gold 40%
- `none` - No overlay

**Usage:**
```blade
<x-animated-background
    image="{{ asset('images/hero.jpg') }}"
    overlay="dark"
/>
```

### 4. Parallax Effect
Background elements bergerak smooth saat scroll.

**Usage:**
```html
<div class="parallax" data-speed="0.5">
    Decorative element
</div>
```

**Speeds:**
- `0.1` - Very slow
- `0.5` - Medium (recommended)
- `1.0` - Fast

### 5. Ken Burns Effect
Smooth zoom animation pada background images (30 detik loop).

Otomatis aktif saat menggunakan image background:
```blade
<x-animated-background image="/images/bg.jpg" />
```

## 📋 Section yang Sudah Diupdate

### ✅ Hero/Opening Section
- Background: `<x-animated-background variant="default" />`
- Animations: fade-in-down, fade-in-up, zoom-in

### ✅ Salam Section
- Heading: fade-in-up dengan delay 100ms
- Text: zoom-in dengan delay 200ms
- Cards: stagger animation

### ✅ Event Section
- Decorative ornaments ditambahkan
- Heading: fade-in-up
- Countdown: zoom-in dengan delay
- Event cards: stagger animation

### ⚠️ Sections Lain Belum Diupdate
Section berikut masih menggunakan animated background dari before, tapi belum diberi scroll animations:
- Gallery (sudah ada wave dividers & ornaments)
- Gift (sudah ada animated background rose variant)
- Guest Book (sudah ada wave divider & animated background light variant)
- Maps
- RSVP

## 🚀 Cara Menambahkan Animasi ke Section Lain

### Template Dasar:

```blade
<section id="section-name" class="relative py-20 overflow-hidden">
    <!-- Background dengan image (optional) -->
    <x-animated-background
        image="{{ asset('images/section-bg.jpg') }}"
        overlay="dark"
    />

    <!-- Decorations (optional) -->
    <x-decorative-ornament position="top-left" type="floral" color="gold" />

    <!-- Content Container -->
    <div class="relative z-10 container mx-auto px-4">
        <!-- Animated Heading -->
        <div class="animate-on-scroll" data-animation="fade-in-up">
            <h2>Section Title</h2>
        </div>

        <!-- Animated Content -->
        <div class="animate-on-scroll" data-animation="zoom-in" data-delay="200">
            <p>Description</p>
        </div>

        <!-- Stagger Animated Cards -->
        <div class="grid grid-cols-3 gap-8 stagger-animation">
            <div>Card 1</div>
            <div>Card 2</div>
            <div>Card 3</div>
        </div>
    </div>
</section>
```

## 📸 Cara Upload & Gunakan Background Images

### 1. Upload Images

Simpan di:
```
public/images/backgrounds/
```

Struktur folder:
```
public/images/backgrounds/
├── hero.jpg
├── gallery.webp
├── gift.jpg
├── event.jpg
└── ...
```

### 2. Update Section

```blade
<!-- Gallery Section Example -->
<section id="gallery" class="relative py-20 overflow-hidden">
    <x-animated-background
        image="{{ asset('images/backgrounds/gallery.webp') }}"
        overlay="light"
    />

    <div class="relative z-10 container mx-auto">
        <!-- Gallery content -->
    </div>
</section>
```

### 3. Recommended Sizes

| Section | Size | Format |
|---------|------|--------|
| Hero | 1920x1080px | JPG/WebP |
| Gallery | 1920x1080px | WebP |
| Other | 1600x900px | JPG/WebP |

### 4. Optimize Images

Gunakan tools:
- TinyPNG (https://tinypng.com)
- Squoosh (https://squoosh.app)
- ImageOptim (Mac)

## 🎯 Next Steps

### 1. Update Sections yang Belum Ada Animasi

Edit `resources/views/invitation/sections/`:
- `gallery.blade.php` - Tambahkan scroll animations
- `gift.blade.php` - Tambahkan scroll animations
- `guestbook.blade.php` - Tambahkan scroll animations

### 2. Upload Background Images (Optional)

Jika ingin pakai background image:
1. Prepare images (recommended WebP format)
2. Upload ke `public/images/backgrounds/`
3. Update sections dengan parameter `image` dan `overlay`

### 3. Test Animations

1. Scroll perlahan untuk lihat animations
2. Test di berbagai device (mobile, tablet, desktop)
3. Check performance dengan Chrome DevTools

### 4. Fine-tune Delays

Adjust `data-delay` values untuk timing yang lebih baik:
```html
<div class="animate-on-scroll" data-animation="fade-in-up" data-delay="0">...</div>
<div class="animate-on-scroll" data-animation="fade-in-up" data-delay="100">...</div>
<div class="animate-on-scroll" data-animation="fade-in-up" data-delay="200">...</div>
```

## 📚 Dokumentasi Lengkap

Lihat file `ANIMATION_GUIDE.md` untuk:
- Detail semua animasi
- Advanced usage examples
- Performance tips
- Troubleshooting guide
- Complete API reference

## ⚡ Performance Notes

**Optimizations Applied:**
- ✅ Intersection Observer API (lebih efisien dari scroll event)
- ✅ requestAnimationFrame untuk parallax
- ✅ CSS animations (hardware accelerated)
- ✅ Animation unobserve setelah triggered (memory efficient)
- ✅ Graceful degradation untuk browser lama

**Browser Support:**
- ✅ Chrome 90+
- ✅ Firefox 88+
- ✅ Safari 14+
- ✅ Edge 90+

## 🎉 Summary

**Total Additions:**
- 1 new component file
- 1 documentation file
- 15+ new CSS animations
- Scroll-triggered animation system
- Stagger animation system
- Parallax system
- Background image support
- Ken Burns effect
- 60+ lines of JavaScript
- 100+ lines of CSS

**Sections Updated:**
- Hero/Opening ✅
- Salam ✅
- Event ✅
- Gallery (partial) ⚠️
- Gift (partial) ⚠️
- Guest Book (partial) ⚠️

**Result:**
Website undangan sekarang lebih dinamis, engaging, dan modern dengan animations yang smooth dan professional! 🚀
