<!-- Animated Background Component -->
@props(['variant' => 'default', 'image' => null, 'overlay' => 'dark'])

@php
$variants = [
    'default' => 'from-primary-600 via-primary-500 to-primary-400',
    'gold' => 'from-gold-600 via-gold-500 to-gold-400',
    'rose' => 'from-rose-600 via-rose-500 to-rose-400',
    'purple' => 'from-purple-600 via-purple-500 to-purple-400',
    'light' => 'from-gray-50 via-white to-gray-50',
];
$gradientClass = $variants[$variant] ?? $variants['default'];

$overlays = [
    'dark' => 'bg-black/40',
    'light' => 'bg-white/40',
    'primary' => 'bg-primary-900/40',
    'gold' => 'bg-gold-900/40',
    'none' => '',
];
$overlayClass = $overlays[$overlay] ?? $overlays['dark'];
@endphp

<div class="absolute inset-0 overflow-hidden">
    @if($image)
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat animate-ken-burns"
         style="background-image: url('{{ $image }}');"></div>

    <!-- Image Overlay -->
    @if($overlayClass)
    <div class="absolute inset-0 {{ $overlayClass }}"></div>
    @endif
    @else
    <!-- Gradient Background -->
    <div class="absolute inset-0 bg-gradient-to-br {{ $gradientClass }} animate-gradient"></div>
    @endif

    <!-- Floating Blobs -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-0 -left-4 w-72 h-72 bg-white rounded-full mix-blend-multiply filter blur-xl animate-blob"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-yellow-200 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-4000"></div>
        <div class="absolute bottom-20 right-20 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-6000"></div>
    </div>

    <!-- Geometric Shapes -->
    <div class="absolute inset-0 opacity-10">
        <svg class="absolute top-10 left-10 w-20 h-20 text-white animate-float" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
        </svg>
        <svg class="absolute top-1/4 right-10 w-16 h-16 text-white animate-float animation-delay-2000" fill="currentColor" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"></circle>
        </svg>
        <svg class="absolute bottom-1/4 left-1/4 w-24 h-24 text-white animate-float animation-delay-4000" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
        </svg>
    </div>

    <!-- Sparkle Effect -->
    <div class="absolute inset-0">
        @for($i = 0; $i < 20; $i++)
        <div class="absolute w-1 h-1 bg-white rounded-full animate-twinkle"
             style="top: {{ rand(0, 100) }}%; left: {{ rand(0, 100) }}%; animation-delay: {{ $i * 0.1 }}s;"></div>
        @endfor
    </div>
</div>
