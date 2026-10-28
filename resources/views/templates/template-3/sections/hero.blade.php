<!-- Hero Section -->
<section id="hero" class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-cream-50 via-brown-50 to-cream-100 overflow-hidden">
    <!-- Parallax Clouds Background -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <svg class="parallax absolute top-20 left-10 w-40 h-40 text-brown-200 opacity-60 animate-float-slow" data-speed="0.3" fill="currentColor" viewBox="0 0 640 512">
            <path d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128H144z"/>
        </svg>
        <svg class="parallax absolute top-40 right-20 w-32 h-32 text-brown-300 opacity-50 animate-float animation-delay-2000" data-speed="0.4" fill="currentColor" viewBox="0 0 640 512">
            <path d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128H144z"/>
        </svg>
        <svg class="parallax absolute bottom-40 left-1/4 w-36 h-36 text-brown-200 opacity-40 animate-float animation-delay-4000" data-speed="0.2" fill="currentColor" viewBox="0 0 640 512">
            <path d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128H144z"/>
        </svg>
    </div>

    <!-- Decorative Birds -->
    <div class="absolute top-32 right-1/4 animate-fly-bird opacity-60">
        <svg class="w-16 h-16 text-brown-700" fill="currentColor" viewBox="0 0 24 24">
            <path d="M23 7.5c0-.34-.27-.61-.61-.61-1.54 0-2.81-1.27-2.81-2.81 0-.34-.27-.61-.61-.61s-.61.27-.61.61c0 1.54-1.27 2.81-2.81 2.81-.34 0-.61.27-.61.61s.27.61.61.61c1.54 0 2.81 1.27 2.81 2.81 0 .34.27.61.61.61s.61-.27.61-.61c0-1.54 1.27-2.81 2.81-2.81.34 0 .61-.27.61-.61zM12 2c-.34 0-.61.27-.61.61 0 2.27-1.85 4.11-4.11 4.11-.34 0-.61.27-.61.61s.27.61.61.61c2.27 0 4.11 1.85 4.11 4.11 0 .34.27.61.61.61s.61-.27.61-.61c0-2.27 1.85-4.11 4.11-4.11.34 0 .61-.27.61-.61s-.27-.61-.61-.61c-2.27 0-4.11-1.85-4.11-4.11C12.61 2.27 12.34 2 12 2z"/>
        </svg>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
        <!-- Decorative Leaf Top -->
        <div class="animate-on-scroll mb-8" data-animation="zoom-in">
            <svg class="w-20 h-20 mx-auto text-brown-600 opacity-80" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17 8C8 10 5.9 16.17 3.82 21.34l-.59 1.66 1.66-.59C10.83 20.1 17 18 19 9l1-4-4 1-2 2 2 2c-1 2.5-3.5 5-6.5 6.5l1.5-4.5L17 8z"/>
            </svg>
        </div>

        <!-- Couple Names -->
        <div class="animate-on-scroll" data-animation="fade-in-up">
            <h1 class="font-script text-7xl md:text-8xl text-brown-800 mb-6 leading-tight">
                {{ $event->brideNickname() }} & {{ $event->groomNickname() }}
            </h1>
        </div>

        <!-- Divider -->
        <div class="animate-on-scroll my-8" data-animation="fade-in" data-delay="200">
            <div class="flex items-center justify-center gap-4">
                <div class="w-16 h-0.5 bg-gradient-to-r from-transparent to-brown-400"></div>
                <svg class="w-8 h-8 text-brown-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
                <div class="w-16 h-0.5 bg-gradient-to-l from-transparent to-brown-400"></div>
            </div>
        </div>

        <!-- Quote -->
        <div class="animate-on-scroll" data-animation="fade-in-up" data-delay="300">
            <p class="text-brown-700 text-lg md:text-xl font-serif italic max-w-2xl mx-auto leading-relaxed">
                "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya"
            </p>
            <p class="text-brown-600 font-medium mt-4">
                - QS. Ar-Rum: 21
            </p>
        </div>

        <!-- Date -->
        <div class="animate-on-scroll mt-12" data-animation="fade-in-up" data-delay="400">
            <div class="inline-block bg-white/90 backdrop-blur-sm border-2 border-brown-300 rounded-2xl px-8 py-6 shadow-xl">
                <p class="text-brown-600 text-sm uppercase tracking-wider mb-2">Save The Date</p>
                <p class="text-brown-800 text-3xl md:text-4xl font-serif font-bold">
                    {{ $event->dateMedium() }}
                </p>
            </div>
        </div>

        <!-- Decorative Leaf Bottom -->
        <div class="animate-on-scroll mt-12" data-animation="zoom-in" data-delay="500">
            <svg class="w-16 h-16 mx-auto text-brown-600 opacity-60 transform rotate-180" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17 8C8 10 5.9 16.17 3.82 21.34l-.59 1.66 1.66-.59C10.83 20.1 17 18 19 9l1-4-4 1-2 2 2 2c-1 2.5-3.5 5-6.5 6.5l1.5-4.5L17 8z"/>
            </svg>
        </div>

        <!-- Scroll Indicator -->
        <div class="animate-on-scroll mt-16" data-animation="fade-in" data-delay="600">
            <div class="animate-bounce">
                <svg class="w-8 h-8 mx-auto text-brown-700 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Bottom Grass Wave -->
    <div class="absolute bottom-0 left-0 right-0 pointer-events-none">
        <svg class="w-full h-32 text-brown-700 opacity-20" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0 Q100,40 200,20 T400,0 Q500,40 600,20 T800,0 Q900,40 1000,20 T1200,0 L1200,120 L0,120 Z" fill="currentColor"/>
        </svg>
    </div>
</section>

<style>
@keyframes fly-bird {
    0% {
        transform: translateX(0) translateY(0) scale(1);
    }
    25% {
        transform: translateX(100px) translateY(-20px) scale(1.1);
    }
    50% {
        transform: translateX(200px) translateY(10px) scale(0.9);
    }
    75% {
        transform: translateX(300px) translateY(-10px) scale(1);
    }
    100% {
        transform: translateX(400px) translateY(0) scale(1.1);
    }
}

.animate-fly-bird {
    animation: fly-bird 15s ease-in-out infinite;
}
</style>
