<?php

namespace Tests\Unit\Entity\Reverse;

use App\Common\Entity\Reverse;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;


class ReverseTest extends TestCase
{
    use DatabaseTransactions;

    public function testVerify(): void
    {
        $reverse = factory(Reverse::class)->create([
            'name' => 'Reverse 1',
            'text' => 'Text 1',
            'status' => 'unread'
        ]);
        $reverse->verify();

        self::assertFalse($reverse->isUnRead());
        self::assertTrue($reverse->isRead());
    }

    public function testNew(): void
    {
        $reverse = Reverse::new(
            null,
            $name = 'name',
            $text = 'text'
        );

        self::assertNotEmpty($reverse);
        self::assertEquals($name, $reverse->name);
        self::assertEquals($text, $reverse->text);
    }

}