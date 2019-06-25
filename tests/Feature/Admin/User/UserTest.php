<?php

namespace Tests\Feature\Admin\User;

use App\Common\Entity\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;


class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function testMain()
    {
        $response = $this->getAuthResponse();
        $response = $this->get('/admin/users');
        $response
            ->assertStatus(200)
            ->assertSee('Користувачі');
    }

    public function testCreate()
    {
        $response = $this->getAuthResponse();
        $user = factory(User::class)->make();

        $response = $this->post('/admin/users', [
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role
        ]);
        $response = $this->get('/admin/users')->assertSee($user->name);
    }

    public function testUpdate()
    {
        $response = $this->getAuthResponse();
        $user = factory(User::class)->create();

        $new_name = $user->name . ' new';

        $response = $this->put('/admin/users/' . $user->id, [
            'name' => $new_name,
            'email' => $user->email,
            'role' => $user->role
        ])
            ->assertStatus(302)
            ->assertRedirect('admin/users/' . $user->id)
            ->assertSessionHas('success', 'Ви успішно змінили дані користувача.');
    }

    public function testDelete()
    {
        $response = $this->getAuthResponse();
        $user = factory(User::class)->create();

        $response = $this->delete('/admin/users/' . $user->id);
        $response = $this->get('/admin/users')->assertDontSee($user->name);
    }

    public function testVerify()
    {
        $response = $this->getAuthResponse();
        $user = factory(User::class)->create(['status' => User::STATUS_WAIT]);

        $response = $this->post('/admin/users/' . $user->id . '/verify')
            ->assertSessionHas('success', 'Ви успішно верифікували користувача.');
    }


    private function getAuthResponse(): \Illuminate\Foundation\Testing\TestResponse
    {
        $user = factory(User::class)->create(['status' => User::STATUS_ACTIVE, 'role' => User::ROLE_SUPER_ADMIN]);
        return $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret'
        ]);
    }

}