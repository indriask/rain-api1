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
        Schema::create('student', function (Blueprint $table) {
            $table->id('nim')->primary();
            $table->unsignedBigInteger('id_profile');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_major');
            $table->unsignedBigInteger('id_study_program');
            $table->string('institute', 100)->nullable(true);
            $table->string('skill', 100)->nullable(true);
            $table->timestamps();

            $table->foreign('id_profile')
                ->references('id_profile')
                ->on('profile')
                ->onDelete('cascade');
            
            $table->foreign('id_user')
                ->references('id_user')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('id_major')
                ->references('id')
                ->on('major')
                ->onDelete('cascade');

            $table->foreign('id_study_program')
                ->references('id')
                ->on('study_program')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
