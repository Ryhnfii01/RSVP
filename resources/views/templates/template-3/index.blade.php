<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('templates.partials.meta')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-cream-100">

<!-- Opening Cover -->
<div id="opening-cover" class="fixed inset-0 z-50 flex items-center justify-center bg-gradient-to-br from-brown-100 via-cream-200 to-brown-50 transition-opacity duration-1000 overflow-hidden">
    <!-- Parallax Clouds -->
    <div class="absolute inset-0 opacity-20">
        <svg class="absolute top-10 left-10 w-32 h-32 text-brown-300 animate-float-slow" fill="currentColor" viewBox="0 0 640 512">
            <path d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128H144z"/>
        </svg>
        <svg class="absolute top-32 right-20 w-40 h-40 text-cream-400 animate-float animation-delay-2000" fill="currentColor" viewBox="0 0 640 512">
            <path d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128H144z"/>
        </svg>
    </div>

    <div class="relative z-10 text-center px-4">
        <!-- Decorative Top Leaf -->
        <div class="mb-6 animate-fade-in-down">
            <svg class="w-24 h-24 mx-auto text-brown-600" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.67C7.5 17.76 9.59 12 17 10zm-6.45 8.27L8 12.46l-.55 3.81-2.9-1.1L4.1 18l2.3.87.2 3.28 1.45-.04.2-3.28L10.55 18z"/>
            </svg>
        </div>

        <div class="animate-slide-up">
            <p class="text-brown-700 text-sm tracking-[0.3em] uppercase mb-4 font-medium">The Wedding of</p>

            <h2 class="font-script text-6xl sm:text-7xl md:text-8xl text-brown-800 mb-2 leading-tight">
                {{ $event->brideNickname() }} <span class="text-cream-700">&</span> {{ $event->groomNickname() }}
            </h2>
        </div>

        <p class="text-brown-600 text-lg mb-2 mt-8 animate-fade-in">{{ $event->dateLong() }}</p>
        <p class="text-brown-500 mb-8 animate-fade-in">Kepada Yth.</p>
        <p class="text-brown-700 text-xl font-medium mb-8 animate-zoom-in">{{ $guestName }}</p>

        <button id="open-invitation" class="group relative inline-flex items-center justify-center px-10 py-4 text-lg font-medium text-white bg-gradient-to-r from-brown-700 to-brown-600 rounded-full overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 animate-fade-in">
            <span class="relative z-10 flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"></path>
                </svg>
                OPEN INVITATION
            </span>
        </button>
    </div>

    <!-- Decorative Bottom Grass -->
    <div class="absolute bottom-0 left-0 right-0 h-24 opacity-30">
        <svg class="w-full h-full" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0 Q300,80 600,20 T1200,0 L1200,120 L0,120 Z" fill="currentColor" class="text-brown-700"/>
        </svg>
    </div>
</div>

