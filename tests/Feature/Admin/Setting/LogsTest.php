<?php

namespace Tests\Feature\Admin\Setting;

use App\Common\Entity\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Response;
use Tests\TestCase;


class LogsTest extends TestCase
{

    use DatabaseTransactions;

    public function testMain()
    {
        $response = $this->getAuthResponse();
        $response = $this->get('/admin/logs');
        $response
            ->assertStatus(200)
            ->assertSee('Логи');
    }

    public function testDelete()
    {
        $response = $this->getAuthResponse();

        $response = $this->delete('/admin/logs')
            ->assertStatus(302)
            ->assertRedirect('admin/logs')
            ->assertSessionHas('success', 'Ви успішно очистили логи.');
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