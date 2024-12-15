<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LowonganProdi extends Model
{
    use HasFactory;

    protected $table = 'lowongan_prodi';

    protected $fillable = [
        'lowongan_id',
        'prodi_id',
    ];

    /**
     * Relasi ke tabel Lowongan.
     */
    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'lowongan_id');
    }

    /**
     * Relasi ke tabel Prodi.
     */
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}
