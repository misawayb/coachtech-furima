<!DOCTYPE html>
<html>

<head>
    <title>ダッシュボード</title>
</head>

<body>
    <h1>ログイン成功！</h1>
    <form method="POST" action="/logout">
        @csrf
        <button type="submit">ログアウト</button>
    </form>
</body>

</html>