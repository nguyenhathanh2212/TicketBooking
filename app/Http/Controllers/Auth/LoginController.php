<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        if (Auth::guard()->check()) {
            return redirect()->action('Admin\HomeController@index');
        }

        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $data = $request->only([
            'email',
            'password',
        ]);

        if (Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ])) {
            if (in_array(Auth::user()->role, [config('setting.user.role.super_admin'), config('setting.user.role.admin')])
                || Auth::user()->userCompanies()->count()) {
                return redirect()->action('Admin\HomeController@index');
            }

            Auth::logout();
        }
        
        return redirect()
            ->action('Auth\LoginController@index')
            ->with('message', trans('auth.failed'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect()->action('Auth\LoginController@index');
    }
}
