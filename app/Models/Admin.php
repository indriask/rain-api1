<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $primaryKey = 'id_admin';
    protected $table = 'admin';

    protected $fillable = [
        'id_profile',
        'id_user',
        'institute',
        'privilege',
    ];

    // method one-to-one pada admin ke user
    public function account() {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // method one-to-one pada admin ke profile
    public function profile() {
        return $this->belongsTo(Profile::class, 'id_profile', 'id_profile');
    }
}
