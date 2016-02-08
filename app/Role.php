<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    public function users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function giveRoleTo(User $user){
        return $this->users()->save($user);
    }
}
