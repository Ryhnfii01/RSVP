<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Moderasi ucapan tamu (F-10).
     */
    public function up(): void
    {
        Schema::table('guests', function (Blueprint $table) {
            // visible = tampil di undangan, pending = menunggu persetujuan, hidden = disembunyikan admin
            $table->string('message_status', 10)->default('visible')->after('message');
        });

        Schema::table('events', function (Blueprint $table) {
            // Jika aktif, ucapan baru harus disetujui admin sebelum tampil
            $table->boolean('moderate_wishes')->default(false)->after('wa_message');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('moderate_wishes');
        });

        Schema::table('guests', function (Blueprint $table) {
            $table->dropColumn('message_status');
        });
    }
};
