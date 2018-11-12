<?php

namespace Tests\Feature\Site\Pages;

use App\Common\Entity\Sub;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;


class SubAddTest extends TestCase
{
    use DatabaseTransactions;

    public function testMain()
    {
        $response = $this->get('/about');
        $response
            ->assertStatus(200)
            ->assertSee('Про нас');
    }


    public function testAddSub()
    {
        $sub = factory(Sub::class)->make();

        $response = $this->post('/about', [
            'email' => $sub->email
        ])
            ->assertStatus(302)
            ->assertRedirect('/about')
            ->assertSessionHas('success', 'Ви успішно підписались на наші новини.');
    }

}