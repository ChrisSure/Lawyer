<?php

namespace App\Admin\UseCases\Reverse;

use App\Common\Entity\Sub;
use App\Admin\Mail\Reverse\SendMail;
use Illuminate\Contracts\Mail\Mailer;

class MailService
{
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMail(string $text): void
    {
        $emails = Sub::all();
        foreach($emails as $email) {
            $this->mailer->to($email->email)->send(new SendMail($text));
        }
    }

}