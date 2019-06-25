<?php

namespace App\Admin\Http\Controllers\Reverse;

use App\Common\Entity\Reverse;
use App\Common\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ReverseController extends Controller
{

    public function index(Request $request)
    {
        $reverses = Reverse::with('user')->orderByDesc('id')->paginate(20);
        return view('admin.reverse.reverse.index', compact('reverses'));
    }

    public function destroy(Reverse $reverse)
    {
        $reverse->delete();
        return redirect()->route('admin.reverse.index');
    }

    public function verify(Reverse $reverse)
    {
        $reverse->verify();
        return redirect()->route('admin.reverse.index')->with('success', 'Ви успішно позначили прочитаним повідомлення.');
    }

}