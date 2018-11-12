<?php

namespace Tests\Feature\Cabinet\Profile;

use App\Common\Entity\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Tests\TestCase;


class MainTest extends TestCase
{

    use DatabaseTransactions;

    public function testMain()
    {
        $response = $this->getAuthResponse();
        $response = $this->get('/cabinet/main');
        $response
            ->assertStatus(200)
            ->assertSee('Дані профіля для документів');
    }

    /*public function testUpdate()
    {
        $response = $this->getAuthResponse();
        $user = User::findOrFail(Auth::id());

        $new_name = $user->name . ' new';
        $response = $this->put('/cabinet/main/' . $user->id, [
            'name' => $new_name
        ])
            ->assertStatus(302)
            ->assertRedirect('cabinet')
            ->assertSessionHas('success', 'Ви успішно обновили основні дані.');
    }*/

    private function getAuthResponse(): \Illuminate\Foundation\Testing\TestResponse
    {
        $user = factory(User::class)->create(['status' => User::STATUS_ACTIVE, 'role' => User::ROLE_USER]);
        return $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret'
        ]);
    }

}