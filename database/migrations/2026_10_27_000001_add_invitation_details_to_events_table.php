<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Nama panggilan untuk sampul undangan
            $table->string('bride_nickname')->nullable()->after('bride_name');
            $table->string('groom_nickname')->nullable()->after('groom_name');

            // Akad nikah (event_time_start/end dipakai untuk resepsi)
            $table->time('akad_time_start')->nullable()->after('event_date');
            $table->time('akad_time_end')->nullable()->after('akad_time_start');
            $table->string('akad_venue_name')->nullable()->after('venue_longitude');
            $table->text('akad_venue_address')->nullable()->after('akad_venue_name');
            $table->string('akad_maps_url')->nullable()->after('akad_venue_address');

            // Amplop digital: [{type: bank|ewallet, provider, number, holder}]
            $table->json('gift_accounts')->nullable()->after('love_story');
            $table->string('gift_recipient')->nullable()->after('gift_accounts');
            $table->text('gift_address')->nullable()->after('gift_recipient');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn([
                'bride_nickname',
                'groom_nickname',
                'akad_time_start',
                'akad_time_end',
                'akad_venue_name',
                'akad_venue_address',
                'akad_maps_url',
                'gift_accounts',
                'gift_recipient',
                'gift_address',
            ]);
        });
    }
};
