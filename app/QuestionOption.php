<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    protected $fillable = [
        'option', 'question_id', 'project_id',
    ];
}
