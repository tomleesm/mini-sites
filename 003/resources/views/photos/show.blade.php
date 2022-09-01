<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>003 相簿</title>
</head>
<body>
    <h3>圖片將在 {{ session('runQueueTime') }} 刪除</h3>
   @foreach($images as $image)
       <a data-fslightbox="gallery" href="{{ $image['origin'] }}">
           <img src="{{ $image['thumbnail'] }}">
       </a>
   @endforeach
</body>
    <script src="{{ mix('/js/app.js') }}"></script>
</html>
