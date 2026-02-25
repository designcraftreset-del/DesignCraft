@extends('auth-v2.layout')

@section('title', 'Новый пароль — DesignCraft')

@section('content')
    <h1>Новый пароль</h1>
    <p class="auth-v2-subtitle">Придумайте надёжный пароль для входа</p>

    @if ($errors->any())
        <div class="auth-v2-alert auth-v2-alert-error">
            Проверьте правильность заполнения полей (пароль не менее 8 символов).
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" class="auth-v2-form">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="field">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required
                   autocomplete="email" placeholder="you@example.com"
                   class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
            @error('email')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="password">Новый пароль</label>
            <div class="input-password-wrap">
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       placeholder="Минимум 8 символов"
                       class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
                <button type="button" class="auth-v2-eye" aria-label="Показать пароль"></button>
            </div>
            @error('password')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="password_confirmation">Повторите пароль</label>
            <div class="input-password-wrap">
                <input id="password_confirmation" type="password" name="password_confirmation" required
                       autocomplete="new-password" placeholder="••••••••">
                <button type="button" class="auth-v2-eye" aria-label="Показать пароль"></button>
            </div>
        </div>

        <button type="submit" class="btn-primary">Сохранить пароль</button>

        <div class="auth-v2-links">
            <a href="{{ route('login') }}">← Вернуться к входу</a>
        </div>
    </form>
@endsection
