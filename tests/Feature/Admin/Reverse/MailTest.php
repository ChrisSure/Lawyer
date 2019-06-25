<?php

namespace Tests\Feature\Admin\User;

use App\Common\Entity\User;
use App\Admin\Entity\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;



class MailTest extends TestCase
{
    use DatabaseTransactions;

    public function testMain()
    {
        $response = $this->getAuthResponse();
        $response = $this->get('/admin/mail');
        $response
            ->assertStatus(200)
            ->assertSee('Розсилки');
    }

    public function testCreate()
    {
        $response = $this->getAuthResponse();
        $mail = factory(Mail::class)->make();

        $response = $this->post('/admin/mail/store', [
            'text' => $mail->text
        ]);
        $response = $this->get('/admin/mail')->assertSee($mail->text);
    }

    public function testDelete()
    {
        $response = $this->getAuthResponse();
        $mail = factory(Mail::class)->create();

        $response = $this->delete('/admin/mail/' . $mail->id)
            ->assertStatus(302)
            ->assertRedirect('admin/mail')
            ->assertSessionHas('success', 'Ви успішно видалили розсилку.');
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