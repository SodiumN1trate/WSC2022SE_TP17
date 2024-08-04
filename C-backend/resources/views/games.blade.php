@extends('layout')
@section('content')
    <label>
        Filter:
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
                <th scope="row"><a href="{{ route('games.profile', ['slug' => $game->slug]) }}">{{ $game->title }}</a></th>
                <td>{{ $game->description }}</td>
                <td>{{ $game->thumbnail }}</td>
                <td>{{ $game->author->username }}</td>
                <td><ul>
                        @foreach ($game->versions  as $version)
                            <li>{{$version->created_at}}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $game->is_deleted ? 'deleted' : '' }}</td>
            </tr>
        @endforeach
    </table>
    <script>
        const rows = document.querySelectorAll('tbody > tr')
        document.getElementById('filter').addEventListener('input', (e) => {
            rows.forEach((row) => {
                if(!row.childNodes[1].childNodes[0].innerHTML.includes(e.target.value)) {
                    row.style.display = 'none'
                } else {
                    row.style.display = 'table-row'
                }
            })
        })
    </script>

@endsection
