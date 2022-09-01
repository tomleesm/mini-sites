<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>003 相簿</title>
</head>
<body>
   @foreach($thumbnails as $thumbnail)
       <img src="{{ $thumbnail }}">
   @endforeach
</body>
    <script src="{{ mix('/js/app.js') }}"></script>
</html>
