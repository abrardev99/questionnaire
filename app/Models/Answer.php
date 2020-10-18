<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $casts = [ 'is_correct' => 'boolean'];

    public const InitialQuestions = 1;
    public const InitialChoices = 2;
}
