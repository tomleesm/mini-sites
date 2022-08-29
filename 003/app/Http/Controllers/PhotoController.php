<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Log;

class PhotoController extends Controller
{
    public function store(Request $request) {
        $files = $request->file('uploadPhotos');

        if($request->hasFile('uploadPhotos') && $files->isValid()) {

            # 儲存檔案到類似 storage/app/2022-08-28/x9wyHUII5Jlsulnb/
            $path = sprintf('%s/%s/origin/', today()->toDateString(), Str::random());
            $files->store($path);
        } else {
            Log::error('無法儲存檔案');
        }
    }
}
