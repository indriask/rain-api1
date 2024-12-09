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
        Schema::create('profile', function (Blueprint $table) {
            $table->id('id_profile')->primary()->autoIncrement();
            $table->string('photo_profile', 255);
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('location', 255)->nullable(true);
            $table->string('postal_code', 20)->nullable(true);
            $table->string('city', 255)->nullable(true);
            $table->string('phone_number', 15)->nullable(true);
            $table->text('description')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
