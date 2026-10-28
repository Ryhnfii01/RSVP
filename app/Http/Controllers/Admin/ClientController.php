<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\ClientCredentials;
use Illuminate\Http\Request;

/**
 * Super admin: akun client (pasangan) yang bisa login dan mengelola acaranya.
 */
class ClientController extends Controller
{
    public function index()
    {
        $clients = User::where('role', User::ROLE_CLIENT)
            ->with('events')
            ->orderBy('name')
            ->get();

        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Buat akun client dengan password sementara yang digenerate sistem.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:20',
        ]);

        $password = ClientCredentials::generatePassword();

        $client = User::create($validated + [
            'role' => User::ROLE_CLIENT,
            'password' => $password,
            'must_change_password' => true,
        ]);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Akun client berhasil dibuat.')
            ->with('client_credentials', ClientCredentials::forFlash($client, $password));
    }

    /**
     * Buat password sementara baru (misalnya client lupa password).
     */
    public function resetPassword(User $client)
    {
        abort_if($client->isSuperAdmin(), 404);

        $password = ClientCredentials::generatePassword();
        $client->update(['password' => $password, 'must_change_password' => true]);

        return redirect()->route('admin.clients.index')
            ->with('success', "Password sementara baru untuk {$client->name} sudah dibuat.")
            ->with('client_credentials', ClientCredentials::forFlash($client, $password));
    }

    /**
     * Ubah nomor WhatsApp client (untuk mengirim kredensial).
     */
    public function updatePhone(Request $request, User $client)
    {
        abort_if($client->isSuperAdmin(), 404);

        $client->update($request->validate(['phone' => 'nullable|string|max:20']));

        return redirect()->route('admin.clients.index')
            ->with('success', "Nomor WhatsApp {$client->name} disimpan.");
    }
}
