<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('templates.partials.meta')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white">

<!-- Opening Cover -->
<div id="opening-cover" class="fixed inset-0 z-50 flex items-center justify-center bg-gradient-to-br from-rose-100 via-pink-50 to-white transition-opacity duration-1000">
    <div class="text-center px-4">
        <!-- Floral Top Ornament -->
        <div class="mb-8 animate-fade-in-down">
            <svg class="w-32 h-32 mx-auto text-rose-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
        </div>

        <div class="animate-slide-up">
            <p class="text-rose-600 text-sm tracking-[0.3em] uppercase mb-4">The Wedding of</p>

            <h2 class="font-script text-6xl sm:text-7xl md:text-8xl text-rose-700 mb-2 leading-tight">
                {{ $event->brideNickname() }}<span class="text-rose-400"> & </span>{{ $event->groomNickname() }}
            </h2>
        </div>

        <p class="text-gray-600 text-lg mb-2 mt-8 animate-fade-in">{{ $event->dateLong() }}</p>
        <p class="text-gray-500 mb-8 animate-fade-in">Kepada Yth.</p>
        <p class="text-gray-700 text-xl font-medium mb-8 animate-zoom-in">{{ $guestName }}</p>

        <button id="open-invitation" class="group relative inline-flex items-center justify-center px-10 py-4 text-lg font-medium text-white bg-gradient-to-r from-rose-500 to-pink-500 rounded-full overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 animate-fade-in">
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
    <section id="opening" class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background with soft floral pattern -->
        <div class="absolute inset-0 bg-gradient-to-br from-rose-50 via-pink-50 to-rose-100"></div>

        <!-- Decorative Flowers -->
        <div class="absolute inset-0 opacity-10">
            <svg class="absolute top-10 left-10 w-32 h-32 text-rose-300 animate-float" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
            <svg class="absolute top-1/4 right-20 w-24 h-24 text-pink-300 animate-float animation-delay-2000" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
            <svg class="absolute bottom-1/4 left-1/4 w-28 h-28 text-rose-200 animate-float animation-delay-4000" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
        </div>

        <div class="relative z-10 container mx-auto px-4 text-center">
            <div class="animate-fade-in-down">
                <p class="text-rose-600 text-sm sm:text-base tracking-[0.3em] uppercase mb-4">
                    The Wedding of
                </p>
            </div>

            <div class="animate-fade-in-up my-12">
                <h1 class="font-script text-6xl sm:text-7xl md:text-8xl lg:text-9xl text-rose-700 mb-4 leading-tight">
                    {{ $event->groomNickname() }}
                </h1>
                <div class="flex items-center justify-center my-6">
                    <svg class="w-8 h-8 text-rose-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                </div>
                <h1 class="font-script text-6xl sm:text-7xl md:text-8xl lg:text-9xl text-pink-700 mb-8 leading-tight">
                    {{ $event->brideNickname() }}
                </h1>
            </div>

            <div class="animate-zoom-in bg-white/80 backdrop-blur-sm inline-block px-8 py-4 rounded-full shadow-lg">
                <p class="text-base sm:text-lg text-gray-700 font-medium mb-1">
                    {{ $event->dateLong() }}
                </p>
                <p class="text-sm text-gray-600">
                    #SaveTheDate
                </p>
            </div>
        </div>
    </section>

    <!-- Divider with Floral Pattern -->
    <div class="relative h-16 bg-gradient-to-r from-rose-200 via-pink-200 to-rose-200">
        <div class="absolute inset-0 flex items-center justify-center">
            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
        </div>
    </div>

    <!-- Include Sections -->
    @include('templates.template-2.sections.couple')
    @include('templates.template-2.sections.story')
    @include('templates.template-2.sections.event')
    @include('templates.partials.gallery', ['theme' => [
            'section' => 'bg-gradient-to-b from-rose-50 to-white',
            'title' => 'font-serif text-gray-800',
            'divider' => 'bg-rose-300',
            'tile' => 'shadow-lg border-4 border-white ring-rose-300',
        ]])
    @include('templates.template-2.sections.gift')
    @include('templates.template-2.sections.rsvp')
    @include('templates.partials.wishes', ['theme' => [
        'section' => 'bg-gradient-to-b from-white to-rose-50',
        'title' => 'font-serif text-gray-800',
        'divider' => 'bg-rose-300',
        'card' => 'bg-white shadow-md border border-rose-100',
        'avatar' => 'bg-rose-500 text-white',
        'name' => 'text-gray-800',
        'meta' => 'text-gray-500',
        'message' => 'text-gray-700',
        'badge' => 'bg-rose-50 text-rose-700',
        'empty' => 'text-gray-500',
    ]])

    <!-- Footer with Ornament -->
    <footer class="relative py-12 bg-gradient-to-br from-rose-50 to-pink-50 text-center">
        <div class="container mx-auto px-4">
            <svg class="w-12 h-12 mx-auto text-rose-300 mb-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
            <p class="text-gray-600 mb-2">Thank you for being part of our special day</p>
            <p class="text-sm text-gray-500">Made with love ❤️</p>
        </div>
    </footer>
