@extends('layouts.app')

@section('title', 'Undangan Pernikahan - Nama Pengantin')

@section('content')
<!-- Opening Cover -->
<div id="opening-cover" class="fixed inset-0 z-50 bg-gradient-to-br from-primary-800 via-primary-700 to-primary-600 flex items-center justify-center transition-all duration-1000">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 -left-4 w-72 h-72 bg-white rounded-full mix-blend-multiply filter blur-xl animate-blob"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-gold-300 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-white rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-4000"></div>
    </div>

    <div class="relative z-10 text-center px-4 max-w-2xl mx-auto">
        <div class="mb-8">
            <div class="w-32 h-32 mx-auto mb-6 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </div>
        </div>

        <h1 class="text-2xl sm:text-3xl md:text-4xl font-serif text-white mb-4">
            The Wedding Of
        </h1>

        <div class="my-8">
            <h2 class="font-script text-4xl sm:text-5xl md:text-6xl text-white mb-4">
                Nama Pria & Nama Wanita
            </h2>
        </div>

        <p class="text-white/90 text-lg mb-2">Minggu, 31 Desember 2025</p>
        <p class="text-white/80 mb-8">Kepada Yth.</p>
        <p class="text-white text-xl font-medium mb-8">Dear Special Guest</p>

        <button id="open-invitation" class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-medium text-primary-700 bg-gradient-to-r from-gold-400 to-gold-500 rounded-full overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
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
        <!-- Animated Background -->
        <x-animated-background variant="default" />

        <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <div class="animate-fade-in-down">
                <p class="text-sm sm:text-base md:text-lg tracking-widest uppercase mb-4 opacity-90">
                    THE WEDDING OF
                </p>
            </div>

            <div class="animate-fade-in-up my-8 sm:my-12">
                <h1 class="font-script text-5xl sm:text-6xl md:text-7xl lg:text-8xl mb-4 leading-tight">
                    Nama Pria
                </h1>
                <div class="flex items-center justify-center my-6">
                    <div class="h-px w-16 sm:w-24 bg-white/50"></div>
                    <span class="mx-4 text-2xl sm:text-3xl">&</span>
                    <div class="h-px w-16 sm:w-24 bg-white/50"></div>
                </div>
                <h1 class="font-script text-5xl sm:text-6xl md:text-7xl lg:text-8xl mb-8 leading-tight">
                    Nama Wanita
                </h1>
            </div>

            <div class="animate-zoom-in">
                <p class="text-base sm:text-lg md:text-xl mb-2">
                    Minggu, 31 Desember 2025
                </p>
                <p class="text-sm sm:text-base opacity-90">
                    Pukul 19.00 WIB
                </p>
            </div>

            <div class="absolute bottom-24 left-1/2 transform -translate-x-1/2 animate-bounce">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </section>

    <div class="h-2 bg-gradient-to-r from-gold-400 via-gold-300 to-gold-400"></div>

    <!-- Salam Section -->
    <section id="salam" class="py-16 sm:py-20 lg:py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
            <div class="text-center mb-12 animate-on-scroll" data-animation="fade-in-up" data-delay="100">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-serif text-gray-800 mb-4">
                    Assalamu'alaikum Wr. Wb.
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-transparent via-gold-500 to-transparent mx-auto mb-8"></div>
            </div>

            <div class="prose prose-lg mx-auto text-center text-gray-600 animate-on-scroll" data-animation="zoom-in" data-delay="200">
                <p class="mb-6 text-base sm:text-lg leading-relaxed">
                    Dengan memohon rahmat dan ridho Allah Subhanahu Wa Ta'ala, kami bermaksud mengundang Bapak/Ibu/Saudara/i
                    untuk menghadiri acara pernikahan kami:
                </p>
            </div>

            <!-- Bride & Groom Cards -->
            <div class="grid md:grid-cols-2 gap-8 mt-16 stagger-animation">
                <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-primary-50 to-white shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="w-32 h-32 mx-auto mb-6 rounded-full bg-gradient-to-br from-primary-400 to-primary-600 p-1">
                        <div class="w-full h-full rounded-full bg-gray-200 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="font-script text-3xl sm:text-4xl text-primary-700 mb-2">Nama Lengkap Pria</h3>
                    <p class="text-gray-600 mb-1">Putra dari</p>
                    <p class="font-medium text-gray-800">Bapak [Nama] & Ibu [Nama]</p>
                    <div class="mt-4">
                        <a href="https://instagram.com/username" target="_blank" class="inline-flex items-center text-primary-600 hover:text-primary-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                            @username
                        </a>
                    </div>
                </div>

                <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-gold-50 to-white shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="w-32 h-32 mx-auto mb-6 rounded-full bg-gradient-to-br from-gold-400 to-gold-600 p-1">
                        <div class="w-full h-full rounded-full bg-gray-200 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="font-script text-3xl sm:text-4xl text-gold-700 mb-2">Nama Lengkap Wanita</h3>
                    <p class="text-gray-600 mb-1">Putri dari</p>
                    <p class="font-medium text-gray-800">Bapak [Nama] & Ibu [Nama]</p>
                    <div class="mt-4">
                        <a href="https://instagram.com/username" target="_blank" class="inline-flex items-center text-gold-600 hover:text-gold-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                            @username
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- After Salam section (line ~160) --}}
    @include('invitation.sections.gallery')
    <div class="h-2 bg-gradient-to-r from-gold-400 via-gold-300 to-gold-400"></div>

    @include('invitation.sections.gift')
    <div class="h-2 bg-gradient-to-r from-gold-400 via-gold-300 to-gold-400"></div>

    <!-- Event Section -->
    <section id="event" class="relative py-16 sm:py-20 lg:py-24 bg-gradient-to-br from-gray-50 to-gray-100 overflow-hidden">
        <!-- Decorative Elements -->
        <x-decorative-ornament position="top-left" type="floral" color="primary" />
        <x-decorative-ornament position="bottom-right" type="geometric" color="gold" />

        <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
            <div class="text-center mb-16 animate-on-scroll" data-animation="fade-in-up">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-serif text-gray-800 mb-4">
                    Waktu & Tempat
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-transparent via-gold-500 to-transparent mx-auto"></div>
            </div>

            <!-- Countdown Timer -->
            <div class="mb-16 animate-on-scroll" data-animation="zoom-in" data-delay="100">
                <div class="glass rounded-2xl p-8 backdrop-blur-lg bg-white/80 shadow-xl">
                    <h3 class="text-center text-xl sm:text-2xl font-serif text-gray-700 mb-6">Menuju Hari Bahagia</h3>
                    <div id="countdown" class="grid grid-cols-4 gap-4 max-w-2xl mx-auto">
                        <div class="text-center">
                            <div class="bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl p-4 shadow-lg">
                                <div id="days" class="text-3xl sm:text-4xl font-bold text-white">00</div>
                            </div>
                            <p class="text-sm sm:text-base text-gray-600 mt-2">Hari</p>
                        </div>
                        <div class="text-center">
                            <div class="bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl p-4 shadow-lg">
                                <div id="hours" class="text-3xl sm:text-4xl font-bold text-white">00</div>
                            </div>
                            <p class="text-sm sm:text-base text-gray-600 mt-2">Jam</p>
                        </div>
                        <div class="text-center">
                            <div class="bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl p-4 shadow-lg">
                                <div id="minutes" class="text-3xl sm:text-4xl font-bold text-white">00</div>
                            </div>
                            <p class="text-sm sm:text-base text-gray-600 mt-2">Menit</p>
                        </div>
                        <div class="text-center">
                            <div class="bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl p-4 shadow-lg">
                                <div id="seconds" class="text-3xl sm:text-4xl font-bold text-white">00</div>
                            </div>
                            <p class="text-sm sm:text-base text-gray-600 mt-2">Detik</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Cards -->
            <div class="grid md:grid-cols-2 gap-8 stagger-animation">
                <div class="bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-shadow duration-300">
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                            <svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-serif text-gray-800 mb-2">Akad Nikah</h3>
                        <div class="space-y-2 text-gray-600">
                            <p class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Minggu, 31 Desember 2025
                            </p>
                            <p class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                08.00 - 10.00 WIB
                            </p>
                            <p class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Gedung Serbaguna
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-shadow duration-300">
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-gold-100 to-gold-200 flex items-center justify-center">
                            <svg class="w-10 h-10 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-serif text-gray-800 mb-2">Resepsi Pernikahan</h3>
                        <div class="space-y-2 text-gray-600">
                            <p class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Minggu, 31 Desember 2025
                            </p>
                            <p class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                19.00 - Selesai
                            </p>
                            <p class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Gedung Serbaguna
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="h-2 bg-gradient-to-r from-gold-400 via-gold-300 to-gold-400"></div>

    {{-- Guest Book Section --}}
    @include('invitation.sections.guestbook')

    <div class="h-2 bg-gradient-to-r from-gold-400 via-gold-300 to-gold-400"></div>

    <!-- Map Section -->
    <section id="maps" class="py-16 sm:py-20 lg:py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-serif text-gray-800 mb-4">
                    Lokasi Acara
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-transparent via-gold-500 to-transparent mx-auto mb-6"></div>
                <p class="text-gray-600">Jl. Contoh No. 123, Kota, Provinsi</p>
            </div>

            <div class="rounded-2xl overflow-hidden shadow-2xl">
                <div id="map-container" class="w-full h-96 bg-gray-200 flex items-center justify-center">
                    <p class="text-gray-500">Google Maps akan dimuat di sini</p>
                </div>
            </div>

            <div class="text-center mt-8">
                <a href="https://maps.google.com" target="_blank" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-primary-600 to-primary-500 text-white rounded-full hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Buka di Google Maps
                </a>
            </div>
        </div>
    </section>

    <!-- RSVP Section -->
    <section id="rsvp" class="py-16 sm:py-20 lg:py-24 bg-gradient-to-br from-primary-50 to-gold-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-2xl">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-serif text-gray-800 mb-4">
                    Konfirmasi Kehadiran
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-transparent via-gold-500 to-transparent mx-auto mb-6"></div>
                <p class="text-gray-600">
                    Mohon konfirmasi kehadiran Anda untuk membantu kami mempersiapkan acara dengan lebih baik
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-2xl p-8">
                <form id="rsvp-form" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                        <input type="text" id="name" name="name" required
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                        <input type="email" id="email" name="email" required
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">No. WhatsApp</label>
                        <input type="tel" id="phone" name="phone"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                    </div>

                    <div>
                        <label for="attendance" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Kehadiran *</label>
                        <select id="attendance" name="attendance" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                            <option value="">Pilih...</option>
                            <option value="hadir">Hadir</option>
                            <option value="tidak_hadir">Tidak Hadir</option>
                        </select>
                    </div>

                    <div id="guests-field" class="hidden">
                        <label for="number_of_guests" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Tamu *</label>
                        <input type="number" id="number_of_guests" name="number_of_guests" min="1" max="5" value="1"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Ucapan & Doa</label>
                        <textarea id="message" name="message" rows="4"
                                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                  placeholder="Berikan ucapan dan doa untuk kami..."></textarea>
                    </div>

                    <div id="alert-container"></div>

                    <button type="submit" id="submit-btn"
                            class="w-full bg-gradient-to-r from-primary-600 to-primary-500 text-white py-4 rounded-lg font-medium hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                        Kirim Konfirmasi
                    </button>
                </form>
            </div>

            <div class="text-center mt-8 text-gray-600">
                <p>
                    <span id="confirmed-count">{{ $confirmedGuests }}</span> dari {{ $totalCapacity }} tamu telah konfirmasi
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-gray-800 to-gray-900 text-white py-12 pb-24">
        <div class="container mx-auto px-4 text-center">
            <p class="font-script text-3xl sm:text-4xl mb-4">Terima Kasih</p>
            <p class="text-gray-300 mb-2">Merupakan suatu kehormatan dan kebahagiaan bagi kami</p>
            <p class="text-gray-300">apabila Bapak/Ibu/Saudara/i berkenan hadir</p>
            <div class="mt-8 text-gray-400 text-sm">
                <p>&copy; 2025 Wedding Invitation</p>
            </div>
        </div>
    </footer>