<!-- Main Content -->
<div id="main-content" class="opacity-0 pointer-events-none transition-opacity duration-1000">
    <!-- Include All Sections -->
    @include('templates.template-3.sections.hero')
    @include('templates.template-3.sections.couple')
    @include('templates.template-3.sections.story')
    @include('templates.template-3.sections.event')
    @include('templates.partials.gallery', ['theme' => [
            'section' => 'bg-gradient-to-br from-brown-50 via-cream-100 to-brown-100',
            'title' => 'font-script text-brown-800',
            'divider' => 'bg-brown-400',
            'tile' => 'shadow-lg border-4 border-cream-50 ring-brown-300',
        ]])
    @include('templates.template-3.sections.gift')
    @include('templates.template-3.sections.rsvp')

    <!-- Footer -->
    <footer class="relative py-12 bg-gradient-to-br from-brown-900 to-brown-800 text-center overflow-hidden">
        <!-- Decorative Leaves -->
        <div class="absolute top-5 left-10 opacity-20">
            <svg class="w-16 h-16 text-cream-200 animate-float" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.67C7.5 17.76 9.59 12 17 10zm-6.45 8.27L8 12.46l-.55 3.81-2.9-1.1L4.1 18l2.3.87.2 3.28 1.45-.04.2-3.28L10.55 18z"/>
            </svg>
        </div>
        <div class="absolute bottom-5 right-10 opacity-20">
            <svg class="w-16 h-16 text-cream-200 animate-float animation-delay-2000" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.67C7.5 17.76 9.59 12 17 10zm-6.45 8.27L8 12.46l-.55 3.81-2.9-1.1L4.1 18l2.3.87.2 3.28 1.45-.04.2-3.28L10.55 18z"/>
            </svg>
        </div>

        <div class="relative z-10 container mx-auto px-4">
            <svg class="w-12 h-12 mx-auto text-cream-400 mb-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.67C7.5 17.76 9.59 12 17 10zm-6.45 8.27L8 12.46l-.55 3.81-2.9-1.1L4.1 18l2.3.87.2 3.28 1.45-.04.2-3.28L10.55 18z"/>
            </svg>
            <p class="text-cream-100 mb-2">Thank you for being part of our special day</p>
            <p class="text-sm text-cream-300">Made with love & nature 🌿</p>
        </div>
    </footer>
</div>


<!-- Bottom Navigation -->
<nav id="bottom-nav" class="fixed bottom-0 left-0 right-0 bg-cream-50/95 backdrop-blur-md shadow-lg z-40 transition-all duration-500 translate-y-full opacity-0 border-t border-brown-200">
    <div id="nav-slider" class="flex overflow-x-auto snap-x snap-mandatory scrollbar-hide scroll-smooth py-3">
        <a href="#opening" class="nav-item flex flex-col items-center text-brown-700 transition-all duration-300 hover:text-brown-800 active flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Home</span>
        </a>
        <a href="#couple" class="nav-item flex flex-col items-center text-gray-600 transition-all duration-300 hover:text-brown-800 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Couple</span>
        </a>
        <a href="#story" class="nav-item flex flex-col items-center text-gray-600 transition-all duration-300 hover:text-brown-800 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Story</span>
        </a>
        <a href="#event" class="nav-item flex flex-col items-center text-gray-600 transition-all duration-300 hover:text-brown-800 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Event</span>
        </a>
        <a href="#gallery" class="nav-item flex flex-col items-center text-gray-600 transition-all duration-300 hover:text-brown-800 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Gallery</span>
        </a>
        <a href="#gift" class="nav-item flex flex-col items-center text-gray-600 transition-all duration-300 hover:text-brown-800 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Gift</span>
        </a>
        <a href="#rsvp" class="nav-item flex flex-col items-center text-gray-600 transition-all duration-300 hover:text-brown-800 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">RSVP</span>
        </a>
    </div>

    <!-- Scroll Indicator Dots -->
    <div id="nav-dots" class="flex justify-center items-center gap-1.5 pb-2 pt-1">
        <div class="dot w-1.5 h-1.5 rounded-full bg-brown-700 transition-all duration-300"></div>
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
        item.classList.remove('active', 'text-brown-700');
        item.classList.add('text-gray-600');

        if (item.getAttribute('href') === `#${current}`) {
            item.classList.add('active', 'text-brown-700');
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
            dot.classList.add('bg-brown-700', 'w-4');
        } else {
            dot.classList.remove('bg-brown-700', 'w-4');
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

// Parallax Effect
let ticking = false;
window.addEventListener('scroll', () => {
    if (!ticking) {
        window.requestAnimationFrame(() => {
            const scrolled = window.pageYOffset;
            document.querySelectorAll('.parallax').forEach(el => {
                const speed = el.dataset.speed || 0.5;
                const yPos = -(scrolled * speed);
                el.style.transform = `translateY(${yPos}px)`;
            });
            ticking = false;
        });
        ticking = true;
    }
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
@include('templates.partials.music', ['buttonClass' => 'bg-brown-600 text-cream-50'])
</body>
</html>
