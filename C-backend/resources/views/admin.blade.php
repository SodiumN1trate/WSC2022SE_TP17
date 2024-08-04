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
    <h1>Login</h1>
    <form action="{{ route('login.process') }}" method="POST">
        @csrf
        <label>
            Username <br>
            <input type="text" name="username">
        </label>
        <br>
        <label>
            Password <br>
            <input type="password" name="password">
        </label>
        <br>
        <button>Login</button>
    </form>
</body>
</html>
