@extends('layouts.app')

@section('title')
マイページ
@endsection

@section('css')
<link rel="stylesheet" href="{{ ('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage-page">
    <div class="profile-field">
        <img class="profile-img" width="100px" src="{{ $user->profile_image ? asset( 'storage/' . $user->profile_image ) : asset( 'image/default-profile.png' ) }}" alt="プロフィール画像">
        <p class="profile-name">{{ $user->name }}</p>
        <a class="編集-btn" href="{{ route('user.index',$user )}}">プロフィールを編集</a>
    </div>
    <div class="tab-nav">
        <a class="{{ $tab === 'sell' ? 'nav-title active' : 'nav-title' }}" href="/mypage?page=sell">出品した商品</a>
        <a class="{{ $tab === 'buy' ? 'nav-title active' : 'nav-title' }}" href="/mypage?page=buy">購入した商品</a>
    </div>
    <div class="item-list">
        @foreach( $items as $item )
        <div class="item-field">
            <img class="item-image" src="{{ asset('storage/' . $item->image) }}" alt="商品画像">
            <a class="item-name" href="">{{ $item->name }}</a>
        </div>
        @endforeach
    </div>
</div>
@endsection