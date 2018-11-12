<?php

namespace Tests\Feature\Cabinet\Profile;

use App\Common\Entity\User;
use App\Cabinet\Entity\Profile;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Tests\TestCase;


class ProfileTest extends TestCase
{

    use DatabaseTransactions;

    public function testMain()
    {
        $response = $this->getAuthResponse();
        $profile = factory(Profile::class)->create(['user_id' => Auth::id()]);
        $response = $this->get('/cabinet/profile');
        $response
            ->assertStatus(200)
            ->assertSee('Дані профіля для документів');
    }

    /*public function testUpdate()
    {
        $response = $this->getAuthResponse();
        $profile = factory(Profile::class)->create(['user_id' => Auth::id()]);

        $new_name = $profile->lastname . ' new';

        $response = $this->put('/cabinet/profile/' . $profile->id, [
            'firstname' => $profile->firstname,
            'lastname' => $new_name,
            'surname' => $profile->surname,
            'address' => $profile->address,
            'phone' => $profile->phone
        ])
            ->assertStatus(302)
            ->assertRedirect('cabinet')
            ->assertSessionHas('success', 'Ви успішно обновили профіль.');
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