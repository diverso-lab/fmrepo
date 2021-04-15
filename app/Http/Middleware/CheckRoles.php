<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {

        $roles = explode('|', $roles);

        foreach(Auth::user()->roles as $rol)
        {
            if (in_array($rol->rol, $roles))
            {
                return $next($request);
            }
        }

        return redirect()->route('home');

    }
}
