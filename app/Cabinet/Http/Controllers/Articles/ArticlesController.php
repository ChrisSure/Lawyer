<?php

namespace App\Cabinet\Http\Controllers\Articles;

use App\Cabinet\Http\Requests\Articles\CreateArticlesRequest;
use App\Cabinet\Http\Requests\Articles\UpdateArticlesRequest;
use App\Common\Http\Controllers\Controller;
use App\Common\Entity\Articles;
use Illuminate\Support\Facades\Gate;


class ArticlesController extends Controller
{

    public function index()
    {
        $articles = Articles::my()->paginate(20);
        return view('cabinet.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('cabinet.articles.create');
    }

    public function store(CreateArticlesRequest $request)
    {
        $article = Articles::new(
            $request['name'],
            $request['text'],
            $request['description']
        );
        return redirect()->route('cabinet.articles.show', $article)->with('success', 'Ви успішно додали юридичну статтю.');
    }

    public function edit(Articles $article)
    {
        $this->checkAccess($article);
        return view('cabinet.articles.edit', compact('article'));
    }

    public function update(UpdateArticlesRequest $request, Articles $article)
    {
        $this->checkAccess($article);
        $article->edit(
            $request['name'],
            $request['text'],
            $request['description']
        );
        return redirect()->route('cabinet.articles.show', $article)->with('success', 'Ви успішно обновили юридичну статтю.');
    }

    public function show(Articles $article)
    {
        $this->checkAccess($article);
        return view('cabinet.articles.show', compact('article'));
    }

    public function destroy(Articles $article)
    {
        $this->checkAccess($article);
        $article->delete();
        return redirect()->route('cabinet.articles.index');
    }

    private function checkAccess(Articles $article): void
    {
        if (!Gate::allows('manage-own-articles', $article)) {
            abort(403);
        }
    }
}
