<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Crypt;

class OnlyAdminAgenKurir
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
        $status = Crypt::decrypt($request->route()->parameters['status']);
        if($status == 'delivery-by-courier' || $status == 'complete'){
            if((int)Auth::user()->level == 1 || (int)Auth::user()->level == 3):
                return $next($request);
            endif;
        }
        if($status == 'loaded' && (int)Auth::user()->level == 1){
            return $next($request);
        }
        abort(403);
    }
}
