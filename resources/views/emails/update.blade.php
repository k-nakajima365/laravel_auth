<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
</head>
<body>
    <h1>メールアドレスが変更されました</h1>
    <p>変更処理を完了させるには、<a href="{{ route('verification.verify') }}">こちら</a>から本登録を完了してください</p>
    <p><strong style="color:red;">お心当たりがない場合はご放念ください</strong></p>
</body>
</html>