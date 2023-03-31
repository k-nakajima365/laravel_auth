<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
</head>
<body>
    @if(session('status') == 'expired')
        <h1>本人確認メールの期限が切れました</h1>
    @else
        <h1>登録はまだ完了していません</h1>
    @endif
    
    <p>確認用のメールを送信しましたので、</p>
    <p>メールのリンクから本登録を完了してください</p>
    <p><a href="{{ route('verification.retry') }}">メールをもう一度送信する</a></p>
</body>
</html>