@extends('layout')

@section('content')
    <h1>User profile</h1>
    <h2>username: {{$user->username}}</h2>
    <p>Registered at: {{$user->created_at}}</p>
    <p>Last login at: {{$user->last_login_at}}</p>


    <hr>
        @csrf
        @if($user->block_reason === null)
        <form method="POST" action="{{ route('users.block', ['id' => $user->id]) }}">
            @csrf
            <label>
                Select reason for blocking:
                <select name="reason">
                    <option value="0">You have been blocked by an administrator</option>
                    <option value="1">You have been blocked for spamming</option>
                    <option value="2">You have been blocked for cheating</option>
                </select>
            </label>
            <button>Block</button>
        </form>
        @else
            <form method="POST" action="{{ route('users.unblock', ['id' => $user->id]) }}">
                @csrf
                <button>Unblock</button>
            </form>
        @endif
@endsection
