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
        Schema::create('vacancy', function (Blueprint $table) {
            $table->id('id_vacancy')->primary()->autoIncrement();
            $table->string('nib');
            $table->unsignedBigInteger('id_major');
            $table->integer('applied');
            $table->string('title', 225);
            $table->string('salary', 20);
            $table->enum('time_type', ['part time', 'full time'])->default('full time');
            $table->enum('type', ['online', 'offline', 'hybrid'])->default('offline');
            $table->string('duration');
            $table->string('location', 100);
            $table->text('description')->nullable();
            $table->integer('quota');
            $table->date('date_created');
            $table->date('date_ended');
            $table->timestamps();

            $table->foreign('nib')
                ->references('nib')
                ->on('company')
                ->onDelete('cascade');

            $table->foreign('id_major')
                ->references('id')
                ->on('major')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancy');
    }
};
