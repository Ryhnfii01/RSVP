<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/**
 * Akun Saya: setiap user (super admin maupun client) mengubah profil dan password sendiri.
 */
class AccountController extends Controller
{
    public function edit(Request $request)
    {
        return view('admin.account.edit', ['user' => $request->user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        return redirect()->route('admin.account.edit')->with('success', 'Profil disimpan.');
    }

    public function updatePassword(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'different:current_password', Password::min(8)],
        ], [
            'current_password.current_password' => 'Password saat ini salah.',
            'password.different' => 'Password baru harus berbeda dari password saat ini.',
            'password.confirmed' => 'Konfirmasi password baru tidak sama.',
        ]);

        $user->update([
            'password' => $request->input('password'),
            'must_change_password' => false,
        ]);

        // Keluarkan sesi di perangkat lain yang mungkin memakai password lama
        auth()->logoutOtherDevices($request->input('password'));

        return redirect()->route('admin.account.edit')->with('success', 'Password berhasil diganti.');
    }
}
