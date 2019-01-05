<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        if($request->user() === null){ // if no login
            return redirect('/login');
        }
        $actions = $request->route()->getAction(); //get action from route
        $roles = isset($actions['roles'])? $actions['roles']: null; //retrive roles from route

        if($request->user()->hasAnyRole($roles) || !$roles){ //check user has role match or not
            return $next($request);
        }

        return redirect('/unauthorized');
    }
}
