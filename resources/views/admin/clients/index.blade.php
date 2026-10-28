@extends('admin.layouts.app')

@section('title', 'Clients')
@section('subtitle', 'Couple accounts that can log in and manage their own event')

@section('content')
@php
    $input = 'w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500';
@endphp

<!-- New client -->
<div class="bg-white rounded-2xl shadow-lg p-6 mb-6 border border-gray-100">
    <h3 class="text-lg font-semibold text-gray-800 mb-1">Add Client</h3>
    <p class="text-sm text-gray-500 mb-6">A temporary password is generated for you and shown once, ready to send on WhatsApp. Assign the account to an event under Events or Event Settings.</p>

    <form method="POST" action="{{ route('admin.clients.store') }}" class="grid md:grid-cols-4 gap-4 items-end">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required class="{{ $input }}" placeholder="Rina & Dimas">
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required class="{{ $input }}" placeholder="rina@email.com">
            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">WhatsApp number</label>
            <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" class="{{ $input }}" placeholder="0812...">
            @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <button type="submit" class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-medium transition-colors">Create Account</button>
    </form>
</div>

<!-- Client list -->
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
    @if ($clients->isEmpty())
        <div class="p-12 text-center">
            <p class="text-gray-800 font-medium mb-1">No client accounts yet</p>
            <p class="text-sm text-gray-500">Add one above, or create it together with a new event.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Events</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">WhatsApp number</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Password</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($clients as $client)
                    <tr class="hover:bg-gray-50 transition-colors align-top">
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-gray-900">{{ $client->name }}</p>
                            <p class="text-xs text-gray-500">{{ $client->email }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            @forelse ($client->events as $event)
                                <a href="{{ $event->publicUrl() }}" target="_blank" class="block text-primary-600 hover:text-primary-700">{{ $event->coupleNames() }}</a>
                            @empty
                                <span class="text-gray-400">Not assigned</span>
                            @endforelse
                        </td>
                        <td class="px-6 py-4">
                            <form method="POST" action="{{ route('admin.clients.phone', $client) }}" class="flex gap-2">
                                @csrf
                                @method('PUT')
                                <label for="phone-{{ $client->id }}" class="sr-only">WhatsApp number for {{ $client->name }}</label>
                                <input id="phone-{{ $client->id }}" type="tel" name="phone" value="{{ $client->phone ? '0' . preg_replace('/^62/', '', $client->phone) : '' }}" placeholder="0812..." class="w-36 px-3 py-1.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                <button type="submit" class="px-3 py-1.5 text-xs font-medium text-gray-700 border border-gray-300 hover:bg-gray-50 rounded-lg">Save</button>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($client->must_change_password)
                                <span class="block mb-2 w-fit px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Temporary</span>
                            @else
                                <span class="block mb-2 w-fit px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Set by client</span>
                            @endif
                            <form method="POST" action="{{ route('admin.clients.password', $client) }}" onsubmit="return confirm('Create a new temporary password for {{ addslashes($client->name) }}? Their current password will stop working.')">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="px-3 py-1.5 text-xs font-medium text-gray-700 border border-gray-300 hover:bg-gray-50 rounded-lg">New temporary password</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
