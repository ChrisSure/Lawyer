<?php

namespace App\Site\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Common\Entity\Sub;
use App\Common\Entity\Pages;
use App\Site\Http\Requests\SubRequest;
use App\Common\Http\Controllers\Controller;


class AboutController extends Controller
{

    public function index()
    {
        $page = Pages::findOrFail(1);
        return view('site.about', compact('page'));
    }

    public function store(SubRequest $request)
    {
        Sub::new($request['email']);
        return redirect()->route('about')->with('success', 'Ви успішно підписались на наші новини.');
    }

}
