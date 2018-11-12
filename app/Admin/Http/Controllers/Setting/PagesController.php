<?php

namespace App\Admin\Http\Controllers\Setting;


use App\Admin\Http\Requests\Setting\CreatePagesRequest;
use App\Admin\UseCases\Setting\PagesService;
use App\Common\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Common\Entity\Pages;


class PagesController extends Controller
{

    /**
     * @var PagesService
     */
    private $service;

    public function __construct(PagesService $service)
    {

        $this->middleware('can:admin.setting');
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $pages = Pages::orderByDesc('id')->paginate(20);
        return view('admin.setting.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.setting.pages.create');
    }

    public function store(CreatePagesRequest $request)
    {
        $page = Pages::new(
            $request['name'],
            $request['text'],
            $request['description']
        );
        return redirect()->route('admin.pages.show', $page)->with('success', 'Ви успішно додали сторінку.');
    }

    public function edit(Pages $page)
    {
        return view('admin.setting.pages.edit', compact('page'));
    }

    public function update(CreatePagesRequest $request, Pages $page)
    {
        $page->edit(
            $request['name'],
            $request['text'],
            $request['description']
        );
        return redirect()->route('admin.pages.show', $page)->with('success', 'Ви успішно обновили сторінку.');
    }

    public function show(Pages $page)
    {
        return view('admin.setting.pages.show', compact('page'));
    }

    public function destroy(Pages $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index');
    }

    public function verify(Pages $page)
    {
        $this->service->verify($page->id);
        return redirect()->route('admin.pages.show', $page)->with('success', 'Ви успішно опублікували сторінку.');
    }

    public function unverify(Pages $page)
    {
        $this->service->unverify($page->id);
        return redirect()->route('admin.pages.show', $page)->with('success', 'Ви перевели сторінку в чорновик.');
    }

}