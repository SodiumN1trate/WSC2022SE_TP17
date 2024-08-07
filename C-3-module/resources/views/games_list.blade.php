@extends('layout')

@section('content')
    <h1>Games</h1>

    <label>
        Filter
        <input type="text" id="filter">
    </label>
    <table>
        <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Thumbnail</th>
            <th scope="col">Author</th>
            <th scope="col">Versions</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
            @foreach($games as $game)
                <tr>
                    <th scope="row"><a href="{{ route('games.profile', ['slug' => $game->slug]) }}">{{$game->title}}</a></th>
                    <td>{{$game->description}}</td>
                    <td><img src="{{$game->thumbnail}}"></td>
                    <td>{{$game->user->username}}</td>
                    <td><ul>@foreach($game->versions as $version)
                            <li>{{ $version->created_at }}</li>
                    @endforeach</ul></td>
                    <td>{{ $game->trashed() ? 'deleted' : '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        const rows = document.querySelectorAll('tbody > tr > th > a')
        const filter = document.getElementById('filter')

        filter.addEventListener('input', (e) => {
            rows.forEach((row) => {
                if(row.innerHTML.includes(e.target.value)) {
                    row.parentNode.parentNode.style.display = 'table-row'
                } else {
                    row.parentNode.parentNode.style.display = 'none'
                }
            })
        })


    </script>
@endsection
