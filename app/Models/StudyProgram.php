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

    public function studyPrograms()
    {
        return $this->belongsTo(Major::class, 'id_jurusan', 'id');
    }
}
