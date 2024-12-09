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
        Schema::create('proposal', function (Blueprint $table) {
            $table->id('id_proposal')->primary();
            $table->unsignedBigInteger('id_vacancy');
            $table->unsignedBigInteger('nim');
            $table->string('resume', 50);
            $table->date('applied_date');
            $table->date('interview_date')->nullable();
            $table->enum('final_status', ['approved', 'rejected', 'waiting'])->default('waiting');
            $table->enum('proposal_status', ['approved', 'rejected', 'waiting'])->default('waiting');
            $table->enum('interview_status', ['approved', 'rejected', 'waiting'])->default('waiting');

            $table->foreign('id_vacancy')
                ->references('id_vacancy')
                ->on('vacancy')
                ->onDelete('cascade');

            $table->foreign('nim')
                ->references('nim')
                ->on('student')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal');
    }
};
