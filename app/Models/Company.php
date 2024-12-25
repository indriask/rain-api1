<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $primaryKey = 'nib';
    protected $table = 'company';

    protected $fillable = [
        'nib',
        'id_profile',
        'id_user',
        'type',
        'business_fields',
        'founded_date',
        'cooperation_file',
        'email_verified_at',
        'status_verified_at'
    ];

    // method one-to-one pada company ke user
    public function account() {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // method one-to-one pada company ke profile
    public function profile() {
        return $this->belongsTo(Profile::class, 'id_profile', 'id_profile');
    }

    // method one-to-many pada company ke vacnacy
    public function vacancies() {
        return $this->hasMany(Vacancy::class, 'nib', 'nib');
    }
}
