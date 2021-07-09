<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
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
        if(Auth::check()){
            if(Auth::user()->role==2){
                return $next($request);
            }else{
                abort(401, 'This action is unauthorized.');
            }
            
        }else{
            return redirect('lobby');
        }
        return $next($request);
    }
}
