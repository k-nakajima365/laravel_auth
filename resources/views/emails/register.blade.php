<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
</head>
<body>
    <h1>ご登録いただきありがとうございます</h1>
    <p>お客様は現在仮登録が完了した状態です</p>
    <p><a href="{{ route('verification.verify') }}">こちら</a>から本登録を完了してください</p>
</body>
</html>