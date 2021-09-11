<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        switch(Auth::user()->tipo){
            case 'ADMIN':
                return $next($request);
                break;
            case 'PRESTADOR':
                return redirect()->route('dashboard');
                break;
            case 'DEPARTAMENTO':
                return redirect()->route('dashboard');
                break;
            default:
                abort(401);
                break;
        }
    }
}
