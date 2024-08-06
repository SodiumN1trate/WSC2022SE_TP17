@extends('layout')


@section('content')
    <h1>User: {{ $user->username }}</h1>
    <p>Last login at: {{ $user->last_login_at }}</p>
    <p>Registered at: {{ $user->created_at }}</p>

    <h1>Block user</h1>
    <hr>
    @if(!isset($user->block_reason))
        <form action="{{ route('users.block', ['user' => $user->id]) }}" method="POST">
            @csrf
            <label>Select reason</label>
            <br>
            <select name="reason">
                <option selected disabled>Select reason</option>
                <option value="0">You have been blocked by an administrator</option>
                <option value="1">You have been blocked for spamming</option>
                <option value="2">You have been blocked for cheating</option>
            </select>
            <br>
            <br>
            <button>BLOCK</button>
        </form>
    @else
        <form action="{{ route('users.unblock', ['user' => $user->id]) }}" method="POST">
            @csrf
            <button>UNBLOCK</button>
        </form>
    @endif
@endsection
