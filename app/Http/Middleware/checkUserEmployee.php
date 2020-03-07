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
        if(Auth::guard('employee')->check()&&Auth::guard('employee')->user()->level==1){
            return redirect()->intended('admin');
        }
        elseif(Auth::guard('employee')->check()&&Auth::guard('employee')->user()->level==2){
            return redirect()->intended('employee');
        }
        elseif(Auth::guard('employee')->check()&&Auth::guard('employee')->user()->level==3){
            return redirect()->intended('shipper');
        }
        return $next($request);
    }
}
