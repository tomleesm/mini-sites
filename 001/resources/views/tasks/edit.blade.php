<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>001 待辦事項清單</title>
</head>
<body>
    @if($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <form method="post" action="{{ route('tasks.update', [ 'task' => $task->id ]) }}">
        @csrf
        @method('PUT')

        <label>
            <input type="text" name="update-task" value="{{ $task->content }}" autofocus>
            <button type="submit">儲存</button>
        </label>
    </form>

    <p>
        <a href="{{ route('tasks.index') }}">回到事項清單</a>
    </p>
</body>
</html>
