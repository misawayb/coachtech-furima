@extends('layouts.app')

@section('title')
トップ
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/item-index.css') }}">
@endsection

@section('content')
<div class="items-page">
    <div class="tab-nav">
        <a class="top-title" href="/">おすすめ</a>
        <a class="top-title" href="/?tab=mylist{{ $keyword ? '&keyword=' . $keyword : '' }}">マイリスト</a>
    </div>
    <div class="item-list">
        @foreach($items as $item)
        <div class="item-field">
            @if($item->purchase !== null)
            <div class="sold-field">
                <span class="sold-badge">Sold</span>
            </div>
            @endif
            <img class="item-image @if($item->purchase !== null) item-image--sold @endif" src="{{ asset('storage/' . $item->image) }}" alt="商品画像">
            <a class="item-name" href="{{ route('item.show', $item->id) }}">{{ $item->name }}</a>
        </div>
        @endforeach
    </div>
</div>
@endsection