@extends('layouts.auth')

@section('title')
ログイン
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<h1 class="auth-title">ログイン</h1>
<form class="auth-form" action="/login" method="post">
    @csrf
    <label class="form-label" for="email">メールアドレス</label>
    <input class="form-input" id="email" name="email" type="email">
    <label class="form-label" for="password">パスワード</label>
    <input class="form-input" id="password" name="password" type="password">
    <button class="auth-btn" type="submit">ログインする</button>
</form>
<a class="auth-link" href="/register">会員登録はこちら</a>


@endsection