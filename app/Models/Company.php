<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
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
}