</div>


<!-- Bottom Navigation -->
<nav id="bottom-nav" class="fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-md shadow-lg z-40 transition-all duration-500 translate-y-full opacity-0 border-t border-rose-100">
    <div id="nav-slider" class="flex overflow-x-auto snap-x snap-mandatory scrollbar-hide scroll-smooth py-3">
        <a href="#opening" class="nav-item flex flex-col items-center text-rose-600 transition-all duration-300 hover:text-rose-700 active flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Home</span>
        </a>
        <a href="#couple" class="nav-item flex flex-col items-center text-gray-600 transition-all duration-300 hover:text-rose-700 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Couple</span>
        </a>
        <a href="#story" class="nav-item flex flex-col items-center text-gray-600 transition-all duration-300 hover:text-rose-700 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Story</span>
        </a>
        <a href="#event" class="nav-item flex flex-col items-center text-gray-600 transition-all duration-300 hover:text-rose-700 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Event</span>
        </a>
        <a href="#gallery" class="nav-item flex flex-col items-center text-gray-600 transition-all duration-300 hover:text-rose-700 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Gallery</span>
        </a>
        <a href="#gift" class="nav-item flex flex-col items-center text-gray-600 transition-all duration-300 hover:text-rose-700 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Gift</span>
        </a>
        <a href="#rsvp" class="nav-item flex flex-col items-center text-gray-600 transition-all duration-300 hover:text-rose-700 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">RSVP</span>
        </a>
    </div>

    <!-- Scroll Indicator Dots -->
    <div id="nav-dots" class="flex justify-center items-center gap-1.5 pb-2 pt-1">
        <div class="dot w-1.5 h-1.5 rounded-full bg-rose-600 transition-all duration-300"></div>
        <div class="dot w-1.5 h-1.5 rounded-full bg-gray-300 transition-all duration-300"></div>
        <div class="dot w-1.5 h-1.5 rounded-full bg-gray-300 transition-all duration-300"></div>
        <div class="dot w-1.5 h-1.5 rounded-full bg-gray-300 transition-all duration-300"></div>
        <div class="dot w-1.5 h-1.5 rounded-full bg-gray-300 transition-all duration-300"></div>
        <div class="dot w-1.5 h-1.5 rounded-full bg-gray-300 transition-all duration-300"></div>
        <div class="dot w-1.5 h-1.5 rounded-full bg-gray-300 transition-all duration-300"></div>
    </div>
</nav>

<script>
// Opening Cover
const openBtn = document.getElementById('open-invitation');
const openingCover = document.getElementById('opening-cover');
const mainContent = document.getElementById('main-content');
const bottomNav = document.getElementById('bottom-nav');

openBtn.addEventListener('click', function() {
    openingCover.classList.add('opacity-0');
    setTimeout(() => {
        openingCover.classList.add('hidden');
        mainContent.classList.remove('opacity-0', 'pointer-events-none');
        bottomNav.classList.remove('translate-y-full', 'opacity-0');
    }, 1000);
});

// Navigation & Scroll (sama seperti template 1)
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
        item.classList.remove('active', 'text-rose-600');
        item.classList.add('text-gray-600');

        if (item.getAttribute('href') === `#${current}`) {
            item.classList.add('active', 'text-rose-600');
            item.classList.remove('text-gray-600');
            item.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
            updateDots(index);
        }
    });
});

function updateDots(activeIndex) {
    navDots.forEach((dot, index) => {
        if (index === activeIndex) {
            dot.classList.remove('bg-gray-300', 'w-1.5');
            dot.classList.add('bg-rose-600', 'w-4');
        } else {
            dot.classList.remove('bg-rose-600', 'w-4');
            dot.classList.add('bg-gray-300', 'w-1.5');
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
            const animation = element.dataset.animation || 'fade-in-up';
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

document.querySelectorAll('.slide-up').forEach(el => {
    animateOnScroll.observe(el);
});

document.querySelectorAll('.stagger-animation').forEach(el => {
    animateOnScroll.observe(el);
});

// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});
</script>

<style>
@keyframes blob {
    0%, 100% { transform: translate(0, 0) scale(1); }
    25% { transform: translate(20px, -50px) scale(1.1); }
    50% { transform: translate(-20px, 20px) scale(0.9); }
    75% { transform: translate(50px, 50px) scale(1.05); }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

#bottom-nav a.active {
    position: relative;
}

/* Scroll Animations */
.animate-on-scroll {
    opacity: 0;
    transform: translateY(50px);
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

.slide-up {
    opacity: 0;
    transform: translateY(80px);
    transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}

.slide-up.animated {
    opacity: 1;
    transform: translateY(0);
}
</style>
@include('templates.partials.music', ['buttonClass' => 'bg-rose-500 text-white'])
</body>
</html>
