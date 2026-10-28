@extends('admin.layouts.app')

@section('title', 'My Account')
@section('subtitle', 'Your login details')

@section('content')
@php
    $input = 'w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500';
@endphp
<div class="max-w-2xl mx-auto space-y-6">
    @if ($user->must_change_password)
        <div class="rounded-2xl border-2 border-amber-300 bg-amber-50 p-5">
            <p class="font-medium text-amber-900">Set your own password</p>
            <p class="text-sm text-amber-800">You logged in with a temporary password from the admin. Replace it below so only you know it.</p>
        </div>
    @endif

    <!-- Password -->
    <form method="POST" action="{{ route('admin.account.password') }}" class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 space-y-4">
        @csrf
        @method('PUT')
        <h3 class="text-lg font-semibold text-gray-800">Change Password</h3>

        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">{{ $user->must_change_password ? 'Temporary password' : 'Current password' }}</label>
            <input id="current_password" type="password" name="current_password" required autocomplete="current-password" class="{{ $input }}">
            @error('current_password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New password</label>
                <input id="password" type="password" name="password" required minlength="8" autocomplete="new-password" class="{{ $input }}">
                @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Repeat new password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required minlength="8" autocomplete="new-password" class="{{ $input }}">
            </div>
        </div>
        <p class="text-sm text-gray-500">At least 8 characters. Other devices logged in to this account will be logged out.</p>
        <button type="submit" class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-medium transition-colors">Change Password</button>
    </form>

    <!-- Profile -->
    <form method="POST" action="{{ route('admin.account.profile') }}" class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 space-y-4">
        @csrf
        @method('PUT')
        <h3 class="text-lg font-semibold text-gray-800">Profile</h3>

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required class="{{ $input }}">
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email (used to log in)</label>
                <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required class="{{ $input }}">
                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">WhatsApp number</label>
                <input id="phone" type="tel" name="phone" value="{{ old('phone', $user->phone ? '0' . preg_replace('/^62/', '', $user->phone) : '') }}" class="{{ $input }}" placeholder="0812...">
                @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>
        <button type="submit" class="px-6 py-2.5 border border-primary-600 text-primary-700 hover:bg-primary-50 rounded-xl font-medium transition-colors">Save Profile</button>
    </form>
</div>
@endsection
