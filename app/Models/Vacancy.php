<?php

namespace App\Models;

use Database\Factories\VacancyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_vacancy';
    protected $table = 'vacancy';

    protected $fillable = [
        'nib',
        'applied',
        'status',
        'title',
        'salary',
        'time_type',
        'type',
        'duration',
        'id_major',
        'location',
        'description',
        'date_created',
        'date_ended',
        'quota'
    ];

    // membuat instansiasi object baru dengan model vacancy
    protected static function newFactory() {
        return VacancyFactory::new();
    }

    // method many-to-one pada vacancy ke company
    public function company() {
        return $this->belongsTo(Company::class, 'nib', 'nib');
    }

    // method one-to-meny pada vacancy ke proposal
    public function proposals() {
        return $this->hasMany(Proposal::class, 'id_vacancy', 'id_vacancy');
    }

    // method one-to-many pada vacancy ke major
    public function major() {
        return $this->belongsTo(Major::class, 'id_major', 'id');
    }
}
