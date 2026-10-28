@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
@php
    $attending = $attendance['hadir'];
    $notAttending = $attendance['tidak_hadir'];
    $undecided = $attendance['masih_ragu'];
    $pct = fn ($part, $whole) => $whole > 0 ? round($part / $whole * 100) : 0;

    $attendanceRows = [
        ['label' => 'Attending', 'data' => $attending, 'bar' => 'bg-green-600'],
        ['label' => 'Not attending', 'data' => $notAttending, 'bar' => 'bg-red-500'],
        ['label' => 'Undecided', 'data' => $undecided, 'bar' => 'bg-amber-400'],
    ];

    $funnelRows = [
        ['label' => 'Personal links created', 'value' => $funnel['created']],
        ['label' => 'Sent via WhatsApp', 'value' => $funnel['sent']],
        ['label' => 'Opened by guest', 'value' => $funnel['opened']],
        ['label' => 'Replied (RSVP)', 'value' => $funnel['replied']],
    ];

    $dailyMax = max(1, $daily->max('total'));
    $dailyTotal = $daily->sum('total');
@endphp

<!-- Event summary -->
@if ($event)
<div class="bg-white rounded-2xl shadow-lg p-6 mb-6 border border-gray-100 flex flex-wrap items-center justify-between gap-4">
    <div class="min-w-0">
        <h2 class="text-xl font-semibold text-gray-900">{{ $event->coupleNames() }}</h2>
        <p class="text-sm text-gray-500">{{ $event->dateLong() ?: 'Event date not set yet' }}</p>
    </div>
    <div class="flex flex-wrap items-center gap-3">
        @if (! is_null($daysLeft))
            <span class="px-4 py-2 rounded-xl text-sm font-medium {{ $daysLeft >= 0 ? 'bg-primary-50 text-primary-700' : 'bg-gray-100 text-gray-600' }}">
                @if ($daysLeft > 0)
                    <span class="tabular-nums">{{ $daysLeft }}</span> days to go
                @elseif ($daysLeft === 0)
                    The big day is today
                @else
                    Event has passed
                @endif
            </span>
        @endif
        <a href="{{ $event->publicUrl() }}" target="_blank" rel="noopener" class="px-4 py-2 rounded-xl text-sm font-medium border border-gray-300 text-gray-700 hover:bg-gray-50">View invitation</a>
    </div>
</div>
@endif

