<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Xin chao {{ $user->name }}</h1>
    <p>Cam on ban da su dung dich vu cua chung toi</p>
    <p>Toi can ban xac nhan ca thong tin sau:</p>
    <p>Name: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>Password: {{ $password }}</p>
</body>
</html>