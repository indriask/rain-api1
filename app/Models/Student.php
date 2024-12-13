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

    // method one-to-one pada student ke user
    public function account() {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // method one-to-one pada student ke profile
    public function profile() {
        return $this->belongsTo(Profile::class, 'id_profile', 'id_profile');
    }

    // method one-to-many pada student ke proposal
    public function proposals() {
        return $this->hasMany(Proposal::class, 'nim', 'nim');
    }
}
