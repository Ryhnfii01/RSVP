<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('templates.partials.meta')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600&family=Italianno&family=Cormorant+Garamond:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Work Sans', sans-serif;
        }

        .font-signature {
            font-family: 'Italianno', cursive;
        }

        .font-serif {
            font-family: 'Cormorant Garamond', serif;
        }

        /* Bugis Emerald Color Scheme */
        .bg-emerald-dark {
            background-color: #003f30;
        }

        .bg-emerald {
            background-color: #059669;
        }

        .bg-cream {
            background-color: #f9e7bc;
        }

        .text-emerald-dark {
            color: #003f30;
        }

        .text-emerald {
            color: #059669;
        }

        .text-cream {
            color: #f9e7bc;
        }

        .border-emerald {
            border-color: #059669;
        }

        .border-cream {
            border-color: #f9e7bc;
        }

        /* Bugis Ornament Pattern */
        .bugis-ornament {
            background-image:
                repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(249, 231, 188, 0.1) 10px, rgba(249, 231, 188, 0.1) 20px),
                repeating-linear-gradient(-45deg, transparent, transparent 10px, rgba(249, 231, 188, 0.1) 10px, rgba(249, 231, 188, 0.1) 20px);
        }

        /* Decorative Frame */
        .decorative-frame {
            position: relative;
            padding: 2rem;
        }

        .decorative-frame::before,
        .decorative-frame::after {
            content: '✤';
            position: absolute;
            color: #f9e7bc;
            font-size: 2rem;
            opacity: 0.6;
        }

        .decorative-frame::before {
            top: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .decorative-frame::after {
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        /* Corner Ornaments */
        .corner-ornaments {
            position: relative;
        }

        .corner-ornaments::before,
        .corner-ornaments::after {
            content: '';
            position: absolute;
            width: 60px;
            height: 60px;
            border: 2px solid #f9e7bc;
            opacity: 0.5;
        }

        .corner-ornaments::before {
            top: 0;
            left: 0;
            border-right: none;
            border-bottom: none;
        }

        .corner-ornaments::after {
            bottom: 0;
            right: 0;
            border-left: none;
            border-top: none;
        }

        /* Section Frame Ornaments */
        .section-frame {
            position: relative;
            padding: 3rem 1rem;
        }

        .section-frame::before,
        .section-frame::after {
            content: '✤';
            position: absolute;
            color: #f9e7bc;
            font-size: 3rem;
            opacity: 0.4;
            z-index: 1;
        }

        .section-frame::before {
            top: 1rem;
            left: 1rem;
        }

        .section-frame::after {
            bottom: 1rem;
            right: 1rem;
        }

        /* Four Corner Frame */
        .four-corner-frame {
            position: relative;
        }

        .four-corner-frame::before,
        .four-corner-frame::after {
            content: '';
            position: absolute;
            width: 80px;
            height: 80px;
            border: 3px solid #f9e7bc;
            opacity: 0.3;
            z-index: 1;
        }

        .four-corner-frame::before {
            top: 0;
            left: 0;
            border-right: none;
            border-bottom: none;
        }

        .four-corner-frame::after {
            bottom: 0;
            right: 0;
            border-left: none;
            border-top: none;
        }

        /* Additional corners using pseudo elements on child */
        .four-corner-frame > .container::before,
        .four-corner-frame > .container::after {
            content: '';
            position: absolute;
            width: 80px;
            height: 80px;
            border: 3px solid #f9e7bc;
            opacity: 0.3;
            z-index: 1;
        }

        .four-corner-frame > .container::before {
            top: 0;
            right: 0;
            border-left: none;
            border-bottom: none;
        }

        .four-corner-frame > .container::after {
            bottom: 0;
            left: 0;
            border-right: none;
            border-top: none;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-fade-in-down {
            animation: fadeInDown 0.8s ease-out;
        }

        .animate-slide-up {
            animation: slideUp 0.8s ease-out;
        }

        .animate-fade-in {
            animation: fadeInUp 0.8s ease-out;
        }

        .animate-zoom-in {
            animation: zoomIn 0.8s ease-out;
        }

        /* Scroll Animations */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .animate-on-scroll.animated {
            opacity: 1;
            transform: translateY(0);
        }

        .fade-in-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .fade-in-left.animated {
            opacity: 1;
            transform: translateX(0);
        }

        .fade-in-right {
            opacity: 0;
            transform: translateX(50px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .fade-in-right.animated {
            opacity: 1;
            transform: translateX(0);
        }

        .scale-in {
            opacity: 0;
            transform: scale(0.8);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .scale-in.animated {
            opacity: 1;
            transform: scale(1);
        }

        /* Floral Divider */
        .floral-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 2rem 0;
        }

        .floral-divider::before,
        .floral-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, #f9e7bc, transparent);
        }

        .floral-divider span {
            padding: 0 1rem;
            color: #f9e7bc;
            font-size: 1.5rem;
        }

        /* Scrollbar Hide */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Bottom Nav Active State */
        #bottom-nav a.active {
            position: relative;
        }
    </style>
</head>
<body class="bg-emerald-dark text-cream overflow-x-hidden">

<!-- Opening Cover -->
<div id="opening-cover" class="fixed inset-0 z-50 flex items-center justify-center bg-gradient-to-br from-emerald-900 via-emerald-800 to-emerald-700 transition-opacity duration-1000 overflow-hidden bugis-ornament">
    <!-- Decorative Background -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-32 h-32 border-4 border-cream rounded-full"></div>
        <div class="absolute bottom-10 right-10 w-48 h-48 border-4 border-cream rounded-full"></div>
        <div class="absolute top-1/2 left-1/4 w-24 h-24 border-2 border-cream transform rotate-45"></div>
    </div>

    <div class="relative z-10 text-center px-4">
        <!-- Bismillah -->
        <div class="mb-6 animate-fade-in-down">
            <p class="font-serif text-xl sm:text-2xl mb-2">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
        </div>

        <div class="animate-slide-up">
            <p class="text-sm tracking-[0.3em] uppercase mb-4 font-medium">The Wedding of</p>

            <h2 class="font-signature text-6xl sm:text-7xl md:text-8xl text-cream mb-2 leading-tight">
                {{ $event->brideNickname() }} <span class="text-cream/70">&</span> {{ $event->groomNickname() }}
            </h2>
        </div>

        <p class="text-lg mb-2 mt-8 animate-fade-in">{{ $event->dateLong() }}</p>
        <p class="text-cream/80 mb-8 animate-fade-in">Kepada Yth.</p>
        <p class="text-xl font-medium mb-8 animate-zoom-in">{{ $guestName }}</p>

        <button id="open-invitation" class="group relative inline-flex items-center justify-center px-10 py-4 text-lg font-medium text-emerald-dark bg-gradient-to-r from-cream to-yellow-100 rounded-full overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 animate-fade-in">
            <span class="relative z-10 flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"></path>
                </svg>
                OPEN INVITATION
            </span>
        </button>
    </div>
</div>

<!-- Main Content -->
<div id="main-content" class="opacity-0 pointer-events-none transition-opacity duration-1000">
    <!-- Hero Section -->
    <section id="opening" class="min-h-screen flex items-center justify-center relative overflow-hidden bugis-ornament">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-32 h-32 border-4 border-cream rounded-full"></div>
            <div class="absolute bottom-10 right-10 w-48 h-48 border-4 border-cream rounded-full"></div>
            <div class="absolute top-1/2 left-1/4 w-24 h-24 border-2 border-cream transform rotate-45"></div>
        </div>

        <div class="container mx-auto px-4 text-center relative z-10 corner-ornaments">
            <div class="max-w-2xl mx-auto py-16">
                <!-- Bismillah -->
                <div class="mb-8">
                    <p class="font-serif text-2xl mb-2">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
                    <p class="text-sm opacity-90">Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang</p>
                </div>

                <div class="floral-divider">
                    <span>✤</span>
                </div>

                <!-- Title -->
                <h1 class="font-serif text-xl tracking-widest mb-4">THE WEDDING OF</h1>

                <!-- Couple Names -->
                <div class="my-12">
                    <h2 class="font-signature text-7xl md:text-8xl text-cream mb-2">{{ $event->brideNickname() }}</h2>
                    <div class="flex items-center justify-center my-6">
                        <div class="h-px w-24 bg-cream/50"></div>
                        <span class="mx-4 text-3xl font-serif">&</span>
                        <div class="h-px w-24 bg-cream/50"></div>
                    </div>
                    <h2 class="font-signature text-7xl md:text-8xl text-cream">{{ $event->groomNickname() }}</h2>
                </div>

                <div class="floral-divider">
                    <span>✤</span>
                </div>

                <!-- Date -->
                <div class="mt-8 space-y-2">
                    <p class="text-lg font-serif">{{ $event->datePart('l') }}</p>
                    <p class="text-5xl font-serif font-bold">{{ $event->datePart('j') }}</p>
                    <p class="text-xl font-serif">{{ $event->datePart('F Y') }}</p>
                </div>

                <!-- Scroll Down Indicator -->
                <div class="mt-16 animate-bounce">
                    <svg class="w-6 h-6 mx-auto text-cream" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Divider with Ornament -->
    <div class="relative h-16 bg-gradient-to-r from-emerald via-emerald-600 to-emerald">
        <div class="absolute inset-0 flex items-center justify-center">
            <span class="text-3xl text-cream">✤</span>
        </div>
    </div>

    <!-- Ayat Al-Quran Section -->
    <section id="ayat" class="py-20 bg-gradient-to-b from-emerald-dark to-black section-frame four-corner-frame">
        <div class="container mx-auto px-4 relative">
            <div class="max-w-3xl mx-auto text-center decorative-frame animate-on-scroll" data-delay="100">
                <div class="bg-emerald/20 backdrop-blur-sm rounded-2xl p-8 md:p-12 border border-cream/20">
                    <p class="font-serif text-2xl sm:text-3xl mb-6 leading-relaxed" dir="rtl">
                        وَمِنْ آيَاتِهِ أَنْ خَلَقَ لَكُم مِّنْ أَنفُسِكُمْ أَزْوَاجًا لِّتَسْكُنُوا إِلَيْهَا وَجَعَلَ بَيْنَكُم مَّوَدَّةً وَرَحْمَةً
                    </p>
                    <p class="text-xs sm:text-sm opacity-90 leading-relaxed">
                        "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang."
                    </p>
                    <p class="mt-4 font-serif text-lg">— QS. Ar-Rum: 21 —</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Bride & Groom Section -->
    <section id="mempelai" class="py-20 bg-black section-frame four-corner-frame">
        <div class="container mx-auto px-4 relative">
            <div class="text-center mb-16 animate-on-scroll" data-delay="100">
                <h2 class="font-serif text-4xl md:text-5xl mb-4">Mempelai</h2>
                <div class="floral-divider">
                    <span>✤</span>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-12 max-w-5xl mx-auto">
                <!-- Bride -->
                <div class="text-center fade-in-left animate-on-scroll" data-delay="200">
                    <div class="bg-gradient-to-b from-emerald to-emerald-dark rounded-3xl p-8 corner-ornaments">
                        <!-- Photo Placeholder -->
                        <div class="w-48 h-48 mx-auto mb-6 rounded-full border-4 border-cream/50 overflow-hidden bg-emerald-dark flex items-center justify-center">
                            <svg class="w-24 h-24 text-cream/30" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>

                        <h3 class="font-signature text-5xl mb-4">{{ $event->bride_name }}</h3>
                        <p class="text-sm mb-2">Putri dari</p>
                        <p class="font-serif">{{ $event->bride_father }}</p>
                        <p class="font-serif mb-4">{{ $event->bride_mother }}</p>

                        <a href="{{ $event->instagramUrl('bride') ?? '#' }}" target="_blank" class="inline-flex items-center text-cream hover:text-cream/80 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                            {{ $event->instagramHandle('bride') }}
                        </a>
                    </div>
                </div>

                <!-- Groom -->
                <div class="text-center fade-in-right animate-on-scroll" data-delay="300">
                    <div class="bg-gradient-to-b from-emerald to-emerald-dark rounded-3xl p-8 corner-ornaments">
                        <!-- Photo Placeholder -->
                        <div class="w-48 h-48 mx-auto mb-6 rounded-full border-4 border-cream/50 overflow-hidden bg-emerald-dark flex items-center justify-center">
                            <svg class="w-24 h-24 text-cream/30" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>

                        <h3 class="font-signature text-5xl mb-4">{{ $event->groom_name }}</h3>
                        <p class="text-sm mb-2">Putra dari</p>
                        <p class="font-serif">{{ $event->groom_father }}</p>
                        <p class="font-serif mb-4">{{ $event->groom_mother }}</p>

                        <a href="{{ $event->instagramUrl('groom') ?? '#' }}" target="_blank" class="inline-flex items-center text-cream hover:text-cream/80 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                            {{ $event->instagramHandle('groom') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Event Details Section -->
    <section id="acara" class="py-20 bg-emerald-dark bugis-ornament section-frame four-corner-frame">
        <div class="container mx-auto px-4 relative">
            <div class="text-center mb-16 animate-on-scroll" data-delay="100">
                <h2 class="font-serif text-4xl md:text-5xl mb-4">Detail Acara</h2>
                <div class="floral-divider">
                    <span>✤</span>
                </div>
            </div>

            <!-- Countdown -->
            <div id="countdown" class="grid grid-cols-4 gap-3 max-w-md mx-auto mb-14 text-center animate-on-scroll" data-delay="150">
                <div class="rounded-xl border border-cream/30 bg-black/30 py-4">
                    <p id="cd-days" class="font-serif text-3xl tabular-nums">00</p>
                    <p class="text-xs uppercase tracking-wider text-cream/70 mt-1">Hari</p>
                </div>
                <div class="rounded-xl border border-cream/30 bg-black/30 py-4">
                    <p id="cd-hours" class="font-serif text-3xl tabular-nums">00</p>
                    <p class="text-xs uppercase tracking-wider text-cream/70 mt-1">Jam</p>
                </div>
                <div class="rounded-xl border border-cream/30 bg-black/30 py-4">
                    <p id="cd-minutes" class="font-serif text-3xl tabular-nums">00</p>
                    <p class="text-xs uppercase tracking-wider text-cream/70 mt-1">Menit</p>
                </div>
                <div class="rounded-xl border border-cream/30 bg-black/30 py-4">
                    <p id="cd-seconds" class="font-serif text-3xl tabular-nums">00</p>
                    <p class="text-xs uppercase tracking-wider text-cream/70 mt-1">Detik</p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <!-- Akad Nikah -->
                <div class="bg-black/30 backdrop-blur-sm rounded-2xl p-8 border border-cream/20 text-center scale-in animate-on-scroll" data-delay="200">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-emerald flex items-center justify-center">
                        <svg class="w-10 h-10 text-cream" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>

                    <h3 class="font-serif text-2xl mb-6">Akad Nikah</h3>

                    <div class="space-y-3 mb-6">
                        <div class="flex items-center justify-center text-sm">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ $event->dateLong() }}</span>
                        </div>
                        <div class="flex items-center justify-center text-sm">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ $event->akadTime() }}</span>
                        </div>
                        <div class="flex items-start justify-center text-sm">
                            <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ $event->akadVenueName() }}<br/>{{ $event->akadVenueAddress() }}</span>
                        </div>
                    </div>

                    <a href="{{ $event->akadMapsUrl() }}" target="_blank" class="inline-block px-6 py-3 bg-emerald hover:bg-emerald/80 text-cream rounded-full transition-colors">
                        <svg class="w-5 h-5 inline-block mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                        Lihat Lokasi
                    </a>
                </div>

                <!-- Resepsi -->
                <div class="bg-black/30 backdrop-blur-sm rounded-2xl p-8 border border-cream/20 text-center scale-in animate-on-scroll" data-delay="300">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-emerald flex items-center justify-center">
                        <svg class="w-10 h-10 text-cream" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                        </svg>
                    </div>

                    <h3 class="font-serif text-2xl mb-6">Resepsi Pernikahan</h3>

                    <div class="space-y-3 mb-6">
                        <div class="flex items-center justify-center text-sm">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ $event->dateLong() }}</span>
                        </div>
                        <div class="flex items-center justify-center text-sm">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ $event->receptionTime() }}</span>
                        </div>
                        <div class="flex items-start justify-center text-sm">
                            <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ $event->venue_name }}<br/>{{ $event->venue_address }}</span>
                        </div>
                    </div>

                    <a href="{{ $event->mapsUrl() }}" target="_blank" class="inline-block px-6 py-3 bg-emerald hover:bg-emerald/80 text-cream rounded-full transition-colors">
                        <svg class="w-5 h-5 inline-block mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                        Lihat Lokasi
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Mappatabe' (Traditional Bugis Blessing) -->
    <section id="mappatabe" class="py-20 bg-black section-frame four-corner-frame">
        <div class="container mx-auto px-4 relative">
            <div class="max-w-3xl mx-auto text-center decorative-frame animate-on-scroll" data-delay="100">
                <div class="bg-emerald/10 backdrop-blur-sm rounded-2xl p-8 md:p-12 border border-cream/20">
                    <h2 class="font-serif text-3xl mb-8">Mappatabe'</h2>
                    <p class="font-serif text-base sm:text-lg leading-relaxed italic mb-6">
                        "Rebba sipatokkong, mali siparappe, sipakalebbi,<br>
                        Sitongeng natongengngi, tenri siri' narekko tannia siri'nu<br>
                        Siri' emmi ri onroang ri lino, siri' naewai pammase dewata"
                    </p>
                    <p class="text-xs sm:text-sm opacity-90 leading-relaxed">
                        (Saling menguatkan dalam kebaikan, saling mengingatkan dalam kebenaran, saling memuliakan,<br>
                        Saling menopang dan melengkapi, tiada sirih bila tiada harga diri,<br>
                        Harga dirilah yang membawa kehormatan di dunia, dan harga diri pulalah yang mendatangkan ampunan dari Tuhan)
                    </p>
                </div>
            </div>
        </div>
    </section>

    @include('templates.partials.gallery', ['theme' => [
            'section' => 'bg-black section-frame four-corner-frame',
            'title' => 'font-serif text-cream',
            'divider' => 'bg-cream/40',
            'tile' => 'border border-cream/20 ring-cream/40',
        ]])

    @php($giftAccounts = $event->bankAccounts()->concat($event->ewallets()))
    @if ($giftAccounts->isNotEmpty() || $event->gift_address)
    <!-- Amplop Digital -->
    <section id="hadiah" class="py-20 bg-emerald-dark section-frame four-corner-frame">
        <div class="container mx-auto px-4 relative">
            <div class="text-center mb-12 animate-on-scroll" data-delay="100">
                <h2 class="font-serif text-4xl md:text-5xl mb-4">Amplop Digital</h2>
                <div class="floral-divider">
                    <span>✤</span>
                </div>
                <p class="max-w-xl mx-auto text-cream/80">Doa restu Anda adalah karunia terindah. Bagi yang ingin memberi tanda kasih, dapat melalui:</p>
            </div>

            <div class="grid sm:grid-cols-2 gap-6 max-w-3xl mx-auto">
                @foreach ($giftAccounts as $i => $account)
                <div class="rounded-2xl border border-cream/20 bg-black/30 p-6 text-center">
                    <p class="text-xs uppercase tracking-wider text-cream/60 mb-1">{{ $account['type'] === 'bank' ? 'Transfer Bank' : 'E-Wallet' }}</p>
                    <p class="font-serif text-2xl mb-3">{{ $account['provider'] ?? '' }}</p>
                    <p id="gift-number-{{ $i }}" class="font-mono text-xl tracking-wider mb-1">{{ $account['number'] }}</p>
                    <p class="text-sm text-cream/70 mb-5">a.n. {{ $account['holder'] ?? '' }}</p>
                    <button type="button" data-copy-target="gift-number-{{ $i }}" class="px-5 py-2 rounded-full bg-emerald hover:bg-emerald/80 text-cream text-sm transition-colors">Salin nomor</button>
                </div>
                @endforeach
            </div>

            @if ($event->gift_address)
            <div class="max-w-3xl mx-auto mt-6 rounded-2xl border border-cream/20 bg-black/30 p-6 text-center">
                <p class="text-xs uppercase tracking-wider text-cream/60 mb-2">Kirim Hadiah</p>
                <p class="leading-relaxed">{!! nl2br(e($event->gift_address)) !!}</p>
                @if ($event->gift_recipient)
                <p class="text-sm text-cream/70 mt-2">a.n. {{ $event->gift_recipient }}</p>
                @endif
            </div>
            @endif
        </div>
    </section>
    @endif

    <!-- RSVP Section -->
    <section class="py-20 bg-emerald-dark section-frame four-corner-frame" id="rsvp">
        <div class="container mx-auto px-4 relative">
            <div class="max-w-2xl mx-auto">
                <div class="text-center mb-12 animate-on-scroll" data-delay="100">
                    <h2 class="font-serif text-4xl md:text-5xl mb-4">Konfirmasi Kehadiran</h2>
                    <div class="floral-divider">
                        <span>✤</span>
                    </div>
                    <p class="mt-6 opacity-90">Merupakan suatu kehormatan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir untuk memberikan doa restu</p>
                </div>

                <form action="{{ $rsvpUrl }}" method="POST" class="bg-black/30 backdrop-blur-sm rounded-2xl p-8 border border-cream/20 animate-on-scroll" data-delay="200">
                    @csrf
                    @include('templates.partials.invitation-code')

                    @if (session('rsvp_success'))
                        <div class="mb-6 rounded-lg bg-emerald/60 border border-cream/40 px-4 py-3 text-cream">
                            {{ session('rsvp_success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 rounded-lg bg-red-900/60 border border-red-300/40 px-4 py-3 text-cream text-sm">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $invitation?->name) }}" required
                                   class="w-full px-4 py-3 bg-emerald-dark/50 border border-cream/30 rounded-lg text-cream placeholder-cream/50 focus:outline-none focus:ring-2 focus:ring-emerald focus:border-transparent"
                                   placeholder="Masukkan nama Anda">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Email (Opsional)</label>
                            <input type="email" name="email"
                                   class="w-full px-4 py-3 bg-emerald-dark/50 border border-cream/30 rounded-lg text-cream placeholder-cream/50 focus:outline-none focus:ring-2 focus:ring-emerald focus:border-transparent"
                                   placeholder="email@example.com">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Konfirmasi Kehadiran</label>
                            <select name="attendance" required
                                    class="w-full px-4 py-3 bg-emerald-dark/50 border border-cream/30 rounded-lg text-cream focus:outline-none focus:ring-2 focus:ring-emerald focus:border-transparent">
                                <option value="">Pilih Konfirmasi</option>
                                <option value="hadir">Hadir</option>
                                <option value="tidak_hadir">Tidak Hadir</option>
                                <option value="masih_ragu">Masih Ragu</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Jumlah Tamu</label>
                            <input type="number" name="number_of_guests" min="1" max="5"
                                   class="w-full px-4 py-3 bg-emerald-dark/50 border border-cream/30 rounded-lg text-cream placeholder-cream/50 focus:outline-none focus:ring-2 focus:ring-emerald focus:border-transparent"
                                   placeholder="1">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Ucapan & Doa</label>
                            <textarea name="message" rows="4"
                                      class="w-full px-4 py-3 bg-emerald-dark/50 border border-cream/30 rounded-lg text-cream placeholder-cream/50 focus:outline-none focus:ring-2 focus:ring-emerald focus:border-transparent resize-none"
                                      placeholder="Berikan ucapan dan doa untuk mempelai..."></textarea>
                        </div>

                        <button type="submit"
                                class="w-full bg-emerald hover:bg-emerald/80 text-cream py-4 px-6 rounded-lg font-medium transition-colors flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Kirim Konfirmasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @include('templates.partials.wishes', ['theme' => [
        'section' => 'bg-black section-frame four-corner-frame',
        'title' => 'font-serif text-cream',
        'divider' => 'bg-cream/40',
        'card' => 'bg-emerald-dark/70 border border-cream/20',
        'avatar' => 'bg-emerald text-cream',
        'name' => 'text-cream',
        'meta' => 'text-cream/60',
        'message' => 'text-cream/90',
        'badge' => 'bg-cream/10 text-cream',
        'empty' => 'text-cream/70',
    ]])

    <!-- Footer -->
    <footer class="py-12 bg-black text-center">
        <div class="floral-divider mb-8">
            <span>✤</span>
        </div>

        <p class="font-serif text-xl mb-4">{{ $event->coupleNames() }}</p>
        <p class="text-sm opacity-75">
            Made with
            <svg class="w-4 h-4 inline-block text-emerald mx-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
            </svg>
            by Wedding Invitation Builder
        </p>

        <div class="floral-divider mt-8">
            <span>✤</span>
        </div>
    </footer>
