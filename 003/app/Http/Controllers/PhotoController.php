<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Log;

class PhotoController extends Controller
{
    # 儲存檔案到類似 storage/app/2022-08-28/x9wyHUII5Jlsulnb/
    private $filePath;

    public function __construct() {
        $this->filePath = sprintf('%s/%s/', today()->toDateString(), Str::random());
    }

    public function store(Request $request) {
        $files = $request->file('uploadPhotos');

        foreach($files as $file) {
            if($request->hasFile('uploadPhotos') && $file->isValid()) {
                $file->store($this->filePath . 'origin');
            } else {
                Log::error('無法儲存檔案');
            }
        }

    }
}
