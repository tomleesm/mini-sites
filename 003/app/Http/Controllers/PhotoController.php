<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Log;

class PhotoController extends Controller
{
    public function store(Request $request) {
        $files = $request->file('uploadPhotos');

        # 儲存檔案到類似 storage/app/2022-08-28/x9wyHUII5Jlsulnb/origin/
        $path = sprintf('%s/%s/origin/', today()->toDateString(), Str::random());
        foreach($files as $file) {
            if($request->hasFile('uploadPhotos') && $file->isValid()) {
                $file->store($path);
            } else {
                Log::error('無法儲存檔案');
            }
        }
    }
}
