<!-- Gallery Section -->
<section id="gallery" class="relative py-16 sm:py-20 lg:py-24 bg-gradient-to-br from-gray-50 to-white overflow-hidden">
    <!-- Wave Divider Top -->
    <x-wave-divider position="top" color="white" />

    <!-- Decorative Ornaments -->
    <x-decorative-ornament position="top-right" type="geometric" color="primary" />
    <x-decorative-ornament position="bottom-left" type="floral" color="gold" />

    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-serif text-gray-800 mb-4">
                Our Moments
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-transparent via-gold-500 to-transparent mx-auto mb-6"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Beberapa momen indah yang telah kami lalui bersama
            </p>
        </div>

        <!-- Photo Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
            @for($i = 1; $i <= 9; $i++)
            <div class="group relative overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 cursor-pointer aspect-square border-4 border-white/50 hover:border-white hover:-translate-y-1"
                 onclick="openLightbox({{ $i - 1 }})">
                <!-- Gradient overlay on hover -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10"></div>

                <!-- Placeholder Image - Replace with actual images -->
                <div class="w-full h-full bg-gradient-to-br from-primary-200 via-purple-200 to-gold-200 flex items-center justify-center animate-gradient">
                    <div class="text-center text-gray-600 group-hover:scale-95 transition-transform duration-300">
                        <svg class="w-20 h-20 mx-auto mb-3 opacity-40 group-hover:opacity-60 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-sm font-semibold">Photo {{ $i }}</p>
                    </div>
                </div>

                <!-- Uncomment when you have real images -->
                {{-- <img src="{{ asset('images/gallery/photo-' . $i . '.jpg') }}"
                     alt="Gallery Photo {{ $i }}"
                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700"
                     loading="lazy"> --}}

                <!-- Zoom Icon & Label -->
                <div class="absolute inset-0 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 z-20">
                    <div class="w-14 h-14 bg-white/95 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg mb-2 transform group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                        </svg>
                    </div>
                    <p class="text-white text-sm font-semibold tracking-wide drop-shadow-lg">Lihat Foto</p>
                </div>

                <!-- Corner accent -->
                <div class="absolute top-2 right-2 w-8 h-8 border-t-2 border-r-2 border-white/50 rounded-tr-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20"></div>
                <div class="absolute bottom-2 left-2 w-8 h-8 border-b-2 border-l-2 border-white/50 rounded-bl-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20"></div>
            </div>
            @endfor
        </div>
    </div>

    <!-- Wave Divider Bottom -->
    <x-wave-divider position="bottom" color="white" />
</section>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-black/95 z-50 hidden items-center justify-center">
    <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white hover:text-gold-400 transition-colors z-50">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    <button onclick="previousImage()" class="absolute left-4 text-white hover:text-gold-400 transition-colors z-50">
        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </button>

    <button onclick="nextImage()" class="absolute right-4 text-white hover:text-gold-400 transition-colors z-50">
        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>

    <div class="max-w-6xl max-h-screen p-4">
        <div id="lightbox-content" class="relative">
            <!-- Placeholder -->
            <div class="w-full h-96 bg-gradient-to-br from-primary-200 to-gold-200 rounded-lg flex items-center justify-center">
                <p class="text-gray-600">Loading...</p>
            </div>

            <!-- Uncomment when you have real images -->
            {{-- <img id="lightbox-image" src="" alt="Gallery" class="max-w-full max-h-[90vh] rounded-lg shadow-2xl"> --}}
        </div>
        <p id="lightbox-caption" class="text-white text-center mt-4 text-sm"></p>
    </div>
</div>

@push('scripts')
<script>
let currentImageIndex = 0;
const totalImages = 9;

function openLightbox(index) {
    currentImageIndex = index;
    document.getElementById('lightbox').classList.remove('hidden');
    document.getElementById('lightbox').classList.add('flex');
    updateLightboxImage();
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightbox').classList.add('hidden');
    document.getElementById('lightbox').classList.remove('flex');
    document.body.style.overflow = 'auto';
}

function previousImage() {
    currentImageIndex = (currentImageIndex - 1 + totalImages) % totalImages;
    updateLightboxImage();
}

function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % totalImages;
    updateLightboxImage();
}

function updateLightboxImage() {
    const caption = document.getElementById('lightbox-caption');
    caption.textContent = `Photo ${currentImageIndex + 1} of ${totalImages}`;

    // Uncomment when you have real images
    // const img = document.getElementById('lightbox-image');
    // img.src = `/images/gallery/photo-${currentImageIndex + 1}.jpg`;
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const lightbox = document.getElementById('lightbox');
    if (!lightbox.classList.contains('hidden')) {
        if (e.key === 'ArrowLeft') previousImage();
        if (e.key === 'ArrowRight') nextImage();
        if (e.key === 'Escape') closeLightbox();
    }
});

// Close on background click
document.getElementById('lightbox').addEventListener('click', function(e) {
    if (e.target === this) {
        closeLightbox();
    }
});
</script>
@endpush
