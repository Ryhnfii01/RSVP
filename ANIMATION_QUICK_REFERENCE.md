# Animation Quick Reference Card

## 🚀 Quick Copy-Paste Examples

### Scroll-Triggered Animations

```html
<!-- Fade from bottom (default) -->
<div class="animate-on-scroll" data-animation="fade-in-up">
    Content
</div>

<!-- Fade from top -->
<div class="animate-on-scroll" data-animation="fade-in-down">
    Content
</div>

<!-- Fade from left -->
<div class="animate-on-scroll" data-animation="fade-in-left">
    Content
</div>

<!-- Fade from right -->
<div class="animate-on-scroll" data-animation="fade-in-right">
    Content
</div>

<!-- Zoom in -->
<div class="animate-on-scroll" data-animation="zoom-in">
    Content
</div>

<!-- With delay (milliseconds) -->
<div class="animate-on-scroll" data-animation="fade-in-up" data-delay="200">
    Content
</div>
```

### Stagger Animations

```html
<!-- Cards will animate one by one -->
<div class="grid grid-cols-3 gap-8 stagger-animation">
    <div class="card">Card 1</div>
    <div class="card">Card 2</div>
    <div class="card">Card 3</div>
</div>
```

### Background with Gradient

```blade
<section class="relative overflow-hidden">
    <x-animated-background variant="default" />
    <!-- or: gold, rose, purple, light -->

    <div class="relative z-10 container mx-auto">
        <!-- Content -->
    </div>
</section>
```

### Background with Image

```blade
<section class="relative overflow-hidden">
    <x-animated-background
        image="{{ asset('images/bg.jpg') }}"
        overlay="dark"
    />
    <!-- overlay: dark, light, primary, gold, none -->

    <div class="relative z-10 container mx-auto">
        <!-- Content -->
    </div>
</section>
```

### Complete Section Template

```blade
<section id="my-section" class="relative py-20 overflow-hidden">
    <!-- Background -->
    <x-animated-background
        image="{{ asset('images/section-bg.jpg') }}"
        overlay="dark"
    />

    <!-- Decorations -->
    <x-decorative-ornament position="top-left" type="floral" color="gold" />
    <x-decorative-ornament position="bottom-right" type="geometric" color="primary" />

    <!-- Wave Divider -->
    <x-wave-divider position="top" color="white" />

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4">
        <!-- Heading -->
        <div class="text-center mb-12 animate-on-scroll" data-animation="fade-in-up">
            <h2 class="text-4xl font-serif">Section Title</h2>
        </div>

        <!-- Description -->
        <div class="animate-on-scroll" data-animation="zoom-in" data-delay="100">
            <p class="text-center">Description text</p>
        </div>

        <!-- Cards -->
        <div class="grid md:grid-cols-3 gap-8 mt-12 stagger-animation">
            <div class="card">Card 1</div>
            <div class="card">Card 2</div>
            <div class="card">Card 3</div>
        </div>
    </div>

    <!-- Bottom Wave -->
    <x-wave-divider position="bottom" color="gray-50" />
</section>
```

### Parallax Element

```html
<div class="parallax" data-speed="0.5">
    <img src="decoration.png" alt="Decoration">
</div>
```

### Immediate CSS Animations

```html
<div class="animate-fade-in">Fade in</div>
<div class="animate-fade-in-up">Fade in from bottom</div>
<div class="animate-fade-in-down">Fade in from top</div>
<div class="animate-zoom-in">Zoom in</div>
<div class="animate-slide-up">Slide up</div>
<div class="animate-slide-down">Slide down</div>
```

### Background Decorative Animations

```html
<div class="animate-float">Floating element</div>
<div class="animate-blob animation-delay-2000">Blob</div>
<div class="animate-twinkle">Sparkle</div>
<div class="animate-pulse-soft">Soft pulse</div>
<div class="animate-rotate-slow">Slow rotation</div>
```

## 📐 Common Patterns

### Hero Section

```blade
<section class="relative min-h-screen overflow-hidden">
    <x-animated-background variant="default" />

    <div class="relative z-10 container mx-auto text-center">
        <div class="animate-fade-in-down">
            <p class="text-sm uppercase tracking-widest">THE WEDDING OF</p>
        </div>

        <div class="animate-fade-in-up">
            <h1 class="text-7xl font-script">Bride & Groom</h1>
        </div>

        <div class="animate-zoom-in">
            <p class="text-xl">Date & Time</p>
        </div>
    </div>
</section>
```

### Content Section

