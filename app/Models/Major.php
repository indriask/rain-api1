<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'major';

    protected $fillable = [
        'name'
    ];

    // method many-to-one pada major ke study_program
    public function studyPrograms() {
        return $this->hasMany(StudyProgram::class, 'id_major', 'id');
    }

    // method many-to-one pada major ke vacancy
    public function vacancies() {
        return $this->hasMany(Vacancy::class, 'id_major', 'id');
    }

    // method many-to-one pada major ke student
    public function students() {
        return $this->hasMany(Student::class, 'id_major', 'id');
    }
}
