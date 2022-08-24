@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <ul>
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif
        </ul>

        <div class="col-md-8">
            <a href="{{ route('posts.create') }}">新增文章</a>
        </div>
    </div>
</div>
@endsection
