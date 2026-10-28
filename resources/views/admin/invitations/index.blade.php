@extends('admin.layouts.app')

@section('title', 'Invitations')
@section('subtitle', 'People you invite, each with a personal link')

@section('content')
@php
    $input = 'w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500';
@endphp

<!-- Summary -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-2xl shadow-lg p-5 border border-gray-100">
        <p class="text-sm text-gray-500">Invited</p>
        <p class="text-3xl font-semibold text-gray-900 tabular-nums">{{ $stats['total'] }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow-lg p-5 border border-gray-100">
        <p class="text-sm text-gray-500">Sent via WhatsApp</p>
        <p class="text-3xl font-semibold text-gray-900 tabular-nums">{{ $stats['sent'] }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow-lg p-5 border border-gray-100">
        <p class="text-sm text-gray-500">Opened the link</p>
        <p class="text-3xl font-semibold text-gray-900 tabular-nums">{{ $stats['opened'] }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow-lg p-5 border border-gray-100">
        <p class="text-sm text-gray-500">Replied (RSVP)</p>
        <p class="text-3xl font-semibold text-gray-900 tabular-nums">{{ $stats['replied'] }}</p>
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-6 mb-6">
    <!-- Add one -->
    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Add Guest</h3>
        <form method="POST" action="{{ route('admin.invitations.store') }}" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name on the invitation</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required class="{{ $input }}" placeholder="Bapak Ahmad Fauzi & Keluarga">
                @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">WhatsApp number</label>
                    <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" class="{{ $input }}" placeholder="0812...">
                    @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="group" class="block text-sm font-medium text-gray-700 mb-2">Group</label>
                    <input id="group" type="text" name="group" value="{{ old('group') }}" class="{{ $input }}" placeholder="Keluarga">
                </div>
            </div>
            <button type="submit" class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-medium transition-colors">Add Guest</button>
        </form>
    </div>

    <!-- Import CSV -->
    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800 mb-1">Import from CSV</h3>
        <p class="text-sm text-gray-500 mb-4">
            Columns: name, WhatsApp number, group. Export from Excel or Google Sheets as CSV.
            Rows already on the list are skipped.
            <a href="{{ route('admin.invitations.template') }}" class="text-primary-600 hover:text-primary-700">Download example file</a>
        </p>
        <form method="POST" action="{{ route('admin.invitations.import') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label for="file" class="sr-only">CSV file</label>
                <input id="file" type="file" name="file" accept=".csv,text/csv" required class="block w-full text-sm text-gray-700 file:mr-4 file:px-4 file:py-2 file:rounded-xl file:border-0 file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                @error('file') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="px-6 py-2.5 border border-primary-600 text-primary-700 hover:bg-primary-50 rounded-xl font-medium transition-colors">Import</button>
        </form>
    </div>
</div>

<!-- WhatsApp message -->
<details class="group bg-white rounded-2xl shadow-lg border border-gray-100 mb-6" @if ($errors->has('wa_message')) open @endif>
    <summary class="flex items-center justify-between gap-4 p-6 cursor-pointer list-none">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">WhatsApp Message</h3>
            <p class="text-sm text-gray-500">{{ filled($event->wa_message) ? 'Custom message' : 'Default message' }} &middot; sent with the WhatsApp button on each guest</p>
            <p class="text-sm text-gray-500 mt-1">
                Admin sender number: <span class="font-medium text-gray-700 tabular-nums">+{{ config('whatsapp.sender_number') }}</span>
                @if (config('whatsapp.sender_is_dummy'))
                    <span class="ml-1 px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">dummy</span>
                @endif
                <span class="text-gray-400">&middot; automatic sending via Baileys is not connected yet</span>
            </p>
        </div>
        <span class="text-sm text-primary-700 group-open:hidden">Edit</span>
        <span class="text-sm text-primary-700 hidden group-open:inline">Close</span>
    </summary>

    <div class="px-6 pb-6 grid lg:grid-cols-2 gap-6">
        <form method="POST" action="{{ route('admin.invitations.message') }}" class="space-y-3">
            @csrf
            @method('PUT')
            <label for="wa_message" class="block text-sm font-medium text-gray-700">Message template</label>
            <textarea id="wa_message" name="wa_message" rows="14" class="{{ $input }} font-mono text-sm">{{ old('wa_message', $event->waMessageTemplate()) }}</textarea>
            @error('wa_message') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            <p class="text-sm text-gray-500">
                Replaced per guest:
                @foreach (\App\Models\Event::WA_PLACEHOLDERS as $placeholder)
                    <code class="px-1.5 py-0.5 bg-gray-100 rounded text-gray-700">{{ $placeholder }}</code>
                @endforeach
                &middot; <code class="px-1.5 py-0.5 bg-gray-100 rounded text-gray-700">*text*</code> = bold in WhatsApp.
            </p>
            <div class="flex flex-wrap gap-3">
                <button type="submit" class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-medium transition-colors">Save Message</button>
                @if (filled($event->wa_message))
                    <button type="submit" name="wa_message" value="" class="px-6 py-2.5 border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-xl font-medium transition-colors">Reset to Default</button>
                @endif
            </div>
        </form>

        <div>
            <p class="block text-sm font-medium text-gray-700 mb-3">Preview (saved message)</p>
            <div class="rounded-2xl bg-[#e5ddd5] p-4">
                <div class="max-w-sm ml-auto rounded-xl rounded-tr-sm bg-[#dcf8c6] px-4 py-3 shadow-sm text-sm text-gray-800 whitespace-pre-line break-words">{!! preg_replace('/\*([^*\n]+)\*/', '<strong>$1</strong>', e($preview)) !!}</div>
            </div>
        </div>
    </div>
</details>

<!-- List -->
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
    @php($filtering = request()->filled('search') || request()->filled('status') || request()->filled('group'))
    <div class="p-4 border-b border-gray-100 space-y-3">
        <form method="GET" action="{{ route('admin.invitations.index') }}" class="flex flex-wrap gap-2">
            <label for="search" class="sr-only">Search</label>
            <input id="search" type="search" name="search" value="{{ request('search') }}" class="flex-1 min-w-[12rem] px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500" placeholder="Search name, number, or group">

            <label for="status" class="sr-only">Status</label>
            <select id="status" name="status" class="px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                <option value="">All statuses</option>
                @foreach ($statusFilters as $value => $label)
                    <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                @endforeach
            </select>

            @if ($groups->isNotEmpty())
                <label for="group-filter" class="sr-only">Group</label>
                <select id="group-filter" name="group" class="px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">All groups</option>
                    @foreach ($groups as $groupOption)
                        <option value="{{ $groupOption }}" @selected(request('group') === $groupOption)>{{ $groupOption }}</option>
                    @endforeach
                </select>
            @endif

            <button type="submit" class="px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 hover:bg-gray-50 rounded-xl">Filter</button>
            @if ($filtering)
                <a href="{{ route('admin.invitations.index') }}" class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-800">Clear</a>
            @endif
        </form>

        <div class="flex flex-wrap items-center justify-between gap-2 text-sm">
            <p class="text-gray-500">
                {{ $invitations->total() }} {{ Str::plural('guest', $invitations->total()) }}{{ $filtering ? ($invitations->total() === 1 ? ' matches' : ' match') . ' the filter' : '' }}
            </p>
            <a href="{{ route('admin.invitations.export', request()->only('search', 'status', 'group')) }}"
               class="inline-flex items-center gap-2 px-4 py-2 font-medium text-primary-700 border border-primary-200 hover:bg-primary-50 rounded-xl">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Export {{ $filtering ? 'filtered list' : 'all' }} (CSV for Excel)
            </a>
        </div>
    </div>

    @if ($invitations->isEmpty())
        <div class="p-12 text-center">
            @if ($filtering)
                <p class="text-gray-800 font-medium mb-1">No guests match the filter</p>
                <a href="{{ route('admin.invitations.index') }}" class="text-sm text-primary-600 hover:text-primary-700">Show all guests</a>
            @else
                <p class="text-gray-800 font-medium mb-1">No guests on the list yet</p>
                <p class="text-sm text-gray-500">Add them one by one or import a CSV above. Each guest gets their own invitation link.</p>
            @endif
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guest</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Group</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">RSVP</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Personal link</th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($invitations as $invitation)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-gray-900">{{ $invitation->name }}</p>
                            <p class="text-xs text-gray-500 tabular-nums">{{ $invitation->phone ? '+' . $invitation->phone : 'No number' }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $invitation->group ?: '-' }}</td>
                        <td class="px-6 py-4 text-sm whitespace-nowrap space-y-1">
                            @if ($invitation->sent_at)
                                <span class="block w-fit px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700" title="{{ $invitation->sent_at->format('d M Y H:i') }}">Sent {{ $invitation->sent_at->diffForHumans() }}</span>
                            @endif
                            @if ($invitation->opened_at)
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700" title="{{ $invitation->opened_at->format('d M Y H:i') }}">Opened {{ $invitation->opened_at->diffForHumans() }}</span>
                            @else
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">Not opened</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm whitespace-nowrap">
                            @if (! $invitation->guest)
                                <span class="text-gray-400">No reply</span>
                            @elseif ($invitation->guest->attendance === 'hadir')
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-700">Attending &middot; {{ $invitation->guest->number_of_guests }} {{ Str::plural('person', $invitation->guest->number_of_guests) }}</span>
                            @else
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700">Not attending</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <input type="text" readonly value="{{ $invitation->personalUrl() }}" aria-label="Personal link for {{ $invitation->name }}" class="w-56 px-3 py-1.5 text-xs text-gray-700 bg-gray-50 border border-gray-200 rounded-lg" onfocus="this.select()">
                                <button type="button" data-copy="{{ $invitation->personalUrl() }}" class="px-3 py-1.5 text-xs font-medium text-primary-700 border border-primary-200 hover:bg-primary-50 rounded-lg whitespace-nowrap">Copy</button>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <a href="{{ route('admin.invitations.whatsapp', $invitation) }}" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-white bg-[#25D366] hover:bg-[#1ebe57] rounded-lg"
                               title="{{ $invitation->phone ? 'Open WhatsApp chat with +' . $invitation->phone : 'No number: WhatsApp will ask you to pick a contact' }}">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91C21.95 6.45 17.5 2 12.04 2zm5.8 14.03c-.24.68-1.42 1.3-1.95 1.35-.5.05-.97.23-3.27-.68-2.77-1.09-4.52-3.92-4.66-4.1-.13-.18-1.1-1.47-1.1-2.8 0-1.33.7-1.98.95-2.25.24-.27.53-.34.71-.34h.51c.16 0 .38-.06.6.46.24.55.79 1.9.86 2.04.07.14.11.3.02.48-.09.18-.14.3-.27.46-.14.16-.29.36-.41.48-.14.14-.28.29-.12.56.16.27.71 1.17 1.52 1.9 1.05.93 1.93 1.22 2.2 1.36.27.14.43.11.59-.07.16-.18.68-.79.86-1.06.18-.27.36-.23.6-.14.25.09 1.58.75 1.85.88.27.14.45.2.52.32.07.11.07.66-.17 1.33z"/></svg>
                                {{ $invitation->sent_at ? 'Resend' : 'WhatsApp' }}
                            </a>
                            <a href="{{ route('admin.invitations.edit', $invitation) }}" class="px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-100 rounded-lg">Edit</a>
                            <form method="POST" action="{{ route('admin.invitations.destroy', $invitation) }}" class="inline" onsubmit="return confirm('Remove {{ addslashes($invitation->name) }} from the list? Their link will stop working.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50 rounded-lg">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($invitations->hasPages())
            <div class="p-4 border-t border-gray-100">{{ $invitations->links() }}</div>
        @endif
    @endif
</div>

<script>
    // Salin link personal
    document.querySelectorAll('[data-copy]').forEach((button) => {
        button.addEventListener('click', () => {
            const label = button.textContent;
            navigator.clipboard.writeText(button.dataset.copy)
                .then(() => { button.textContent = 'Copied'; })
                .catch(() => { button.previousElementSibling.select(); button.textContent = 'Press Ctrl+C'; })
                .finally(() => setTimeout(() => { button.textContent = label; }, 2000));
        });
    });
</script>
@endsection
