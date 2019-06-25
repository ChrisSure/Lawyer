<?php

namespace App\Common\Http\Controllers\Auth;

use App\Common\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Common\Http\Requests\Auth\LoginsRequest;


class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('site.auth.login');
    }

    public function login(LoginsRequest $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $this->sendLockoutResponse($request);
        }

        $authenticate = Auth::attempt(
            $request->only(['email', 'password']),
            $request->filled('remember')
        );

        if ($authenticate) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            $user = Auth::user();
            if ($user->isWait()) {
                Auth::logout();
                return back()->with('error', 'Вам потрібно підтвердити свій акаунт. Будь ласка, перевірте свою електронну пошту.');
            }
            if ($user->role == "user") {
                return redirect()->intended(route('cabinet.home'));
            } else {
                return redirect()->intended(route('admin.home'));
            }

        }

        $this->incrementLoginAttempts($request);

        throw ValidationException::withMessages(['email' => 'Неправельний логін або пароль.']);
    }

    public function logout(Request $request)
    {
        Auth::guard()->logout();
        $request->session()->invalidate();
        return redirect()->route('home');
    }

    protected function username()
    {
        return 'email';
    }
}
