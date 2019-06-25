<?php

namespace Tests\Feature\Admin\Articles;

use App\Common\Entity\User;
use App\Common\Entity\Articles;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;


class ArticlesTest extends TestCase
{
    use DatabaseTransactions;

    public function testMain()
    {
        $response = $this->getAuthResponse();
        $response = $this->get('/admin/articles');
        $response
            ->assertStatus(200)
            ->assertSee('Юридичні статті');
    }

    public function testCreate()
    {
        $response = $this->getAuthResponse();
        $articles = factory(Articles::class)->create();

        $response = $this->get('/admin/articles/' . $articles->id);
        $response
            ->assertStatus(200)
            ->assertSee($articles->name);
    }

    public function testVerifyToUnverify()
    {
        $response = $this->getAuthResponse();
        $articles = factory(Articles::class)->create(['status' => Articles::STATUS_WAIT]);

        $response = $this->post('/admin/articles/' . $articles->id . "/verify")
            ->assertStatus(302)
            ->assertRedirect('admin/articles/' . $articles->id)
            ->assertSessionHas('success', 'Юридична стаття опублікована.');

        $response = $this->post('/admin/articles/' . $articles->id . "/unverify")
            ->assertStatus(302)
            ->assertRedirect('admin/articles/' . $articles->id)
            ->assertSessionHas('success', 'Юридична стаття переведена в чернетки.');
    }

    public function testDelete()
    {
        $response = $this->getAuthResponse();
        $articles = factory(Articles::class)->create(['status' => Articles::STATUS_WAIT]);

        $response = $this->delete('/admin/articles/' . $articles->id)
            ->assertStatus(302)
            ->assertRedirect('admin/articles')
            ->assertSessionHas('success', 'Юридична стаття видалена.');
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