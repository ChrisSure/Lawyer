<?php

namespace Tests\Unit\Cabinet\Entity;

use App\Cabinet\Entity\Profile;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;


class ProfileTest extends TestCase
{
    use DatabaseTransactions;


    public function testCreate(): void
    {
        $profile = Profile::new(
            $user_id = 222
        );

        self::assertNotEmpty($profile);
        self::assertEquals($user_id, $profile->user_id);
    }


    public function testEdit(): void
    {
        $profile = factory(Profile::class)->create();

        $profile->edit(
            $firstname = 'firstname_fff',
            $lastname = 'name_ne46w',
            $surname = 'text_ne655w',
            $address = 'text_n55ew',
            $phone = '45454545'
        );

        self::assertNotEmpty($profile);

        self::assertEquals($firstname, $profile->firstname);
        self::assertEquals($lastname, $profile->lastname);
        self::assertEquals($surname, $profile->surname);
        self::assertEquals($address, $profile->address);
        self::assertEquals($phone, $profile->phone);
    }
}