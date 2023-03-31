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
        <h1>メールアドレスが変更されました</h1>
    @endif
    
    <p>確認用のメールを送信しましたので、</p>
    <p>メールのリンクからメール確認を完了してください</p>
    <p><a href="{{ route('verification.retry') }}">メールをもう一度送信する</a></p>
</body>
</html>