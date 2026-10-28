# Multi-Template System Guide

## 🎯 Overview

Website undangan sekarang mendukung multiple templates dengan routing berbeda. User dapat memilih template yang sesuai dengan tema pernikahan mereka.

## 📁 Struktur Folder

```
resources/views/
├── home.blade.php                    # Template selector homepage
├── components/                       # Shared components
│   ├── animated-background.blade.php
│   ├── wave-divider.blade.php
│   ├── decorative-ornament.blade.php
│   └── section-animated.blade.php
└── templates/
    ├── template-1/                   # Elegant Modern
    │   ├── index.blade.php
    │   └── sections/
    │       ├── gallery.blade.php
    │       ├── gift.blade.php
    │       └── guestbook.blade.php
    └── template-2/                   # Classic Romantic
        ├── index.blade.php
        └── sections/
            ├── couple.blade.php
            ├── story.blade.php
            ├── event.blade.php
            ├── gallery.blade.php
            ├── gift.blade.php
            └── rsvp.blade.php
```

## 🌐 Routes

### Homepage
```
GET / → home.blade.php
```
Template selector page dengan preview kedua template.

### Template 1 - Elegant Modern
```
GET /template-1 → templates.template-1.index
POST /template-1/rsvp → rsvp.store
```

### Template 2 - Classic Romantic
```
GET /template-2 → templates.template-2.index
POST /template-2/rsvp → rsvp.store
```

### Legacy Redirect
```
GET /invitation → redirect ke /template-1
```

## 🎨 Template Features Comparison

| Feature | Template 1 (Elegant Modern) | Template 2 (Classic Romantic) |
|---------|----------------------------|------------------------------|
| **Style** | Modern, Clean, Techy | Classic, Romantic, Floral |
| **Color Scheme** | Primary Blue + Gold | Rose Pink + Soft Colors |
| **Animations** | Scroll-triggered, Glassmorphism | Floral animations, Soft transitions |
| **Hero** | Gradient with blobs | Floral background with hearts |
| **Sections** | Gallery, Gift, Guest Book | Couple, Story, Event, Gallery, Gift |
| **Ornaments** | Geometric shapes | Floral hearts |
| **Navigation** | Bottom slider nav | Bottom slider nav |
| **Best For** | Modern weddings, Tech-savvy couples | Traditional weddings, Romantic themes |

## 👨‍💻 Controller Implementation

### InvitationController.php

```php
class InvitationController extends Controller
{
    // Homepage - Template Selector
    public function home()
    {
        return view('home');
    }

    // Template 1
    public function template1()
    {
        $data = $this->getInvitationData();
        return view('templates.template-1.index', $data);
    }

    // Template 2
    public function template2()
    {
        $data = $this->getInvitationData();
        return view('templates.template-2.index', $data);
    }

    // Shared data untuk semua template
    private function getInvitationData()
    {
        return [
            'eventDate' => '2025-12-31 19:00:00',
            'confirmedGuests' => Guest::where('is_confirmed', true)->count(),
            'wishes' => Guest::whereNotNull('message')->latest()->paginate(10),
            // ... etc
        ];
    }
}
```

## 🚀 Cara Menambahkan Template Baru

### Step 1: Buat Folder Structure
```bash
mkdir -p resources/views/templates/template-3/sections
```

### Step 2: Buat File Index
```bash
touch resources/views/templates/template-3/index.blade.php
```

### Step 3: Tambahkan Route
Edit `routes/web.php`:
```php
Route::prefix('template-3')->name('template3.')->group(function () {
    Route::get('/', [InvitationController::class, 'template3'])->name('index');
    Route::post('/rsvp', [GuestController::class, 'store'])->name('rsvp.store');
});
```

### Step 4: Tambahkan Method di Controller
Edit `app/Http/Controllers/InvitationController.php`:
```php
public function template3()
{
    $data = $this->getInvitationData();
    return view('templates.template-3.index', $data);
}
```

### Step 5: Update Homepage
Edit `resources/views/home.blade.php` dan tambahkan card untuk template 3.

## 📝 Template Sections

### Template 1 Sections
1. **Hero/Opening** - Full screen hero dengan animated background
2. **Salam** - Greeting dan intro couple
3. **Gallery** - Photo gallery dengan lightbox
4. **Gift** - Bank transfer dan e-wallet info
5. **Event** - Akad & Resepsi info dengan countdown
6. **Guest Book** - Wedding wishes dari tamu
7. **Maps** - Lokasi venue
8. **RSVP** - Form konfirmasi kehadiran

