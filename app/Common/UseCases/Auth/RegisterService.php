<?php

namespace App\Common\UseCases\Auth;

use App\Cabinet\Entity\Profile;
use App\Common\Entity\User;
use App\Common\Http\Requests\Auth\RegisterRequest;
use App\Common\Mail\Auth\VerifyMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\DB;


class RegisterService
{
    private $mailer;
    private $dispatcher;

    public function __construct(Mailer $mailer, Dispatcher $dispatcher)
    {
        $this->mailer = $mailer;
        $this->dispatcher = $dispatcher;
    }

    public function register(RegisterRequest $request): void
    {
        $user = User::register(
            $request['name'],
            $request['email'],
            $request['password']
        );
        $this->mailer->to($user->email)->send(new VerifyMail($user));
        $this->dispatcher->dispatch(new Registered($user));
    }

    public function verify($id): void
    {
        /** @var User $user */
        DB::transaction(function () use ($id) {
            $user = User::findOrFail($id);
            Profile::new($user->id);
            $user->verify();
        });
    }
}