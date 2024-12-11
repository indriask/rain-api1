<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
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
}
