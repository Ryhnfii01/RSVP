# Background Cheatsheet - Copy & Paste Ready! 🚀

## 🎯 Syntax Dasar

### Background dengan Image
```blade
<x-animated-background
    image="{{ asset('images/backgrounds/nama-file.jpg') }}"
    overlay="dark"
/>
```

### Background dengan Gradient
```blade
<x-animated-background variant="gold" />
```

---

## 📋 Parameter Reference

### `image` - Path ke gambar background
```blade
image="{{ asset('images/backgrounds/hero.jpg') }}"
image="{{ asset('images/backgrounds/gallery.webp') }}"
image="/images/bg.jpg"
```

### `overlay` - Overlay warna di atas image

| Value | Warna | Opacity | Kapan Pakai |
|-------|-------|---------|-------------|
| `dark` | Black | 40% | Text putih, dramatic |
| `light` | White | 40% | Text gelap, bright |
| `primary` | Blue | 40% | Brand color, romantic |
| `gold` | Gold | 40% | Elegant, luxury |
| `none` | - | - | Image jelas terlihat |

```blade
overlay="dark"     <!-- Default, untuk text putih -->
overlay="light"    <!-- Untuk text gelap -->
overlay="primary"  <!-- Blue tint -->
overlay="gold"     <!-- Warm gold tint -->
overlay="none"     <!-- Tanpa overlay -->
```

### `variant` - Gradient type (jika TIDAK pakai image)

| Variant | Gradient | Kapan Pakai |
|---------|----------|-------------|
| `default` | Blue gradient | Hero, professional |
| `gold` | Gold gradient | Gift, luxury |
| `rose` | Pink gradient | Romantic, soft |
| `purple` | Purple gradient | Modern, creative |
| `light` | White-gray | Clean, minimal |

```blade
variant="default"  <!-- Primary blue -->
variant="gold"     <!-- Elegant gold -->
variant="rose"     <!-- Romantic pink -->
variant="purple"   <!-- Modern purple -->
variant="light"    <!-- Subtle gray -->
```

---

## 🎨 Template Section Lengkap

### Template 1: Section dengan Background Image

```blade
<section id="section-id" class="relative py-20 overflow-hidden">
    <!-- Background -->
    <x-animated-background
        image="{{ asset('images/backgrounds/section-bg.jpg') }}"
        overlay="dark"
    />

    <!-- Wave Divider (optional) -->
    <x-wave-divider position="top" color="white" />

    <!-- Ornaments (optional) -->
    <x-decorative-ornament position="top-left" type="floral" color="gold" />

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4">
        <h2 class="text-5xl text-white text-center">Section Title</h2>
        <!-- Your content here -->
    </div>

    <!-- Wave Divider Bottom (optional) -->
    <x-wave-divider position="bottom" color="gray-50" />
</section>
```

### Template 2: Section dengan Gradient Background

```blade
<section id="section-id" class="relative py-20 overflow-hidden">
    <!-- Gradient Background -->
    <x-animated-background variant="light" />

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4">
        <h2 class="text-5xl text-gray-800 text-center">Section Title</h2>
        <!-- Your content here -->
    </div>
</section>
```

---

## 🖼️ Copy-Paste Examples Per Section

### Hero Section
```blade
<section id="opening" class="relative min-h-screen overflow-hidden">
    <x-animated-background
        image="{{ asset('images/backgrounds/hero.jpg') }}"
        overlay="dark"
    />

    <div class="relative z-10 container mx-auto px-4 text-center text-white">
        <h1 class="text-7xl font-script">Bride & Groom</h1>
        <p class="text-xl">Date & Time</p>
    </div>
</section>
```

### Gallery Section
```blade
<section id="gallery" class="relative py-20 overflow-hidden">
    <x-animated-background
        image="{{ asset('images/backgrounds/gallery.jpg') }}"
        overlay="light"
    />

    <x-wave-divider position="top" color="white" />

    <div class="relative z-10 container mx-auto px-4">
        <h2 class="text-5xl text-gray-800 text-center">Our Moments</h2>
        <!-- Gallery grid -->
    </div>

    <x-wave-divider position="bottom" color="white" />
</section>
```

### Gift Section
```blade
<section id="gift" class="relative py-20 overflow-hidden">
    <x-animated-background
        image="{{ asset('images/backgrounds/gift.jpg') }}"
        overlay="gold"
    />

    <x-decorative-ornament position="top-left" type="hearts" color="gold" />

    <div class="relative z-10 container mx-auto px-4">
        <h2 class="text-5xl text-white text-center">Wedding Gift</h2>
        <!-- Bank cards -->
    </div>
</section>
```

### Event Section (Gradient)
```blade
<section id="event" class="relative py-20 overflow-hidden">
    <x-animated-background variant="light" />

    <x-decorative-ornament position="top-left" type="floral" color="primary" />

    <div class="relative z-10 container mx-auto px-4">
        <h2 class="text-5xl text-gray-800 text-center">Waktu & Tempat</h2>
        <!-- Event details -->
    </div>
</section>
```

### Guest Book Section
```blade
<section id="wishes" class="relative py-20 overflow-hidden">
    <x-animated-background
        image="{{ asset('images/backgrounds/guestbook.jpg') }}"
        overlay="light"
    />

    <x-wave-divider position="top" color="white" />

    <div class="relative z-10 container mx-auto px-4">
        <h2 class="text-5xl text-gray-800 text-center">Wedding Wishes</h2>
        <!-- Wish cards -->
    </div>
</section>
```

