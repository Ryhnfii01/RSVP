<!-- Couple Section -->
<section id="couple" class="relative py-20 bg-gradient-to-br from-cream-100 via-brown-50 to-cream-50 overflow-hidden">
    <!-- Parallax Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none opacity-10">
        <svg class="parallax absolute top-20 right-10 w-64 h-64 text-brown-400" data-speed="0.2" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17 8C8 10 5.9 16.17 3.82 21.34l-.59 1.66 1.66-.59C10.83 20.1 17 18 19 9l1-4-4 1-2 2 2 2c-1 2.5-3.5 5-6.5 6.5l1.5-4.5L17 8z"/>
        </svg>
        <svg class="parallax absolute bottom-20 left-10 w-56 h-56 text-brown-300 transform rotate-45" data-speed="0.3" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
        </svg>
    </div>

    <div class="relative z-10 container mx-auto px-4 max-w-6xl">
        <!-- Header -->
        <div class="text-center mb-16 animate-on-scroll" data-animation="fade-in-up">
            <h2 class="text-5xl md:text-6xl font-script text-brown-800 mb-4">Bride & Groom</h2>
            <div class="flex items-center justify-center gap-4 mt-6">
                <div class="w-20 h-0.5 bg-gradient-to-r from-transparent to-brown-400"></div>
                <svg class="w-6 h-6 text-brown-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
                <div class="w-20 h-0.5 bg-gradient-to-l from-transparent to-brown-400"></div>
            </div>
            <p class="text-brown-700 mt-6 max-w-2xl mx-auto text-lg">
                Dengan memohon rahmat dan ridho Allah SWT, kami bermaksud mengundang Bapak/Ibu/Saudara/i pada acara pernikahan kami
            </p>
        </div>

        <!-- Couple Profiles -->
        <div class="grid md:grid-cols-2 gap-12 md:gap-8 items-center">
            <!-- Bride -->
            <div class="fade-in-left" data-delay="200">
                <div class="relative">
                    <!-- Photo Frame with Nature Ornaments -->
                    <div class="relative bg-white/90 backdrop-blur-sm rounded-3xl p-8 shadow-2xl border-2 border-brown-300">
                        <!-- Top Left Leaf -->
                        <svg class="absolute -top-4 -left-4 w-16 h-16 text-brown-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17 8C8 10 5.9 16.17 3.82 21.34l-.59 1.66 1.66-.59C10.83 20.1 17 18 19 9l1-4-4 1-2 2 2 2c-1 2.5-3.5 5-6.5 6.5l1.5-4.5L17 8z"/>
                        </svg>

                        <!-- Top Right Leaf -->
                        <svg class="absolute -top-4 -right-4 w-16 h-16 text-brown-600 transform rotate-90" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17 8C8 10 5.9 16.17 3.82 21.34l-.59 1.66 1.66-.59C10.83 20.1 17 18 19 9l1-4-4 1-2 2 2 2c-1 2.5-3.5 5-6.5 6.5l1.5-4.5L17 8z"/>
                        </svg>

                        <!-- Bottom Left Leaf -->
                        <svg class="absolute -bottom-4 -left-4 w-16 h-16 text-brown-600 transform rotate-270" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17 8C8 10 5.9 16.17 3.82 21.34l-.59 1.66 1.66-.59C10.83 20.1 17 18 19 9l1-4-4 1-2 2 2 2c-1 2.5-3.5 5-6.5 6.5l1.5-4.5L17 8z"/>
                        </svg>

                        <!-- Bottom Right Leaf -->
                        <svg class="absolute -bottom-4 -right-4 w-16 h-16 text-brown-600 transform rotate-180" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17 8C8 10 5.9 16.17 3.82 21.34l-.59 1.66 1.66-.59C10.83 20.1 17 18 19 9l1-4-4 1-2 2 2 2c-1 2.5-3.5 5-6.5 6.5l1.5-4.5L17 8z"/>
                        </svg>

                        <!-- Photo -->
                        <div class="relative rounded-2xl overflow-hidden mb-6 aspect-[3/4] bg-gradient-to-br from-brown-200 to-cream-200">
                            <img
                                src="https://images.unsplash.com/photo-1595475207225-428b62bda831?w=400&h=600&fit=crop"
                                alt="Bride"
                                class="w-full h-full object-cover"
                            >
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-brown-900/20 to-transparent"></div>
                        </div>

                        <!-- Info -->
                        <div class="text-center">
                            <h3 class="font-script text-4xl md:text-5xl text-brown-800 mb-3">{{ $event->bride_name }}</h3>
                            <p class="text-brown-600 text-sm mb-1">Putri dari</p>
                            <p class="text-brown-700 font-medium mb-1">{{ $event->bride_father }}</p>
                            <p class="text-brown-700 font-medium mb-4">{{ $event->bride_mother }}</p>

                            <!-- Instagram -->
                            <a
                                href="{{ $event->instagramUrl('bride') ?? '#' }}"
                                target="_blank"
                                class="inline-flex items-center gap-2 text-brown-600 hover:text-brown-800 transition-colors duration-200"
                            >
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                                <span class="text-sm">{{ $event->instagramHandle('bride') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Heart Divider (Mobile Only) -->
            <div class="md:hidden flex justify-center animate-on-scroll" data-animation="zoom-in">
                <svg class="w-16 h-16 text-brown-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </div>

            <!-- Groom -->
            <div class="fade-in-right" data-delay="300">
                <div class="relative">
                    <!-- Photo Frame with Nature Ornaments -->
                    <div class="relative bg-white/90 backdrop-blur-sm rounded-3xl p-8 shadow-2xl border-2 border-brown-300">
                        <!-- Top Left Leaf -->
                        <svg class="absolute -top-4 -left-4 w-16 h-16 text-brown-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17 8C8 10 5.9 16.17 3.82 21.34l-.59 1.66 1.66-.59C10.83 20.1 17 18 19 9l1-4-4 1-2 2 2 2c-1 2.5-3.5 5-6.5 6.5l1.5-4.5L17 8z"/>
                        </svg>

                        <!-- Top Right Leaf -->
                        <svg class="absolute -top-4 -right-4 w-16 h-16 text-brown-600 transform rotate-90" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17 8C8 10 5.9 16.17 3.82 21.34l-.59 1.66 1.66-.59C10.83 20.1 17 18 19 9l1-4-4 1-2 2 2 2c-1 2.5-3.5 5-6.5 6.5l1.5-4.5L17 8z"/>
                        </svg>

                        <!-- Bottom Left Leaf -->
                        <svg class="absolute -bottom-4 -left-4 w-16 h-16 text-brown-600 transform rotate-270" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17 8C8 10 5.9 16.17 3.82 21.34l-.59 1.66 1.66-.59C10.83 20.1 17 18 19 9l1-4-4 1-2 2 2 2c-1 2.5-3.5 5-6.5 6.5l1.5-4.5L17 8z"/>
                        </svg>

                        <!-- Bottom Right Leaf -->
                        <svg class="absolute -bottom-4 -right-4 w-16 h-16 text-brown-600 transform rotate-180" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17 8C8 10 5.9 16.17 3.82 21.34l-.59 1.66 1.66-.59C10.83 20.1 17 18 19 9l1-4-4 1-2 2 2 2c-1 2.5-3.5 5-6.5 6.5l1.5-4.5L17 8z"/>
                        </svg>

                        <!-- Photo -->
                        <div class="relative rounded-2xl overflow-hidden mb-6 aspect-[3/4] bg-gradient-to-br from-brown-200 to-cream-200">
                            <img
                                src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop"
                                alt="Groom"
                                class="w-full h-full object-cover"
                            >
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-brown-900/20 to-transparent"></div>
                        </div>

                        <!-- Info -->
                        <div class="text-center">
                            <h3 class="font-script text-4xl md:text-5xl text-brown-800 mb-3">{{ $event->groom_name }}</h3>
                            <p class="text-brown-600 text-sm mb-1">Putra dari</p>
                            <p class="text-brown-700 font-medium mb-1">{{ $event->groom_father }}</p>
                            <p class="text-brown-700 font-medium mb-4">{{ $event->groom_mother }}</p>

                            <!-- Instagram -->
                            <a
                                href="{{ $event->instagramUrl('groom') ?? '#' }}"
                                target="_blank"
                                class="inline-flex items-center gap-2 text-brown-600 hover:text-brown-800 transition-colors duration-200"
                            >
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                                <span class="text-sm">{{ $event->instagramHandle('groom') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Decorative Grass -->
    <div class="absolute bottom-0 left-0 right-0 pointer-events-none">
        <svg class="w-full h-24 text-brown-700 opacity-10" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,20 Q100,60 200,40 T400,20 Q500,60 600,40 T800,20 Q900,60 1000,40 T1200,20 L1200,120 L0,120 Z" fill="currentColor"/>
        </svg>
    </div>
</section>
