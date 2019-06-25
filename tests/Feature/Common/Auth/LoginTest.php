<?php

namespace Tests\Feature\Common\Auth;

use App\Common\Entity\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;


class LoginTest extends TestCase
{

    use DatabaseTransactions;

    public function testForm(): void
    {
        $response = $this->get('/login');

        $response
            ->assertStatus(200)
            ->assertSee('Login');
    }

    public function testErrors(): void
    {
        $response = $this->post('/login', [
            'email' => '',
            'password' => '',
        ]);

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors(['email', 'password']);
    }

    public function testWait(): void
    {
        $user = factory(User::class)->create(['status' => User::STATUS_WAIT]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret',
        ]);

        $response
            ->assertStatus(302)
            ->assertRedirect('/')
            ->assertSessionHas('error', 'Вам потрібно підтвердити свій акаунт. Будь ласка, перевірте свою електронну пошту.');
    }

    public function testActive(): void
    {
        $user = factory(User::class)->create(['status' => User::STATUS_ACTIVE]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret',
        ]);

        if ($user->role == User::ROLE_USER) {
            $response->assertStatus(302)->assertRedirect('/cabinet');
        } else {
            $response->assertStatus(302)->assertRedirect('/admin');
        }


        $this->assertAuthenticated();
    }
}