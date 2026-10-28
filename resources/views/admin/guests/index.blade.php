@extends('admin.layouts.app')

@section('title', 'Manage Guests')
@section('subtitle', 'View and manage all RSVP responses')

@section('content')
<!-- Filters & Actions -->
<div class="bg-white rounded-2xl shadow-lg p-6 mb-6 border border-gray-100">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <!-- Search & Filters -->
        <div class="flex-1 flex flex-col md:flex-row gap-4">
            <form method="GET" action="{{ route('admin.guests') }}" class="flex-1">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by name or email..."
                        class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                    >
                </div>
            </form>

            <form method="GET" action="{{ route('admin.guests') }}">
                <select
                    name="attendance"
                    onchange="this.form.submit()"
                    class="block w-full md:w-48 px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                >
                    <option value="">All Attendance</option>
                    <option value="hadir" {{ request('attendance') === 'hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="tidak_hadir" {{ request('attendance') === 'tidak_hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                    <option value="masih_ragu" {{ request('attendance') === 'masih_ragu' ? 'selected' : '' }}>Masih Ragu</option>
                </select>
            </form>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-3">
            <a href="{{ route('admin.guests.export') }}" class="inline-flex items-center px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Export CSV
            </a>
        </div>
    </div>
</div>

<!-- Guests Table -->
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Attendance</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guests</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($guests as $guest)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ $guest->name }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-500">{{ $guest->email ?? '-' }}</div>
                    </td>
                    <td class="px-6 py-4">
                        @if($guest->attendance === 'hadir')
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Hadir
                        </span>
                        @elseif($guest->attendance === 'tidak_hadir')
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Tidak Hadir
                        </span>
                        @else
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Masih Ragu
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $guest->number_of_guests ?? 1 }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-500 max-w-xs truncate" title="{{ $guest->message }}">
                            {{ $guest->message ?? '-' }}
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $guest->created_at->format('d M Y, H:i') }}
                    </td>
                    <td class="px-6 py-4 text-right text-sm font-medium">
                        <div class="flex items-center justify-end gap-2">
                            <form method="POST" action="{{ route('admin.guests.delete', $guest->id) }}" onsubmit="return confirm('Are you sure you want to delete this guest?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 transition-colors" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <p class="text-gray-500 text-lg mb-2">No guests found</p>
                        <p class="text-gray-400 text-sm">Try adjusting your search or filters</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($guests->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $guests->links() }}
    </div>
    @endif
</div>

<!-- Stats Summary -->
<div class="mt-6 bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
    <div class="flex items-center justify-between text-sm text-gray-600">
        <span>Showing {{ $guests->firstItem() ?? 0 }} to {{ $guests->lastItem() ?? 0 }} of {{ $guests->total() }} guests</span>
        <span>Total: {{ $guests->total() }} RSVP responses</span>
    </div>
</div>
@endsection
