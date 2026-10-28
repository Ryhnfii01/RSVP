@extends('admin.layouts.app')

@section('title', 'Wishes')
@section('subtitle', 'Messages guests send with their RSVP, shown in the guest book')

@section('content')
@php
    $pending = $counts[\App\Models\Guest::WISH_PENDING] ?? 0;
    $total = $counts->sum();
@endphp

<!-- Settings -->
<div class="bg-white rounded-2xl shadow-lg p-6 mb-6 border border-gray-100">
    <form method="POST" action="{{ route('admin.wishes.settings') }}" class="flex flex-wrap items-center justify-between gap-4">
        @csrf
        @method('PUT')
        <div class="max-w-xl">
            <h3 class="text-lg font-semibold text-gray-800">Review before showing</h3>
            <p class="text-sm text-gray-500">
                @if ($event->moderate_wishes)
                    On: new messages wait here until you approve them.
                @else
                    Off: new messages appear on the invitation right away. You can still hide any message later.
                @endif
            </p>
        </div>
        <input type="hidden" name="moderate_wishes" value="{{ $event->moderate_wishes ? 0 : 1 }}">
        <button type="submit" class="px-5 py-2.5 rounded-xl font-medium transition-colors {{ $event->moderate_wishes ? 'border border-gray-300 text-gray-700 hover:bg-gray-50' : 'bg-primary-600 hover:bg-primary-700 text-white' }}">
            {{ $event->moderate_wishes ? 'Turn off review' : 'Turn on review' }}
        </button>
    </form>
</div>

<!-- Filters -->
<div class="flex flex-wrap items-center justify-between gap-3 mb-4">
    <nav class="flex flex-wrap gap-2" aria-label="Filter wishes">
        <a href="{{ route('admin.wishes.index') }}" class="px-4 py-2 rounded-xl text-sm font-medium {{ ! $status ? 'bg-primary-600 text-white' : 'bg-white border border-gray-200 text-gray-700 hover:bg-gray-50' }}">
            All <span class="tabular-nums opacity-80">{{ $total }}</span>
        </a>
        @foreach ($filters as $value => $label)
            <a href="{{ route('admin.wishes.index', ['status' => $value]) }}" class="px-4 py-2 rounded-xl text-sm font-medium {{ $status === $value ? 'bg-primary-600 text-white' : 'bg-white border border-gray-200 text-gray-700 hover:bg-gray-50' }}">
                {{ $label }} <span class="tabular-nums opacity-80">{{ $counts[$value] ?? 0 }}</span>
            </a>
        @endforeach
    </nav>

    @if ($pending > 0)
        <form method="POST" action="{{ route('admin.wishes.approve-all') }}">
            @csrf
            <button type="submit" class="px-4 py-2 rounded-xl text-sm font-medium bg-green-600 hover:bg-green-700 text-white">Approve all {{ $pending }} waiting</button>
        </form>
    @endif
</div>

<!-- List -->
<div class="space-y-3">
    @forelse ($wishes as $wish)
    <article class="bg-white rounded-2xl shadow p-5 border {{ $wish->message_status === 'pending' ? 'border-amber-300' : 'border-gray-100' }}">
        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-3">
            <div class="flex-1 min-w-0">
                <div class="flex flex-wrap items-center gap-2">
                    <h3 class="font-semibold text-gray-900">{{ $wish->name }}</h3>
                    @if ($wish->message_status === 'pending')
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Waiting</span>
                    @elseif ($wish->message_status === 'hidden')
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-gray-200 text-gray-700">Hidden</span>
                    @else
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">Shown</span>
                    @endif
                    <span class="text-xs text-gray-500">{{ $wish->attendance === 'hadir' ? 'Attending' : 'Not attending' }} &middot; {{ $wish->created_at->format('d M Y H:i') }}</span>
                </div>
                <p class="mt-2 text-gray-700 leading-relaxed break-words whitespace-pre-line">{{ $wish->message }}</p>
            </div>

            <div class="flex flex-wrap gap-2 shrink-0">
                @if ($wish->message_status !== 'visible')
                    <form method="POST" action="{{ route('admin.wishes.status', $wish) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="visible">
                        <button type="submit" class="px-3 py-1.5 text-xs font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg">{{ $wish->message_status === 'pending' ? 'Approve' : 'Show' }}</button>
                    </form>
                @endif
                @if ($wish->message_status !== 'hidden')
                    <form method="POST" action="{{ route('admin.wishes.status', $wish) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="hidden">
                        <button type="submit" class="px-3 py-1.5 text-xs font-medium text-gray-700 border border-gray-300 hover:bg-gray-50 rounded-lg">Hide</button>
                    </form>
                @endif
                <form method="POST" action="{{ route('admin.wishes.destroy', $wish) }}" onsubmit="return confirm('Delete this message from {{ addslashes($wish->name) }}? Their RSVP answer is kept.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50 rounded-lg">Delete message</button>
                </form>
            </div>
        </div>
    </article>
    @empty
    <div class="bg-white rounded-2xl shadow p-12 text-center border border-gray-100">
        <p class="text-gray-800 font-medium mb-1">{{ $status ? 'No messages in this list' : 'No messages yet' }}</p>
        <p class="text-sm text-gray-500">Messages appear here when guests write a wish in the RSVP form.</p>
    </div>
    @endforelse
</div>

@if ($wishes->hasPages())
    <div class="mt-6">{{ $wishes->links() }}</div>
@endif
@endsection
