<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

use Illuminate\Support\Facades\Storage;

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

        # 顯示縮圖
        # Storage::files('public/2022-09-01/3QcqQhejNOpvTJTZ/origin/')
        # return [ 'public/2022-09-01/3QcqQhejNOpvTJTZ/origin/abc.jpg' ]
        $storageThumbnails =  Storage::files($this->filePath . '/thumbnails');

        # 轉換成 public 路徑
        $publicThumbnails = [];
        foreach($storageThumbnails as $filename) {
            # 把 'public/2022-09-01/3QcqQhejNOpvTJTZ/origin/abc.jpg'
            # 轉成 '/storage/2022-09-01/3QcqQhejNOpvTJTZ/origin/abc.jpg'
            $publicThumbnails[] = Storage::url($filename);
        }

        return view('photos.show', [
            'thumbnails' => $publicThumbnails,
        ]);
    }
}
