@extends('layouts.app')

@section('title')
商品詳細
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
<div class="detail-page">
    <div class="image-field">
        <img class="detail-image @if($item->purchase !== null) detail-image--sold @endif" src="{{ asset('storage/' . $item->image) }}" alt="商品画像">
    </div>
    <div class="detail-field">
        <h2 class="item-name-detail">{{ $item->name }}</h2>
        <span class="item-brand">{{ $item->brand }}</span>
        <div class="price-field">
            <span class="price-symbol">¥</span>
            <span class="item-price">{{ number_format($item->price) }}</span>
            <span class="price-tax">(税込)</span>
        </div>
        <div class="item-actions">
            <div class="likes-field">
                @auth
                <form class="like-form" action="{{ route('like.store', ['item_id' => $item->id]) }}" method="post">
                    @csrf
                    <button class="like-button" type="submit">
                        @if($isLiked)
                        <img class="likes-icon" src="{{ asset( 'image/likes-icon.png' ) }}" alt="いいね済みハート">
                        @else
                        <img class="likes-icon" src="{{ asset( 'image/likes-default-icon.png' ) }}" alt="デフォルトハート">
                        @endif
                    </button>
                </form>
                @endauth
                @guest
                <img class="likes-icon" src="{{ asset( 'image/likes-default-icon.png' ) }}" alt="デフォルトハート">
                @endguest
                <span class="likes-count">{{ $item->likes->count() }}</span>
            </div>
            <div class="comment-field">
                <img class="comment-icon" src="{{ asset('image/comment-icon.png') }}" alt="">
                <span class="comments-count">{{ $item->comments->count() }}</span>
            </div>
            @guest
            <p class="for-guest">
                いいねとコメントは<br />
                ログイン後に送信できます</p>
            @endguest
        </div>
        <button class="red-btn"><a class="red-btn" href="{{ route('purchase.show',$item->id) }}">購入手続きへ</a></button>
        <h3 class="detail-title">商品説明</h3>
        <p class="detail-description">{{ $item->description }}</p>
        <h3 class="detail-title">商品の情報</h3>
        <div class="category-field">
            <span class="detail-category">カテゴリー</span>
            <div class="categories-wrap">
                @foreach($item->categories as $category)
                <span class="categories">{{ $category->name }}</span>
                @endforeach
            </div>
        </div>
        <div class="condition-field">
            <span class="detail-condition">商品の状態</span>
            <div class="condition-wrap">
                <span class="condition">{{ $item->condition }}</span>
            </div>
        </div>
        <h3 class="detail-title-comment">コメント({{ $item->comments->count() }})</h3>
        @foreach( $item->comments as $comment)
        <div class="comment-detail">
            <div class="comment-person">
                <img class="comment-person-img" src="{{ $comment->user->profile_image ? asset( 'storage/' . $comment->user->profile_image ) : asset( 'image/default-profile.png' ) }}" alt="プロフィール画像">
                <p class="comment-person-name">{{ $comment->user->name }}</p>
            </div>
            <p class="comment">{{ $comment->comment }}</p>
        </div>
        @endforeach
        <form class="comment-form" action="{{ route('comment.store', ['item_id' => $item->id])}}" method="post">
            @csrf
            <label class="for-item" for="comment-input">商品へのコメント</label>
            <textarea class="comment-input" name="comment" id="comment-input"></textarea>
            <button class="red-btn" type="submit">コメントを送信する</button>
            @guest
            <span class="for-guest">コメントはログイン後に送信できます</span>
            @endguest
            @error('comment')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </form>
    </div>
</div>
@endsection