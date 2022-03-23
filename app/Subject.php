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
        $res = false;
        if($this->questions()->get()->count()){
            $res = true;
        }
        return $res;
    }

    public function answers(){
        return $this->hasMany('App\Answer');
    }

    public function isExamined(){
        $res = true;
        if($this->answers()->get()->count()){
            $res = false;
        }
        return $res;
    }
}
