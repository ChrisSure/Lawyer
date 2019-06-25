<?php

namespace App\Admin\Mail\Reverse;

use App\Common\Entity\Sub;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use SerializesModels;

    public $text;

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function build()
    {
        return $this
            ->subject('Signup Confirmation')
            ->markdown('admin.emails.reverse.send');
    }
}
