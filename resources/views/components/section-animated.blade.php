<!-- Section with Animation Component -->
@props([
    'id' => '',
    'bgVariant' => 'default',
    'bgImage' => null,
    'overlay' => 'dark',
    'animation' => 'fade-in-up',
    'delay' => '0',
    'class' => ''
])

@php
$animations = [
    'fade-in-up' => 'opacity-0 animate-on-scroll',
    'fade-in-down' => 'opacity-0 animate-on-scroll',
    'fade-in-left' => 'opacity-0 animate-on-scroll',
    'fade-in-right' => 'opacity-0 animate-on-scroll',
    'zoom-in' => 'opacity-0 animate-on-scroll',
    'none' => '',
];
$animationClass = $animations[$animation] ?? $animations['fade-in-up'];
@endphp

<section
    id="{{ $id }}"
    class="relative overflow-hidden {{ $class }}"
    data-animation="{{ $animation }}"
    data-delay="{{ $delay }}"
>
    <!-- Background (Gradient or Image) -->
    <x-animated-background
        :variant="$bgVariant"
        :image="$bgImage"
        :overlay="$overlay"
    />

    <!-- Content Slot -->
    <div class="{{ $animationClass }}" style="animation-delay: {{ $delay }}ms;">
        {{ $slot }}
    </div>
</section>
