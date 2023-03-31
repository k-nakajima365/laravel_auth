<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
</head>
<body>
    @if(session('status') == 'profile-updated')
        <p>{{ __('プロフィールが更新されました') }}</p>
    @endif
    <p>ID：{{ $user->id }}</p>
    <p>名前：{{ $user->name }}</p>
    <p>メールアドレス：{{ $user->email }}</p>
    <p>メールアドレス確認日：{{ $user->email_verified_at }}</p>
    <p>作成日：{{ $user->created_at }}</p>
    <p>更新日：{{ $user->updated_at }}</p>
    <a href="{{ route('home') }}">ホームページへ戻る</a>
    <br>
    <a href="{{ route('profile.edit') }}">プロフィール編集</a>
    <br>
    <a onclick="document.getElementById('modal').style.display = (document.getElementById('modal').style.display == 'none'?'block': 'none')">ユーザ削除</a>
    <div id="modal" @error('password') @else style="display:none;" @enderror>
        {{ Form::open(['url' => route('profile.delete'), 'method' => 'delete']) }}
        {{ Form::label('パスワード') }}
        {{ Form::password('password', ['placeholder' => 'パスワードを入力してください']) }}
        @error('password')
            {{ $message }}
        @enderror
        <br>
        {{ Form::submit('削除') }}
        {{ Form::close() }}
    </div>
</body>
</html>