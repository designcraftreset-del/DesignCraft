@extends('auth-v2.layout')

@section('title', 'Вход — DesignCraft')

@section('content')
    <h1>Вход</h1>
    <p class="auth-v2-subtitle">Введите данные для входа в аккаунт</p>

    @if ($errors->any())
        <div class="auth-v2-alert auth-v2-alert-error">
            Неверный email или пароль. Проверьте данные и попробуйте снова.
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="auth-v2-form">
        @csrf

        <div class="field">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   autocomplete="email" placeholder="you@example.com"
                   class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
            @error('email')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="password">Пароль</label>
            <div class="input-password-wrap">
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       placeholder="••••••••"
                       class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
                <button type="button" class="auth-v2-eye" aria-label="Показать пароль"></button>
            </div>
            @error('password')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="checkbox-wrap">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">Запомнить меня</label>
        </div>

        <button type="submit" class="btn-primary">Войти</button>

        <div class="auth-v2-links">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Забыли пароль?</a>
            @endif
            <span class="divider">·</span>
            <a href="{{ route('register') }}">Создать аккаунт</a>
        </div>
    </form>
@endsection
