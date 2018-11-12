<?php

namespace App\Admin\UseCases\Setting;

use App\Common\Entity\Pages;


class PagesService
{

    public function verify($id): void
    {
        /** @var Pages $page */
        $page = Pages::findOrFail($id);
        $page->verify();
    }

    public function unverify($id): void
    {
        /** @var Pages $page */
        $page = Pages::findOrFail($id);
        $page->unverify();
    }

}