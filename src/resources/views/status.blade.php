<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン状態</title>
</head>
<body>
    @if (Auth::check())
        <p>ログイン済み</p>
    @else
        <p>未ログイン</p>
    @endif


    <form action="/logout" method="POST">
    @csrf
    <button type="submit">ログアウト</button>
</form>
</body>
</html>