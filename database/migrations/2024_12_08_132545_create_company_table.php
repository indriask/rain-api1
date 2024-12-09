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
        Schema::create('company', function (Blueprint $table) {
            $table->id('nib')->primary();
            $table->unsignedBigInteger('id_profile');
            $table->unsignedBigInteger('id_user');
            $table->string('type', 50)->nullable(true);
            $table->string('business_fields', 50)->nullable(true);
            $table->date('founded_date')->nullable(true);

            $table->foreign('id_profile')
                ->references('id_profile')
                ->on('profile')
                ->onDelete('cascade');

            $table->foreign('id_user')
                ->references('id')
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
        Schema::dropIfExists('company');
    }
};
