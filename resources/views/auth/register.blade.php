@extends('layouts.app')

@section('content')
<body>
    <style>
        body { background-color: #0f141d; margin-top: -55px; }
        .dark-theme .hero_login_section { background-color: #0f141d; }
    </style>
    <a href="{{ url('/') }}" class="back-btn_two">← Вернуться на главную</a>
    <style>
        .back-btn_two {
            position: fixed;
            top: 10px;
            left: 20px;
            z-index: 5;
            margin-top: 1rem;
            color: #94a3b8;
            font-weight: 500;
            transition: color 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 10px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
        }
        .back-btn_two:hover { color: #3B82F6; background: rgba(59, 130, 246, 0.1); }
    </style>

    <section class="hero_login_section">
        <div class="hero_login__section"></div>
        <div class="hero_login___section"></div>
        <div class="container">
            <div class="container login-container">
                <div class="row justify-content-center">
                    <div class="col-md-88">
                        <div class="card login-card">
                            <div class="card-header login-card-header">
                                {{ __('Регистрация') }}
                            </div>
                            <div class="card-body login-card-body">
                                <div class="decoration decoration-1"></div>
                                <div class="decoration decoration-2"></div>
                                <form method="POST" action="{{ route('register') }}" class="login-form">
                                    @csrf
                                    <div class="row mb-3 form-row">
                                        <label for="name" class="col-md-4 col-form-label text-md-end form-label">{{ __('Имя') }}</label>
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback error-message" role="alert"><strong>Поле заполнено не верно</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3 form-row">
                                        <label for="email" class="col-md-4 col-form-label text-md-end form-label">{{ __('Почта') }}</label>
                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                            @error('email')
                                                <span class="invalid-feedback error-message" role="alert"><strong>Поле заполнено не верно</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3 form-row">
                                        <label for="password" class="col-md-4 col-form-label text-md-end form-label">{{ __('Пароль') }}</label>
                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                            @error('password')
                                                <span class="invalid-feedback error-message" role="alert"><strong>Поле заполнено не верно</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3 form-row">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end form-label">{{ __('Повтори пароль') }}</label>
                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="row mb-3 form-row">
                                        <div class="col-md-12">
                                            <div class="form-check legal-check">
                                                <input class="form-check-input @error('terms_privacy_accepted') is-invalid @enderror" type="checkbox" name="terms_privacy_accepted" id="terms_privacy_accepted" value="1" {{ old('terms_privacy_accepted') ? 'checked' : '' }} required>
                                                <label class="form-check-label legal-label" for="terms_privacy_accepted">
                                                    Согласен с <a href="{{ route('privacy') }}" target="_blank" rel="noopener">политикой конфиденциальности</a> и <a href="{{ route('terms') }}" target="_blank" rel="noopener">условиями использования</a>
                                                </label>
                                            </div>
                                            @error('terms_privacy_accepted')
                                                <span class="invalid-feedback error-message d-block" role="alert"><strong>Необходимо принять политику конфиденциальности и условия использования</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-0">
                                        <div class="col-md-8 offset-md-2">
                                            <button type="submit" class="btn btn-primary login-button">
                                                {{ __('Регистрация') }}
                                                <div class="button-hover-effect"></div>
                                            </button>
                                            <div class="auth-links">
                                                @if (Route::has('login'))
                                                    <a class="btn btn-link auth-link" href="{{ route('login') }}">{{ __('Есть аккаунт ?') }}</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
    .login-container { margin-top: 7rem; }
    .col-md-88 { display: flex; justify-content: center; }
    .login-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        min-width: 500px;
    }
    .login-card-header {
        background: linear-gradient(135deg, #1D4ED8 0%, #3B82F6 100%);
        color: white;
        border: none;
        padding: 20px 30px;
        font-size: 24px;
        font-weight: 700;
        text-align: center;
    }
    .login-card-body { padding: 40px 30px; position: relative; }
    .decoration { position: absolute; border-radius: 50%; opacity: 0.1; z-index: 0; }
    .decoration-1 { top: -50px; right: -50px; width: 150px; height: 150px; background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%); }
    .decoration-2 { bottom: -30px; left: -30px; width: 100px; height: 100px; background: linear-gradient(135deg, #1D4ED8 0%, #3B82F6 100%); }
    .login-form { position: relative; z-index: 1; }
    .form-row { align-items: center; margin-bottom: 25px !important; }
    .form-label { color: #374151; font-weight: 500; font-size: 16px; padding-right: 15px; }
    .form-control {
        background: rgba(255, 255, 255, 0.8);
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 16px;
        transition: all 0.3s ease;
        color: #374151;
    }
    .form-control:focus {
        outline: none;
        border-color: #3B82F6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
        background: white !important;
    }
    .error-message { display: block; color: #ef4444; font-size: 14px; margin-top: 5px; }
    .legal-check { display: flex; align-items: flex-start; gap: 10px; margin: 0; }
    .legal-check .form-check-input { margin-top: 4px; width: 18px; height: 18px; border: 2px solid #d1d5db; border-radius: 4px; cursor: pointer; flex-shrink: 0; }
    .legal-label { color: #374151; font-size: 14px; cursor: pointer; margin: 0; line-height: 1.4; }
    .legal-label a { color: #3B82F6; text-decoration: none; }
    .legal-label a:hover { text-decoration: underline; }
    .login-button {
        background: linear-gradient(135deg, #1D4ED8 0%, #3B82F6 100%);
        border: none;
        border-radius: 10px;
        padding: 14px 20px;
        font-size: 16px;
        font-weight: 600;
        color: white;
        width: 100%;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .login-button:hover { box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3) !important; }
    .button-hover-effect { content: ''; position: absolute; inset: 0; background: rgba(255, 255, 255, 0.1); left: -100%; transition: 0.4s; }
    .login-button:hover .button-hover-effect { left: 0 !important; }
    .auth-links { display: flex; justify-content: center; margin-top: 20px; gap: 15px; }
    .auth-link { color: #3B82F6; text-decoration: none; font-size: 14px; font-weight: 500; padding: 8px 0; transition: color 0.3s ease; }
    .auth-link:hover { color: #1D4ED8 !important; }
    .dark-theme .login-card { background: rgba(45, 45, 45, 0.95) !important; border: 1px solid rgba(255, 255, 255, 0.1) !important; }
    .dark-theme .form-control { background: rgba(61, 61, 61, 0.8) !important; border-color: #4a5568 !important; color: #e0e0e0 !important; }
    .dark-theme .form-control:focus { background: #4a5568 !important; border-color: #63B3ED !important; box-shadow: 0 0 0 3px rgba(99, 179, 237, 0.1) !important; }
    .dark-theme .form-label { color: #e0e0e0 !important; }
    .dark-theme .legal-label { color: #e0e0e0 !important; }
    .dark-theme .legal-label a { color: #63B3ED !important; }
    .dark-theme .auth-link { color: #63B3ED !important; }
    .dark-theme .auth-link:hover { color: #90CDF4 !important; }
    @media (max-width: 768px) {
        .col-md-88 { width: 100% !important; padding: 0 15px; }
        .login-card-body { padding: 30px 20px !important; }
        .auth-links { flex-direction: column; text-align: center; gap: 10px !important; }
        .login-card { min-width: auto; }
        .form-row { flex-direction: column; align-items: stretch; }
        .form-label { text-align: left; padding-right: 0; }
    }
    </style>
</body>
@endsection
