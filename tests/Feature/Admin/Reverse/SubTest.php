<?php

namespace Tests\Feature\Admin\User;

use App\Common\Entity\User;
use App\Common\Entity\Sub;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;



class SubTest extends TestCase
{
    use DatabaseTransactions;

    public function testMain()
    {
        $response = $this->getAuthResponse();
        $response = $this->get('/admin/sub');
        $response
            ->assertStatus(200)
            ->assertSee('Список підписників');
    }

    public function testDelete()
    {
        $response = $this->getAuthResponse();
        $sub = factory(Sub::class)->create();

        $response = $this->delete('/admin/sub/' . $sub->id)
            ->assertStatus(302)
            ->assertRedirect('admin/sub')
            ->assertSessionHas('success', 'Ви успішно видалили підписника.');
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