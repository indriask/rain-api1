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
        Schema::create('users', function (Blueprint $table) {
<<<<<<< HEAD
            $table->id('id_user')->primary()->autoIncrement();
            $table->unsignedBigInteger('role');
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->date('created_date');
=======
            $table->id('id_user');
            $table->string('email', 100)->unique();
            $table->unsignedBigInteger('role');
            $table->foreign('role')->references('id')->on('user_roles')->onDelete('cascade');
>>>>>>> fix/conflict
            $table->date('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role')->references('id')->on('user_roles')->onDelete('cascade');
        });

        Schema::create('users_roles', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};