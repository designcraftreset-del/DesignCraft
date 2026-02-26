@extends('mobile.layouts.mobile-app')

@section('title', 'Настройки — DesignCraft')

@section('content')
<section class="m-hero">
    <h1 class="m-hero__title">Настройки</h1>
    <p class="m-hero__subtitle">Почта, телефон и пароль</p>
</section>

@if(session('success'))
<div class="m-card" style="background: rgba(34, 197, 94, 0.15); border-color: #22c55e;">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="m-card" style="background: rgba(239, 68, 68, 0.15); border-color: #ef4444;">{{ session('error') }}</div>
@endif
@if($errors->any())
<div class="m-card" style="background: rgba(239, 68, 68, 0.15); border-color: #ef4444;">
    @foreach($errors->all() as $e) <p class="m-text" style="margin:0;">{{ $e }}</p> @endforeach
</div>
@endif

<section class="m-section">
    <h2 class="m-section__title m-title">Профиль</h2>
    <form action="{{ route('profile.update') }}" method="post" class="m-card">
        @csrf
        <input type="hidden" name="redirect_mobile" value="1">
        <div class="m-order-field">
            <label for="m-settings-name">Имя</label>
            <input type="text" id="m-settings-name" name="name" value="{{ old('name', $user->name) }}" required class="m-order-input">
        </div>
        <div class="m-order-field">
            <label for="m-settings-email">Email</label>
            <input type="email" id="m-settings-email" name="email" value="{{ old('email', $user->email) }}" required class="m-order-input">
        </div>
        <div class="m-order-field">
            <label for="m-settings-phone">Телефон</label>
            <input type="tel" id="m-settings-phone" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+7 (999) 123-45-67" maxlength="18" class="m-order-input">
        </div>
        <button type="submit" class="m-btn m-btn--primary m-btn--block">Сохранить</button>
    </form>
</section>

<section class="m-section">
    <h2 class="m-section__title m-title">Пароль</h2>
    <form action="{{ route('profile.password') }}" method="post" class="m-card">
        @csrf
        <input type="hidden" name="redirect_mobile" value="1">
        <div class="m-order-field">
            <label for="m-settings-current">Текущий пароль</label>
            <input type="password" id="m-settings-current" name="current_password" required class="m-order-input">
        </div>
        <div class="m-order-field">
            <label for="m-settings-password">Новый пароль</label>
            <input type="password" id="m-settings-password" name="password" required minlength="8" class="m-order-input">
        </div>
        <div class="m-order-field">
            <label for="m-settings-password-confirm">Подтвердите новый пароль</label>
            <input type="password" id="m-settings-password-confirm" name="password_confirmation" required minlength="8" class="m-order-input">
        </div>
        <button type="submit" class="m-btn m-btn--primary m-btn--block m-btn--password-submit">Сменить пароль</button>
    </form>
    <p class="m-text" style="margin-top:0.5rem; font-size:0.8rem;">Или отправить ссылку на почту для сброса (без текущего пароля):</p>
    <form action="{{ route('profile.password.send-link') }}" method="post" style="margin-top:0.5rem;">
        @csrf
        <input type="hidden" name="redirect_mobile" value="1">
        <button type="submit" class="m-btn m-btn--secondary m-btn--block">Отправить ссылку на {{ $user->email }}</button>
    </form>
</section>

<section class="m-section">
    <a href="{{ route('mobile.account') }}" class="m-btn m-btn--secondary m-btn--block">Назад в аккаунт</a>
</section>
@endsection
