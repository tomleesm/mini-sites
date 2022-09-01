<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class PhotoController extends Controller
{
    # 儲存檔案到類似 storage/app/2022-08-28/x9wyHUII5Jlsulnb/
    private $filePath;

    public function __construct() {
        $this->filePath = sprintf('public/%s/%s/', today()->toDateString(), Str::random());
    }

    public function store(Request $request) {
        $files = $request->file('uploadPhotos');

        # 儲存原圖
        foreach($files as $file) {
            if($request->hasFile('uploadPhotos') && $file->isValid()) {
                $file->store($this->filePath . 'origin');
            } else {
                Log::error('無法儲存檔案');
            }
        }

        # 產生縮圖
        $thumbnailPath = storage_path('app/' . $this->filePath . 'thumbnails');
        $originPath = storage_path('app/' . $this->filePath . 'origin');

        $mkdir = new Process(['mkdir', '-p', $thumbnailPath]);
        $generateThumbnails = new Process([
            'mogrify',
            '-format',
            'gif',
            '-path',
            $thumbnailPath,
            '-thumbnail',
            '100x100',
            $originPath . '/*'
        ]);

        try {
            $mkdir->mustRun();
            $generateThumbnails->mustRun();
        } catch (ProcessFailedException $exception) {
            Log::error($exception->getMessage());
        }
    }
}
