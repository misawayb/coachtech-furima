@extends('layouts.app')

@section('title')
商品購入
@endsection

@section('css')
<link rel="stylesheet" href="{{ ('css/purchase.detail.css') }}">
@endsection

@section('content')
<div class="purchase-page">
    <form class="purchase-form" action="{{ route('purchase.store', $item->id ) }}" method="post">
        @csrf
        <div class="purchase-field">
            <div class="detail-field">
                <img class="item-img" src="{{ asset('storage/' . $item->image) }}" alt="商品画像">
                <span class="item-name">{{ $item->name }}</span>
                <span class="price-symbol">¥</span>
                <span class="item-price">{{ number_format($item->price) }}</span>
                <input type="hidden" name="item_id" value="{{ $item->id }}">
            </div>
            <div class="purchase-field">
                <label class="field-title" for="payment_method">支払い方法</label>
                <select name="payment_method" id="payment_method">
                    <option value="" hidden disabled selected>選択してください</option>
                    @foreach( $payment_methods as $payment_method )
                    <option value="{{ $payment_method->value }}" {{ old('payment_method') == $payment_method->value ? 'selected' : '' }}>{{ $payment_method->value}}</option>
                    @endforeach
                </select>
                @error('payment_method')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            <div class="purchase-field">
                <div class="field-title__group">
                    <span class="field-title">配送先</span>
                    <a class="address-change" href="{{ route('address.show',$item->id)}}">変更する</a>
                </div>
                <div class="address-group">
                    <span class="address-zip_code">{{ $address_delivery['zip_code'] }}</span>
                    <span class="address">{{ $address_delivery['address'] . "　" . $address_delivery['building'] }}</span>
                    <input type="hidden" name="zip_code" value="{{ $address_delivery['zip_code'] }}">
                    @error('zip_code')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                    <input type="hidden" name="address" value="{{ $address_delivery['address'] }}">
                    @error('address')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                    <input type="hidden" name="building" value="{{ $address_delivery['building'] }}">
                </div>
            </div>
        </div>
        <div class="summary-field">
            <div class="summary-item">
                <span>商品代金</span>
                <div>
                    <span class="price-symbol">¥</span>
                    <span class="item-price">{{ number_format($item->price) }}</span>
                </div>
            </div>
            <div class="summary-item">
                <span class="field-title">支払い方法</span>
                <span class="payment-value" id="payment-display"></span>
            </div>
            <button class="purchase-btn" type="submit">購入する</button>
        </div>
    </form>
</div>
<script>
    const select = document.getElementById('payment_method');
    const display = document.getElementById('payment-display');

    select.addEventListener('change', function() {
        display.textContent = this.value;
    });
</script>
@endsection