<?php

namespace App\Admin\Http\Controllers\Reverse;

use App\Common\Entity\Sub;
use App\Common\Http\Controllers\Controller;
use Illuminate\Http\Request;


class SubController extends Controller
{

    public function index(Request $request)
    {
        $subs = Sub::orderByDesc('id')->paginate(20);
        return view('admin.reverse.sub.index', compact('subs'));
    }

    public function destroy(Sub $sub)
    {
        $sub->delete();
        return redirect()->route('admin.sub.index')->with('success', 'Ви успішно видалили підписника.');;
    }

}