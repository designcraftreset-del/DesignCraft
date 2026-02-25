@extends('auth-v2.layout')

@section('title', 'Восстановление пароля — DesignCraft')

@section('content')
    <h1>Забыли пароль?</h1>
    <p class="auth-v2-subtitle">Введите email — мы отправим ссылку для сброса пароля</p>

    @if (session('status'))
        <div class="auth-v2-alert auth-v2-alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="auth-v2-alert auth-v2-alert-error">
            {{ $errors->first('email', 'Укажите корректный email.') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="auth-v2-form">
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

        <button type="submit" class="btn-primary">Отправить ссылку</button>

        <div class="auth-v2-links">
            <a href="{{ route('login') }}">← Вернуться к входу</a>
        </div>
    </form>
@endsection
