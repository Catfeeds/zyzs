<?php

namespace App\Http\Middleware;
use Auth;
use Redirect;
use Closure;

class AdminMiddleware
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
        if (Auth::user() && Auth::user()->permission>="5") {
            return $next($request);
        }
        $errmsg= array('report'=>'error','errmsg'=>'无权访问','location'=>'/');
        return Redirect::to('notice')->with('errmsg',$errmsg);
    }
}
