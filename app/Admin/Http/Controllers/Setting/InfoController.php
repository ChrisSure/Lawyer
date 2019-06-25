<?php

namespace App\Admin\Http\Controllers\Setting;


use App\Common\Http\Controllers\Controller;
use Illuminate\Http\Request;


class InfoController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.setting');
    }

    public function index(Request $request)
    {
        $info = $this->getInfo();
        return view('admin.setting.info.index', compact('info'));
    }

    private function getInfo(): array
    {
        $info = [];
        $info['app_name'] = env('APP_NAME');
        $info['app_env'] = env('APP_ENV');
        $info['app_debug'] = env('APP_DEBUG');
        $info['app_url'] = env('APP_URL');
        $info['app_db'] = env('DB_CONNECTION');
        $info['app_cache'] = env('CACHE_DRIVER');
        $info['app_mail'] = env('MAIL_DRIVER');
        return $info;
    }

}