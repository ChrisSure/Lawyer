<?php

namespace Tests\Unit\Entity\Setting;

use App\Common\Entity\Pages;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;


class PagesTest extends TestCase
{
    use DatabaseTransactions;

    public function testNew(): void
    {
        $page = Pages::new(
            $name = 'name',
            $text = 'text',
            $description = 'desc'
        );

        self::assertNotEmpty($page);

        self::assertEquals($name, $page->name);
        self::assertEquals($text, $page->text);
        self::assertEquals($description, $page->description);

        self::assertTrue($page->isWait());
    }

    public function testEdit(): void
    {
        $page = factory(Pages::class)->create();

        $page->edit(
            $name = 'name_new',
            $text = 'text_new',
            $description = 'desc'
        );

        self::assertNotEmpty($page);

        self::assertEquals($name, $page->name);
        self::assertEquals($text, $page->text);
        self::assertEquals($description, $page->description);
    }

    public function testVerify(): void
    {
        $page = factory(Pages::class)->create(['status' => Pages::STATUS_WAIT]);
        $page->verify();

        self::assertFalse($page->isWait());
        self::assertTrue($page->isActive());
    }

    public function testUnverify(): void
    {
        $page = factory(Pages::class)->create(['status' => Pages::STATUS_ACTIVE]);
        $page->unverify();

        self::assertFalse($page->isActive());
        self::assertTrue($page->isWait());
    }

}