<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pemilik bisnis: mengelola semua acara
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => User::ROLE_SUPER_ADMIN,
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Contoh akun pasangan: hanya mengelola acaranya sendiri
        User::create([
            'name' => 'Rina & Dimas',
            'email' => 'klien@example.com',
            'role' => User::ROLE_CLIENT,
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
    }
}
