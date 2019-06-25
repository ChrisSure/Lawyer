<?php

namespace App\Site\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Common\Entity\Reverse;
use App\Common\Entity\Pages;
use App\Site\Http\Requests\ReverseRequest;
use App\Common\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ContactsController extends Controller
{

    public function index()
    {
        $page = Pages::findOrFail(2);
        return view('site.contacts', compact('page'));
    }

    public function store(ReverseRequest $request)
    {
        Reverse::new(
            (Auth::check()) ? Auth::user()->id : null,
            $request['name'],
            $request['text']);
        return redirect()->route('contacts')->with('success', 'Ви успішно надіслали нам лист.');
    }

}
