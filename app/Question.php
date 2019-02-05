<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'user_id', 'question', 'type', 'project_id',
    ];
    
    public function questionOptions()
    {
        return $this->hasMany('App\QuestionOption');
    }
    
    public function perseptions()
    {
        return $this->hasMany('App\Perseption');
    }
}
