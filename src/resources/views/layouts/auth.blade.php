<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | COACHTECHフリマ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <p class="header-logo">
            <img src="{{ asset( 'image/coachtech_header_logo.png' )}}" href="/" alt="COACHTECHロゴ">
        </p>
    </header>
    <main class="main">
        @yield('content')
    </main>

</body>

</html>