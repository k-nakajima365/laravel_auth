<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
</head>
<body>
    {{ Form::open(['url' => route('auth.store')]) }}
    {{ Form::label('ユーザ名') }}
    {{ Form::text('name', '', ['placeholder' => 'ユーザ名を入力してください']) }}
    @error('name')
        {{ $message }}
    @enderror
    <br>
    {{ Form::label('メールアドレス') }}
    {{ Form::text('email', '', ['placeholder' => 'メールアドレスを入力してください']) }}
    @error('email')
        {{ $message }}
    @enderror
    <br>
    {{ Form::label('パスワード') }}
    {{ Form::password('password', ['placeholder' => 'パスワードを入力してください']) }}
    @error('password')
        {{ $message }}
    @enderror
    <br>
    {{ Form::checkbox('remember') }}ログイン状態を保持する
    <br>
    {{ Form::submit('ログイン') }}
    {{ Form::close() }}
    <a href="{{ route('top') }}">トップページへ戻る</a>
</body>
</html>