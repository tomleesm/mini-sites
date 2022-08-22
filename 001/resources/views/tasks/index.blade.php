<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>001 待辦事項清單</title>
</head>
<body>
    <h1>待辦事項清單</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="post" action="{{ route('tasks.store') }}">
        @csrf
        <label>
            <input type="text" name="new-task" autofocus>
            <button type="submit">新增</button>
        </label>
    </form>

    <ul>
    @foreach ($tasks as $task)
        <li>
            {{ $task->content }} |
            <a href="{{ route('tasks.edit', [ 'task' => $task->id ]) }}">修改</a> |
            <a href="#delete">刪除</a>

            <form method="post" action="{{ route('tasks.destroy', [ 'task' => $task->id ]) }}">
                @csrf
                @method('DELETE')
            </form>

        </li>
    @endforeach
    </ul>

</body>
    <script>
        document.querySelectorAll('a[href="#delete"]').forEach(function(element) {
            element.addEventListener('click', function(event) {
                if(confirm('刪除事項 ?') == true) {
                    event.preventDefault();
                    // <a> 的下一個元素即爲要送出的 <form>
                    event.target.nextElementSibling.submit();
                }
            });
        });
    </script>
</html>
