# Template 3 - Elegant Nature

## 🎨 Design Concept

Template 3 terinspirasi dari **indoinvite.com** dengan karakteristik:

### Style
- **Nature-Inspired**: Earthy, warm, natural
- **Elegant**: Sophisticated dengan ornamen floral
- **Parallax**: Floating clouds, grass, birds elements

### Color Palette
```
Primary: #594423 (Deep Brown) - Headings, text
Background: #e2dbcb (Warm Cream) - Main background
Accent: #d4a574 (Golden Brown) - Buttons, highlights
Light: #f5f1e8 (Soft Cream) - Cards, sections
Dark: #3d2f1f (Dark Brown) - Footer, contrast
```

### Typography
- **Headings**: Font Serif (Georgia, Playfair Display style)
- **Body**: Sans-serif (Inter, Assistant)
- **Script**: Cursive untuk nama couple (Dancing Script)

## 📐 Layout Structure

### Sections Order:
1. **Opening Cover** - Parallax dengan clouds & grass
2. **Hero Section** - Couple names dengan nature ornaments
3. **Couple Profile** - Bride & Groom dengan photo frames
4. **Love Story** - Narrative timeline
5. **Event Details** - Akad & Resepsi dengan countdown
6. **Gallery** - Photo grid dengan nature borders
7. **Gift Options** - Bank transfer & virtual gifts
8. **RSVP** - Confirmation form
9. **Closing** - Thank you dengan nature footer

## 🎭 Animations & Effects

### Parallax Elements:
- ☁️ Floating clouds (slow movement)
- 🌿 Grass swaying (bottom sections)
- 🦜 Birds flying (top decorations)
- 🌳 Trees (side ornaments)

### Scroll Animations:
- Fade-in-up for sections
- Zoom-in for images
- Slide-in for timeline items

## 🖼️ Decorative Elements

### Nature Ornaments (SVG/Images):
```
Top: Birds, clouds, tree branches
Sides: Flowers, leaves, vines
Bottom: Grass, bushes, small plants
Corners: Floral frames, botanical corners
```

### Card Styles:
- Cream/beige backgrounds
- Brown borders dengan shadow soft
- Nature ornaments di corners
- Vintage paper texture (optional)

## 🎯 Key Features

### 1. Parallax Scrolling
```javascript
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;

    // Clouds move slower
    clouds.style.transform = `translateY(${scrolled * 0.3}px)`;

    // Grass moves slightly
    grass.style.transform = `translateY(${scrolled * 0.1}px)`;
});
```

### 2. Nature Ornaments
```blade
<!-- Cloud SVG -->
<svg class="cloud animate-float-slow">...</svg>

<!-- Grass SVG -->
<svg class="grass animate-sway">...</svg>

<!-- Bird SVG -->
<svg class="bird animate-fly">...</svg>
```

### 3. Warm Color Gradients
```css
background: linear-gradient(to bottom, #e2dbcb, #f5f1e8);
color: #594423;
border: 2px solid #d4a574;
```

## 📱 Responsive Design

### Mobile (< 640px):
- Single column layout
- Reduced ornament sizes
- Simplified parallax
- Touch-friendly buttons

### Tablet (640px - 1024px):
- 2 column grids
- Medium ornaments
- Moderate parallax

### Desktop (> 1024px):
- Full parallax effects
- Large decorative elements
- 3 column galleries
- Enhanced animations

## 🎨 Custom CSS Animations

### For Nature Elements:
```css
@keyframes float-cloud {
    0%, 100% { transform: translate(0, 0); }
    50% { transform: translate(20px, -10px); }
}

@keyframes sway-grass {
    0%, 100% { transform: rotate(-2deg); }
    50% { transform: rotate(2deg); }
}

@keyframes fly-bird {
    0% { transform: translateX(-100px); }
    100% { transform: translateX(100vw); }
}
```

## 🔤 Custom Fonts

Recommended Google Fonts:
```html
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&family=Great+Vibes&display=swap');
```

- Playfair Display: Headings
- Inter: Body text
- Great Vibes: Couple names (alternative to Dancing Script)

## 📦 Assets Needed

### Images:
```
public/images/template-3/
├── ornaments/
│   ├── cloud-1.svg
│   ├── cloud-2.svg
│   ├── grass.svg
│   ├── bird.svg
│   ├── tree-left.svg
│   ├── tree-right.svg
│   ├── flower-corner.svg
│   └── leaves.svg
├── backgrounds/
│   ├── paper-texture.png
│   └── vintage-pattern.png
└── couple/
    ├── bride.jpg
    └── groom.jpg
```

## 🎯 Comparison with Other Templates

| Feature | Template 1 | Template 2 | Template 3 |
|---------|-----------|-----------|-----------|
| **Style** | Modern Tech | Classic Romantic | Elegant Nature |
| **Colors** | Blue+Gold | Rose+Pink | Brown+Cream |
| **Theme** | Professional | Romantic | Earthy/Natural |
| **Ornaments** | Geometric | Hearts | Nature (birds, trees) |
| **Effects** | Glassmorphism | Soft transitions | Parallax scrolling |
| **Best For** | Modern couples | Traditional | Nature lovers, rustic themes |

## 🚀 Implementation Status

### ✅ Completed:
- [x] Routing setup
- [x] Controller method
- [x] Folder structure

### 🔄 In Progress:
- [ ] Main index.blade.php
- [ ] Opening cover section
- [ ] Hero section with parallax
- [ ] Couple section
- [ ] Story section
- [ ] Event section
- [ ] Gallery section
- [ ] Gift section
- [ ] RSVP section

### 📝 Next Steps:
1. Create custom color variables in CSS
2. Design nature SVG ornaments
3. Implement parallax JavaScript
4. Build all sections with earthy theme
5. Add vintage/nature styling
6. Test parallax on mobile

## 💡 Design Tips

### For Cohesive Nature Theme:
1. Use **muted, earthy colors** throughout
2. Add **subtle textures** (paper, fabric)
3. Include **organic shapes** (curved borders, irregular patterns)
4. Use **nature metaphors** in copy ("Growing together", "Roots & Wings")
5. Incorporate **botanical illustrations** consistently

### Typography Guidelines:
- Headings: 2.5rem - 4rem (large, elegant)
- Body: 1rem - 1.125rem (readable)
- Line height: 1.6 - 1.8 (airy, breathable)
- Letter spacing: Slightly wider for elegance

## 🎨 CSS Custom Properties

```css
:root {
    /* Colors */
    --color-primary: #594423;
    --color-bg-cream: #e2dbcb;
    --color-accent: #d4a574;
    --color-light: #f5f1e8;
    --color-dark: #3d2f1f;

    /* Fonts */
    --font-heading: 'Playfair Display', serif;
    --font-body: 'Inter', sans-serif;
    --font-script: 'Great Vibes', cursive;

    /* Spacing */
    --spacing-sm: 0.5rem;
    --spacing-md: 1rem;
    --spacing-lg: 2rem;
    --spacing-xl: 4rem;
}
```

## 📖 Usage Example

```blade
<!-- Nature Section with Parallax -->
<section class="relative py-20 bg-cream overflow-hidden">
    <!-- Parallax Clouds -->
    <div class="parallax-cloud absolute top-10 left-10">
        <svg><!-- Cloud SVG --></svg>
    </div>

    <!-- Content -->
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-heading text-brown">Section Title</h2>
        <!-- Content here -->
    </div>

    <!-- Bottom Grass -->
    <div class="absolute bottom-0 w-full">
        <svg class="grass"><!-- Grass SVG --></svg>
    </div>
</section>
```

---

**Template 3 - Elegant Nature** akan memberikan nuansa alami, hangat, dan elegan untuk undangan pernikahan dengan tema rustic, garden, atau outdoor wedding! 🌿✨
