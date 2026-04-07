<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | COACHTECHフリマ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <p class="header-logo">
            <img src="" alt="COACHTECHロゴ">
        </p>
        <form class="header-search" action="" method="get">
            <input class="search-input" type="text" placeholder="なにをお探しですか？">
        </form>
        <nav class="header-nav">
            @auth
            <form class="logout" action="" method="post">
                @csrf
                <button class="nav-logout" type="submit">ログアウト</button>
            </form>
            @else
            <a class="nav-login" href="">ログイン</a>
            @endauth
            <a class="nav-mypage" href="">マイページ</a>
            <a class="nav-sell" href="">出品</a>
        </nav>
    </header>
    <main class="main">
        @yield('content')
    </main>

</body>

</html>