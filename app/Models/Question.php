<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];
    public const TYPE = [
        1 => 'Free Text',
        2 => 'Multiple Choice (Single Option)',
        3 => 'Multiple Choice (Multiple Option)'
    ];

    public function answers()
    {
        return $this->hasMany(Question::class, 'question_id');
    }
}