</div>


<!-- Bottom Navigation -->
<nav id="bottom-nav" class="fixed bottom-0 left-0 right-0 bg-emerald-dark/95 backdrop-blur-md shadow-lg z-40 transition-all duration-500 translate-y-full opacity-0 border-t border-cream/20">
    <div id="nav-slider" class="flex overflow-x-auto snap-x snap-mandatory scrollbar-hide scroll-smooth py-3">
        <a href="#opening" class="nav-item flex flex-col items-center text-cream transition-all duration-300 hover:text-cream/80 active flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Home</span>
        </a>
        <a href="#ayat" class="nav-item flex flex-col items-center text-cream/60 transition-all duration-300 hover:text-cream/80 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Ayat</span>
        </a>
        <a href="#mempelai" class="nav-item flex flex-col items-center text-cream/60 transition-all duration-300 hover:text-cream/80 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Mempelai</span>
        </a>
        <a href="#acara" class="nav-item flex flex-col items-center text-cream/60 transition-all duration-300 hover:text-cream/80 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Acara</span>
        </a>
        <a href="#mappatabe" class="nav-item flex flex-col items-center text-cream/60 transition-all duration-300 hover:text-cream/80 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Mappatabe'</span>
        </a>
        <a href="#gallery" class="nav-item flex flex-col items-center text-cream/60 transition-all duration-300 hover:text-cream/80 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Galeri</span>
        </a>
        <a href="#rsvp" class="nav-item flex flex-col items-center text-cream/60 transition-all duration-300 hover:text-cream/80 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">RSVP</span>
        </a>
        <a href="#wishes" class="nav-item flex flex-col items-center text-cream/60 transition-all duration-300 hover:text-cream/80 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Ucapan</span>
        </a>
    </div>

    <!-- Scroll Indicator Dots -->
    <div id="nav-dots" class="flex justify-center items-center gap-1.5 pb-2 pt-1">
        <div class="dot w-1.5 h-1.5 rounded-full bg-cream transition-all duration-300"></div>
        <div class="dot w-1.5 h-1.5 rounded-full bg-cream/30 transition-all duration-300"></div>
        <div class="dot w-1.5 h-1.5 rounded-full bg-cream/30 transition-all duration-300"></div>
        <div class="dot w-1.5 h-1.5 rounded-full bg-cream/30 transition-all duration-300"></div>
        <div class="dot w-1.5 h-1.5 rounded-full bg-cream/30 transition-all duration-300"></div>
        <div class="dot w-1.5 h-1.5 rounded-full bg-cream/30 transition-all duration-300"></div>
        <div class="dot w-1.5 h-1.5 rounded-full bg-cream/30 transition-all duration-300"></div>
        <div class="dot w-1.5 h-1.5 rounded-full bg-cream/30 transition-all duration-300"></div>
    </div>
