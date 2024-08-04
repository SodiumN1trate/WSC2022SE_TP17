@extends('layout')
@section('content')
    <h1>User profile</h1>
    <hr>
    <h2>Username: {{ $user->username }}</h2>
    <p>Last login at: {{ $user->last_login_at }}</p>
    <p>Registered at: {{ $user->created_at }}</p>

    <br>
    <h1>Block user</h1>
    <hr>
    @if(!isset($user->block_reason))
        <form method="POST" action="{{ route('users.block', ['id' => $user->id]) }}">
            @csrf
            <label>
                Reason
                <br>
                <select name="block_reason">
                    <option value="199" selected>---</option>
                    <option value="0">You have been blocked by an administrator</option>
                    <option value="1">You have been blocked for spamming</option>
                    <option value="2">You have been blocked for cheating</option>
                </select>
            </label>
            <br>
            <button>BLOCK</button>
        </form>
    @else
        <form method="POST" action="{{ route('users.unblock', ['id' => $user->id]) }}">
            @csrf
            <button>UNBLOCK</button>
        </form>
    @endif
@endsection
