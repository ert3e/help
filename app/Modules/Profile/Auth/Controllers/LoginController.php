<?php

namespace App\Modules\Profile\Auth\Controllers;

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;


class LoginController extends ProfileController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        parent::__construct();
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm(): \Illuminate\View\View
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     */
    public function login(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'telephone' => 'required',
        ]);
        $credentials = $request->only('telephone');
        if (Auth::attempt($credentials)) {

            auth()->user()->generateCode();

            return redirect()->route('auth.index');
        }

        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }

    public function username()
    {
        return 'telephone';
    }

}
