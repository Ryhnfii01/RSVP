<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Wedding Invitation')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('head-extra')

    <style>
        /* Mobile Wrapper - Membuat tampilan seperti HP di desktop */
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        /* Desktop: Tampilan seperti HP di tengah */
        @media (min-width: 768px) {
            .mobile-wrapper {
                max-width: 430px;
                margin: 2rem auto;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                border-radius: 2rem;
                overflow: hidden;
                position: relative;
            }

            /* Optional: Efek bezel HP */
            .mobile-wrapper::before {
                content: '';
                position: absolute;
                top: 1rem;
                left: 50%;
                transform: translateX(-50%);
                width: 120px;
                height: 25px;
                background: rgba(0, 0, 0, 0.8);
                border-radius: 0 0 20px 20px;
                z-index: 9999;
            }

            /* Notch kecil di tengah */
            .mobile-wrapper::after {
                content: '';
                position: absolute;
                top: 1.3rem;
                left: 50%;
                transform: translateX(-50%);
                width: 60px;
                height: 5px;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 10px;
                z-index: 10000;
            }
        }

        /* Mobile: Full screen */
        @media (max-width: 767px) {
            .mobile-wrapper {
                width: 100%;
                min-height: 100vh;
            }

            body {
                background: #fff;
            }
        }

        /* Content wrapper */
        .mobile-content {
            position: relative;
            width: 100%;
            min-height: 100vh;
            overflow-x: hidden;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <div class="mobile-wrapper">
        <div class="mobile-content">
            @yield('content')
        </div>
    </div>
</body>
</html>
