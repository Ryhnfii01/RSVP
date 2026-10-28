# 📘 Integration Guide - New Sections

## 🎯 Overview

Saya telah membuat 3 section baru yang siap digunakan:
1. **Gallery** - Grid foto dengan lightbox
2. **Gift** - Info rekening & e-wallet
3. **Guest Book** - Ucapan & doa dari tamu

## 📁 Files Created

```
resources/views/invitation/sections/
├── gallery.blade.php      ✅ Created
├── gift.blade.php         ✅ Created
└── guestbook.blade.php    ✅ Created
```

## 🔧 How to Integrate

### Option 1: Quick Integration (Recommended)

Tambahkan sections ke file `resources/views/invitation/index.blade.php` setelah section yang sudah ada:

**Lokasi untuk insert sections:**

1. **Gallery** - Setelah `</section>` Salam section (setelah line ~160)
2. **Gift** - Setelah `</section>` Maps section (setelah line ~301)
3. **Guest Book** - Setelah `</section>` RSVP section (setelah line ~375)

**Code to add:**

```blade
{{-- After Salam Section (line ~160) --}}
@include('invitation.sections.gallery')

<div class="h-2 bg-gradient-to-r from-gold-400 via-gold-300 to-gold-400"></div>

{{-- After Maps Section (line ~301) --}}
@include('invitation.sections.gift')

<div class="h-2 bg-gradient-to-r from-gold-400 via-gold-300 to-gold-400"></div>

{{-- Before Footer (after RSVP section, line ~375) --}}
@include('invitation.sections.guestbook')

<div class="h-2 bg-gradient-to-r from-gold-400 via-gold-300 to-gold-400"></div>
```

### Option 2: Manual Copy-Paste

Copy isi dari setiap section file dan paste langsung ke `index.blade.php` di posisi yang sesuai.

## 🎨 Update Bottom Navigation

Tambahkan menu baru di bottom navigation (line ~391):

**Current navigation** (5 items):
- Opening, Salam, Event, Maps, RSVP

**New navigation** (8 items):
- Opening, Salam, Gallery, Event, Maps, Gift, RSVP, Wishes

Update code di `<nav id="bottom-nav">` section:

```blade
<nav id="bottom-nav" class="fixed bottom-0 left-0 right-0 bg-white shadow-lg z-40 transition-all duration-500 translate-y-full opacity-0 overflow-x-auto">
    <div class="flex justify-start md:justify-around items-center px-2 py-3 min-w-max md:min-w-0">
        <a href="#opening" class="nav-item flex flex-col items-center text-primary-600 px-3 md:px-4">
            <svg class="w-5 h-5 md:w-6 md:h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Opening</span>
        </a>

        <a href="#salam" class="nav-item flex flex-col items-center text-gray-600 px-3 md:px-4">
            <svg class="w-5 h-5 md:w-6 md:h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Salam</span>
        </a>

        <!-- NEW: Gallery Menu -->
        <a href="#gallery" class="nav-item flex flex-col items-center text-gray-600 px-3 md:px-4">
            <svg class="w-5 h-5 md:w-6 md:h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Gallery</span>
        </a>

        <a href="#event" class="nav-item flex flex-col items-center text-gray-600 px-3 md:px-4">
            <svg class="w-5 h-5 md:w-6 md:h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Event</span>
        </a>

        <a href="#maps" class="nav-item flex flex-col items-center text-gray-600 px-3 md:px-4">
            <svg class="w-5 h-5 md:w-6 md:h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Maps</span>
        </a>

        <!-- NEW: Gift Menu -->
        <a href="#gift" class="nav-item flex flex-col items-center text-gray-600 px-3 md:px-4">
            <svg class="w-5 h-5 md:w-6 md:h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Gift</span>
        </a>

        <a href="#rsvp" class="nav-item flex flex-col items-center text-gray-600 px-3 md:px-4">
            <svg class="w-5 h-5 md:w-6 md:h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">RSVP</span>
        </a>

        <!-- NEW: Wishes Menu -->
        <a href="#wishes" class="nav-item flex flex-col items-center text-gray-600 px-3 md:px-4">
            <svg class="w-5 h-5 md:w-6 md:h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Wishes</span>
        </a>
    </div>
</nav>
```

**CSS Update:** Tambahkan scrolling support untuk mobile:
```css
#bottom-nav {
    scrollbar-width: none; /* Firefox */
}

#bottom-nav::-webkit-scrollbar {
    display: none; /* Chrome, Safari */
}
```

## 🖼️ Adding Real Images

### Gallery Photos

1. Upload 9 foto ke `public/images/gallery/`
2. Nama file: `photo-1.jpg` sampai `photo-9.jpg`
3. Recommended size: 1200x800px atau 4:3 ratio

**Update gallery.blade.php:**
Uncomment line dengan `<img>` tag dan comment `<div>` placeholder

```blade
<!-- Line ~20-30 in gallery.blade.php -->
<img src="{{ asset('images/gallery/photo-' . $i . '.jpg') }}"
     alt="Gallery Photo {{ $i }}"
     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
     loading="lazy">
```

### QR Codes

1. Generate QR code untuk QRIS/GoPay/OVO
2. Upload ke `public/images/qr-code/`
3. Nama file: `qris.png`, `gopay.png`, `ovo.png`

**Update gift.blade.php:**
Uncomment `<img>` tag untuk QR code

## ✏️ Customization

### Bank Account Info

Edit `resources/views/invitation/sections/gift.blade.php`:

```blade
<!-- Line ~15: BCA Account Number -->
<p id="bca-number" class="...">1234567890</p>

<!-- Line ~24: Account Name -->
<p class="...">Nama Lengkap Pria</p>

<!-- Line ~45: Mandiri Account Number -->
<p id="mandiri-number" class="...">0987654321</p>

<!-- Line ~54: Account Name -->
<p class="...">Nama Lengkap Wanita</p>
```

### Physical Address

Edit line ~120 di `gift.blade.php`:

```blade
<p class="text-base font-medium text-gray-800">
    Jl. Contoh No. 123, Kelurahan, Kecamatan<br>
    Kota, Provinsi 12345
</p>
<p class="text-sm text-gray-600 mt-2">a.n. Nama Penerima | 0812-3456-7890</p>
```

## 🚀 Next Steps

1. **Integrate sections** - Add @include statements
2. **Update bottom nav** - Add new menu items
3. **Upload images** - Add gallery photos & QR codes
4. **Rebuild assets** - Run `npm run build`
5. **Test** - Check all functionality

## 📝 Testing Checklist

- [ ] Gallery lightbox works
- [ ] Copy bank number works
- [ ] Guest book displays wishes
- [ ] Navigation scrolls smoothly
- [ ] Responsive on mobile
- [ ] Images load properly
- [ ] Stats show correct numbers

---

**Ready to integrate? Let me know if you need help!** 🎉
