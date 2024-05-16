<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials, false)) {

            if (auth()->user()->getRoleName() == 'superadmin') {
                return to_route('dashboard');
            } else {
                if (auth()->user()->status == 'NONAKTIF') {
                    Auth::logout();
                    throw ValidationException::withMessages([
                        $this->username() => ['User Di Nonaktifkan, Silahkan hubungi Admin'],
                    ]);
                } else {
                    if (auth()->user()->getRoleName() == 'superadmin') {
                        return to_route('dashboard');
                    } else {
                        return to_route('beranda.index');
                    }
                }
            }
        }
        throw ValidationException::withMessages([
            $this->username() => [trans('Username atau Password Salah, Silahkan Coba Lagi')],
        ]);
    }
}

function authenticated(Request $request, $user)
{
    $user->update([
        'last_login_at' => Carbon::now()->toDateTimeString(),
        'last_login_ip' => $request->getClientIp(),
    ]);
}
