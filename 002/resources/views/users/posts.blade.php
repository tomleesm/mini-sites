<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $user->name }} 的所有文章</title>
</head>
<body>
    @foreach($posts as $post)
        <p>
            <a href="{{ route('users.posts.show', [ 'user' => $user->id, 'post' => $post->id ]) }}">{{ $post->title }}</a>
        </p>
    @endforeach
</body>
</html>
