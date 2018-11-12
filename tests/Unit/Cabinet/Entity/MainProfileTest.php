<?php

namespace Tests\Unit\Cabinet\Entity;

use App\Common\Entity\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;


class MainProfileTest extends TestCase
{
    use DatabaseTransactions;

    public function testEditMain(): void
    {
        $user = factory(User::class)->create();

        $user->editMain(
            $name = 'name_new',
            $email = 'new@mail.ru'
        );

        self::assertNotEmpty($user);

        self::assertEquals($name, $user->name);
        self::assertEquals($email, $user->email);
    }
}