<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perseption extends Model
{
    protected $fillable = [
        'perseption', 'question_id', 'project_id',
    ];
}
