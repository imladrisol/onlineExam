<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'status'];

   /* public function getStatusAttribute($value){
        return $this->attributes['status']?"Active":"Non";
    }*/

    public function subjects(){
        return $this->hasMany('App\Subject');
    }

}
