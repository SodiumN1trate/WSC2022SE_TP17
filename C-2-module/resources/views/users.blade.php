@extends('layout')


@section('content')
    <h1>Platform users</h1>

    <table>
        <thead>
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Registered</th>
                <th scope="col">Last login</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row"><a href="{{ route('users.profile', ['username' => $user->username]) }}">{{ $user->username }}</a></th>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->last_login_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
