<?php

namespace App\Admin\Http\Controllers\Setting;

use App\Common\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UploadController extends Controller
{
    public function image(Request $request): string
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpg,jpeg,png',
        ]);
        $file = $request->file('file');
        $path = $file->store('images/pages', 'public');
        return Storage::disk('public')->url($path);
    }
}