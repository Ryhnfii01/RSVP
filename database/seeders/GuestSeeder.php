<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guests = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'phone' => '081234567890',
                'number_of_guests' => 2,
                'message' => 'Selamat menempuh hidup baru! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah.',
                'attendance' => 'hadir',
                'is_confirmed' => true,
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti@example.com',
                'phone' => '081234567891',
                'number_of_guests' => 3,
                'message' => 'Barakallah! Semoga langgeng sampai kakek nenek.',
                'attendance' => 'hadir',
                'is_confirmed' => true,
            ],
            [
                'name' => 'Ahmad Dahlan',
                'email' => 'ahmad@example.com',
                'phone' => '081234567892',
                'number_of_guests' => 1,
                'message' => 'Selamat dan sukses!',
                'attendance' => 'hadir',
                'is_confirmed' => false,
            ],
            [
                'name' => 'Rina Wijaya',
                'email' => 'rina@example.com',
                'phone' => '081234567893',
                'number_of_guests' => 2,
                'message' => 'Mohon maaf tidak bisa hadir, sedang di luar kota.',
                'attendance' => 'tidak_hadir',
                'is_confirmed' => true,
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi@example.com',
                'phone' => '081234567894',
                'number_of_guests' => 4,
                'message' => 'Selamat ya! Semoga menjadi pasangan yang harmonis.',
                'attendance' => 'hadir',
                'is_confirmed' => true,
            ],
        ];

        $event = Event::getActive();

        if (! $event) {
            return;
        }

        foreach ($guests as $guest) {
            $event->guests()->create($guest);
        }
    }
}
