@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(count($users) > 0)
            <h1>作者清單</h1>
                @foreach ($users as $user)
                    <p>
                        <a href="{{ route('users.posts.index', [ 'user' => $user->id ]) }}">{{ $user->name }} - {{ $user->email }}</a>
                    </p>
                @endforeach
            @else
                <p>目前沒有使用者，你要不要<a href="{{ route('register') }}">註冊</a>一個？</p>
            @endif

            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