</div>

<!-- Bottom Navigation Slider -->
<nav id="bottom-nav" class="fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-md shadow-lg z-40 transition-all duration-500 translate-y-full opacity-0 border-t border-gray-200/50">
    <!-- Navigation Items Container -->
    <div id="nav-slider" class="flex overflow-x-auto snap-x snap-mandatory scrollbar-hide scroll-smooth py-3" style="scroll-behavior: smooth; -webkit-overflow-scrolling: touch;">
        <a href="#opening" class="nav-item flex flex-col items-center text-primary-600 transition-all duration-300 hover:text-primary-700 active flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Home</span>
        </a>
        <a href="#salam" class="nav-item flex flex-col items-center text-gray-600 transition-all duration-300 hover:text-primary-700 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Couple</span>
        </a>
        <a href="#gallery" class="nav-item flex flex-col items-center text-gray-600 transition-all duration-300 hover:text-primary-700 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Gallery</span>
        </a>
        <a href="#gift" class="nav-item flex flex-col items-center text-gray-600 transition-all duration-300 hover:text-primary-700 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Gift</span>
        </a>
        <a href="#event" class="nav-item flex flex-col items-center text-gray-600 transition-all duration-300 hover:text-primary-700 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Event</span>
        </a>
        <a href="#wishes" class="nav-item flex flex-col items-center text-gray-600 transition-all duration-300 hover:text-primary-700 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Wishes</span>
        </a>
        <a href="#maps" class="nav-item flex flex-col items-center text-gray-600 transition-all duration-300 hover:text-primary-700 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">Maps</span>
        </a>
        <a href="#rsvp" class="nav-item flex flex-col items-center text-gray-600 transition-all duration-300 hover:text-primary-700 flex-shrink-0 snap-center px-6">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span class="text-xs font-medium whitespace-nowrap">RSVP</span>
        </a>
    </div>

    <!-- Scroll Indicator Dots -->
    <div id="nav-dots" class="flex justify-center items-center gap-1.5 pb-2 pt-1">
        <div class="dot w-1.5 h-1.5 rounded-full bg-primary-600 transition-all duration-300"></div>
        <div class="dot w-1.5 h-1.5 rounded-full bg-gray-300 transition-all duration-300"></div>
        <div class="dot w-1.5 h-1.5 rounded-full bg-gray-300 transition-all duration-300"></div>
        <div class="dot w-1.5 h-1.5 rounded-full bg-gray-300 transition-all duration-300"></div>
        <div class="dot w-1.5 h-1.5 rounded-full bg-gray-300 transition-all duration-300"></div>
        <div class="dot w-1.5 h-1.5 rounded-full bg-gray-300 transition-all duration-300"></div>
        <div class="dot w-1.5 h-1.5 rounded-full bg-gray-300 transition-all duration-300"></div>
        <div class="dot w-1.5 h-1.5 rounded-full bg-gray-300 transition-all duration-300"></div>
    </div>
