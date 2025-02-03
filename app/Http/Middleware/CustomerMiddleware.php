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
            return $next($request);
        } else {
            dd($request,Auth::guard($guard));
            return redirect()->to('/?login=0');
        }
    }
}
