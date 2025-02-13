<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }




    public function showForm($type)
    {
        return view('auth.login',compact('type'));
    }


    public function login(Request $request){

        //return $request;
        if (Auth::guard($request->type)->attempt(['email' => $request->email, 'password' => $request->password])) {
            if($request->type == 'student')
            {
                return redirect()->intended(RouteServiceProvider::STUDENT);
            }
            elseif($request->type == 'admin')
            {
                return redirect()->intended(RouteServiceProvider::HOME);
            }else{
                return redirect()->route('selection');
            }
        }else{
            return redirect()->back()->with('password_error', __('Incorrect email or password'));
        }

    }
    public function logout(Request $request,$type)
    {
        Auth::guard($type)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
