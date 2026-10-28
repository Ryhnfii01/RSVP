<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Alamat undangan: /u/{slug}
            $table->string('slug')->nullable()->unique()->after('id');
            $table->string('template', 20)->default('template-1')->after('slug');
        });

        // Isi slug untuk acara yang sudah ada
        foreach (DB::table('events')->get() as $event) {
            $base = Str::slug(trim(($event->bride_name ?? '') . ' ' . ($event->groom_name ?? ''))) ?: 'acara';
            DB::table('events')->where('id', $event->id)->update(['slug' => $base . '-' . $event->id]);
        }

        Schema::table('guests', function (Blueprint $table) {
            $table->foreignId('event_id')->nullable()->after('id')->constrained()->cascadeOnDelete();

            // Satu email boleh RSVP di beberapa acara, tapi sekali per acara
            $table->dropUnique(['email']);
            $table->unique(['event_id', 'email']);
        });

        // Tamu lama milik acara pertama
        $firstEventId = DB::table('events')->orderBy('id')->value('id');
        if ($firstEventId) {
            DB::table('guests')->whereNull('event_id')->update(['event_id' => $firstEventId]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guests', function (Blueprint $table) {
            $table->dropUnique(['event_id', 'email']);
            $table->dropConstrainedForeignId('event_id');
            $table->unique('email');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn(['slug', 'template']);
        });
    }
};
