<?php

namespace App\Http\Middleware;

use Closure;


use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserStatus
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

$expire = Carbon::now()->addMinute(1) ;

Cache::put('user-is-online'. Auth::user()->id, true, $expire);
        }


        return $next($request);


    }
}
