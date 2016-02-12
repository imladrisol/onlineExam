<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Role;

class UserPanel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        //dd($user->email);

        if($user){
            $role = Role::whereName('guest')->first();
            if($user->hasRole($role)){
                return $next($request);
            }
        }
        return redirect('/');
    }
}
