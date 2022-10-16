@extends('layouts.app')

@section('content')
    <ul id="messages"></ul>
    @guest
        <p id="join-message">{{ __('Login') }} or {{ __('Register') }} to Join</p>
    @else
    <form id="form" action="">
        <input id="input" autocomplete="off" /><button>Send</button>
        <input id="user_id" type="hidden" value="{{ $user->id }}" />
    </form>
    @endguest
@endsection
