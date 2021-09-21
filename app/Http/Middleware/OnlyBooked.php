<?php

namespace App\Http\Middleware;

use Closure;
use App\Awb;

class OnlyBooked
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
        $awb = Awb::find($request->route()->parameter('id'));
        if($awb->status_tracking == 'booked'  && $request->route()->parameter('hilang') !== 'hilang'):
            return $next($request);
        elseif($awb->status_tracking == 'complete' && $request->route()->parameter('hilang') == 'hilang'):
            return $next($request);
        endif;
        abort(403);
    }
}
