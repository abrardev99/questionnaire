<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{

    protected $casts = [ 'can_resume' => 'boolean', 'published' => 'boolean' ];

    const HOUR = [
        1 => 1,
        2 => 2
    ];

    const MIN = [
        5 => 5,
        10 => 10,
        15 => 15,
        20 => 20,
        25 => 25,
        30 => 30,
        35 => 35,
        40 => 40,
    ];

    public function getResumeForHumanAttribute($query)
    {
        return $this->can_resume ? 'Yes' : 'No';
    }

    public function getPublishedForHumanAttribute($query)
    {
        return $this->published ? 'Yes' : 'No';
    }

    public function getDurationForHumanAttribute($query)
    {
        return $this->duration_hour . 'hr ' . $this->duration_min . 'min';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'questionnaire_id');
    }
}
