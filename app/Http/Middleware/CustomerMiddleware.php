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
        dump($request,Auth::guard($guard));
        if (Auth::guard($guard)->check()) {
            return $next($request);
        } else {
            return redirect()->to('/?login=0');
        }
    }
}