```blade
<section class="py-20 bg-white">
    <div class="container mx-auto">
        <div class="animate-on-scroll" data-animation="fade-in-up">
            <h2 class="text-4xl text-center">Section Title</h2>
        </div>

        <div class="animate-on-scroll" data-animation="zoom-in" data-delay="200">
            <p class="text-center">Content description</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 mt-12 stagger-animation">
            <div class="card">Item 1</div>
            <div class="card">Item 2</div>
        </div>
    </div>
</section>
```

### Gallery Section

```blade
<section class="relative py-20 overflow-hidden">
    <x-animated-background
        image="{{ asset('images/gallery-bg.jpg') }}"
        overlay="light"
    />

    <div class="relative z-10 container mx-auto">
        <div class="animate-on-scroll" data-animation="fade-in-up">
            <h2>Our Gallery</h2>
        </div>

        <div class="grid grid-cols-3 gap-4 stagger-animation">
            @for($i = 1; $i <= 9; $i++)
            <div class="photo-card">Photo {{ $i }}</div>
            @endfor
        </div>
    </div>
</section>
```

## 🎨 Animation Combinations

### Sequential Reveals

```html
<div class="animate-on-scroll" data-animation="fade-in-up" data-delay="0">
    First element
</div>
<div class="animate-on-scroll" data-animation="fade-in-up" data-delay="100">
    Second element (100ms later)
</div>
<div class="animate-on-scroll" data-animation="fade-in-up" data-delay="200">
    Third element (200ms later)
</div>
```

### Alternating Animations

```html
<div class="animate-on-scroll" data-animation="fade-in-left">
    From left
</div>
<div class="animate-on-scroll" data-animation="fade-in-right" data-delay="100">
    From right
</div>
<div class="animate-on-scroll" data-animation="fade-in-left" data-delay="200">
    From left again
</div>
```

### Center Focus

```html
<div class="animate-on-scroll" data-animation="zoom-in">
    <h2>Main Title (zoom in)</h2>
</div>
<div class="animate-on-scroll" data-animation="fade-in-up" data-delay="200">
    <p>Supporting text (fade from bottom)</p>
</div>
```

## 🎯 Component Props Cheatsheet

### animated-background

```blade
<x-animated-background
    variant="default|gold|rose|purple|light"
    image="{{ asset('path/to/image.jpg') }}"
    overlay="dark|light|primary|gold|none"
/>
```

### decorative-ornament

```blade
<x-decorative-ornament
    position="top-left|top-right|bottom-left|bottom-right"
    type="floral|geometric|hearts"
    color="gold|primary|white"
/>
```

### wave-divider

```blade
<x-wave-divider
    position="top|bottom"
    color="white|gray-50|primary-50|gold-50"
/>
```

## 📱 Upload Background Images

### 1. Folder Structure

```
public/images/backgrounds/
├── hero.jpg          (1920x1080)
├── gallery.webp      (1920x1080)
├── gift.jpg          (1600x900)
├── event.jpg         (1600x900)
└── guestbook.jpg     (1600x900)
```

### 2. Usage

```blade
<x-animated-background
    image="{{ asset('images/backgrounds/hero.jpg') }}"
    overlay="dark"
/>
```

### 3. Optimization

- Use **WebP** format for smaller size
- Compress with **TinyPNG** or **Squoosh**
- Maximum file size: **500KB**

## 🔧 Delays Reference

```
0ms    - Instant
100ms  - Quick
200ms  - Normal
300ms  - Delayed
500ms  - Slow
```

## ⚡ Performance Tips

```html
✅ DO: Limit animations per section (max 5-7)
✅ DO: Use stagger-animation for multiple items
✅ DO: Optimize images (WebP, compressed)
✅ DO: Test on mobile devices

❌ DON'T: Animate every single element
❌ DON'T: Use very large images (>1MB)
❌ DON'T: Stack multiple delays >500ms
```

## 🐛 Troubleshooting

```
Issue: Animation tidak muncul
Fix: Check console errors, pastikan class benar

Issue: Background image tidak terlihat
Fix: Verify path benar, clear cache

Issue: Animation laggy
Fix: Reduce jumlah animasi, optimize images

Issue: Delay tidak kerja
Fix: Pastikan format data-delay="200" (number)
```

## 📊 Browser Support

```
✅ Chrome 90+
✅ Firefox 88+
✅ Safari 14+
✅ Edge 90+
⚠️  IE 11 (tanpa animasi)
```

---

**Need full documentation?** See `ANIMATION_GUIDE.md`
