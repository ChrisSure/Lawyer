<?php

namespace App\Admin\Http\Controllers\Setting;


use App\Common\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stevebauman\LogReader\Facades\LogReader;


class LogsController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.setting');
    }

    public function index(Request $request)
    {
        $logs = (LogReader::paginate(20))->withPath('/admin/logs');
        return view('admin.setting.logs.index', compact('logs'));
    }

    public function destroy()
    {
        LogReader::delete();
        return redirect()->route('admin.logs.index')->with('success', 'Ви успішно очистили логи.');;
    }

}