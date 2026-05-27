@extends('layouts.app')

@section('title')
トップ
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
<div class="items-page">
    @if(session('message'))
    <div class="session-message">
        {{ session('message') }}
    </div>
    <script>
        document.getElementById('session-message').addEventListener('click', function() {
            this.remove();
        });
    </script>
    @endif
    <div class="tab-wrapper">
        <div class="tab-nav">
            <a class="nav-title" href="/">おすすめ</a>
            <a class="nav-title" href="/?tab=mylist{{ $keyword ? '&keyword=' . $keyword : '' }}">マイリスト</a>
        </div>
    </div>
    <div class="item-list">
        @foreach($items as $item)
        <div class="item-field">
            @if($item->purchase !== null)
            <div class="sold-field">
                <span class="sold-badge">Sold</span>
            </div>
            @endif
            <a class="item-link" href="{{ route('item.show', $item->id) }}">
                <img class="item-image @if($item->purchase !== null) item-image--sold @endif" src="{{ asset('storage/' . $item->image) }}" alt="商品画像">
                <span class="item-name">{{ $item->name }}</span>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection