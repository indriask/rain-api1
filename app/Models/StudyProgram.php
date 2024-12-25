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

    // method many-to-one pada study_program ke students
    public function students() {
        return $this->hasMany(Student::class, 'id_study_program', 'id');
    }
}
