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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');

            $table->enum('category', [
                'Offline Action',
                'Online Webinar',
                'Modul Development For Kids'
            ]);

            // ✅ Flag apakah program punya form registrasi
            $table->boolean('is_registrasi')->default(false);

            $table->string('image')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('link_url')->nullable();
            $table->string('lokasi')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status_publikasi', ['Published', 'Hidden'])->default('Hidden');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
