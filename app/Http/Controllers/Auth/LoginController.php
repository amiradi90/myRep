<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
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
    protected $redirectTo = '/pick';
//    protected $redirectTo = '/pick';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

//AMM
//    public function username()
//    {
//        return 'username';
//    }

    public function myLogout(Request $request)
    {
        dd('MylogOut Called');

        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/pick');

//        Auth::user()->logout();
//        return redirect('/');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
