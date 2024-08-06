@extends('layout')


@section('content')
    <h1>Admins</h1>

    <table>
        <thead>
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Created</th>
                <th scope="col">Last login</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
                <tr>
                    <th scope="row">{{ $admin->username }}</th>
                    <td>{{ $admin->created_at }}</td>
                    <td>{{ $admin->last_login_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
