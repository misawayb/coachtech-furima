@extends('layouts.app')

@section('title')
商品詳細
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/item-detail.css') }}">
@endsection

@section('content')
<div class="detail page">
    <img class="item-image @if($item->purchase !== null) item-image--sold @endif" src="{{ asset('storage/' . $item->image) }}" alt="商品画像">
    <div class="detail-field">
        <h2 class="item-name">{{ $item->name }}</h2>
        <span class="item-brand">{{ $item->brand }}</span>
        <div class="price-field">
            <span class="price-symbol">¥</span>
            <span class="item-price">{{ number_format($item->price) }}</span>
            <span class="price-tax">（税込）</span>
        </div>
        <div class="item-actions">
            <div class="likes-field">
                <img class="likes-icon" src="{{ asset( 'image/likes-default-icon.png' ) }}" alt="デフォルトハート">
                <span class="likes-count">{{ $item->likes->count() }}</span>
            </div>
            <div class="comment-field">
                <img class="comment-icon" src="{{ asset('image/comment-icon.png') }}" alt="">
                <span class="comments-count">{{ $item->comments->count() }}</span>
            </div>
            <a class="購入手続きに行く-btn" href="">購入手続きへ</a>
            <h3 class="detail-title">商品説明</h3>
            <p class="detail-description">{{ $item->description }}</p>
            <h3 class="detail-title">商品の状態</h3>
            <div class="category-field">
                <strong class="detail-category">カテゴリー</strong>
                @foreach($item->categories as $category)
                <span class="categories">{{ $category->name }}</span>
                @endforeach
            </div>
            <div class="condition-field">
                <strong class="detail-condition">商品の状態</strong>
                <span class="condition">{{ $item->condition }}</span>
            </div>
            <h3 class="comment-field">コメント({{ $item->comments->count() }})</h3>
            @foreach( $item->comments as $comment)
            <div class="comment-field">
                <div class="comment-person">
                    <img src="" alt="">
                    <p>{{ $comment->user->name }}</p>
                </div>
                <p class="comment">{{ $comment->comment }}</p>
            </div>
            @endforeach
            <form class="comment-form" action="" method="post">
                @csrf
                <label class="for-item" for="comment-input">商品へのコメント</label>
                <textarea class="comment-input" name="" id="comment-input"></textarea>
                <button class="comment-btn" type="submit">コメントを送信する</button>
            </form>
        </div>
    </div>
</div>
@endsection