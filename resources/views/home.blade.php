@php
    $brand = config('landing.brand');
    $waLink = 'https://wa.me/' . config('landing.whatsapp') . '?text=' . rawurlencode(config('landing.whatsapp_message'));
    $packages = config('landing.packages');
    $testimonials = config('landing.testimonials');
    $faqs = config('landing.faqs');
@endphp
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $brand }} - Undangan Pernikahan Digital</title>
    <meta name="description" content="Undangan pernikahan digital dengan RSVP online, galeri foto, peta lokasi, dan amplop digital. Pilih template, kirim data, undangan siap dibagikan lewat WhatsApp.">
    <meta property="og:title" content="{{ $brand }} - Undangan Pernikahan Digital">
    <meta property="og:description" content="Pilih template, kirim data, undangan siap dibagikan lewat WhatsApp.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:locale" content="id_ID">
    <meta property="og:image" content="{{ asset(\App\Support\ShareImage::DEFAULT_PATH) }}">
    <meta property="og:image:width" content="{{ \App\Support\ShareImage::WIDTH }}">
    <meta property="og:image:height" content="{{ \App\Support\ShareImage::HEIGHT }}">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@400;500;600&family=Dancing+Script:wght@500;600&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-stone-50 text-stone-800">

    <!-- Navigasi -->
    <header class="sticky top-0 z-40 bg-stone-50/90 backdrop-blur border-b border-stone-200">
        <nav class="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="font-script text-3xl text-primary-800">{{ $brand }}</a>
            <div class="hidden md:flex items-center gap-8 text-sm text-stone-600">
                <a href="#fitur" class="hover:text-primary-700">Fitur</a>
                <a href="#template" class="hover:text-primary-700">Template</a>
                <a href="#harga" class="hover:text-primary-700">Harga</a>
                <a href="#faq" class="hover:text-primary-700">FAQ</a>
            </div>
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="text-sm text-stone-600 hover:text-primary-700">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-stone-600 hover:text-primary-700">Masuk</a>
                @endauth
                <a href="{{ $waLink }}" target="_blank" rel="noopener"
                   class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-700 text-white text-sm font-medium hover:bg-primary-800 transition-colors">
                    Pesan Sekarang
                </a>
            </div>
        </nav>
    </header>

    <main>
        <!-- Hero -->
        <section class="relative overflow-hidden">
            <div class="max-w-6xl mx-auto px-4 pt-14 pb-20 md:pt-20 md:pb-28 grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <p class="text-xs tracking-[0.25em] uppercase text-gold-700 font-medium mb-5">Undangan pernikahan digital</p>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl text-stone-900 leading-tight mb-6 text-balance">
                        Satu link untuk semua tamu, dari kabar bahagia sampai konfirmasi hadir.
                    </h1>
                    <p class="text-lg text-stone-600 leading-relaxed mb-8 max-w-xl">
                        Pilih template, kirim data mempelai, dan undangan Anda siap dibagikan lewat WhatsApp.
                        Tamu melihat lokasi, mengisi RSVP, dan mengirim ucapan dari HP mereka.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="#template"
                           class="inline-flex items-center px-6 py-3 rounded-full bg-primary-700 text-white font-medium hover:bg-primary-800 transition-colors">
                            Lihat Template
                        </a>
                        <a href="{{ $waLink }}" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2 px-6 py-3 rounded-full border border-stone-300 text-stone-800 font-medium hover:border-primary-700 hover:text-primary-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91C21.95 6.45 17.5 2 12.04 2zm5.8 14.03c-.24.68-1.42 1.3-1.95 1.35-.5.05-.97.23-3.27-.68-2.77-1.09-4.52-3.92-4.66-4.1-.13-.18-1.1-1.47-1.1-2.8 0-1.33.7-1.98.95-2.25.24-.27.53-.34.71-.34h.51c.16 0 .38-.06.6.46.24.55.79 1.9.86 2.04.07.14.11.3.02.48-.09.18-.14.3-.27.46-.14.16-.29.36-.41.48-.14.14-.28.29-.12.56.16.27.71 1.17 1.52 1.9 1.05.93 1.93 1.22 2.2 1.36.27.14.43.11.59-.07.16-.18.68-.79.86-1.06.18-.27.36-.23.6-.14.25.09 1.58.75 1.85.88.27.14.45.2.52.32.07.11.07.66-.17 1.33z"/></svg>
                            Tanya via WhatsApp
                        </a>
                    </div>
                    <dl class="mt-10 grid grid-cols-3 gap-4 max-w-md text-sm">
                        <div>
                            <dt class="text-stone-500">Template</dt>
                            <dd class="text-xl sm:text-2xl font-serif text-stone-900 whitespace-nowrap">4 tema</dd>
                        </div>
                        <div>
                            <dt class="text-stone-500">Siap dalam</dt>
                            <dd class="text-xl sm:text-2xl font-serif text-stone-900 whitespace-nowrap">1x24 jam</dd>
                        </div>
                        <div>
                            <dt class="text-stone-500">Mulai</dt>
                            <dd class="text-xl sm:text-2xl font-serif text-stone-900 whitespace-nowrap">{{ $packages[0]['price'] }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Mockup HP -->
                <div class="relative flex justify-center md:justify-end">
                    <div class="absolute -z-10 w-80 h-80 md:w-96 md:h-96 rounded-full bg-gold-100 blur-3xl opacity-70 top-10 right-10"></div>
                    <div class="w-64 md:w-72 rounded-[2.5rem] bg-stone-900 p-3 shadow-2xl rotate-2">
                        <div class="rounded-[2rem] overflow-hidden bg-white">
                            <div class="bg-gradient-to-br from-primary-700 via-primary-600 to-primary-400 text-white text-center px-6 pt-12 pb-10">
                                <p class="text-[10px] tracking-[0.3em] uppercase opacity-80 mb-3">The Wedding of</p>
                                <p class="font-script text-4xl leading-tight">Rina &amp; Dimas</p>
                                <p class="text-xs opacity-90 mt-3">Sabtu, 14 Februari 2027</p>
                                <div class="mt-5 grid grid-cols-4 gap-2 text-center">
                                    <div class="bg-white/15 rounded-lg py-2"><p class="font-semibold">108</p><p class="text-[9px] opacity-80">Hari</p></div>
                                    <div class="bg-white/15 rounded-lg py-2"><p class="font-semibold">12</p><p class="text-[9px] opacity-80">Jam</p></div>
                                    <div class="bg-white/15 rounded-lg py-2"><p class="font-semibold">45</p><p class="text-[9px] opacity-80">Menit</p></div>
                                    <div class="bg-white/15 rounded-lg py-2"><p class="font-semibold">09</p><p class="text-[9px] opacity-80">Detik</p></div>
                                </div>
                            </div>
                            <div class="px-5 py-5 space-y-3">
                                <p class="text-[11px] text-stone-500">Kepada Yth.</p>
                                <p class="font-serif text-stone-900 -mt-2">Bapak/Ibu Ahmad</p>
                                <div class="rounded-xl border border-stone-200 p-3">
                                    <p class="text-[11px] text-stone-500 mb-2">Konfirmasi kehadiran</p>
                                    <div class="flex gap-2">
                                        <span class="flex-1 text-center text-[11px] py-1.5 rounded-lg bg-primary-700 text-white">Hadir</span>
                                        <span class="flex-1 text-center text-[11px] py-1.5 rounded-lg border border-stone-200 text-stone-600">Tidak hadir</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute bottom-6 left-0 md:left-6 bg-white rounded-2xl shadow-xl px-4 py-3 -rotate-2">
                        <p class="text-[11px] text-stone-500">RSVP masuk hari ini</p>
                        <p class="font-serif text-xl text-stone-900">+24 tamu hadir</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Fitur -->
        <section id="fitur" class="scroll-mt-16 bg-white border-y border-stone-200">
            <div class="max-w-6xl mx-auto px-4 py-20">
                <div class="max-w-2xl mb-12">
                    <h2 class="text-3xl md:text-4xl text-stone-900 mb-4 text-balance">Semua yang tamu perlukan, dalam satu halaman</h2>
                    <p class="text-stone-600 leading-relaxed">Setiap template dilengkapi fitur berikut. Anda cukup mengirim data, kami yang menyiapkan.</p>
                </div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-10">
                    @foreach ([
                        ['RSVP online', 'Tamu mengonfirmasi hadir atau tidak, lengkap dengan jumlah orang. Rekap otomatis di dashboard.', 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['Peta lokasi', 'Tombol langsung ke Google Maps supaya tamu tidak tersesat menuju gedung.', 'M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z'],
                        ['Hitung mundur', 'Countdown ke hari H yang membuat tamu ingat tanggalnya.', 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['Galeri foto', 'Tampilkan foto prewedding dalam galeri yang nyaman dilihat di HP.', 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
                        ['Amplop digital', 'Nomor rekening dan e-wallet dengan tombol salin, untuk tamu yang berhalangan hadir.', 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z'],
                        ['Musik & ucapan', 'Musik latar pilihan Anda dan buku tamu untuk doa serta ucapan selamat.', 'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3'],
                    ] as [$title, $desc, $icon])
                        <div class="flex gap-4">
                            <div class="shrink-0 w-11 h-11 rounded-xl bg-primary-50 text-primary-700 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-sans font-semibold text-stone-900 mb-1">{{ $title }}</h3>
                                <p class="text-sm text-stone-600 leading-relaxed">{{ $desc }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Template -->
        <section id="template" class="scroll-mt-16 max-w-6xl mx-auto px-4 py-20">
            <div class="flex flex-wrap items-end justify-between gap-4 mb-12">
                <div class="max-w-2xl">
                    <h2 class="text-3xl md:text-4xl text-stone-900 mb-4">Pilih tema yang paling Anda banget</h2>
                    <p class="text-stone-600 leading-relaxed">Buka demonya untuk melihat undangan seperti yang akan diterima tamu.</p>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Template 1 -->
                <a href="{{ route('template1.index') }}" class="group block">
                    <div class="aspect-[3/4] rounded-2xl overflow-hidden bg-gradient-to-br from-primary-600 via-primary-500 to-primary-400 text-white flex flex-col items-center justify-center text-center p-6 transition-transform duration-300 group-hover:-translate-y-1 group-hover:shadow-xl">
                        <p class="text-[10px] tracking-[0.3em] uppercase opacity-80 mb-2">The Wedding of</p>
                        <p class="font-script text-4xl">Bride &amp; Groom</p>
                        <div class="w-16 h-px bg-white/50 my-4"></div>
                        <p class="text-xs opacity-90">Modern &middot; Glassmorphism</p>
                    </div>
                    <div class="pt-4">
                        <div class="flex flex-wrap items-baseline justify-between gap-x-3">
                            <h3 class="text-xl text-stone-900">Elegant Modern</h3>
                            <span class="text-sm text-primary-700 group-hover:underline">Lihat demo &rarr;</span>
                        </div>
                        <p class="text-sm text-stone-600 mt-1">Animasi halus dan tampilan bersih untuk pasangan modern.</p>
                    </div>
                </a>

                <!-- Template 2 -->
                <a href="{{ route('template2.index') }}" class="group block">
                    <div class="aspect-[3/4] rounded-2xl overflow-hidden bg-gradient-to-br from-rose-500 via-pink-500 to-rose-400 text-white flex flex-col items-center justify-center text-center p-6 transition-transform duration-300 group-hover:-translate-y-1 group-hover:shadow-xl">
                        <svg class="w-10 h-10 mb-3 opacity-80" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                        <p class="font-script text-4xl">Couple Names</p>
                        <p class="text-xs opacity-90 mt-4">#SaveTheDate</p>
                    </div>
                    <div class="pt-4">
                        <div class="flex flex-wrap items-baseline justify-between gap-x-3">
                            <h3 class="text-xl text-stone-900">Classic Romantic</h3>
                            <span class="text-sm text-rose-700 group-hover:underline">Lihat demo &rarr;</span>
                        </div>
                        <p class="text-sm text-stone-600 mt-1">Ornamen floral dan warna lembut, lengkap dengan love story.</p>
                    </div>
                </a>

                <!-- Template 3 -->
                <a href="{{ route('template3.index') }}" class="group block">
                    <div class="aspect-[3/4] rounded-2xl overflow-hidden bg-gradient-to-br from-brown-600 via-brown-500 to-brown-400 text-white flex flex-col items-center justify-center text-center p-6 transition-transform duration-300 group-hover:-translate-y-1 group-hover:shadow-xl">
                        <svg class="w-10 h-10 mb-3 opacity-80" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17 8C8 10 5.9 16.17 3.82 21.34l-.59 1.66 1.66-.59C10.83 20.1 17 18 19 9l1-4-4 1-2 2 2 2c-1 2.5-3.5 5-6.5 6.5l1.5-4.5L17 8z"/></svg>
                        <p class="font-script text-4xl">Couple Names</p>
                        <p class="text-xs opacity-90 mt-4">Rustic &middot; Garden</p>
                    </div>
                    <div class="pt-4">
                        <div class="flex flex-wrap items-baseline justify-between gap-x-3">
                            <h3 class="text-xl text-stone-900">Elegant Nature</h3>
                            <span class="text-sm text-brown-700 group-hover:underline">Lihat demo &rarr;</span>
                        </div>
                        <p class="text-sm text-stone-600 mt-1">Nuansa alam dan warna earthy untuk acara outdoor.</p>
                    </div>
                </a>

                <!-- Template 4 -->
                <a href="{{ route('template4.index') }}" class="group block">
                    <div class="aspect-[3/4] rounded-2xl overflow-hidden bg-gradient-to-br from-emerald-700 via-emerald-600 to-emerald-500 text-white flex flex-col items-center justify-center text-center p-6 transition-transform duration-300 group-hover:-translate-y-1 group-hover:shadow-xl">
                        <p class="text-sm opacity-90 mb-3">بِسْمِ اللَّهِ</p>
                        <p class="font-script text-4xl">Couple Names</p>
                        <p class="text-xs opacity-90 mt-4">Adat Bugis &middot; Makassar</p>
                    </div>
                    <div class="pt-4">
                        <div class="flex flex-wrap items-baseline justify-between gap-x-3">
                            <h3 class="text-xl text-stone-900">Bugis Emerald</h3>
                            <span class="text-sm text-emerald-700 group-hover:underline">Lihat demo &rarr;</span>
                        </div>
                        <p class="text-sm text-stone-600 mt-1">Ornamen khas Bugis dengan sentuhan islami.</p>
                    </div>
                </a>
            </div>
        </section>

        <!-- Cara pesan -->
        <section class="bg-stone-900 text-stone-100">
            <div class="max-w-6xl mx-auto px-4 py-20">
                <h2 class="text-3xl md:text-4xl text-white mb-12">Tiga langkah sampai undangan terkirim</h2>
                <ol class="grid md:grid-cols-3 gap-10">
                    <li>
                        <p class="font-serif text-5xl text-gold-400 mb-4">1</p>
                        <h3 class="font-sans font-semibold text-white mb-2">Pilih template & paket</h3>
                        <p class="text-stone-400 leading-relaxed">Lihat demo, pilih tema yang cocok, lalu hubungi kami lewat WhatsApp.</p>
                    </li>
                    <li>
                        <p class="font-serif text-5xl text-gold-400 mb-4">2</p>
                        <h3 class="font-sans font-semibold text-white mb-2">Kirim data & foto</h3>
                        <p class="text-stone-400 leading-relaxed">Nama mempelai, orang tua, jadwal acara, lokasi, dan foto prewedding.</p>
                    </li>
                    <li>
                        <p class="font-serif text-5xl text-gold-400 mb-4">3</p>
                        <h3 class="font-sans font-semibold text-white mb-2">Bagikan ke tamu</h3>
                        <p class="text-stone-400 leading-relaxed">Undangan siap dalam 1x24 jam. Pantau RSVP dari dashboard admin Anda.</p>
                    </li>
                </ol>
            </div>
        </section>

        <!-- Harga -->
        <section id="harga" class="scroll-mt-16 max-w-6xl mx-auto px-4 py-20">
            <div class="max-w-2xl mb-12">
                <h2 class="text-3xl md:text-4xl text-stone-900 mb-4">Harga sekali bayar, tanpa biaya bulanan</h2>
                <p class="text-stone-600 leading-relaxed">Semua paket bisa memakai template mana pun.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-6 items-start">
                @foreach ($packages as $package)
                    <div class="rounded-2xl p-8 {{ $package['featured'] ? 'bg-primary-800 text-white shadow-xl md:-translate-y-2' : 'bg-white border border-stone-200' }}">
                        <div class="flex items-center justify-between mb-1">
                            <h3 class="font-sans text-lg font-semibold {{ $package['featured'] ? 'text-white' : 'text-stone-900' }}">{{ $package['name'] }}</h3>
                            @if ($package['featured'])
                                <span class="text-xs px-3 py-1 rounded-full bg-gold-400 text-stone-900 font-medium">Favorit</span>
                            @endif
                        </div>
                        <p class="text-sm {{ $package['featured'] ? 'text-primary-100' : 'text-stone-500' }} mb-6">{{ $package['note'] }}</p>
                        <p class="font-serif text-4xl mb-8 {{ $package['featured'] ? 'text-white' : 'text-stone-900' }}">{{ $package['price'] }}</p>
                        <ul class="space-y-3 mb-8 text-sm">
                            @foreach ($package['features'] as $feature)
                                <li class="flex gap-3">
                                    <svg class="w-5 h-5 shrink-0 {{ $package['featured'] ? 'text-gold-400' : 'text-primary-700' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    <span class="{{ $package['featured'] ? 'text-primary-50' : 'text-stone-700' }}">{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <a href="https://wa.me/{{ config('landing.whatsapp') }}?text={{ rawurlencode('Halo, saya ingin memesan undangan paket ' . $package['name'] . '.') }}"
                           target="_blank" rel="noopener"
                           class="block text-center py-3 rounded-full font-medium transition-colors {{ $package['featured'] ? 'bg-white text-primary-800 hover:bg-primary-50' : 'border border-stone-300 text-stone-800 hover:border-primary-700 hover:text-primary-700' }}">
                            Pilih {{ $package['name'] }}
                        </a>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Testimoni (tampil hanya jika diisi di config/landing.php) -->
        @if (count($testimonials))
            <section class="bg-white border-y border-stone-200">
                <div class="max-w-6xl mx-auto px-4 py-20">
                    <h2 class="text-3xl md:text-4xl text-stone-900 mb-12">Kata mereka yang sudah memakai</h2>
                    <div class="grid md:grid-cols-3 gap-8">
                        @foreach ($testimonials as $testimonial)
                            <figure class="border-l-2 border-gold-400 pl-6">
                                <blockquote class="text-stone-700 leading-relaxed mb-4">&ldquo;{{ $testimonial['quote'] }}&rdquo;</blockquote>
                                <figcaption class="text-sm">
                                    <span class="font-semibold text-stone-900">{{ $testimonial['name'] }}</span>
                                    <span class="text-stone-500">&middot; {{ $testimonial['city'] }}</span>
                                </figcaption>
                            </figure>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- FAQ -->
        <section id="faq" class="scroll-mt-16 max-w-3xl mx-auto px-4 py-20">
            <h2 class="text-3xl md:text-4xl text-stone-900 mb-10">Pertanyaan yang sering ditanyakan</h2>
            <div class="divide-y divide-stone-200 border-y border-stone-200">
                @foreach ($faqs as $faq)
                    <details class="group py-5">
                        <summary class="flex items-center justify-between gap-4 cursor-pointer list-none font-medium text-stone-900">
                            {{ $faq['q'] }}
                            <svg class="w-5 h-5 shrink-0 text-stone-400 transition-transform group-open:rotate-45" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
                        </summary>
                        <p class="mt-3 text-stone-600 leading-relaxed">{{ $faq['a'] }}</p>
                    </details>
                @endforeach
            </div>
        </section>

        <!-- CTA penutup -->
        <section class="max-w-6xl mx-auto px-4 pb-20">
            <div class="rounded-3xl bg-gradient-to-br from-primary-800 to-primary-600 text-white px-8 py-14 md:px-14 flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div>
                    <h2 class="text-3xl md:text-4xl mb-3 text-balance">Siap menyebar kabar bahagia?</h2>
                    <p class="text-primary-100">Ceritakan tanggal dan tema acara Anda, kami bantu pilihkan template.</p>
                </div>
                <a href="{{ $waLink }}" target="_blank" rel="noopener"
                   class="shrink-0 inline-flex items-center justify-center px-8 py-4 rounded-full bg-white text-primary-800 font-medium hover:bg-primary-50 transition-colors">
                    Chat via WhatsApp
                </a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="border-t border-stone-200">
        <div class="max-w-6xl mx-auto px-4 py-10 flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-stone-500">
            <p><span class="font-script text-xl text-primary-800">{{ $brand }}</span> &middot; Undangan pernikahan digital</p>
            <div class="flex items-center gap-6">
                <a href="#template" class="hover:text-primary-700">Template</a>
                <a href="#harga" class="hover:text-primary-700">Harga</a>
                <a href="{{ route('login') }}" class="hover:text-primary-700">Login Admin</a>
                <a href="https://saweria.co/yusril713" target="_blank" rel="noopener noreferrer" class="hover:text-primary-700">Traktir Kopi</a>
            </div>
        </div>
    </footer>
</body>
</html>
