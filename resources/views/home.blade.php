<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
</head>
<body>
    @if(session('status') == 'home-registered')
        <p>{{ __('本登録が完了しました') }}</p>
    @endif

    <a href="{{ route('profile.show') }}">プロフィール</a>
    {{ Form::open(['url' => route('auth.delete')]) }}
    {{ Form::submit('ログアウト') }}
    {{ Form::close() }}
</body>
</html>