<?php

namespace Tests\Feature\Common\Auth;

use App\Common\Entity\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;


class ForgetTest extends TestCase
{

    use DatabaseTransactions;

    public function testForm(): void
    {
        $response = $this->get('/password/reset');

        $response
            ->assertStatus(200)
            ->assertSee('Скидання пароля');
    }

    /*public function testReset(): void
    {
        $user = factory(User::class)->create([
            'status' => User::STATUS_ACTIVE
        ]);

        $response = $this->post('/password/email', [
            'email' => $user->email,
        ])
            ->assertStatus(302)
            ->assertRedirect('password/reset')
            ->assertSessionHas('status', 'Ми надіслали вам електронний лист із посиланням на скидання пароля!');
    }*/

    /*public function testFailedReset(): void
    {
        $user = factory(User::class)->create([
            'status' => User::STATUS_ACTIVE
        ]);

        $response = $this->post('/password/email', [
            'email' => $user->email,
        ])
            ->assertStatus(302)
            ->assertRedirect('/password/reset')
            ->assertSessionHas('error', 'Ми не можемо знайти користувача з цією адресою електронної пошти.');
    }*/


}