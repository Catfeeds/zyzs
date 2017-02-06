<?php

namespace App\Http\Middleware;

use Closure;
use App\Onlineserver;
use Cookie;
use Redirect;

class ServersMiddleware
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
        if (Cookie::has('serverusername') && Cookie::has('serverkey')) {
            $serverusername = Cookie::get('serverusername');
            $serverkey = Cookie::get('serverkey');
            if (!empty($serverusername) && !empty($serverkey)) {
                $server = Onlineserver::where('id',$serverusername)->where('permission',4)->where('key',$serverkey)->first();
                if ($server) {
                    return $next($request);
                }
            }   
        }
        $array = array('status' =>'auth' ,'errmsg'=>'权限验证失败' );
        return response($array, 200);
    }
}
