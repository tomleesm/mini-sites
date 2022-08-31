<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>003 相簿 </title>
</head>
<body>
    <form method="post" action="{{ route('photos.store') }}" enctype="multipart/form-data">
        @csrf
        <p><input type="file" name="uploadPhotos[]" multiple accept="image/gif,image/jpeg,image/png"><button type="submit">上傳圖片</button></p>
        <p>上傳圖片限制：每張圖片 10 MB，最多 50 張，總共最多 100 MB，類型爲 JPG、GIF 和 PNG</p>
    </form>
</body>
</html>
