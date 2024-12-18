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

    public function studyPrograms() {
        return $this->hasMany(StudyProgram::class, 'id_major', 'id');
    }
}
