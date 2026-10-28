<!-- Decorative Ornament Component -->
@props(['position' => 'top-left', 'type' => 'floral', 'color' => 'gold'])

@php
$positions = [
    'top-left' => 'top-0 left-0',
    'top-right' => 'top-0 right-0',
    'bottom-left' => 'bottom-0 left-0',
    'bottom-right' => 'bottom-0 right-0',
];
$positionClass = $positions[$position] ?? $positions['top-left'];

$colors = [
    'gold' => 'text-gold-300/20',
    'primary' => 'text-primary-300/20',
    'white' => 'text-white/10',
];
$colorClass = $colors[$color] ?? $colors['gold'];
@endphp

<div class="absolute {{ $positionClass }} pointer-events-none z-0">
    @if($type === 'floral')
    <!-- Floral Ornament -->
    <svg class="w-32 h-32 md:w-48 md:h-48 {{ $colorClass }} transform {{ str_contains($position, 'right') ? 'scale-x-[-1]' : '' }} {{ str_contains($position, 'bottom') ? 'scale-y-[-1]' : '' }}" viewBox="0 0 200 200" fill="currentColor">
        <path d="M100,50 Q120,40 140,50 Q150,70 140,90 Q120,100 100,90 Q80,100 60,90 Q50,70 60,50 Q80,40 100,50 Z" opacity="0.3"/>
        <path d="M100,70 Q110,65 120,70 Q125,80 120,90 Q110,95 100,90 Q90,95 80,90 Q75,80 80,70 Q90,65 100,70 Z" opacity="0.5"/>
        <circle cx="100" cy="80" r="8" opacity="0.7"/>
        <path d="M100,90 L105,120 Q100,125 95,120 Z" opacity="0.4"/>
        <path d="M90,95 L70,110 Q65,105 70,100 Z" opacity="0.4"/>
        <path d="M110,95 L130,110 Q135,105 130,100 Z" opacity="0.4"/>
    </svg>
    @elseif($type === 'geometric')
    <!-- Geometric Pattern -->
    <svg class="w-24 h-24 md:w-40 md:h-40 {{ $colorClass }}" viewBox="0 0 100 100" fill="none" stroke="currentColor">
        <circle cx="50" cy="50" r="40" stroke-width="0.5" opacity="0.3"/>
        <circle cx="50" cy="50" r="30" stroke-width="0.5" opacity="0.4"/>
        <circle cx="50" cy="50" r="20" stroke-width="0.5" opacity="0.5"/>
        <line x1="10" y1="50" x2="90" y2="50" stroke-width="0.5" opacity="0.3"/>
        <line x1="50" y1="10" x2="50" y2="90" stroke-width="0.5" opacity="0.3"/>
        <line x1="20" y1="20" x2="80" y2="80" stroke-width="0.5" opacity="0.3"/>
        <line x1="80" y1="20" x2="20" y2="80" stroke-width="0.5" opacity="0.3"/>
    </svg>
    @elseif($type === 'hearts')
    <!-- Hearts Pattern -->
    <svg class="w-28 h-28 md:w-44 md:h-44 {{ $colorClass }}" viewBox="0 0 150 150" fill="currentColor">
        <path d="M75,140 C75,140 20,100 20,65 C20,45 35,35 50,35 C60,35 70,40 75,50 C80,40 90,35 100,35 C115,35 130,45 130,65 C130,100 75,140 75,140 Z" opacity="0.2"/>
        <path d="M75,110 C75,110 40,85 40,62 C40,50 48,44 57,44 C63,44 69,47 75,55 C81,47 87,44 93,44 C102,44 110,50 110,62 C110,85 75,110 75,110 Z" opacity="0.3"/>
    </svg>
    @endif
</div>
