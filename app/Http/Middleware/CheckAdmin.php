<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
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
        if (Auth::check()){
            if (Auth::user()->privilege != "admin" && Auth::user()->privilege != "manager") {
                return redirect('/library/home');
            }
        }else{
            return redirect('/log-in');
        }
        
        return $next($request);
    }
}
