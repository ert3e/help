<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Privilege
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $privilege
     * @return mixed
     */
    public function handle($request, Closure $next, $privilege)
    {

        if (env('ADMIN_NEED_AUTH')) {
            if (!Auth::user()->hasPrivilege($privilege)) {
                return redirect()->back();
            }
        }

        return $next($request);
    }
}
