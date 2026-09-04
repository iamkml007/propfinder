<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()&& Auth::user()){
            if(Auth::check() && Auth::user()->role=='admin'){
                return $next($request);
            }else{
                abort(401,'Unauthorized Access !');
            }
        }else{
            return redirect('login');
        }
    }
}
