<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
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
        'major',
        'location',
        'description',
        'quota'
    ];

    // method many-to-one pada vacancy ke company
    public function company() {
        return $this->belongsTo(Company::class, 'nib', 'nib');
    }

    // method one-to-meny pada vacancy ke proposal
    public function proposals() {
        return $this->hasMany(Proposal::class, 'id_vacancy', 'id_vacancy');
    }
}
