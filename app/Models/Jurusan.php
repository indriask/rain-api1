<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';

    protected $fillable = ['name'];

    // Relasi one-to-many ke Prodi
    public function prodis()
    {
        return $this->hasMany(Prodi::class, 'id_jurusan', 'id');
    }
}