</nav>

<!-- Music Toggle Button -->
<button id="music-toggle" class="fixed bottom-24 right-4 z-40 w-14 h-14 bg-gradient-to-r from-gold-400 to-gold-500 rounded-full shadow-lg flex items-center justify-center transition-all duration-500 translate-y-24 opacity-0 hover:scale-110">
    <svg id="music-icon-play" class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
        <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"></path>
    </svg>
    <svg id="music-icon-pause" class="w-6 h-6 text-white hidden" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
    </svg>
</button>

@endsection

@push('scripts')
<script>
// Opening Cover
const openingCover = document.getElementById('opening-cover');
const mainContent = document.getElementById('main-content');
const bottomNav = document.getElementById('bottom-nav');
const musicToggle = document.getElementById('music-toggle');
const openInvitationBtn = document.getElementById('open-invitation');

openInvitationBtn.addEventListener('click', function() {
    openingCover.classList.add('translate-y-full', 'opacity-0');

    setTimeout(() => {
        openingCover.style.display = 'none';
        mainContent.classList.remove('opacity-0', 'pointer-events-none');
        mainContent.classList.add('opacity-100');

        // Show bottom nav
        setTimeout(() => {
            bottomNav.classList.remove('translate-y-full', 'opacity-0');
            bottomNav.classList.add('translate-y-0', 'opacity-100');
            musicToggle.classList.remove('translate-y-24', 'opacity-0');
            musicToggle.classList.add('translate-y-0', 'opacity-100');
        }, 300);
    }, 1000);
});

