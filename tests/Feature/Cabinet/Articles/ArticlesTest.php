<?php

namespace Tests\Feature\Cabinet\Articles;

use App\Common\Entity\User;
use App\Common\Entity\Articles;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Tests\TestCase;


class ArticlesTest extends TestCase
{

    use DatabaseTransactions;

    public function testMain()
    {
        $response = $this->getAuthResponse();
        $response = $this->get('/cabinet/articles');
        $response
            ->assertStatus(200)
            ->assertSee('Мої юридичні статті');
    }

    public function testCreate()
    {
        $response = $this->getAuthResponse();
        $articles = factory(Articles::class)->make();

        $response = $this->post('/cabinet/articles', [
            'name' => $articles->name,
            'text' => $articles->text,
            'description' => $articles->description
        ]);
        $response = $this->get('/cabinet/articles')->assertSee($articles->name);
    }

    public function testUpdate()
    {
        $response = $this->getAuthResponse();
        $articles = factory(Articles::class)->create(['author_id' => Auth::id()]);

        $new_name = $articles->name . ' new';

        $response = $this->put('/cabinet/articles/' . $articles->id, [
            'name' => $new_name,
            'text' => $articles->text,
            'description' => $articles->description
        ])
            ->assertStatus(302)
            ->assertRedirect('cabinet/articles/' . $articles->id)
            ->assertSessionHas('success', 'Ви успішно обновили юридичну статтю.');
    }

    public function testDelete()
    {
        $response = $this->getAuthResponse();
        $articles = factory(Articles::class)->create();

        $response = $this->delete('/cabinet/articles/' . $articles->id);
        $response = $this->get('/cabinet/articles')->assertDontSee($articles->name);
    }

    private function getAuthResponse(): \Illuminate\Foundation\Testing\TestResponse
    {
        $user = factory(User::class)->create(['status' => User::STATUS_ACTIVE, 'role' => User::ROLE_USER]);
        return $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret'
        ]);
    }

}