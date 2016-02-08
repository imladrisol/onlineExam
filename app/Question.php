<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question', 'option1', 'option2', 'option3', 'option4', 'answer'];

    public function subject(){
        return $this->belongsTo('App\Subject');
    }
}