// Countdown Timer
const eventDate = new Date("{{ $eventDate }}").getTime();

function updateCountdown() {
    const now = new Date().getTime();
    const distance = eventDate - now;

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById('days').textContent = String(days).padStart(2, '0');
    document.getElementById('hours').textContent = String(hours).padStart(2, '0');
    document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
    document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');

    if (distance < 0) {
        clearInterval(countdownInterval);
        document.getElementById('countdown').innerHTML = '<p class="text-2xl">Acara Sedang Berlangsung!</p>';
    }
}

const countdownInterval = setInterval(updateCountdown, 1000);
updateCountdown();

// Bottom Navigation Slider
const navSlider = document.getElementById('nav-slider');
const navItems = document.querySelectorAll('.nav-item');
const navDots = document.querySelectorAll('#nav-dots .dot');
const sections = document.querySelectorAll('section');

// Update active nav based on scroll
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
        item.classList.remove('active', 'text-primary-600');
        item.classList.add('text-gray-600');

        if (item.getAttribute('href') === `#${current}`) {
            item.classList.add('active', 'text-primary-600');
            item.classList.remove('text-gray-600');

            // Scroll nav item into view
            item.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });

            // Update dots
            updateDots(index);
        }
    });
});

// Nav slider scroll handler for dots
navSlider.addEventListener('scroll', () => {
    const scrollLeft = navSlider.scrollLeft;
    const scrollWidth = navSlider.scrollWidth - navSlider.clientWidth;
    const scrollPercent = scrollLeft / scrollWidth;
    const activeIndex = Math.round(scrollPercent * (navItems.length - 1));
    updateDots(activeIndex);
});

