@extends('admin.layouts.app')

@section('title', 'Create Event')
@section('subtitle', 'Start a new invitation; fill in the full details afterwards')

@section('content')
@php
    $input = 'w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500';
    $owner = old('owner', $clients->isEmpty() ? 'new' : 'existing');
@endphp
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.events.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Events
        </a>
    </div>

    <form method="POST" action="{{ route('admin.events.store') }}" class="space-y-6">
        @csrf

        <!-- Couple & Date -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">Couple</h3>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label for="bride_name" class="block text-sm font-medium text-gray-700 mb-2">Bride's Full Name</label>
                    <input id="bride_name" type="text" name="bride_name" value="{{ old('bride_name') }}" required class="{{ $input }}" placeholder="Rina Amelia Putri">
                    @error('bride_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="groom_name" class="block text-sm font-medium text-gray-700 mb-2">Groom's Full Name</label>
                    <input id="groom_name" type="text" name="groom_name" value="{{ old('groom_name') }}" required class="{{ $input }}" placeholder="Dimas Pratama Saputra">
                    @error('groom_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="event_date" class="block text-sm font-medium text-gray-700 mb-2">Event Date</label>
                    <input id="event_date" type="date" name="event_date" value="{{ old('event_date') }}" class="{{ $input }}">
                    @error('event_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="template" class="block text-sm font-medium text-gray-700 mb-2">Template</label>
                    <select id="template" name="template" class="{{ $input }}">
                        @foreach (\App\Models\Event::TEMPLATES as $key => $name)
                            <option value="{{ $key }}" @selected(old('template', 'template-1') === $key)>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Link</label>
                    <div class="flex items-stretch">
                        <span class="inline-flex items-center px-3 rounded-l-xl border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">{{ url('/u') }}/</span>
                        <input id="slug" type="text" name="slug" value="{{ old('slug') }}" class="flex-1 min-w-0 px-4 py-2.5 border border-gray-300 rounded-r-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500" placeholder="rina-dimas">
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Leave empty to generate it from the first names.</p>
                    @error('slug') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Owner -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-1">Owner</h3>
            <p class="text-sm text-gray-500 mb-6">The client account can log in and manage only this event.</p>

            <div class="space-y-3">
                <label class="flex items-center gap-3 p-4 border rounded-xl cursor-pointer {{ $clients->isEmpty() ? 'opacity-50' : '' }}">
                    <input type="radio" name="owner" value="existing" class="text-primary-600 focus:ring-primary-500" @checked($owner === 'existing') @disabled($clients->isEmpty())>
                    <span class="text-sm font-medium text-gray-800">Existing client</span>
                    @if ($clients->isEmpty())
                        <span class="text-xs text-gray-500">(no client accounts yet)</span>
                    @endif
                </label>
                <div data-owner="existing" class="pl-4 {{ $owner === 'existing' ? '' : 'hidden' }}">
                    <label for="user_id" class="sr-only">Client</label>
                    <select id="user_id" name="user_id" class="{{ $input }}">
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" @selected((string) old('user_id') === (string) $client->id)>{{ $client->name }} ({{ $client->email }})</option>
                        @endforeach
                    </select>
                    @error('user_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <label class="flex items-center gap-3 p-4 border rounded-xl cursor-pointer">
                    <input type="radio" name="owner" value="new" class="text-primary-600 focus:ring-primary-500" @checked($owner === 'new')>
                    <span class="text-sm font-medium text-gray-800">New client account</span>
                </label>
                <div data-owner="new" class="pl-4 grid md:grid-cols-3 gap-4 {{ $owner === 'new' ? '' : 'hidden' }}">
                    <div>
                        <label for="client_name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <input id="client_name" type="text" name="client_name" value="{{ old('client_name') }}" class="{{ $input }}" placeholder="Rina & Dimas">
                        @error('client_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="client_email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input id="client_email" type="email" name="client_email" value="{{ old('client_email') }}" class="{{ $input }}" placeholder="rina@email.com">
                        @error('client_email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="client_phone" class="block text-sm font-medium text-gray-700 mb-2">WhatsApp number</label>
                        <input id="client_phone" type="tel" name="client_phone" value="{{ old('client_phone') }}" class="{{ $input }}" placeholder="0812...">
                        @error('client_phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <p class="md:col-span-3 text-sm text-gray-500">A temporary password is generated and shown once after you create the event, ready to send on WhatsApp.</p>
                </div>

                <label class="flex items-center gap-3 p-4 border rounded-xl cursor-pointer">
                    <input type="radio" name="owner" value="none" class="text-primary-600 focus:ring-primary-500" @checked($owner === 'none')>
                    <span class="text-sm font-medium text-gray-800">No owner for now</span>
                    <span class="text-xs text-gray-500">(only super admins can manage it)</span>
                </label>
            </div>
        </div>

        <div class="flex items-center justify-between bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <a href="{{ route('admin.events.index') }}" class="text-gray-600 hover:text-gray-900 font-medium transition-colors">Cancel</a>
            <button type="submit" class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-medium transition-colors">
                Create Event
            </button>
        </div>
    </form>
</div>

<script>
    // Tampilkan isian sesuai pilihan pemilik
    document.querySelectorAll('input[name="owner"]').forEach((radio) => {
        radio.addEventListener('change', () => {
            document.querySelectorAll('[data-owner]').forEach((panel) => {
                panel.classList.toggle('hidden', panel.dataset.owner !== radio.value);
            });
        });
    });
</script>
@endsection
