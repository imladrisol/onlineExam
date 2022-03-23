<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        return $this->belongsToMany('App\Role')->withTimestamps();
    }

    public function giveUserTo(Role $role){
        return $this->roles()->save($role);
    }

    public function hasRole($role){
        foreach($this->roles()->get() as $role1){
            if($role1->name == $role->name){
                return true;
            }
        }

        return false;
    }

    public function answers(){
        return $this->hasMany('App\Answer');
    }
}
