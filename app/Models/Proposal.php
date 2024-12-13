<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $primaryKey = 'id_proposal';
    protected $table = 'proposal';

    protected $fillable = [
        'id_vacancy',
        'nim',
        'resume',
        'applied_date',
        'interview_date',
        'final_status',
        'proposal_status',
        'interview_status'
    ];

    // method many-to-one pada proposal ke student
    public function student() {
        return $this->belongsTo(Student::class, 'nim', 'nim');
    }

    // method many-to-one pada proposal ke vacancy
    public function vacancy() {
        return $this->belongsTo(Vacancy::class, 'id_vacancy', 'id_vacancy');
    }
}
