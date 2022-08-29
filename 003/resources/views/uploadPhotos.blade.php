<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>003 相簿 </title>
</head>
<body>
    <form method="post" action="{{ route('photos.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="uploadPhotos" multiple>
        <button type="submit">上傳圖片</button>
    </form>
</body>
</html>
