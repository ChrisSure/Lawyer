<?php

namespace Tests\Feature\Admin\Reverse;

use App\Common\Entity\User;
use App\Common\Entity\Reverse;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;


class ReverseTest extends TestCase
{
    use DatabaseTransactions;

    public function testMain()
    {
        $response = $this->getAuthResponse();
        $response = $this->get('/admin/reverse');
        $response
            ->assertStatus(200)
            ->assertSee('Листи від користувачів');
    }


    public function testVerify()
    {
        $response = $this->getAuthResponse();
        $reverse = factory(Reverse::class)->create(['status' => Reverse::STATUS_UNREAD]);

        $response = $this->get('/admin/reverse/' . $reverse->id . '/verify')
            ->assertStatus(302)
            ->assertRedirect('/admin/reverse')
            ->assertSessionHas('success', 'Ви успішно позначили прочитаним повідомлення.');
    }

    public function testDelete()
    {
        $response = $this->getAuthResponse();
        $reverse = factory(Reverse::class)->create(['status' => Reverse::STATUS_UNREAD]);

        $response = $this->delete('/admin/reverse/' . $reverse->id)
            ->assertDontSee($reverse->name);
    }


    private function getAuthResponse(): \Illuminate\Foundation\Testing\TestResponse
    {
        $user = factory(User::class)->create(['status' => User::STATUS_ACTIVE, 'role' => User::ROLE_ADMIN]);
        return $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret'
        ]);
    }

}