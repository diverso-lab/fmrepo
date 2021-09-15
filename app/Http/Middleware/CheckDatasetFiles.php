<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckDatasetFiles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if(!is_dir(base_path('/storage/app/tmp/'.session()->token()))){
            return redirect()->back()->withInput()->with('error', 'You cannot create datasets without any associated files.');
        }

        return $next($request);
    }
}
