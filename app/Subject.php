<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable=['name', 'status', 'duration', 'category_id'];

    public function category(){
        return $this->belongsTo('App\Category');
    }
}
