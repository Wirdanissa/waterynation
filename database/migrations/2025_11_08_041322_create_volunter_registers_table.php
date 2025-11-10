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
        Schema::create('volunter_registers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('volunter_id')->constrained('volunteers')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('position');
            $table->string('image');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunter_registers');
    }
};
