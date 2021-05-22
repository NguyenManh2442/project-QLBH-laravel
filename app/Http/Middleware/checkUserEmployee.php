<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class checkUserEmployee
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
        if(Auth::guard('employee')->check() && (Auth::guard('employee')->user()->role==1 || Auth::guard('employee')->user()->role==2 )){
            return redirect()->intended('admin');
        }
        else if(Auth::guard('employee')->check()&&Auth::guard('employee')->user()->role==3){
            return redirect()->intended('shipper');
        }
        return $next($request);
    }
}
