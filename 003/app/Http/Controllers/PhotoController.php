<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

use Illuminate\Support\Facades\Storage;
use App\Jobs\DeleteImages;

class PhotoController extends Controller
{
    public function store(Request $request) {
        $files = $request->file('uploadPhotos');

        # 儲存原圖
        # 儲存檔案到類似 storage/app/public/2022-08-28/x9wyHUII5Jlsulnb/
        $filePath = sprintf('public/%s/%s/', today()->toDateString(), Str::random());;

        foreach($files as $file) {
            if($request->hasFile('uploadPhotos') && $file->isValid()) {
                $file->store($filePath . 'origin');
            } else {
                Log::error('無法儲存檔案');
            }
        }

        # 產生縮圖
        $thumbnailPath = storage_path('app/' . $filePath . 'thumbnails');
        $originPath = storage_path('app/' . $filePath . 'origin');

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

        # 30 分鐘後刪除圖片
        $runQueueTime = now('Asia/Taipei')->addMinutes(30);
        DeleteImages::dispatch($filePath)->delay($runQueueTime);
        session([ 'runQueueTime' => $runQueueTime->format('Y-m-d H:i:s') ]);
        session([ 'filePath' => $filePath ]);

        return redirect()->route('photos.show');
    }

    public function show()
    {
        # 顯示縮圖
        # Storage::files('public/2022-09-01/3QcqQhejNOpvTJTZ/origin/')
        # return [ 'public/2022-09-01/3QcqQhejNOpvTJTZ/origin/abc.jpg' ]
        $storageThumbnails =  Storage::files(session('filePath') . '/thumbnails');
        $storageOrigin =  Storage::files(session('filePath') . '/origin');

        # 1. 轉換成 public 路徑
        # 用 Storage::url() 把 'public/2022-09-01/3QcqQhejNOpvTJTZ/origin/abc.jpg'
        # 轉成 '/storage/2022-09-01/3QcqQhejNOpvTJTZ/origin/abc.jpg'
        # 2. 縮圖和原始圖片路徑合併到
        # $images = [
        #   0 => [
        #     'thumbnail' => $publicThumbnails[0],
        #     'origin' => $publicOrigin[0] ],
        #   1 => ...
        # ]
        $images = [];
        for($i = 0; $i < count($storageThumbnails); $i++ ) {
            $images[$i] = [
                'thumbnail' => Storage::url($storageThumbnails[$i]),
                'origin' => Storage::url($storageOrigin[$i])
            ];
        }

        return view('photos.show', [
            'images' => $images,
        ]);

    }
}
