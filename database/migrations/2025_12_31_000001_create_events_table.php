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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->enum('event_type', ['wedding', 'seminar', 'aqiqah', 'birthday', 'other'])->default('wedding');

            // Bride & Groom / Main Participants
            $table->string('bride_name')->nullable();
            $table->string('bride_father')->nullable();
            $table->string('bride_mother')->nullable();
            $table->string('groom_name')->nullable();
            $table->string('groom_father')->nullable();
            $table->string('groom_mother')->nullable();

            // Event Details
            $table->string('event_title')->nullable();
            $table->text('event_description')->nullable();
            $table->dateTime('event_date')->nullable();
            $table->time('event_time_start')->nullable();
            $table->time('event_time_end')->nullable();

            // Venue Information
            $table->string('venue_name')->nullable();
            $table->text('venue_address')->nullable();
            $table->string('venue_city')->nullable();
            $table->string('venue_maps_url')->nullable();
            $table->decimal('venue_latitude', 10, 8)->nullable();
            $table->decimal('venue_longitude', 11, 8)->nullable();

            // Additional Settings
            $table->string('instagram_bride')->nullable();
            $table->string('instagram_groom')->nullable();
            $table->text('love_story')->nullable();
            $table->string('gallery_folder')->nullable();
            $table->string('background_music')->nullable();

            // Meta
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
