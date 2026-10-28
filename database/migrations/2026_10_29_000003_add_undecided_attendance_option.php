<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Template menawarkan pilihan "Masih Ragu", tapi kolom enum lama hanya
 * menerima hadir / tidak_hadir sehingga RSVP itu gagal tersimpan di MySQL.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('guests', function (Blueprint $table) {
            $table->enum('attendance', ['hadir', 'tidak_hadir', 'masih_ragu'])->default('hadir')->change();
        });
    }

    public function down(): void
    {
        DB::table('guests')->where('attendance', 'masih_ragu')->update(['attendance' => 'tidak_hadir']);

        Schema::table('guests', function (Blueprint $table) {
            $table->enum('attendance', ['hadir', 'tidak_hadir'])->default('hadir')->change();
        });
    }
};
