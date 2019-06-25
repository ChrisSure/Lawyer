<?php

namespace App\Site\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\Http\Controllers\Controller;


class HomeController extends Controller
{

    public function index()
    {
        return view('site.home');
    }
}
