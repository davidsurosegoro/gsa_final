<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class OnlyAdminAgenDriver
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
        if((int)Auth::user()->level == 1 || (int)Auth::user()->level == 3 || (int)Auth::user()->level == 5 ):
            return $next($request);
        endif;
        abort(403);
    }
}
