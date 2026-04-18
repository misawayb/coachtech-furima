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
            <img src="{{ asset( 'image/coachtech_header_logo.png' )}}" href="/" alt="COACHTECHロゴ">
        </p>
        <form class="header-search" action="/" method="get">
            <input class="search-input" name="keyword" type="text" placeholder="なにをお探しですか？" value="{{ $keyword ?? "" }}">
        </form>
        <nav class="header-nav">
            @auth
            <form class="logout" action="/logout" method="post">
                @csrf
                <button class="nav-logout" type="submit">ログアウト</button>
            </form>
            @else
            <a class="nav-login" href="/login">ログイン</a>
            @endauth
            <a class="nav-mypage" href="/mypage">マイページ</a>
            <a class="nav-sell" href="/sell">出品</a>
        </nav>
    </header>
    <main class="main">
        @yield('content')
    </main>

</body>

</html>