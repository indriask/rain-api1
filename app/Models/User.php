<?php

namespace App\Models;

use App\Notifications\SendResetPasswordVerification;
use App\Notifications\SendVerificationEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasFactory, Notifiable;

    protected $primaryKey = "id_user";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'role',
        'created_date',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // method one-to-one pada user ke student
    public function student()
    {
        return $this->hasOne(Student::class, 'id_user', 'id_user'); // Relasi ke student
    }
    
    // method one-to-one pada user ke company
    public function company() {
        return $this->hasOne(Company::class, 'id_user', 'id_user');
    }

    // metod one-to-one pada user ke admin
    public function admin() {
        return $this->hasOne(Admin::class, 'id_user', 'id_user');
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new SendVerificationEmail);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new SendResetPasswordVerification($token));
    }
}
