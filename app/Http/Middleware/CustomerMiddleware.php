<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'customer')
    {
        if (Auth::guard($guard)->check()) {
            dd(Auth::guard($guard)->user());
            return $next($request);
        } else {
            dd(Auth::guard($guard)->user());
            return redirect()->to('/?login=0');
        }
    }
}
