<?php

namespace Tests\Unit\Entity\Articles;

use App\Common\Entity\Articles;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ArticlesStatusesTest extends TestCase
{
    use DatabaseTransactions;


    public function testVerify(): void
    {
        $articles = factory(Articles::class)->create([
            'author_id' => 1,
            'name' => 'Article 1',
            'text' => 'Text 1',
            'status' => 'wait'
        ]);
        $articles->verify();

        self::assertFalse($articles->isWait());
        self::assertTrue($articles->isActive());
    }

    public function testUnVerified(): void
    {
        $articles = factory(Articles::class)->create([
            'author_id' => 1,
            'name' => 'Article 1',
            'text' => 'Text 1',
            'status' => 'wait'
        ]);
        $articles->verify();

        $this->expectExceptionMessage('Articles is already verified.');
        $articles->verify();
    }
}