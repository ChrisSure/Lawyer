<?php

namespace App\Common\Http\Controllers\Auth;

use App\Common\Http\Requests\Auth\RegisterRequest;
use App\Common\Entity\User;
use App\Common\Http\Controllers\Controller;
use App\Common\UseCases\Auth\RegisterService;

class RegisterController extends Controller
{
    private $service;

    public function __construct(RegisterService $service)
    {
        $this->middleware('guest');
        $this->service = $service;
    }

    public function showRegistrationForm()
    {
        return view('site.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $this->service->register($request);

        return redirect()->route('login')
            ->with('success', 'Перевірте свою адресу електронної пошти та натисніть посилання, щоб підтвердити.');
    }

    public function verify($token)
    {
        if (!$user = User::where('verify_token', $token)->first()) {
            return redirect()->route('login')
                ->with('error', 'На жаль, ваша посилання не може бути ідентифікована.');
        }

        try {
            $this->service->verify($user->id);
            return redirect()->route('login')->with('success', 'Ваш електронний лист підтверджено. Тепер ви можете ввійти.');
        } catch (\DomainException $e) {
            return redirect()->route('login')->with('error', $e->getMessage());
        }
    }
}