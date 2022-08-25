
@if(count($users) > 0)
<h1>使用者清單</h1>
    <ul>
    @foreach ($users as $user)
        <li>
            <a href="{{ route('users.posts.index', [ 'user' => $user->id ]) }}">{{ $user->name }}</a>
        </li>
    @endforeach
    </ul>
@else
    <p>目前沒有使用者，你要不要<a href="{{ route('register') }}">註冊</a>一個？</p>
@endif
