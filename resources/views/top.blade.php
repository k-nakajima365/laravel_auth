<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
</head>
<body>
    <a href="{{ route('register.create') }}">ユーザ登録</a>
    <a href="{{ route('auth.create') }}">ログイン</a>
</body>
</html>