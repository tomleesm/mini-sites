<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $post->title }}</title>
</head>
<body>
    <h1>{{ $post->title }}</h1>
    <article>
        {{ $post->content }}
    </article>
    <p>新增文章時間：{{ $post->created_at }}</p>
    <p>修改文章時間：{{ $post->updated_at }}</p>
</body>
</html>
