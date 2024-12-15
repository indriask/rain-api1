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
        Schema::create('lowongan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pekerjaan');
            $table->unsignedBigInteger('id_jurusan'); // Foreign key ke tabel jurusan
            $table->decimal('gaji_perbulan', 10, 2); // Format untuk nilai gaji
            $table->string('nama_perusahaan');
            $table->date('tanggal_pendaftaran');
            $table->string('lokasi');
            $table->integer('jumlah_kouta');
            $table->enum('jenis_kerja', ['Fulltime', 'Partime']);
            $table->enum('mode_kerja', ['Offline', 'Online', 'Hybrid']);
            $table->string('lama_magang');
            $table->timestamps();

            // Definisikan foreign key untuk id_jurusan
            $table->foreign('id_jurusan')
                  ->references('id')
                  ->on('jurusan')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan');
    }
};
