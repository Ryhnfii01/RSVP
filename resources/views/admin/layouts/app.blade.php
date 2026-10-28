<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Mobile Overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-40 hidden md:hidden"></div>

        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-white border-r border-gray-200 flex flex-col fixed h-screen -translate-x-full md:translate-x-0 transition-transform duration-300 z-50">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-10 h-10 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                        </svg>
                        <div class="ml-3">
                            <h1 class="text-lg font-bold text-gray-800">Wedding</h1>
                            <p class="text-xs text-gray-500">Admin Panel</p>
                        </div>
                    </div>
                    <!-- Close button for mobile -->
                    <button id="close-sidebar" class="md:hidden text-gray-500 hover:text-gray-700 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 overflow-y-auto">
                <!-- Acara yang dikelola -->
                <div class="mb-4 px-1">
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400 mb-2">Acara</p>
                    @if (auth()->user()->isSuperAdmin() && $selectableEvents->count() > 1)
                        <form method="POST" action="{{ route('admin.switch-event') }}">
                            @csrf
                            <label for="event_id" class="sr-only">Pilih acara</label>
                            <select id="event_id" name="event_id" onchange="this.form.submit()" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                @foreach ($selectableEvents as $option)
                                    <option value="{{ $option->id }}" @selected($managedEvent?->id === $option->id)>{{ $option->coupleNames() }}</option>
                                @endforeach
                            </select>
                        </form>
                    @elseif ($managedEvent)
                        <p class="text-sm font-medium text-gray-800">{{ $managedEvent->coupleNames() }}</p>
                        <a href="{{ $managedEvent->publicUrl() }}" target="_blank" class="text-xs text-primary-600 hover:text-primary-700 break-all">/u/{{ $managedEvent->slug }}</a>
                    @else
                        <p class="text-sm text-gray-500">Belum ada acara. Isi data di Settings.</p>
                    @endif
                </div>

                <div class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('admin.dashboard*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }} transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Dashboard
                    </a>

                    <a href="{{ route('admin.guests') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('admin.guests*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }} transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Guests
                    </a>

                    <a href="{{ route('admin.invitations.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('admin.invitations.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }} transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Invitations
                    </a>

                    <a href="{{ route('admin.wishes.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('admin.wishes.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }} transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                        Wishes
                        @if ($pendingWishes > 0)
                            <span class="ml-auto min-w-[1.5rem] px-1.5 py-0.5 rounded-full bg-amber-500 text-white text-xs text-center tabular-nums" aria-label="{{ $pendingWishes }} waiting for approval">{{ $pendingWishes }}</span>
                        @endif
                    </a>

                    <a href="{{ route('admin.gallery.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('admin.gallery.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }} transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Gallery
                    </a>

                    <a href="{{ route('admin.settings') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('admin.settings*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }} transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Settings
                    </a>
                </div>

                @if (auth()->user()->isSuperAdmin())
                <div class="mt-6 pt-6 border-t border-gray-200 space-y-1">
                    <p class="px-4 mb-2 text-xs font-medium uppercase tracking-wide text-gray-400">Super Admin</p>
                    <a href="{{ route('admin.events.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('admin.events.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }} transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Events
                    </a>
                    <a href="{{ route('admin.clients.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('admin.clients.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }} transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Clients
                    </a>
                </div>
                @endif

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <a href="{{ route('home') }}" target="_blank" class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-xl transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        View Website
                    </a>

                    <a href="{{ route('admin.account.edit') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('admin.account.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }} transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                        My Account
                        @if (auth()->user()->must_change_password)
                            <span class="ml-auto w-2 h-2 rounded-full bg-amber-500" aria-label="Temporary password"></span>
                        @endif
                    </a>
                </div>
            </nav>

            <!-- User Section -->
            <div class="p-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center">
                            <span class="text-primary-600 font-semibold">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</span>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-800">{{ auth()->user()->name ?? 'Admin' }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->isSuperAdmin() ? 'Super Admin' : 'Admin Acara' }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-gray-600 transition-colors" title="Logout">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 md:ml-64 min-w-0">
            <!-- Top Bar -->
            <header class="bg-white border-b border-gray-200 sticky top-0 z-10">
                <div class="px-4 md:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <!-- Hamburger Menu Button (Mobile Only) -->
                            <button id="menu-toggle" class="md:hidden mr-4 text-gray-500 hover:text-gray-700 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            <div>
                                <h2 class="text-xl md:text-2xl font-bold text-gray-800">@yield('title', 'Dashboard')</h2>
                                <p class="text-xs md:text-sm text-gray-500 mt-1">@yield('subtitle', 'Welcome back!')</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <!-- Notifications -->
                            <button class="relative p-2 text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                            </button>

                            <!-- Profile -->
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center">
                                    <span class="text-primary-600 font-semibold">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-4 md:p-8">
                <!-- Success Message -->
                @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
                @endif

                <!-- Kredensial client baru (sekali tampil) -->
                @include('admin.partials.credentials')

                <!-- Pengingat password sementara -->
                @if (auth()->user()->must_change_password && ! request()->routeIs('admin.account.*'))
                <div class="mb-6 flex flex-wrap items-center justify-between gap-3 bg-amber-50 border-l-4 border-amber-400 p-4 rounded-lg">
                    <p class="text-sm text-amber-800">You are still using a temporary password. Set your own password to keep your account safe.</p>
                    <a href="{{ route('admin.account.edit') }}" class="px-4 py-2 text-sm font-medium text-amber-900 bg-amber-100 hover:bg-amber-200 rounded-lg">Change password</a>
                </div>
                @endif

                <!-- Error Message -->
                @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <!-- Mobile Sidebar Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const menuToggle = document.getElementById('menu-toggle');
            const closeSidebar = document.getElementById('close-sidebar');

            // Open sidebar
            menuToggle.addEventListener('click', function() {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden'; // Prevent body scroll
            });

            // Close sidebar
            function closeSidebarMenu() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.style.overflow = ''; // Restore body scroll
            }

            closeSidebar.addEventListener('click', closeSidebarMenu);
            overlay.addEventListener('click', closeSidebarMenu);

            // Close sidebar when clicking on a navigation link (mobile only)
            const navLinks = sidebar.querySelectorAll('nav a');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 768) { // md breakpoint
                        closeSidebarMenu();
                    }
                });
            });

            // Close sidebar on window resize to desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    closeSidebarMenu();
                }
            });
        });
    </script>
</body>
</html>
