<?php

namespace App\Admin\Http\Controllers\Articles;

use App\Common\Entity\Articles;
use App\Common\Http\Controllers\Controller;
use Illuminate\Http\Request;


class StateController extends Controller
{

    public function index(Request $request)
    {
        return view('admin.articles.index', compact('articles', 'statuses'));
    }

    public function show(Articles $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    public function destroy(Articles $article)
    {
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Юридична стаття видалена.');
    }

    public function verify(Articles $article)
    {
        $article->verify();
        return redirect()->route('admin.articles.show', $article)->with('success', 'Юридична стаття опублікована.');
    }

    public function unverify(Articles $article)
    {
        $article->unverify();
        return redirect()->route('admin.articles.show', $article)->with('success', 'Юридична стаття переведена в чернетки.');
    }

}