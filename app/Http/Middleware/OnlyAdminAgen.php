<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class OnlyAdminAgen
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
        if((int)Auth::user()->level == 1 || (int)Auth::user()->level == 3 ):
            return $next($request);
        endif;
        abort(403);
    }
}
