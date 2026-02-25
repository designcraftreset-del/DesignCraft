@extends('auth-v2.layout')

@section('title', 'Регистрация — DesignCraft')

@section('content')
    <h1>Регистрация</h1>
    <p class="auth-v2-subtitle">Создайте аккаунт, чтобы заказывать дизайн</p>

    @if ($errors->any())
        <div class="auth-v2-alert auth-v2-alert-error">
            @if ($errors->has('terms_privacy_accepted'))
                Необходимо принять политику конфиденциальности и условия использования.
            @else
                Проверьте правильность заполнения полей.
            @endif
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="auth-v2-form">
        @csrf

        <div class="field">
            <label for="name">Имя</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                   autocomplete="name" placeholder="Как к вам обращаться?"
                   class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
            @error('name')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                   autocomplete="email" placeholder="you@example.com"
                   class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
            @error('email')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="password">Пароль</label>
            <div class="input-password-wrap">
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       placeholder="Минимум 8 символов"
                       class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
                <button type="button" class="auth-v2-eye" aria-label="Показать пароль"></button>
            </div>
            <div class="password-strength-wrap" aria-live="polite">
                <div class="password-strength-line" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="4">
                    <span class="password-strength-fill" id="password-strength-fill"></span>
                </div>
                <span class="password-strength-label" id="password-strength-label"></span>
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

        <div class="checkbox-wrap">
            <input type="checkbox" name="terms_privacy_accepted" id="terms_privacy_accepted" value="1"
                   {{ old('terms_privacy_accepted') ? 'checked' : '' }} required>
            <label for="terms_privacy_accepted">
                Согласен с <a href="{{ route('privacy') }}" target="_blank" rel="noopener">политикой конфиденциальности</a> и <a href="{{ route('terms') }}" target="_blank" rel="noopener">условиями использования</a>
            </label>
        </div>
        @error('terms_privacy_accepted')
            <div class="field-error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn-primary">Зарегистрироваться</button>

        <div class="auth-v2-links">
            Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a>
        </div>
    </form>

    <style>
        .password-strength-wrap { margin-top: 10px; }
        .password-strength-line {
            height: 4px;
            background: var(--auth-input-border);
            border-radius: 2px;
            overflow: hidden;
        }
        .password-strength-fill {
            display: block;
            height: 100%;
            width: 0%;
            border-radius: 2px;
            transition: width 0.2s ease, background-color 0.2s ease;
        }
        .password-strength-fill.strength-0 { width: 0; background: #94a3b8; }
        .password-strength-fill.strength-1 { width: 25%; background: #dc2626; }
        .password-strength-fill.strength-2 { width: 50%; background: #ea580c; }
        .password-strength-fill.strength-3 { width: 75%; background: #ca8a04; }
        .password-strength-fill.strength-4 { width: 100%; background: var(--auth-success); }
        .password-strength-label {
            display: block;
            font-size: 0.75rem;
            color: var(--auth-text-muted);
            margin-top: 6px;
        }
    </style>

    @push('scripts')
    <script>
        (function() {
            var input = document.getElementById('password');
            var fill = document.getElementById('password-strength-fill');
            var label = document.getElementById('password-strength-label');
            var progressbar = document.querySelector('.password-strength-wrap [role="progressbar"]');
            if (!input || !fill || !label) return;
            var labels = ['', 'Слабый', 'Средний', 'Хороший', 'Надёжный'];
            function checkStrength(val) {
                var s = 0;
                if (val.length >= 8) s++;
                if (/[a-z]/.test(val) && /[A-Z]/.test(val)) s++;
                if (/\d/.test(val)) s++;
                if (/[^a-zA-Z0-9]/.test(val)) s++;
                if (val.length >= 12) s = Math.min(4, s + 1);
                return Math.min(4, s);
            }
            function update() {
                var val = (input.value || '');
                var strength = val.length ? checkStrength(val) : 0;
                fill.className = 'password-strength-fill strength-' + strength;
                if (progressbar) progressbar.setAttribute('aria-valuenow', strength);
                label.textContent = val.length ? labels[strength] : '';
            }
            input.addEventListener('input', update);
            input.addEventListener('change', update);
        })();
    </script>
    @endpush
@endsection
