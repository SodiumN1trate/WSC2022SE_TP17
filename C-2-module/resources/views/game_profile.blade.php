@extends('layout')


@section('content')
    <h1>Title: {{ $game->title }}</h1>
    <p>{{ $game->description }}</p>

    <hr>
    <form action="{{ route('games.delete', ['game' => $game->id]) }}" method="POST">
        @csrf
        <button>Delete</button>
    </form>

    <br>
    <form action="{{ route('games.reset', ['game' => $game->id]) }}" method="POST">
        @csrf
        <button>Reset scoreboard</button>
    </form>
    <h1>Score baord</h1>
    <table>
        <thead>
        <tr>
            <th scope="col">Player</th>
            <th scope="col">Score</th>
            <th scope="col">Version</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($game->versions as $version)
            @foreach($version->scores as $score)
                @if(!isset($score->user->block_reason))
                    <tr>
                        <th scope="row">{{ $score->user->username }}</th>
                        <td>{{ $score->score }}</td>
                        <td>{{ $version->created_at }}</td>
                        <td>
                            <form action="{{ route('score.delete', ['score' => $score->id]) }}" method="POST">
                                @csrf
                                <button>Delete</button>
                            </form>
                            <form action="{{ route('player.reset', ['user' => $score->user->id]) }}" method="POST">
                                @csrf
                                <button>Reset for player</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        </tbody>
    </table>

@endsection
