@extends('mobile.layouts.mobile-app')

@section('title', 'Новый пароль — DesignCraft')

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
.m-auth__password-wrap { position: relative; }
.m-auth__password-wrap input { padding-right: 48px; }
.m-auth__eye { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); width: 36px; height: 36px; border: none; background: none; color: var(--m-text-muted); cursor: pointer; border-radius: 8px; display: flex; align-items: center; justify-content: center; }
.m-auth__submit { width: 100%; margin-top: 0.5rem; padding: 14px; font-size: 1rem; font-weight: 600; border-radius: var(--m-radius); border: none; background: linear-gradient(135deg, var(--m-accent), #2563eb); color: #fff; cursor: pointer; }
.m-auth__links { margin-top: 1.5rem; text-align: center; font-size: 0.9375rem; color: var(--m-text-muted); }
.m-auth__links a { color: var(--m-accent); text-decoration: none; font-weight: 500; }
.m-auth__alert { padding: 12px; border-radius: var(--m-radius); margin-bottom: 1rem; font-size: 0.875rem; }
.m-auth__alert--error { background: rgba(220, 38, 38, 0.15); color: #f87171; }
.m-auth__error { font-size: 0.8125rem; color: #f87171; margin-top: 4px; }
</style>
@endpush

@section('content')
<div class="m-auth">
    <h1 class="m-auth__title">Новый пароль</h1>
    <p class="m-auth__subtitle">Придумайте надёжный пароль для входа</p>

    @if ($errors->any())
        <div class="m-auth__alert m-auth__alert--error">
            Проверьте правильность заполнения полей (пароль не менее 8 символов).
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="redirect_mobile" value="1">

        <div class="m-order-field">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" class="m-order-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                   value="{{ $email ?? old('email') }}" required autocomplete="email" placeholder="you@example.com">
            @error('email')<div class="m-auth__error">{{ $message }}</div>@enderror
        </div>

        <div class="m-order-field">
            <label for="password">Новый пароль</label>
            <div class="m-auth__password-wrap">
                <input id="password" type="password" name="password" class="m-order-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                       required autocomplete="new-password" placeholder="Минимум 8 символов">
                <button type="button" class="m-auth__eye m-auth-toggle-password" aria-label="Показать пароль" data-target="password">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
            </div>
            @error('password')<div class="m-auth__error">{{ $message }}</div>@enderror
        </div>

        <div class="m-order-field">
            <label for="password_confirmation">Повторите пароль</label>
            <div class="m-auth__password-wrap">
                <input id="password_confirmation" type="password" name="password_confirmation" class="m-order-input"
                       required autocomplete="new-password" placeholder="••••••••">
                <button type="button" class="m-auth__eye m-auth-toggle-password" aria-label="Показать пароль" data-target="password_confirmation">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
            </div>
        </div>

        <button type="submit" class="m-auth__submit">Сохранить пароль</button>

        <div class="m-auth__links">
            <a href="{{ route('mobile.login') }}">← Вернуться к входу</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.querySelectorAll('.m-auth-toggle-password').forEach(function(btn) {
    var id = btn.getAttribute('data-target');
    var input = document.getElementById(id);
    if (!input) return;
    btn.addEventListener('click', function() {
        var isPass = input.type === 'password';
        input.type = isPass ? 'text' : 'password';
        btn.setAttribute('aria-label', isPass ? 'Скрыть пароль' : 'Показать пароль');
    });
});
</script>
@endpush
@endsection
