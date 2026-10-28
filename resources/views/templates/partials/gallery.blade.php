{{--
    Galeri foto bersama untuk semua template (foto diunggah lewat Admin > Gallery).
    Tidak tampil jika belum ada foto.
    Parameter: $theme = kelas warna sesuai template (section, title, divider, tile).
--}}
@php($photos = $event->exists ? $event->photos : collect())
@if ($photos->isNotEmpty())
<section id="gallery" class="py-16 sm:py-20 {{ $theme['section'] }}">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="text-center mb-12">
            <h2 class="text-4xl md:text-5xl mb-4 {{ $theme['title'] }}">Galeri</h2>
            <div class="w-24 h-0.5 mx-auto {{ $theme['divider'] }}"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4">
            @foreach ($photos as $photo)
            <button type="button" data-gallery-index="{{ $loop->index }}"
                    class="group relative aspect-square overflow-hidden rounded-2xl focus:outline-none focus-visible:ring-4 {{ $theme['tile'] }}"
                    aria-label="Lihat foto {{ $loop->iteration }} dari {{ $photos->count() }}">
                <img src="{{ $photo->url() }}" alt="Foto {{ $loop->iteration }}" loading="lazy"
                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
            </button>
            @endforeach
        </div>
    </div>
</section>

<!-- Lightbox -->
<div id="gallery-lightbox" class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/95" role="dialog" aria-modal="true" aria-label="Galeri foto">
    <button type="button" data-gallery-close class="absolute top-4 right-4 w-11 h-11 flex items-center justify-center rounded-full text-white hover:bg-white/10" aria-label="Tutup">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
    <button type="button" data-gallery-prev class="absolute left-2 sm:left-4 w-11 h-11 flex items-center justify-center rounded-full text-white hover:bg-white/10" aria-label="Foto sebelumnya">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button type="button" data-gallery-next class="absolute right-2 sm:right-4 w-11 h-11 flex items-center justify-center rounded-full text-white hover:bg-white/10" aria-label="Foto berikutnya">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </button>
    <figure class="px-14 max-w-5xl w-full text-center">
        <img id="gallery-lightbox-image" src="" alt="" class="mx-auto max-h-[80vh] max-w-full rounded-lg shadow-2xl">
        <figcaption id="gallery-lightbox-caption" class="mt-4 text-sm text-white/80 tabular-nums"></figcaption>
    </figure>
</div>

<script>
(() => {
    const photos = @json($photos->map(fn ($photo) => $photo->url())->values());
    const lightbox = document.getElementById('gallery-lightbox');
    const image = document.getElementById('gallery-lightbox-image');
    const caption = document.getElementById('gallery-lightbox-caption');
    let current = 0;

    const show = (index) => {
        current = (index + photos.length) % photos.length;
        image.src = photos[current];
        image.alt = `Foto ${current + 1}`;
        caption.textContent = `${current + 1} / ${photos.length}`;
    };
    const open = (index) => {
        show(index);
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        document.body.style.overflow = 'hidden';
    };
    const close = () => {
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
        document.body.style.overflow = '';
    };

    document.querySelectorAll('[data-gallery-index]').forEach((tile) => {
        tile.addEventListener('click', () => open(Number(tile.dataset.galleryIndex)));
    });
    lightbox.querySelector('[data-gallery-close]').addEventListener('click', close);
    lightbox.querySelector('[data-gallery-prev]').addEventListener('click', () => show(current - 1));
    lightbox.querySelector('[data-gallery-next]').addEventListener('click', () => show(current + 1));
    lightbox.addEventListener('click', (e) => { if (e.target === lightbox) close(); });

    document.addEventListener('keydown', (e) => {
        if (lightbox.classList.contains('hidden')) return;
        if (e.key === 'Escape') close();
        if (e.key === 'ArrowLeft') show(current - 1);
        if (e.key === 'ArrowRight') show(current + 1);
    });

    // Geser kiri/kanan di HP
    let startX = null;
    lightbox.addEventListener('touchstart', (e) => { startX = e.touches[0].clientX; }, { passive: true });
    lightbox.addEventListener('touchend', (e) => {
        if (startX === null) return;
        const dx = e.changedTouches[0].clientX - startX;
        if (Math.abs(dx) > 50) show(current + (dx < 0 ? 1 : -1));
        startX = null;
    });
})();
</script>
@endif
