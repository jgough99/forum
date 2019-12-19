<?php

namespace App\Http\Middleware;

use Closure;
use App\Post;
use Auth;


class SameUserLogin
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
        $user = Auth::user();
        $id = $request->route("post_id");
        
        $owner_id = Post::findOrFail($id)->user->id;



        if ($user->id != $owner_id)     
        {
            return redirect()->route('topics.index');
        }       
        return $next($request);
    }
}
