{{--
    Judul + preview link (Open Graph) untuk halaman undangan.
    Butuh: $event. Opsional: $invitation (link personal) -> nama tamu ikut di deskripsi.
--}}
@php
    $shareGuest = isset($invitation) && $invitation ? $invitation->name : request()->query('to');
    $shareGuest = is_string($shareGuest) ? \Illuminate\Support\Str::limit(trim($shareGuest), 60, '') : null;
    $shareTitle = $event->shareTitle();
    $shareDescription = $event->shareDescription($shareGuest ?: null);
    $shareImage = \App\Support\ShareImage::for($event);
@endphp
<title>{{ $shareTitle }}</title>
<meta name="description" content="{{ $shareDescription }}">
{{-- Undangan bersifat pribadi: jangan masuk hasil pencarian Google --}}
<meta name="robots" content="noindex, nofollow">
<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ config('landing.brand') }}">
<meta property="og:locale" content="id_ID">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $shareTitle }}">
<meta property="og:description" content="{{ $shareDescription }}">
<meta property="og:image" content="{{ $shareImage['url'] }}">
<meta property="og:image:type" content="image/jpeg">
<meta property="og:image:width" content="{{ $shareImage['width'] }}">
<meta property="og:image:height" content="{{ $shareImage['height'] }}">
<meta property="og:image:alt" content="{{ $shareTitle }}">
<meta name="twitter:card" content="summary_large_image">
