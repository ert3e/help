<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class IsVerified
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

        if (Auth::user() && !Auth::user()->email_verified_at && env('USER_NEED_VERIFY')) {
            Auth::logout();

            return redirect()->route('main')->with('message_error', 'Ваш аккаунт не активирован! Активируйте аккаунт по ссылке, отправленной на почту!');
        }

        return $next($request);
    }
}
