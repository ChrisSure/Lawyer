<?php

namespace Tests\Unit\Entity\Reverse;

use App\Common\Entity\Sub;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;


class SubTest extends TestCase
{
    use DatabaseTransactions;

    public function testNew(): void
    {
        $sub = Sub::new(
            $email = 'test@gmail.com'
        );

        self::assertNotEmpty($sub);
        self::assertEquals($email, $sub->email);
    }

}