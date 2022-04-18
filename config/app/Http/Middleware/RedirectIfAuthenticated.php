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
    public function handle($request, Closure $next)
    {
        if (auth('admin')->check()) {
            return redirect(RouteServiceProvider::HOME);
        }

        if (auth('student')->check()) {
            return redirect(RouteServiceProvider::STUDENT);
        }

        return $next($request);
    }
}
