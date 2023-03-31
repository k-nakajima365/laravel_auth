<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
</head>
<body>
    {{ Form::open(['url' => route('register.store')]) }}
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
    {{ Form::label('パスワード（確認用）') }}
    {{ Form::password('password_confirmation', ['placeholder' => 'パスワード（確認用）を入力してください']) }}
    <br>
    {{ Form::submit('登録') }}
    {{ Form::close() }}
    <a href="{{ route('top') }}">トップページへ戻る</a>
</body>
</html>