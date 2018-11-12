<?php

namespace Tests\Feature\Site\Pages;

use App\Common\Entity\Reverse;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;


class ReverseAddTest extends TestCase
{
    use DatabaseTransactions;

    public function testMain()
    {
        $response = $this->get('/contacts');
        $response
            ->assertStatus(200)
            ->assertSee('Контакти');
    }


    public function testAddReverse()
    {
        $reverse = factory(Reverse::class)->make();

        $response = $this->post('/contacts', [
            'name' => $reverse->name,
            'text' => $reverse->text
        ])
            ->assertStatus(302)
            ->assertRedirect('/contacts')
            ->assertSessionHas('success', 'Ви успішно надіслали нам лист.');
    }

}