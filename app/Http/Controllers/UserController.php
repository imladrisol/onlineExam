<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function getIndex(){
        $users = User::paginate(5);
        $title = 'Users Listing';
        return view ('user.index', compact('users', 'title'));
    }
}
