@extends('layout')

@section('content')
    <h1>Game profile</h1>
    <h2>{{$game->title}}</h2>
    <p>{{$game->description}}</p>


    <form method="POST" action="{{ route('games.delete', ['game' => $game->id]) }}">
        @csrf
        <button>Delete</button>
    </form>

    <hr>
    <h1>Scoreboard</h1>
    <form method="POST" action="{{ route('games.reset', ['game' => $game->id]) }}">
        @csrf
        <button>Reset</button>
    </form>
    <table>
        <thead>
        <tr>
            <th scope="col">Username</th>
            <th scope="col">Score</th>
            <th scope="col">Version</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($game->versions as $version)
            @foreach($version->scores as $score)
                @if(!isset($score->user->block_reason))
                    <tr>
                        <th scope="row">{{$score->user->username}}</th>
                        <td>{{$score->score}}</td>
                        <td>{{$version->created_at}}</td>
                        <td>
                            <form method="POST" action="{{ route('games.deleteSingleScore', ['score' => $score->id]) }}">
                                @csrf
                                <button>Delete</button>
                            </form>
                            <form method="POST" action="{{ route('games.deleteUserScore', ['user' => $score->user->id]) }}">
                                @csrf
                                <button>Delete for user</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        </tbody>
    </table>

@endsection
