<?php

namespace App\Http\Middleware;

use App\Modules\Admin\Users\Models as User;
use Ert3e\PhoneAuth\Models as Ert3;
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

        if (Auth::user()) {
            $userPhone = Auth::user()->phone;
            $userPhoneConfirmed = Ert3\ConfirmedPhone::confirmed($userPhone);

            if (!$userPhoneConfirmed) {
                Auth::logout();

                return redirect()->route('main')->with('message_error', 'Ваш аккаунт не активирован! ');
            }
        }

        return $next($request);
    }
}
