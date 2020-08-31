<?php

namespace App\Http\Middleware;

use Closure;

class DeveloperMiddleware
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
        if (\Auth::user() !== null) {

            if (\Auth::user()->role == 'developer') {
                return $next($request);
            }

            return redirect('/apps');
        }

        abort(403, "Forbidden - You don't have permission to access / on this server");
        // return $next($request);
    }
}
