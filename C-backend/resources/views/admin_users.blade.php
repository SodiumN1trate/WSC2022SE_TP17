@extends('layout')
@section('content')
    <table>
        <thead>
        <tr>
            <th scope="col">Username</th>
            <th scope="col">Created at</th>
            <th scope="col">Last login at</th>
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
    </table>
@endsection
