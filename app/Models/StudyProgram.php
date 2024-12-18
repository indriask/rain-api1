<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'study_program';

    protected $fillable = [
        'name'
    ];

    // method one-to-many pada study_program ke major
    public function major()
    {
        return $this->belongsTo(Major::class, 'id_jurusan', 'id');
    }
}
