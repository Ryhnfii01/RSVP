<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Template pesan WhatsApp per acara dan catatan kapan undangan dikirim.
     */
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Kosong = pakai pesan bawaan (Event::DEFAULT_WA_MESSAGE)
            $table->text('wa_message')->nullable()->after('gift_address');
        });

        Schema::table('invitations', function (Blueprint $table) {
            // Terakhir kali tombol "Kirim via WhatsApp" diklik di admin
            $table->timestamp('sent_at')->nullable()->after('code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->dropColumn('sent_at');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('wa_message');
        });
    }
};
