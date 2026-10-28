@extends('admin.layouts.app')

@section('title', 'Settings')
@section('subtitle', 'Manage your admin settings')

@section('content')
<div class="max-w-4xl">
    <!-- Settings Cards -->
    <div class="space-y-6">
        <!-- Event Settings -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800">Event Settings</h3>
                <a href="{{ route('admin.event-settings.edit') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-xl text-sm font-medium transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Event
                </a>
            </div>

            @if($event)
            <div class="space-y-4">
                <div class="flex flex-wrap items-center justify-between gap-2 py-4 border-b border-gray-100">
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Invitation Link</h4>
                        <p class="text-sm text-gray-500">{{ \App\Models\Event::TEMPLATES[$event->template] ?? $event->template }} template</p>
                    </div>
                    <a href="{{ $event->publicUrl() }}" target="_blank" class="text-sm text-primary-600 hover:text-primary-700 break-all">{{ $event->publicUrl() }}</a>
                </div>

                <div class="flex items-center justify-between py-4 border-b border-gray-100">
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Event Type</h4>
                        <p class="text-sm text-gray-500">Type of invitation</p>
                    </div>
                    <span class="px-3 py-1 bg-primary-100 text-primary-700 text-sm font-medium rounded-full capitalize">{{ $event->event_type }}</span>
                </div>

                <div class="flex items-center justify-between py-4 border-b border-gray-100">
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Event Title</h4>
                        <p class="text-sm text-gray-500">Main title of the event</p>
                    </div>
                    <span class="text-sm text-gray-700">{{ $event->event_title ?? '-' }}</span>
                </div>

                <div class="flex items-center justify-between py-4 border-b border-gray-100">
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Event Date</h4>
                        <p class="text-sm text-gray-500">Date of the event</p>
                    </div>
                    <span class="text-sm text-gray-700">{{ $event->event_date ? $event->event_date->format('d F Y') : '-' }}</span>
                </div>

                <div class="flex items-center justify-between py-4 border-b border-gray-100">
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Bride & Groom</h4>
                        <p class="text-sm text-gray-500">Names of the couple</p>
                    </div>
                    <span class="text-sm text-gray-700">{{ $event->bride_name ?? '-' }} & {{ $event->groom_name ?? '-' }}</span>
                </div>

                <div class="flex items-center justify-between py-4">
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Venue</h4>
                        <p class="text-sm text-gray-500">Event location</p>
                    </div>
                    <span class="text-sm text-gray-700 text-right">{{ $event->venue_name ?? '-' }}<br><small class="text-gray-500">{{ $event->venue_city ?? '' }}</small></span>
                </div>
            </div>
            @else
            <div class="text-center py-8">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <p class="text-gray-500 mb-4">No event configured yet</p>
                <a href="{{ route('admin.event-settings.edit') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-medium transition-colors">
                    Create Event
                </a>
            </div>
            @endif

            <div class="mt-6 pt-6 border-t border-gray-100">
                <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    View Website
                </a>
            </div>
        </div>

        <!-- Templates -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">Available Templates</h3>

            <div class="grid md:grid-cols-3 gap-4">
                <a href="{{ route('template1.index') }}" target="_blank" class="group border-2 border-gray-200 hover:border-primary-500 rounded-xl p-4 transition-all">
                    <div class="aspect-video bg-gradient-to-br from-primary-600 to-primary-400 rounded-lg mb-3"></div>
                    <h4 class="font-medium text-gray-900 group-hover:text-primary-600 transition-colors">Template 1</h4>
                    <p class="text-sm text-gray-500">Elegant Modern</p>
                </a>

                <a href="{{ route('template2.index') }}" target="_blank" class="group border-2 border-gray-200 hover:border-rose-500 rounded-xl p-4 transition-all">
                    <div class="aspect-video bg-gradient-to-br from-rose-500 to-pink-400 rounded-lg mb-3"></div>
                    <h4 class="font-medium text-gray-900 group-hover:text-rose-600 transition-colors">Template 2</h4>
                    <p class="text-sm text-gray-500">Classic Romantic</p>
                </a>

                <a href="{{ route('template3.index') }}" target="_blank" class="group border-2 border-gray-200 hover:border-brown-500 rounded-xl p-4 transition-all">
                    <div class="aspect-video bg-gradient-to-br from-brown-600 to-brown-400 rounded-lg mb-3"></div>
                    <h4 class="font-medium text-gray-900 group-hover:text-brown-600 transition-colors">Template 3</h4>
                    <p class="text-sm text-gray-500">Elegant Nature</p>
                </a>
            </div>
        </div>

        <!-- Account Settings -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">Account Settings</h3>

            <div class="space-y-4">
                <div class="flex items-center justify-between py-4 border-b border-gray-100">
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Account Email</h4>
                        <p class="text-sm text-gray-500">{{ auth()->user()->email ?? 'admin@example.com' }}</p>
                    </div>
                </div>

                <div class="flex items-center justify-between py-4">
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Account Name</h4>
                        <p class="text-sm text-gray-500">{{ auth()->user()->name ?? 'Administrator' }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- System Information -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">System Information</h3>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Laravel Version</p>
                    <p class="text-gray-900 font-medium">{{ app()->version() }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 mb-1">PHP Version</p>
                    <p class="text-gray-900 font-medium">{{ PHP_VERSION }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 mb-1">Environment</p>
                    <p class="text-gray-900 font-medium">{{ app()->environment() }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 mb-1">Debug Mode</p>
                    <p class="text-gray-900 font-medium">{{ config('app.debug') ? 'Enabled' : 'Disabled' }}</p>
                </div>
            </div>
        </div>

        <!-- Support Development -->
        <div class="bg-gradient-to-r from-amber-500 to-orange-500 rounded-2xl shadow-lg p-6 border border-orange-200">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Support Development</h3>
                        <p class="text-sm text-white/90">Dukung pengembangan fitur-fitur baru</p>
                    </div>
                </div>
            </div>

            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 mb-4">
                <p class="text-white text-sm leading-relaxed">
                    Jika aplikasi ini bermanfaat untuk Anda, pertimbangkan untuk memberikan dukungan. Kontribusi Anda akan membantu pengembangan fitur-fitur baru dan pemeliharaan sistem. 🙏
                </p>
            </div>

            <a href="https://saweria.co/yusril713" target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center justify-center w-full px-6 py-3 bg-white hover:bg-gray-50 text-orange-600 font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                </svg>
                Buy Me a Coffee via Saweria
            </a>
        </div>
    </div>
</div>
@endsection