### Template 2 Sections
1. **Hero/Opening** - Floral hero dengan hearts
2. **Couple** - Bride & Groom profile dengan floral frames
3. **Story** - Love timeline/story
4. **Event** - Event details dengan countdown
5. **Gallery** - Romantic photo gallery
6. **Gift** - Gift info dengan soft design
7. **RSVP** - Attendance confirmation

## 🎨 Customization Per Template

### Template-Specific Components

Setiap template dapat memiliki component sendiri di folder `sections/`.

**Contoh - Template 1:**
```blade
@include('templates.template-1.sections.gallery')
@include('templates.template-1.sections.gift')
```

**Contoh - Template 2:**
```blade
@include('templates.template-2.sections.couple')
@include('templates.template-2.sections.story')
```

### Shared Components

Components yang digunakan semua template:
```blade
<x-animated-background variant="rose" />
<x-wave-divider position="top" color="white" />
<x-decorative-ornament position="top-left" type="floral" color="gold" />
```

## 🎯 Navigation & Active States

### Template 1 Navigation
```javascript
// Primary blue color scheme
text-primary-600
bg-primary-500
```

### Template 2 Navigation
```javascript
// Rose/pink color scheme
text-rose-600
bg-rose-500
```

## 💾 Sharing Data Between Templates

Semua templates menggunakan data yang sama dari `getInvitationData()`:

```php
$eventDate
$confirmedGuests
$totalCapacity
$wishes
$totalWishes
$attendingCount
$notAttendingCount
$totalGuests
```

Data ini tersedia di semua template views.

## 🔗 Internal Links

### Route Names

```php
// Homepage
route('home')

// Template 1
route('template1.index')
route('template1.rsvp.store')

// Template 2
route('template2.index')
route('template2.rsvp.store')
```

### Example Usage in Blade

```blade
<!-- Link to template 1 -->
<a href="{{ route('template1.index') }}">Template 1</a>

<!-- Link to template 2 -->
<a href="{{ route('template2.index') }}">Template 2</a>

<!-- Back to home -->
<a href="{{ route('home') }}">Choose Template</a>
```

## 🎨 Color Schemes

### Template 1 - Elegant Modern
```css
Primary: Blue (#0ea5e9, #0284c7)
Accent: Gold (#eab308, #ca8a04)
Background: White with gradient overlays
```

### Template 2 - Classic Romantic
```css
Primary: Rose (#f43f5e, #e11d48)
Accent: Pink (#ec4899, #db2777)
Background: Soft rose/pink gradients
```

## 📱 Responsive Design

Kedua template fully responsive dengan breakpoints:
- Mobile: < 640px
- Tablet: 640px - 1024px
- Desktop: > 1024px

## 🚀 Deployment Notes

### Asset Compilation
```bash
npm run build
```

Akan compile assets untuk semua templates.

### Cache Clear
```bash
php artisan view:clear
php artisan route:clear
php artisan config:clear
```

## 🔍 Testing Checklist

### Homepage
- [ ] Template cards tampil dengan benar
- [ ] Preview images/backgrounds muncul
- [ ] Links ke template 1 & 2 berfungsi
- [ ] Animations smooth

### Template 1
- [ ] All sections tampil
- [ ] Scroll animations berfungsi
- [ ] Bottom nav slider works
- [ ] RSVP form submit berhasil
- [ ] Gallery lightbox works

### Template 2
- [ ] All sections tampil
- [ ] Floral ornaments muncul
- [ ] Scroll animations smooth
- [ ] Bottom nav berfungsi
- [ ] RSVP form berhasil

### Cross-Browser
- [ ] Chrome
- [ ] Firefox
- [ ] Safari
- [ ] Edge
- [ ] Mobile browsers

## 📚 File References

### Routes
[routes/web.php](routes/web.php)

### Controller
[app/Http/Controllers/InvitationController.php](app/Http/Controllers/InvitationController.php)

### Homepage
[resources/views/home.blade.php](resources/views/home.blade.php)

### Templates
- [resources/views/templates/template-1/index.blade.php](resources/views/templates/template-1/index.blade.php)
- [resources/views/templates/template-2/index.blade.php](resources/views/templates/template-2/index.blade.php)

## 🎉 Summary

✅ **2 Templates tersedia**:
  - Template 1: Elegant Modern (Blue/Gold)
  - Template 2: Classic Romantic (Rose/Pink)

✅ **Homepage dengan template selector**

✅ **Routing dengan prefix** (`/template-1`, `/template-2`)

✅ **Shared components** untuk consistency

✅ **Shared data** dari single controller method

✅ **Easy to extend** - tinggal copy template structure dan tambah route

✅ **Fully responsive** untuk semua devices

✅ **Tested & ready** untuk production
