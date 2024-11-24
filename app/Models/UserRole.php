<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $table = 'user_roles'; 
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
    protected $fillable = ['label'];
    protected $dates = ['created_at', 'updated_at'];
    protected $hidden = ['id'];

    public function users (): HasMany {
        return $this->hasMany(User::class,'roles_id');
    }
}
