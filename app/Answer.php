<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['subject_id', 'user_answer', 'question', 'option1', 'option2', 'option3', 'option4', 'right_answer'];
}
