<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLevelAdmin
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
        if(Auth::guard('employee')->check()){
            if ( Auth::guard('employee')->user()->role == 1 && Auth::guard('employee')->user()->status == 1) {
                return $next($request);
            }
            Auth::guard('employee')->logout();
            return redirect('/404.html');
        }else{
            return redirect('/404.html');
        }
    }
}
