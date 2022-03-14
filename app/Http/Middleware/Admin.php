<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class Admin
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

        if (env('ADMIN_NEED_AUTH')) {
            // || Auth::user()->position_id == User::USER
            if (!Auth::check()) {
                return redirect()->route('main');
            }
        }

        if (Session::get('admin') != env('ADMIN_PASSWORD') AND !Route::is('admin.auth')) {
            return redirect()->route('admin.auth');
        }

        return $next($request);
    }
}
