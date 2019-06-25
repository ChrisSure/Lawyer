<?php

namespace Tests\Unit\Admin\Entity\Reverse;

use App\Admin\Entity\Mail;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;


class MailCreateTest extends TestCase
{
    use DatabaseTransactions;

    public function testNew(): void
    {
        $mail = Mail::new(
            $text = 'text'
        );

        self::assertNotEmpty($mail);
        self::assertEquals($text, $mail->text);
    }
}