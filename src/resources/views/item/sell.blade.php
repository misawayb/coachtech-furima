@extends('layouts.app')

@section('title')
出品
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<h1 class="page-title">商品の出品</h1>
<form class="sell-form" action="/sell" method="post" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="sell-field">
        <label class="image-label">商品画像</label>
        <img class="sell-image" src="" id="preview" alt="商品画像">
        <input class="image-select" id="sell_image" name="sell_image" type="file">
        <label class="sell-select" for="sell_image">画像を選択する</label>
        @error('sell_image')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div class="sell-detail">
        <h2>商品の詳細</h2>
        <div class="sell-field">
            <label class="sell-label">カテゴリー</label>
            @foreach( $categories as $category )
            <input class="sell-input" id="category_{{ $category->id }}" name="category[]" value="{{ $category->id }}" @checked(in_array($category->id, old('category', []))) type="checkbox">
            <label for="category_{{ $category->id }}">{{ $category->name }}</label>
            @endforeach
            @error('category')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="sell-field">
            <label class="sell-label" for="condition">商品の状態</label>
            <select class="sell-input" id="condition" name="condition">
                <option hidden disabled selected>選択してください</option>
                @foreach( $conditions as $condition)
                <option value="{{ $condition->value }}" @selected(old('condition')==$condition->value)>{{ $condition->value }}</option>
                @endforeach
            </select>
            @error('condition')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <h2>商品名と説明</h2>
        <div class="sell-field">
            <label class="sell-label" for="name">商品名</label>
            <input class="sell-input" id="name" name="name" type="text" value="{{ old('name') }}">
            @error('name')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="sell-field">
            <label class="sell-label" for="brand">ブランド名</label>
            <input class="sell-input" id="brand" name="brand" type="text" value="{{ old('brand') }}">
        </div>
        <div class="sell-field">
            <label class="sell-label" for="description">商品の説明</label>
            <textarea class="sell-input" id="description" name="description">{{ old('description') }}</textarea>
            @error('description')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="sell-field">
            <label class="sell-label" for="price">販売価格</label>
            <div class="price-group">
                <span class="price-symbol">¥</span>
                <input class="sell-input" id="price" name="price" type="text" value="{{ old('price') }}">
            </div>
            @error('price')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <button class="sell-btn" type="submit">出品する</button>
</form>
<script>
    document.getElementById('sell_image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection