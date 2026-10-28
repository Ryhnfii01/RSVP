<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Daftar orang yang diundang ke sebuah acara, masing-masing dengan link personal.
     * Berbeda dengan `guests` yang berisi jawaban RSVP.
     */
    public function up(): void
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('phone', 20)->nullable();
            $table->string('group', 50)->nullable();
            // Kode acak di link personal: /u/{slug}/{code}
            $table->string('code', 16)->unique();
            $table->timestamp('opened_at')->nullable();
            // Jawaban RSVP dari link personal ini (dipakai F-07)
            $table->foreignId('guest_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();

            $table->index(['event_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
