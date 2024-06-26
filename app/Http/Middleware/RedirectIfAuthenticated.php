<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Check the user's role and redirect accordingly
                if (Auth::user()->role === 'first_aider') {
                    return redirect('/prehospitalcare');
                } elseif (Auth::user()->role === 'health_professional') {
                    return redirect('/codeblueforms');
                } 
            }
        }

        return $next($request);
    }
}