// Update dots indicator
function updateDots(activeIndex) {
    navDots.forEach((dot, index) => {
        if (index === activeIndex) {
            dot.classList.remove('bg-gray-300', 'w-1.5');
            dot.classList.add('bg-primary-600', 'w-4');
        } else {
            dot.classList.remove('bg-primary-600', 'w-4');
            dot.classList.add('bg-gray-300', 'w-1.5');
        }
    });
}

// Click dots to scroll nav
navDots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
        const targetItem = navItems[index];
        if (targetItem) {
            targetItem.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
            updateDots(index);
        }
    });
});

// Add swipe/touch support for better mobile experience
let startX = 0;
let scrollLeft = 0;

navSlider.addEventListener('touchstart', (e) => {
    startX = e.touches[0].pageX - navSlider.offsetLeft;
    scrollLeft = navSlider.scrollLeft;
});

navSlider.addEventListener('touchmove', (e) => {
    const x = e.touches[0].pageX - navSlider.offsetLeft;
    const walk = (x - startX) * 2;
    navSlider.scrollLeft = scrollLeft - walk;
});

// Music Toggle
let isPlaying = false;
const musicIconPlay = document.getElementById('music-icon-play');
const musicIconPause = document.getElementById('music-icon-pause');

musicToggle.addEventListener('click', function() {
    isPlaying = !isPlaying;

    if (isPlaying) {
        musicIconPlay.classList.add('hidden');
        musicIconPause.classList.remove('hidden');
        // Add your music play logic here
    } else {
        musicIconPlay.classList.remove('hidden');
        musicIconPause.classList.add('hidden');
        // Add your music pause logic here
    }
});

// RSVP Form
const attendanceSelect = document.getElementById('attendance');
const guestsField = document.getElementById('guests-field');
const rsvpForm = document.getElementById('rsvp-form');
const submitBtn = document.getElementById('submit-btn');
const alertContainer = document.getElementById('alert-container');

attendanceSelect.addEventListener('change', function() {
    if (this.value === 'hadir') {
        guestsField.classList.remove('hidden');
        document.getElementById('number_of_guests').required = true;
    } else {
        guestsField.classList.add('hidden');
        document.getElementById('number_of_guests').required = false;
    }
});

rsvpForm.addEventListener('submit', async function(e) {
    e.preventDefault();

    submitBtn.disabled = true;
    submitBtn.textContent = 'Mengirim...';

    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());

    try {
        const response = await fetch('{{ route("rsvp.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.ok) {
            showAlert('success', result.message);
            rsvpForm.reset();
            guestsField.classList.add('hidden');

            const confirmedCount = document.getElementById('confirmed-count');
            confirmedCount.textContent = parseInt(confirmedCount.textContent) + 1;
        } else {
            const errors = result.errors ? Object.values(result.errors).flat().join('<br>') : result.message;
            showAlert('error', errors);
        }
    } catch (error) {
        showAlert('error', 'Terjadi kesalahan. Silakan coba lagi.');
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Kirim Konfirmasi';
    }
});

function showAlert(type, message) {
    const bgColor = type === 'success' ? 'bg-green-100 border-green-500 text-green-700' : 'bg-red-100 border-red-500 text-red-700';
    alertContainer.innerHTML = `
        <div class="${bgColor} border-l-4 p-4 rounded mb-4" role="alert">
            <p>${message}</p>
        </div>
    `;

    setTimeout(() => {
        alertContainer.innerHTML = '';
    }, 5000);
}

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

// Scroll-triggered Animations
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

            // Stop observing once animated
            animateOnScroll.unobserve(element);
        }
    });
}, observerOptions);

// Observe all elements with animate-on-scroll class
document.querySelectorAll('.animate-on-scroll').forEach(el => {
    animateOnScroll.observe(el);
});

// Observe stagger animation containers
document.querySelectorAll('.stagger-animation').forEach(el => {
    animateOnScroll.observe(el);
});

// Parallax effect on scroll
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

#bottom-nav a.active::before {
    content: '';
    position: absolute;
    top: -2px;
    left: 50%;
    transform: translateX(-50%);
    width: 40px;
    height: 3px;
    background: linear-gradient(to right, #0ea5e9, #38bdf8);
    border-radius: 0 0 3px 3px;
}
</style>
@endpush
