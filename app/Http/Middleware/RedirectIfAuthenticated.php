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

        // Redirect the user if the user is already authenticated
        if (Auth::guard($guard)->check()) {
            // return redirect(RouteServiceProvider::HOME);
            return redirect()->back();
        }

        // keep flash data in session to continue request
        $request->session()->reflash();

        // Redirect user to login
        return $next($request);

    }

    public function terminate($request, $response)
    {
        // Do something after middleware loads
    }
}
