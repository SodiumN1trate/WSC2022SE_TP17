@extends('layout')
@section('content')
    <table>
        <thead>
        <tr>
            <th scope="col">Username</th>
            <th scope="col">Created at</th>
            <th scope="col">Last login at</th>
            <th scope="col">Is blocked</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row"><a href="{{ route('users.profile', ['username' => $user->username]) }}">{{ $user->username }}</a></th>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->last_login_at }}</td>
                <td>{{ isset($user->block_reason) ? 'Yes' : 'No' }}</td>
            </tr>
        @endforeach
    </table>
@endsection
