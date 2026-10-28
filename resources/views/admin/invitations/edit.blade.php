@extends('admin.layouts.app')

@section('title', 'Edit Guest')
@section('subtitle', $invitation->name)

@section('content')
@php
    $input = 'w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500';
@endphp
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.invitations.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Invitations
        </a>
    </div>

    <form method="POST" action="{{ route('admin.invitations.update', $invitation) }}" class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name on the invitation</label>
            <input id="name" type="text" name="name" value="{{ old('name', $invitation->name) }}" required class="{{ $input }}">
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">WhatsApp number</label>
                <input id="phone" type="tel" name="phone" value="{{ old('phone', $invitation->phone ? '0' . preg_replace('/^62/', '', $invitation->phone) : '') }}" class="{{ $input }}" placeholder="0812...">
                @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="group" class="block text-sm font-medium text-gray-700 mb-2">Group</label>
                <input id="group" type="text" name="group" value="{{ old('group', $invitation->group) }}" class="{{ $input }}" placeholder="Keluarga">
                @error('group') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="rounded-xl bg-gray-50 p-4 text-sm text-gray-600 space-y-1">
            <p>Personal link (stays the same after editing):</p>
            <p class="font-mono text-gray-800 break-all">{{ $invitation->personalUrl() }}</p>
        </div>

        <div class="flex items-center justify-between pt-2">
            <a href="{{ route('admin.invitations.index') }}" class="text-gray-600 hover:text-gray-900 font-medium transition-colors">Cancel</a>
            <button type="submit" class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-medium transition-colors">Save Changes</button>
        </div>
    </form>
</div>
@endsection
