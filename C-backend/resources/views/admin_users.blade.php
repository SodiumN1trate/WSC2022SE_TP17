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

    <style>
        table {
            border-collapse: collapse;
            border: 2px solid rgb(140 140 140);
            font-family: sans-serif;
            font-size: 0.8rem;
            letter-spacing: 1px;
        }

        caption {
            caption-side: bottom;
            padding: 10px;
            font-weight: bold;
        }

        thead,
        tfoot {
            background-color: rgb(228 240 245);
        }

        th,
        td {
            border: 1px solid rgb(160 160 160);
            padding: 8px 10px;
        }

        td:last-of-type {
            text-align: center;
        }

        tbody > tr:nth-of-type(even) {
            background-color: rgb(237 238 242);
        }

        tfoot th {
            text-align: right;
        }

        tfoot td {
            font-weight: bold;
        }

    </style>
@endsection
