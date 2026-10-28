# Card Design Update - Estetik Modern

## Update yang Telah Dilakukan

Semua card di section Gallery, Gift, dan Guest Book telah diupdate dengan desain yang lebih estetik dan modern menggunakan glassmorphism effect dan gradient yang indah.

## 🎨 Perubahan Desain

### 1. Gift Section

#### Bank Account Cards (BCA & Mandiri)
**Sebelum:**
- Background solid color
- Shadow sederhana
- Icon kecil

**Sesudah:**
- ✨ **Glassmorphism**: `bg-white/80 backdrop-blur-sm`
- ✨ **Gradient Overlay**: Subtle gradient `from-primary-500/10` untuk BCA, `from-gold-500/10` untuk Mandiri
- ✨ **Enhanced Shadow**: `shadow-xl hover:shadow-2xl`
- ✨ **Smooth Hover**: `hover:-translate-y-1` dengan durasi 500ms
- ✨ **Icon Lebih Besar**: 14x14 dengan gradient background
- ✨ **Typography Gradien**: Nama bank menggunakan `bg-clip-text text-transparent`
- ✨ **Copy Button**: Gradient button dengan icon SVG dan active scale effect

**Fitur Baru:**
- Relative z-index layering untuk depth
- Rounded corners lebih besar (3xl = 24px)
- Border semi-transparent `border-white/60`
- Group hover scale pada icon
- Uppercase tracking pada labels

#### E-Wallet Section
**Sebelum:**
- Background solid
- Border standar
- Tidak ada hover effect

**Sesudah:**
- ✨ **Card Container**: `bg-white/70 backdrop-blur-md` dengan gradient overlay purple/pink
- ✨ **QR Placeholders**: Rounded 2xl dengan shadow-lg
- ✨ **Hover Effects**: Border color berubah sesuai brand (primary, green, purple)
- ✨ **Icon Transition**: Warna icon berubah saat hover
- ✨ **Typography**: Gradient text pada heading

**Color Mapping:**
- QRIS: `group-hover:border-primary-200`, icon `group-hover:text-primary-300`
- GoPay: `group-hover:border-green-200`, icon `group-hover:text-green-400`
- OVO: `group-hover:border-purple-200`, icon `group-hover:text-purple-400`

#### Physical Address Card
**Sebelum:**
- Gradient sederhana
- Padding standar

**Sesudah:**
- ✨ **Glassmorphism**: `bg-white/70 backdrop-blur-sm`
- ✨ **Icon Box**: Gradient gold dengan shadow-lg dan rounded-2xl
- ✨ **Inner Card**: Nested card dengan `bg-gradient-to-br from-gray-50 to-white`
- ✨ **Typography**: Gradient heading, divider dengan border-t
- ✨ **Spacing**: Padding lebih generous (p-10)

### 2. Guest Book Section

#### Wish Cards
**Sebelum:**
- Background putih solid
- Shadow sederhana
- Avatar standar

**Sesudah:**
- ✨ **Glassmorphism**: `bg-white/80 backdrop-blur-sm`
- ✨ **Gradient Overlay**: Muncul saat hover dengan `from-primary-500/5`
- ✨ **Avatar Enhanced**:
  - Size lebih besar (14x14)
  - Ring white `ring-4 ring-white/50`
  - Scale animation saat hover
- ✨ **Badge Gradient**:
  - Hadir: `from-green-100 to-emerald-100` dengan shadow
  - Tidak Hadir: `from-gray-100 to-gray-200` dengan shadow
- ✨ **Message Box**: Inner card dengan gradient `from-gray-50 to-white`, italic text
- ✨ **Guest Count Badge**: `bg-primary-50` dengan border dan icon
- ✨ **Like Button**: Scale effect saat hover

**Spacing:**
- Rounded 3xl (32px)
- Space-y-5 untuk vertical spacing
- Padding 6 dengan relative z-10 untuk content

#### Stats Cards
**Sebelum:**
- Background putih
- Teks solid color
- Shadow minimal

**Sesudah:**
- ✨ **Glassmorphism**: `bg-white/80 backdrop-blur-sm`
- ✨ **Gradient Numbers**:
  - Total Ucapan: `from-primary-600 to-primary-400`
  - Hadir: `from-green-600 to-emerald-400`
  - Tidak Hadir: `from-gray-600 to-gray-400`
  - Total Tamu: `from-gold-600 to-gold-400`
- ✨ **Hover Effects**:
  - Gradient overlay muncul
  - `-translate-y-1` lift effect
  - `shadow-xl` meningkat
- ✨ **Fade In Animation**: Numbers dengan `animate-fade-in`
- ✨ **Typography**: Uppercase tracking-wider pada labels

### 3. Gallery Section

#### Photo Cards
**Sebelum:**
- Rounded xl
- Border tipis
- Zoom icon sederhana

