@extends('admin.layouts.app')

@section('title', 'Events')
@section('subtitle', 'All invitations managed on this site')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
    <p class="text-sm text-gray-600">{{ $events->count() }} {{ Str::plural('event', $events->count()) }}</p>
    <a href="{{ route('admin.events.create') }}" class="inline-flex items-center px-5 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-xl text-sm font-medium transition-colors">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Create Event
    </a>
</div>

<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
    @if ($events->isEmpty())
        <div class="p-12 text-center">
            <p class="text-gray-800 font-medium mb-1">No events yet</p>
            <p class="text-sm text-gray-500 mb-6">Create the first event to get an invitation link.</p>
            <a href="{{ route('admin.events.create') }}" class="inline-flex items-center px-5 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-xl text-sm font-medium transition-colors">Create Event</a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Couple</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Template</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Owner</th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Guests</th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($events as $event)
                    <tr class="hover:bg-gray-50 transition-colors {{ $managedEvent?->id === $event->id ? 'bg-primary-50/50' : '' }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="text-sm font-medium text-gray-900">{{ $event->coupleNames() }}</p>
                            <a href="{{ $event->publicUrl() }}" target="_blank" class="text-xs text-primary-600 hover:text-primary-700">/u/{{ $event->slug }}</a>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $event->dateMedium() ?: '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ \App\Models\Event::TEMPLATES[$event->template] ?? $event->template }}</td>
                        <td class="px-6 py-4 text-sm">
                            @if ($event->owner)
                                <p class="text-gray-900">{{ $event->owner->name }}</p>
                                <p class="text-xs text-gray-500">{{ $event->owner->email }}</p>
                            @else
                                <span class="text-gray-400">No owner</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700 text-right tabular-nums">{{ $event->guests_count }}</td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            @if ($managedEvent?->id === $event->id)
                                <span class="inline-flex px-3 py-1.5 text-xs font-medium text-primary-700 bg-primary-100 rounded-lg">Managing</span>
                            @else
                                <form method="POST" action="{{ route('admin.events.manage', $event) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 text-xs font-medium text-primary-700 border border-primary-200 hover:bg-primary-50 rounded-lg transition-colors">Manage</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