### Story/Timeline Section
```blade
<section id="story" class="relative py-20 overflow-hidden">
    <x-animated-background
        image="{{ asset('images/backgrounds/story.jpg') }}"
        overlay="primary"
    />

    <div class="relative z-10 container mx-auto px-4 text-white">
        <h2 class="text-5xl font-script text-center">Our Love Story</h2>
        <!-- Timeline items -->
    </div>
</section>
```

---

## 🎨 Kombinasi Background + Animasi

### Section dengan Scroll Animations
```blade
<section class="relative py-20 overflow-hidden">
    <x-animated-background
        image="{{ asset('images/bg.jpg') }}"
        overlay="dark"
    />

    <div class="relative z-10 container mx-auto px-4">
        <!-- Animated Heading -->
        <div class="animate-on-scroll" data-animation="fade-in-up">
            <h2 class="text-5xl text-white text-center">Title</h2>
        </div>

        <!-- Animated Content -->
        <div class="animate-on-scroll" data-animation="zoom-in" data-delay="200">
            <p class="text-white text-center">Description</p>
        </div>

        <!-- Stagger Cards -->
        <div class="grid grid-cols-3 gap-8 stagger-animation">
            <div class="card">Card 1</div>
            <div class="card">Card 2</div>
            <div class="card">Card 3</div>
        </div>
    </div>
</section>
```

### Section dengan Parallax Elements
```blade
<section class="relative py-20 overflow-hidden">
    <x-animated-background
        image="{{ asset('images/bg.jpg') }}"
        overlay="gold"
    />

    <!-- Parallax Decoration -->
    <div class="parallax absolute top-20 left-10 opacity-30" data-speed="0.3">
        <svg class="w-32 h-32 text-white">...</svg>
    </div>

    <div class="relative z-10 container mx-auto px-4">
        <h2 class="text-white">Section Title</h2>
    </div>
</section>
```

---

## 📱 Upload Background Images

### 1. Struktur Folder
```
public/
└── images/
    └── backgrounds/
        ├── hero.jpg
        ├── gallery.webp
        ├── gift.jpg
        ├── event.jpg
        └── guestbook.jpg
```

### 2. Recommended Specs

| Aspect | Recommendation |
|--------|----------------|
| **Hero** | 1920x1080px, <500KB, JPG/WebP |
| **Gallery** | 1920x1080px, <500KB, WebP |
| **Others** | 1600x900px, <300KB, JPG/WebP |

### 3. Optimization Tools
- **TinyPNG**: https://tinypng.com
- **Squoosh**: https://squoosh.app
- **ImageOptim**: (Mac only)

---

## 🎯 Quick Decision Matrix

### Kapan Pakai Image vs Gradient?

```
USE IMAGE:
✅ Hero - Want dramatic impact
✅ Gallery - Add visual context
✅ Gift - Create elegant mood
✅ Story - Emotional connection

USE GRADIENT:
✅ Event - Focus on info
✅ Forms - Less distraction
✅ Salam - Clean & minimal
✅ Mobile - Better performance
```

### Pilih Overlay Berdasarkan Text

```
TEXT PUTIH → overlay="dark"
TEXT GELAP → overlay="light"
BRAND COLOR → overlay="primary"
ELEGANT/WARM → overlay="gold"
IMAGE JELAS → overlay="none" + manual gradient
```

---

## 🔍 Troubleshooting Quick Fixes

```
❌ Image tidak muncul
✅ Check path: {{ asset('images/backgrounds/file.jpg') }}
✅ Pastikan file exists di public/images/backgrounds/
✅ Clear browser cache (Ctrl + Shift + R)

❌ Text tidak terbaca
✅ Pakai overlay yang kontras (dark untuk text putih)
✅ Tambah manual overlay jika perlu
✅ Adjust opacity overlay di component

❌ Animation laggy
✅ Compress images (target <500KB)
✅ Use WebP format
✅ Reduce animation count per section

❌ Ken Burns terlalu cepat
✅ Default 30s, edit di app.css @keyframes ken-burns
```

---

## 💡 Pro Tips

```blade
1. Layer multiple overlays untuk efek custom:
<x-animated-background image="..." overlay="none" />
<div class="absolute inset-0 bg-gradient-to-b from-black/50 to-transparent"></div>

2. Combine dengan wave dividers untuk smooth transitions:
<x-wave-divider position="top" color="white" />
<x-animated-background ... />
<x-wave-divider position="bottom" color="gray-50" />

3. Use glassmorphism cards on image backgrounds:
<div class="bg-white/20 backdrop-blur-md border border-white/30 rounded-2xl p-6">
    Content
</div>

4. Parallax untuk decorative elements:
<div class="parallax absolute ..." data-speed="0.5">
    <svg class="text-white opacity-20">...</svg>
</div>
```

---

## 📋 Final Checklist

```
Upload Background Images:
□ Create folder: public/images/backgrounds/
□ Upload & optimize images (<500KB)
□ Use WebP for better compression

Update Sections:
□ Replace existing backgrounds dengan <x-animated-background>
□ Pilih overlay yang sesuai dengan text color
□ Test di berbagai screen sizes

Add Animations:
□ Tambah scroll-triggered animations
□ Use stagger untuk multiple items
□ Add parallax untuk decorative elements

Test & Optimize:
□ Check performance di mobile
□ Verify text readability
□ Test all animations smooth
□ Clear cache & hard refresh
```

---

**Selamat menggunakan! 🎉**

Lihat **BACKGROUND_EXAMPLES.md** untuk contoh lengkap per section.
