<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;

class Role
{   
    /**
     * Handle an incoming request.
     *
     * Check if the user's role matches the required role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  The required role for the route
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role)
    {
       $roles = array_slice(func_get_args(),2);
       foreach($roles as $role){
         $user = Auth::user()->role;
            if($user == $role){
                return $next($request);
            }
       }
       return redirect()->back();
    }
}
