@extends('layouts.auth')

@section('title')
会員登録
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<h1 class="auth-title">会員登録</h1>
<form class="auth-form" action="/register" method="post">
    @csrf
    <label class="form-label" for="name">ユーザー名</label>
    <input class="form-input" id="name" name="name" type="text">
    <label class="form-label" for="email">メールアドレス</label>
    <input class="form-input" id="email" name="email" type="email">
    <label class="form-label" for="password">パスワード</label>
    <input class="form-input" id="password" name="password" type="password">
    <label class="form-label" for="password_confirmation">確認用パスワード</label>
    <input class="form-input" id="password_confirmation" name="password_confirmation" type="password">
    <button class="auth-btn" type="submit">登録する</button>
</form>
<a class="auth-link" href="/login">ログインはこちら</a>

@endsection