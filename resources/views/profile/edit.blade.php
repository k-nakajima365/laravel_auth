<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
</head>
<body>
    {{ Form::open(['url' => route('profile.update'), 'method' => 'patch']) }}
    {{ Form::label('ユーザ名') }}
    {{ Form::text('name', $user->name, ['placeholder' => 'ユーザ名を入力してください']) }}
    @error('name')
        {{ $message }}
    @enderror
    <br>
    {{ Form::label('メールアドレス') }}
    {{ Form::text('email', $user->email, ['placeholder' => 'メールアドレスを入力してください']) }}
    @error('email')
        {{ $message }}
    @enderror
    <br>
    {{ Form::submit('更新') }}
    {{ Form::close() }}
    <a href="{{ route('profile.show') }}">キャンセル</a>
</body>
</html>