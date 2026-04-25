@extends('layouts.auth')

@section('title')
メール認証
@endsection

@section('css')
@endsection

@section('content')
<p class="guide">
    登録していただいたメールアドレスに認証メールを送付しました。<br>
    メール認証を完了してください。
</p>
<span class="">
    <a href="http://localhost:8025/">認証はこちらから</a>
</span>
<span class="">
    <form action="/email/verification-notification" method="post">
        @csrf
        <button type="submit">認証メールを再送する</button>
    </form>
</span>
@endsection