**Sesudah:**
- ✨ **Border Frame**: `border-4 border-white/50 hover:border-white`
- ✨ **Enhanced Gradient**: `from-primary-200 via-purple-200 to-gold-200` dengan `animate-gradient`
- ✨ **Overlay Darker**: `from-black/60 via-black/20` untuk kontras lebih baik
- ✨ **Zoom Icon Bigger**: 14x14 dengan backdrop-blur dan scale animation
- ✨ **Label Text**: "Lihat Foto" dengan drop-shadow
- ✨ **Corner Accents**: Border dekoratif di pojok kanan atas dan kiri bawah
- ✨ **Smooth Animation**: Duration 500-700ms untuk efek smooth
- ✨ **Lift Effect**: `-translate-y-1` saat hover

**Details:**
- Icon size 20x20 (lebih besar)
- Rounded 2xl untuk softer corners
- Gap 5 untuk spacing lebih baik
- Multiple transition effects (transform, opacity, border)

## 🎯 Teknik Desain yang Digunakan

### Glassmorphism
```css
bg-white/80 backdrop-blur-sm border border-white/60
```
Effect kaca tembus pandang dengan blur untuk depth modern.

### Gradient Overlays
```css
<div class="absolute inset-0 bg-gradient-to-br from-primary-500/10 via-primary-400/5 to-transparent"></div>
```
Layer gradient subtle untuk menambah dimensi tanpa overwhelming.

### Gradient Text
```css
bg-gradient-to-r from-primary-600 to-primary-500 bg-clip-text text-transparent
```
Text dengan gradient fill untuk aksen modern.

### Layered Design
```html
<!-- Background layer -->
<div class="absolute inset-0 bg-gradient..."></div>
<!-- Content layer -->
<div class="relative z-10">...</div>
```
Menggunakan z-index untuk create depth.

### Smooth Transitions
```css
transition-all duration-300
hover:-translate-y-1
hover:shadow-2xl
```
Micro-interactions yang smooth untuk UX lebih baik.

### Group Hover Effects
```css
group hover:scale-110
group-hover:opacity-100
group-hover:text-primary-300
```
Child elements bereaksi terhadap parent hover.

## 🎨 Color Palette

### Primary (Blue)
- `primary-600` to `primary-400` - Bank BCA, Stats, Icons
- `primary-50` - Light backgrounds
- `primary-500/10` - Overlay transparencies

### Gold (Yellow)
- `gold-600` to `gold-400` - Bank Mandiri, Total Tamu
- `gold-50` - Light backgrounds
- `gold-500/10` - Overlay transparencies

### Green (Success)
- `green-600` to `emerald-400` - Hadir badge & stats
- `green-100` to `emerald-100` - Badge backgrounds

### Purple/Pink
- `purple-600` to `pink-600` - E-Wallet section
- `purple-200` - Gallery gradients
- `purple-400` - OVO hover color

### Grays
- `gray-50` to `white` - Inner cards
- `gray-600` to `gray-400` - Tidak Hadir stats
- `white/80`, `white/70` - Glassmorphism

## 📱 Responsive Design

Semua cards responsive dengan:
- `grid-cols-2 md:grid-cols-3` - Gallery
- `md:grid-cols-2` - Bank accounts
- `md:grid-cols-3` - E-Wallets
- `grid-cols-2 md:grid-cols-4` - Stats

Text scaling:
- `text-sm` sampai `text-4xl` dengan breakpoints
- `p-6` sampai `p-10` untuk padding adaptif

## ⚡ Performance

**Optimizations:**
- `backdrop-blur-sm` (lebih ringan dari `backdrop-blur-lg`)
- CSS transitions (lebih performa daripada JS animations)
- `will-change` implicit via transform/opacity
- `duration-300` to `duration-500` (tidak terlalu lama)

## 🔄 Migration Notes

Jika ingin revert ke desain lama, cukup:
1. Replace `bg-white/80 backdrop-blur-sm` dengan `bg-white`
2. Remove gradient overlay divs
3. Simplify hover effects dari `hover:-translate-y-1` ke `hover:shadow-lg`
4. Remove `group` classes dan child group-hover effects

## ✨ Hasil Akhir

Dengan update ini, website undangan memiliki:
- ✅ Look & feel modern dengan glassmorphism
- ✅ Gradients yang indah dan konsisten
- ✅ Hover effects yang smooth dan engaging
- ✅ Visual hierarchy yang jelas
- ✅ Color scheme yang harmonis
- ✅ Typography yang lebih readable
- ✅ Depth & dimensi melalui layering
- ✅ Responsive di semua device
- ✅ Performance tetap optimal

Desain sekarang lebih premium, modern, dan sesuai dengan trend design 2025! 🎉