</nav>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const openButton = document.getElementById('open-invitation');
    const openingCover = document.getElementById('opening-cover');
    const mainContent = document.getElementById('main-content');
    const bottomNav = document.getElementById('bottom-nav');

    // Open invitation
    openButton.addEventListener('click', function() {
        openingCover.style.opacity = '0';
        setTimeout(() => {
            openingCover.style.display = 'none';
            mainContent.classList.remove('opacity-0', 'pointer-events-none');
            bottomNav.classList.remove('translate-y-full', 'opacity-0');
        }, 1000);
    });

    // Bottom Navigation
    const navSlider = document.getElementById('nav-slider');
    const navItems = document.querySelectorAll('.nav-item');
    const navDots = document.querySelectorAll('#nav-dots .dot');
    const sections = document.querySelectorAll('section');

    window.addEventListener('scroll', () => {
        let current = '';
        let currentIndex = 0;

        sections.forEach((section, index) => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (pageYOffset >= (sectionTop - sectionHeight / 3)) {
                current = section.getAttribute('id');
                currentIndex = index;
            }
        });

        navItems.forEach((item, index) => {
            item.classList.remove('active', 'text-cream');
            item.classList.add('text-cream/60');

            if (item.getAttribute('href') === `#${current}`) {
                item.classList.add('active', 'text-cream');
                item.classList.remove('text-cream/60');
                item.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
                updateDots(index);
            }
        });
    });

    function updateDots(activeIndex) {
        navDots.forEach((dot, index) => {
            if (index === activeIndex) {
                dot.classList.remove('bg-cream/30', 'w-1.5');
                dot.classList.add('bg-cream', 'w-4');
            } else {
                dot.classList.remove('bg-cream', 'w-4');
                dot.classList.add('bg-cream/30', 'w-1.5');
            }
        });
    }

    navDots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            const targetItem = navItems[index];
            if (targetItem) {
                targetItem.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
                updateDots(index);
            }
        });
    });


    // Scroll Animations
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const animateOnScroll = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target;
                const delay = element.dataset.delay || 0;

                setTimeout(() => {
                    element.classList.add('animated');
                }, delay);

                animateOnScroll.unobserve(element);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        animateOnScroll.observe(el);
    });

    document.querySelectorAll('.fade-in-left').forEach(el => {
        animateOnScroll.observe(el);
    });

    document.querySelectorAll('.fade-in-right').forEach(el => {
        animateOnScroll.observe(el);
    });

    document.querySelectorAll('.scale-in').forEach(el => {
        animateOnScroll.observe(el);
    });
});
</script>

