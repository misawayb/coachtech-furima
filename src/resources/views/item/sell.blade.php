@extends('layouts.app')

@section('title')
出品
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
<h1 class="page-title">商品の出品</h1>
<form class="sell-form" action="/sell" method="post" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="sell-field">
        <label class="sell-label">商品画像</label>
        <div class="sell-image-field">
            <img class="sell-preview" src="" id="preview" alt="">
            <input class="image-select" id="item_image" name="sell_image" type="file">
            <label class="sell-select" for="item_image">画像を選択する</label>
        </div>
        @error('item_image')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div class="sell-detail">
        <h2 class="sell-title">商品の詳細</h2>
        <div class="category-block">
            <div class="category-title">カテゴリー</div>
            <div class="category-tags">
                @foreach( $categories as $category )
                <input class="category-input" id="category_{{ $category->id }}" name="category[]" value="{{ $category->id }}" @checked(in_array($category->id, old('category', []))) type="checkbox">
                <label class="category-label" for="category_{{ $category->id }}">{{ $category->name }}</label>
                @endforeach
            </div>
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
        <h2 class="sell-title">商品名と説明</h2>
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
            <textarea class="sell-input-textarea" id="description" name="description">{{ old('description') }}</textarea>
            @error('description')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="sell-field">
            <label class="sell-label" for="price">販売価格</label>
            <div class="price-group">
                <span class="price-symbol">¥</span>
                <input class="sell-input-price" id="price" name="price" type="text" value="{{ old('price') }}">
            </div>
            @error('price')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <button class="red-btn" type="submit">出品する</button>
</form>
<script>
    document.getElementById('item_image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            const preview = document.getElementById('preview');
            const label = document.querySelector('.sell-select');

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                preview.style.width = '100%';
                preview.style.height = '100%';
                preview.style.objectFit = 'contain';
                label.style.display = 'none';
            };

            reader.readAsDataURL(file);
        }
    });
</script>
@endsection