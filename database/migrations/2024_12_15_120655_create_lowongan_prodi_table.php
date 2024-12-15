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
        Schema::create('lowongan_prodi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lowongan_id');
            $table->unsignedBigInteger('prodi_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('lowongan_id')
                  ->references('id')
                  ->on('lowongan')
                  ->onDelete('cascade');

            $table->foreign('prodi_id')
                  ->references('id')
                  ->on('prodi')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan_prodi');
    }
};
