@extends('mobile.layouts.mobile-app')

@section('title', 'Восстановление пароля — DesignCraft')

@push('styles')
<style>
.m-auth { max-width: 360px; margin: 0 auto; padding: 1.5rem 0; }
.m-auth__title { font-size: 1.5rem; font-weight: 700; margin: 0 0 0.25rem; color: var(--m-text); }
.m-auth__subtitle { font-size: 0.9375rem; color: var(--m-text-muted); margin: 0 0 1.5rem; }
.m-auth .m-order-field { margin-bottom: 1rem; }
.m-auth .m-order-field label { display: block; font-size: 0.875rem; font-weight: 500; color: var(--m-text-muted); margin-bottom: 0.35rem; }
.m-auth .m-order-input { width: 100%; padding: 12px 14px; border-radius: var(--m-radius); border: 1px solid var(--m-surface-2); background: var(--m-surface); color: var(--m-text); font-size: 1rem; min-height: var(--m-touch); box-sizing: border-box; }
.m-auth .m-order-input:focus { outline: none; border-color: var(--m-accent); }
.m-auth .m-order-input.is-invalid { border-color: #dc2626; }
.m-auth__submit { width: 100%; margin-top: 0.5rem; padding: 14px; font-size: 1rem; font-weight: 600; border-radius: var(--m-radius); border: none; background: linear-gradient(135deg, var(--m-accent), #2563eb); color: #fff; cursor: pointer; }
.m-auth__links { margin-top: 1.5rem; text-align: center; font-size: 0.9375rem; color: var(--m-text-muted); }
.m-auth__links a { color: var(--m-accent); text-decoration: none; font-weight: 500; }
.m-auth__alert { padding: 12px; border-radius: var(--m-radius); margin-bottom: 1rem; font-size: 0.875rem; }
.m-auth__alert--error { background: rgba(220, 38, 38, 0.15); color: #f87171; }
.m-auth__alert--success { background: rgba(34, 197, 94, 0.15); color: #4ade80; }
.m-auth__error { font-size: 0.8125rem; color: #f87171; margin-top: 4px; }
</style>
@endpush

@section('content')
<div class="m-auth">
    <h1 class="m-auth__title">Забыли пароль?</h1>
    <p class="m-auth__subtitle">Введите email — мы отправим ссылку для сброса пароля</p>

    @if (session('status'))
        <div class="m-auth__alert m-auth__alert--success">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="m-auth__alert m-auth__alert--error">
            {{ $errors->first('email', 'Укажите корректный email.') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <input type="hidden" name="redirect_mobile" value="1">

        <div class="m-order-field">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" class="m-order-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                   value="{{ old('email') }}" required autofocus autocomplete="email" placeholder="you@example.com">
            @error('email')<div class="m-auth__error">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="m-auth__submit">Отправить ссылку</button>

        <div class="m-auth__links">
            <a href="{{ route('mobile.login') }}">← Вернуться к входу</a>
        </div>
    </form>
</div>
@endsection
