<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @hasSection('meta')
        @yield('meta')
    @else
        <meta name="description" content="@yield('meta_description', 'Undangan Pernikahan Digital')">
        <title>@yield('title', 'Undangan Pernikahan')</title>
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 overflow-x-hidden">

    @yield('content')

    @stack('scripts')
</body>
</html>
