<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <ul>
        <li><a href="{{ route('admins.list') }}">Admins</a></li>
        <li><a href="{{ route('users.list') }}">Users</a></li>
        <li><a href="{{ route('games.list') }}">Games</a></li>

    </ul>
    @yield('content')
</body>
</html>

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