@include('templates.partials.music', ['buttonClass' => 'bg-emerald text-cream'])
<script>
(() => {
    // Hitung mundur ke hari H
    const target = new Date('{{ $eventDate }}').getTime();
    const pad = (n) => String(Math.max(n, 0)).padStart(2, '0');
    let timer;
    const tick = () => {
        const distance = target - Date.now();
        if (distance <= 0) {
            document.getElementById('countdown').innerHTML = '<p class="col-span-4 font-serif text-2xl">Hari bahagia telah tiba</p>';
            clearInterval(timer);
            return;
        }
        document.getElementById('cd-days').textContent = pad(Math.floor(distance / 864e5));
        document.getElementById('cd-hours').textContent = pad(Math.floor(distance % 864e5 / 36e5));
        document.getElementById('cd-minutes').textContent = pad(Math.floor(distance % 36e5 / 6e4));
        document.getElementById('cd-seconds').textContent = pad(Math.floor(distance % 6e4 / 1e3));
    };
    timer = setInterval(tick, 1000);
    tick();

    // Salin nomor rekening / e-wallet
    document.querySelectorAll('[data-copy-target]').forEach((button) => {
        button.addEventListener('click', () => {
            const text = document.getElementById(button.dataset.copyTarget).textContent.trim();
            const label = button.textContent;
            navigator.clipboard.writeText(text)
                .then(() => { button.textContent = 'Tersalin'; })
                .catch(() => { button.textContent = text; })
                .finally(() => setTimeout(() => { button.textContent = label; }, 2000));
        });
    });
})();
</script>
</body>
</html>
