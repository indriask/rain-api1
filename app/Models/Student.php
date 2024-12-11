<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'student';
    protected $guarded = ['id'];
    protected $primaryKey = 'nim';

    protected $fillable = [
        'id_profile',
        'id_user',
        'institute',
        'study_program',
        'major',
        'skill'
    ];
    
}
