<?php

namespace Tests\Unit\Site\Entity\Articles;

use App\Common\Entity\Articles;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ArticlesTest extends TestCase
{
    use DatabaseTransactions;


    public function testCreate(): void
    {
        $article = Articles::new(
            $name = 'name',
            $text = 'text',
            $description = 'desc'
        );

        self::assertNotEmpty($article);

        self::assertEquals($name, $article->name);
        self::assertEquals($text, $article->text);
        self::assertEquals($description, $article->description);

        self::assertTrue($article->isWait());
    }


    public function testEdit(): void
    {
        $article = factory(Articles::class)->create();

        $article->edit(
            $name = 'name_new',
            $text = 'text_new',
            $description = 'desc'
        );

        self::assertNotEmpty($article);

        self::assertEquals($name, $article->name);
        self::assertEquals($text, $article->text);
        self::assertEquals($description, $article->description);
    }
}