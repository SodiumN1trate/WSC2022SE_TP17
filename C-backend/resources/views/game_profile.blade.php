@extends('layout')
@section('content')
    <h1>User profile</h1>
    <hr>
{{--    <img src="{{config('app.url')}}/storage{{ $game->versions[0]->path }}/thumbnail.png" width="400">--}}
    <h2>Title: {{ $game->title }}</h2>
    <p>Description: {{ $game->description }}</p>


    <form method="POST" action="{{ route('games.delete', ['id' => $game->id]) }}">
        @csrf
        @if(!$game->is_deleted)
            <button>Delete</button>
        @endif
    </form>
    <hr>

    <form method="POST" action="{{ route('games_score.reset', ['id' => $game->id]) }}">
        @csrf
        <button>Reset score</button>
    </form>

    <h1>Scores:</h1>
    <table>
        <thead>
        <tr>
            <th scope="col">Player</th>
            <th scope="col">Version</th>
            <th scope="col">Score</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($game->versions as $version)
            @foreach($version->scores as $score)
                <tr>
                    <th scope="row">{{ $score->user->username }}</th>
                    <th scope="row">{{ $version->created_at }}</th>
                    <th scope="row">{{ $score->score }}</th>
                    <th scope="row">
                        <form method="post" action="{{ route('scores.delete', ['id' => $score->id]) }}">
                            @csrf
                            <button type="submit">Delete</button>
                        </form>
                        <form method="post" action="{{ route('player_scores.delete', ['id' => $score->user->id]) }}">
                            @csrf
                            <button type="submit">Delete all for player</button>
                        </form>
                    </th>
                </tr>
            @endforeach
        @endforeach
    </table>

@endsection
