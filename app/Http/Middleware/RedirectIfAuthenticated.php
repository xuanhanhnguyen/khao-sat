<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(Auth::user()->status == 0){
                Auth::logout();
                return redirect(route('login'));
            }
            else if(Auth::user()->role_id == 2) {
                return redirect(RouteServiceProvider::HOME);
            }else{
                return $next($request);
            }
        }

        return $next($request);
    }
}
