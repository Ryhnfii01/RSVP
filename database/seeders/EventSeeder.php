<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\User;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
            'user_id' => User::where('email', 'klien@example.com')->value('id'),
            'slug' => 'rina-dimas',
            'template' => 'template-4',
            'event_type' => 'wedding',
            'bride_name' => 'Rina Amelia Putri',
            'bride_nickname' => 'Rina',
            'bride_father' => 'Bapak Hasan Basri',
            'bride_mother' => 'Ibu Siti Aminah',
            'groom_name' => 'Dimas Pratama Saputra',
            'groom_nickname' => 'Dimas',
            'groom_father' => 'Bapak Ahmad Fauzi',
            'groom_mother' => 'Ibu Nurhayati',
            'event_title' => 'The Wedding of Rina & Dimas',
            'event_description' => 'Dengan memohon rahmat dan ridho Allah SWT, kami bermaksud menyelenggarakan pernikahan kami.',
            'event_date' => '2027-02-14 08:00:00',
            'akad_time_start' => '08:00:00',
            'akad_time_end' => '10:00:00',
            'event_time_start' => '11:00:00',
            'event_time_end' => '14:00:00',
            'time_zone' => 'WITA',
            'venue_name' => 'Gedung Serbaguna Al-Ikhlas',
            'venue_address' => 'Jl. Perintis Kemerdekaan No. 45, Makassar',
            'venue_city' => 'Makassar',
            'venue_maps_url' => null,
            'instagram_bride' => '@rinaamelia',
            'instagram_groom' => '@dimaspratama',
            'love_story' => 'Kami bertemu di kampus pada 2019 dan memutuskan melangkah bersama.',
            'gift_accounts' => [
                ['type' => 'bank', 'provider' => 'BCA', 'number' => '1234567890', 'holder' => 'Dimas Pratama Saputra'],
                ['type' => 'bank', 'provider' => 'Mandiri', 'number' => '0987654321', 'holder' => 'Rina Amelia Putri'],
                ['type' => 'ewallet', 'provider' => 'GoPay', 'number' => '081234567890', 'holder' => 'Dimas Pratama Saputra'],
                ['type' => 'ewallet', 'provider' => 'DANA', 'number' => '081298765432', 'holder' => 'Rina Amelia Putri'],
            ],
            'gift_recipient' => 'Rina Amelia Putri',
            'gift_address' => 'Jl. Perintis Kemerdekaan No. 45, Makassar 90245',
            'background_music' => 'wedding-song.mp3',
            'is_active' => true,
        ]);
    }
}
