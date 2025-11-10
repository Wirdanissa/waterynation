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
        Schema::create('organisasis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('about');
            $table->text('visi');
            $table->text('misi');
            $table->text('core_values');
            $table->text('focus_areas');
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->string('qris_image');
            $table->string('qris_name');
            $table->string('qris_info');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisasis');
    }
};
