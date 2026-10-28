@extends('admin.layouts.app')

@section('title', 'Guest Details')
@section('subtitle', 'View guest information')

@section('content')
<div class="max-w-4xl">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.guests') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Guests
        </a>
    </div>

    <!-- Guest Info Card -->
    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
        <div class="flex items-start justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $guest->name }}</h2>
                <p class="text-gray-500">Registered on {{ $guest->created_at->format('F d, Y \a\t H:i') }}</p>
            </div>

            <!-- Attendance Badge -->
            <div>
                @if($guest->attendance === 'hadir')
                <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    Hadir
                </span>
                @elseif($guest->attendance === 'tidak_hadir')
                <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                    Tidak Hadir
                </span>
                @else
                <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                    Masih Ragu
                </span>
                @endif
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Contact Information -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Contact Information</h3>
                <div class="space-y-3">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="text-gray-900">{{ $guest->email ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-500">Number of Guests</p>
                            <p class="text-gray-900">{{ $guest->number_of_guests ?? 1 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RSVP Details -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">RSVP Details</h3>
                <div class="space-y-3">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-500">Attendance Status</p>
                            <p class="text-gray-900 capitalize">{{ ucfirst(str_replace('_', ' ', $guest->attendance ?? 'unknown')) }}</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-500">Registered Date</p>
                            <p class="text-gray-900">{{ $guest->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Message -->
        @if($guest->message)
        <div class="mt-6 pt-6 border-t border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Message</h3>
            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-gray-700 leading-relaxed">{{ $guest->message }}</p>
            </div>
        </div>
        @endif

        <!-- Actions -->
        <div class="mt-6 pt-6 border-t border-gray-200 flex gap-3">
            <form method="POST" action="{{ route('admin.guests.delete', $guest->id) }}" onsubmit="return confirm('Are you sure you want to delete this guest?')" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl font-medium transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Delete Guest
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