<!-- Key numbers -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-2xl shadow p-5 border border-gray-100">
        <p class="text-sm text-gray-500 mb-1">Expected guests</p>
        <p class="text-3xl font-bold text-gray-900 tabular-nums">{{ $attending['people'] }}</p>
        <p class="text-xs text-gray-500 mt-1">people from {{ $attending['responses'] }} attending RSVP</p>
    </div>
    <div class="bg-white rounded-2xl shadow p-5 border border-gray-100">
        <p class="text-sm text-gray-500 mb-1">RSVP received</p>
        <p class="text-3xl font-bold text-gray-900 tabular-nums">{{ $totalResponses }}</p>
        <p class="text-xs text-gray-500 mt-1">{{ $dailyTotal }} in the last 14 days</p>
    </div>
    <div class="bg-white rounded-2xl shadow p-5 border border-gray-100">
        <p class="text-sm text-gray-500 mb-1">Links opened</p>
        <p class="text-3xl font-bold text-gray-900 tabular-nums">{{ $pct($funnel['opened'], $funnel['created']) }}%</p>
        <p class="text-xs text-gray-500 mt-1">{{ $funnel['opened'] }} of {{ $funnel['created'] }} personal links</p>
    </div>
    <div class="bg-white rounded-2xl shadow p-5 border border-gray-100">
        <p class="text-sm text-gray-500 mb-1">Links replied</p>
        <p class="text-3xl font-bold text-gray-900 tabular-nums">{{ $pct($funnel['replied'], $funnel['created']) }}%</p>
        <p class="text-xs text-gray-500 mt-1">{{ $funnel['replied'] }} of {{ $funnel['created'] }} personal links</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <!-- Attendance -->
    <section class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800">Attendance</h3>
        <p class="text-sm text-gray-500 mb-5">Answers from {{ $totalResponses }} RSVP</p>

        @if ($totalResponses > 0)
            <div class="flex h-4 gap-0.5 rounded-full overflow-hidden mb-5" role="img"
                 aria-label="Attending {{ $attending['responses'] }}, not attending {{ $notAttending['responses'] }}, undecided {{ $undecided['responses'] }}">
                @foreach ($attendanceRows as $row)
                    @if ($row['data']['responses'] > 0)
                        <div class="{{ $row['bar'] }} h-full" style="width: {{ $row['data']['responses'] / $totalResponses * 100 }}%"
                             title="{{ $row['label'] }}: {{ $row['data']['responses'] }} RSVP"></div>
                    @endif
                @endforeach
            </div>
        @endif

        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-xs text-gray-500">
                    <th class="font-medium pb-2">Answer</th>
                    <th class="font-medium pb-2 text-right">RSVP</th>
                    <th class="font-medium pb-2 text-right">People</th>
                    <th class="font-medium pb-2 text-right">Share</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($attendanceRows as $row)
                    <tr>
                        <td class="py-2 text-gray-700">
                            <span class="inline-block w-2.5 h-2.5 rounded-full {{ $row['bar'] }} mr-2" aria-hidden="true"></span>{{ $row['label'] }}
                        </td>
                        <td class="py-2 text-right tabular-nums text-gray-900">{{ $row['data']['responses'] }}</td>
                        <td class="py-2 text-right tabular-nums text-gray-900">{{ $row['data']['people'] }}</td>
                        <td class="py-2 text-right tabular-nums text-gray-500">{{ $pct($row['data']['responses'], $totalResponses) }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <!-- Personal link funnel -->
    <section class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
        <div class="flex items-start justify-between gap-3 mb-5">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Personal links</h3>
                <p class="text-sm text-gray-500">From created to replied</p>
            </div>
            <a href="{{ route('admin.invitations.index') }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium">Manage →</a>
        </div>

        @if ($funnel['created'] > 0)
            <div class="space-y-4">
                @foreach ($funnelRows as $row)
                    <div>
                        <div class="flex justify-between text-sm mb-1.5">
                            <span class="text-gray-600">{{ $row['label'] }}</span>
                            <span class="text-gray-900 tabular-nums">{{ $row['value'] }} <span class="text-gray-500">({{ $pct($row['value'], $funnel['created']) }}%)</span></span>
                        </div>
                        <div class="w-full bg-gray-100 rounded h-2.5">
                            <div class="bg-primary-600 h-2.5 rounded" style="width: {{ $row['value'] / $funnel['created'] * 100 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-500">No personal links yet. Add guests in <a href="{{ route('admin.invitations.index') }}" class="text-primary-600 hover:underline">Invitations</a> to track who opened and replied.</p>
        @endif
    </section>
</div>

<!-- RSVP per day -->
<section class="bg-white rounded-2xl shadow-lg p-6 mb-6 border border-gray-100">
    <h3 class="text-lg font-semibold text-gray-800">RSVP per day</h3>
    <p class="text-sm text-gray-500 mb-5">Last 14 days &middot; {{ $dailyTotal }} RSVP</p>

    <div class="flex gap-3">
        <!-- Y axis -->
        <div class="flex flex-col justify-between text-xs text-gray-400 tabular-nums h-40 text-right w-6 shrink-0" aria-hidden="true">
            <span>{{ $dailyMax }}</span>
            <span>0</span>
        </div>

        <div class="flex-1 min-w-0">
            <div class="relative h-40 border-b border-gray-200">
                <div class="absolute inset-x-0 top-0 border-t border-dashed border-gray-100" aria-hidden="true"></div>
                <ol class="absolute inset-0 flex items-end gap-1">
                    @foreach ($daily as $day)
                        <li class="group relative flex-1 h-full flex items-end justify-center" tabindex="0"
                            aria-label="{{ $day['date']->locale('en')->isoFormat('ddd D MMM') }}: {{ $day['total'] }} RSVP">
                            @if ($day['total'] > 0)
                                <div class="w-full max-w-8 bg-primary-600 rounded-t group-hover:bg-primary-700 group-focus:bg-primary-700"
                                     style="height: {{ $day['total'] / $dailyMax * 100 }}%"></div>
                            @endif
                            {{-- Tooltip di tepi grafik dirapatkan ke dalam supaya tidak keluar layar --}}
                            <div class="pointer-events-none absolute bottom-full mb-1 {{ $loop->index < 3 ? 'left-0' : ($loop->remaining < 3 ? 'right-0' : 'left-1/2 -translate-x-1/2') }} whitespace-nowrap rounded-lg bg-gray-900 px-2.5 py-1.5 text-xs text-white opacity-0 group-hover:opacity-100 group-focus:opacity-100 z-10">
                                {{ $day['date']->locale('en')->isoFormat('ddd D MMM') }}: <span class="tabular-nums font-semibold">{{ $day['total'] }}</span> RSVP
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>

            <!-- X axis: every other day, so labels don't collide on phones -->
            <div class="flex gap-1 mt-2 text-xs text-gray-400" aria-hidden="true">
                @foreach ($daily as $i => $day)
                    <span class="flex-1 text-center tabular-nums">{{ $i % 2 === 0 || $loop->last ? $day['date']->format('j/n') : '' }}</span>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Recent Guests -->
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-800">Latest RSVP</h3>
            <a href="{{ route('admin.guests') }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium transition-colors">
                View All →
            </a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Attendance</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">People</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($recentGuests as $guest)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $guest->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($guest->attendance === 'hadir')
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Attending</span>
                        @elseif($guest->attendance === 'tidak_hadir')
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Not attending</span>
                        @else
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Undecided</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 tabular-nums">
                        {{ $guest->number_of_guests ?? 1 }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $guest->created_at->format('d M Y, H:i') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center">
                        <p class="text-gray-500">No RSVP yet. Answers appear here as soon as guests fill in the form.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
