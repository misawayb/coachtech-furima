@extends('layouts.app')

@section('title')
送付先住所変更
@endsection

@section('css')
<link rel="stylesheet" href="{{ ('css/purchase.address.css') }}">
@endsection

@section('content')
<h1 class="page-title">住所の変更</h1>
<form class="address-form" action="{{route('address.store',$item_id)}}" method="post">
    @csrf
    <div class="address-field">
        <label class="address-label" for="zip_code">郵便番号</label>
        <input class="address-input" name="zip_code" id="zip_code" type="text">
        @error('zip_code')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div class="address-field">
        <label class="address-label" for="address" >住所</label>
        <input class="address-input" type="text" id="address" name="address">
        @error('address')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div class="address-field">
        <label class="address-label" for="building">建物名</label>
        <input class="address-input" id="building" name="building" type="text">
        @error('building')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <button class="address-btn" type="submit">更新する</button>
</form>
@endsection