<?php

namespace App\Admin\Http\Controllers;

use App\Common\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index()
    {
        return view('admin.home');
    }

}