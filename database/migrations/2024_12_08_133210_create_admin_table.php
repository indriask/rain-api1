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
        Schema::create('admin', function (Blueprint $table) {
            $table->id('id_admin')->primary()->autoIncrement();
            $table->unsignedBigInteger('id_profile');
            $table->unsignedBigInteger('id_user');
            $table->string('institute', 100)->default('Politeknik Negeri Batam');
            $table->string('privilege', 100);

            $table->foreign('id_profile')
                ->references('id_profile')
                ->on('profile')
                ->onDelete('cascade');

            $table->foreign('id_user')
                ->references('id_user')
                ->on('users')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
