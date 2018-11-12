<?php

namespace Tests\Feature\Admin\Setting;

use App\Common\Entity\User;
use App\Common\Entity\Pages;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Response;
use Tests\TestCase;


class PagesTest extends TestCase
{

    use DatabaseTransactions;

    public function testMain()
    {
        $response = $this->getAuthResponse();
        $response = $this->get('/admin/pages');
        $response
            ->assertStatus(200)
            ->assertSee('Сторінки');
    }

    public function testCreate()
    {
        $response = $this->getAuthResponse();
        $page = factory(Pages::class)->make();

        $response = $this->post('/admin/pages', [
            'name' => $page->name,
            'text' => $page->text,
            'description' => $page->description
        ]);
        $response = $this->get('/admin/pages')->assertSee($page->name);
    }

    public function testUpdate()
    {
        $response = $this->getAuthResponse();
        $page = factory(Pages::class)->create();

        $new_name = $page->name . ' new';

        $response = $this->put('/admin/pages/' . $page->id, [
            'name' => $new_name,
            'text' => $page->text,
            'description' => $page->description
        ])
            ->assertStatus(302)
            ->assertRedirect('admin/pages/' . $page->id)
            ->assertSessionHas('success', 'Ви успішно обновили сторінку.');
    }

    public function testDelete()
    {
        $response = $this->getAuthResponse();
        $page = factory(Pages::class)->create();

        $response = $this->delete('/admin/pages/' . $page->id);
        $response = $this->get('/admin/pages')->assertDontSee($page->name);
    }

    public function testVerify()
    {
        $response = $this->getAuthResponse();
        $page = factory(Pages::class)->create(['status' => Pages::STATUS_WAIT]);

        $response = $this->post('/admin/pages/' . $page->id . '/verify')
            ->assertSessionHas('success', 'Ви успішно опублікували сторінку.');
    }

    public function testUnverify()
    {
        $response = $this->getAuthResponse();
        $page = factory(Pages::class)->create(['status' => Pages::STATUS_ACTIVE]);

        $response = $this->post('/admin/pages/' . $page->id . '/unverify')
            ->assertSessionHas('success', 'Ви перевели сторінку в чорновик.');
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