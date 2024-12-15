<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;

    protected $table = 'lowongan';

    protected $fillable = [
        'nama_pekerjaan',
        'id_jurusan',
        'gaji_perbulan',
        'nama_perusahaan',
        'tanggal_pendaftaran',
        'lokasi',
        'jumlah_kouta',
        'jenis_kerja',
        'mode_kerja',
        'lama_magang',
    ];

    /**
     * Relasi ke tabel Prodi (many-to-many).
     */
    public function prodis()
    {
        return $this->belongsToMany(Prodi::class, 'lowongan_prodi', 'lowongan_id', 'prodi_id');
    }

    /**
     * Relasi ke tabel Jurusan (many-to-one).
     */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }
}
