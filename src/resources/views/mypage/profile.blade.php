@extends('layouts.app')

@section('title')
プロフィール設定
@endsection

@section('css')
@endsection

@section('content')
<h1 class="page-title">プロフィール設定</h1>
<form class="profile-form" action="/mypage/profile" method="post" enctype="multipart/form-data" novalidate>
    @csrf
    @method('patch')
    <div class="profile-field">
        <img width="100" class="profile-image" src="{{ $user->profile_image ? asset( 'storage/' . $user->profile_image ) : asset( 'image/default-profile.png' ) }}" id="preview" alt="プロフィール画像">
        <label class="image-label" for="profile_image">画像を選択する</label>
        <input class="image-select" id="profile_image" name="profile_image" type="file">
        @error('profile_image')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div class="profile-field">
        <label class="profile-label" for="name">ユーザー名</label>
        <input class="profile-input" id="name" name="name" type="text" value="{{ old('name',$user->name) }}">
        @error('name')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div class="profile-field">
        <label class="profile-label" for="zip_code">郵便番号</label>
        <input class="profile-input" id="zip_code" name="zip_code" type="text" value="{{ old('zip_code', $user->zip_code) }}">
        @error('zip_code')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div class="profile-field">
        <label class="profile-label" for="address">住所</label>
        <input class="profile-input" id="address" name="address" type="text" value="{{ old('address', $user->address) }}">
        @error('address')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div class="profile-field">
        <label class="profile-label" for="building">建物名</label>
        <input class="profile-input" id="building" name="building" type="text" value="{{ old('building', $user->building) }}">
        @error('building')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <button class="update-btn" type="submit">更新する</button>
</form>

<script>
    document.getElementById('profile_image').addEventListener('change', function(event) {
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