<?php

namespace App\Site\Http\Controllers\Articles;

use Illuminate\Http\Request;
use App\Common\Entity\Articles;
use App\Common\Http\Controllers\Controller;


class ArticlesController extends Controller
{

    public function index(Request $request)
    {
        $query = Articles::active();
        if (!empty($value = $request->get('search'))) {
            $query->where('name', 'like', '%' . $value . '%');
        }
        $articles = $query->paginate(20);
        return view('site.articles.index', compact('articles'));
    }

    public function show(Articles $article)
    {
        return view('site.articles.show', compact('article'));
    }

}
