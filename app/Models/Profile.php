<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_profile';
    protected $table = 'profile';

    protected $fillable = [
        'photo_profile',
        'first_name',
        'last_name',
        'location',
        'postal_code',
        'city',
        'phone_number',
        'descriptin'
    ];

    // method one-to-one pada profile ke student
    public function student() {
        return $this->hasOne(Student::class, 'id_profile', 'id_profile');
    }

    public function company() {
        return $this->hasOne(Company::class, 'id_profile', 'id_profile');
    }

    public function admin() {
        return $this->hasOne(Admin::class, 'id_profile', 'id_profile');
    }
}
