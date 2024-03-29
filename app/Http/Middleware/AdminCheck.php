<?php

namespace App\Http\Middleware;

use Closure;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     //Check if the current user is an admin
    public function handle($request, Closure $next)
    {
        $user = \Auth::user();
        if ($user->id != 1) 
        {
            return redirect()->route('topics.index');
        }       
        return $next($request);
    }
}
