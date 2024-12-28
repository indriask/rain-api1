<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'user_roles';

    public function users() {
        return $this->hasMany(User::class, 'id_role', 'id');
    }
}
