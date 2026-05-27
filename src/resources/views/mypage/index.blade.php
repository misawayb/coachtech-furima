@extends('layouts.app')

@section('title')
マイページ
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage-page">
    <div class="profile-field">
        <img class="profile-img" src="{{ $user->profile_image ? asset( 'storage/' . $user->profile_image ) : asset( 'image/default-profile.png' ) }}" alt="プロフィール画像">
        <p class="profile-name">{{ $user->name }}</p>
        <a class="edit-btn" href="{{ route('user.index',$user )}}">プロフィールを編集</a>
    </div>
    <div class="tab-wrapper">
        <div class="tab-nav">
            <a class="{{ $tab === 'sell' ? 'nav-title active' : 'nav-title' }}" href="/mypage?page=sell">出品した商品</a>
            <a class="{{ $tab === 'buy' ? 'nav-title active' : 'nav-title' }}" href="/mypage?page=buy">購入した商品</a>
        </div>
    </div>
    <div class="item-list">
        @foreach( $items as $item )
        <div class="item-field">
            @if($tab === 'sell')
            <a class="item-link" href="{{ route('item.show', $item->id) }}">
                <img class="item-image" src="{{ asset('storage/' . $item->image) }}" alt="出品した商品の画像">
                <span class="item-name">{{ $item->name }}</span>
            </a>
            @else
            <div class="item-link">
                <div class="item-image__sold">
                    <span class="sold-badge">Sold</span>
                    <img class="item-image" src="{{ asset('storage/' . $item->image) }}" alt="購入した商品の画像">
                </div>
                <span class="item-name">{{ $item->name }}</span>
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection