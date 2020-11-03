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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(auth()->user()){
            if(auth()->user()->user_type == 'admin'){
                return redirect()->route('admin.home');
            }else if(auth()->user()->user_type == 'manager'){
                return redirect()->route('manager.home');
            }else{
                return redirect(RouteServiceProvider::HOME);
            }
        }else{
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
