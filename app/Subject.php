<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable=['name', 'status', 'duration', 'category_id'];

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function questions(){
        return $this->hasMany('App\Question');
    }

    public function hasQuestions(){
        if($this->questions()->get()->count()){
            return true;
        }
        else{
            return false;
        }
    }

    public function answers(){
        return $this->hasMany('App\Answer');
    }

    public function isExamined(){
        if($this->answers()->get()->count()){
            return false;
        }
        return true;
    }
}
