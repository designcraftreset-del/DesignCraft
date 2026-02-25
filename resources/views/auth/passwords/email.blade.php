@extends('layouts.app')

@section('content')
<body>
    <a href="{{ url('/') }}" class="back-btn_two">
        ← Вернуться на главную
    </a>
    <style>
        .back-btn_two {
            position: fixed;
            top: 10px;
            left: 20px;
            z-index: 5;
            margin-top: 1rem;
            color: #64748b;
            font-weight: 500;
            transition: color 0.3s ease;
            cursor: pointer;
        }

        .back-btn_two:hover {
            color: #374151;
        }
    </style>
    <style>
        body{
            background-color: #0f141d;
            margin-top: -55px;
        }
    </style>
    <div id="loginModal" class="modal-overlay">
    
        <span class="close-button" onclick="closeModal()">&times;</span>
        
    <div class="body_header">
        <div class="container login-container">
            <div class="row justify-content-center">
                <div class="col-md-88">
                    <div class="card login-card">
                        <div class="card-header login-card-header">
                            {{ __('Вход') }}
                        </div>

                        <div class="card-body login-card-body">
                            <div class="decoration decoration-1"></div>
                            <div class="decoration decoration-2"></div>
                            
                            <form method="POST" action="{{ route('login') }}" class="login-form">
                                @csrf

                                <div class="row mb-3 form-row">
                                    <label for="email" class="col-md-4 col-form-label text-md-end form-label">{{ __('Почта') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback error-message" role="alert">
                                                <strong>Неверный пароль или почта</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3 form-row">
                                    <label for="password" class="col-md-4 col-form-label text-md-end form-label">{{ __('Пароль') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback error-message" role="alert">
                                                <strong>Неверный пароль</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3 form-row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check remember-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label remember-label" for="remember">
                                                {{ __('Запомнить') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-0">
                                    <div class="col-md-8 offset-md-2">
                                        <button type="submit" class="btn btn-primary login-button">
                                            {{ __('Вход') }}
                                            <div class="button-hover-effect"></div>
                                        </button>

                                        <div class="auth-links">
                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link auth-link" href="{{ route('register') }}">
                                                    {{ __('Нет аккаунта ?') }}
                                                </a>
                                            @endif
                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link auth-link" href="{{ route('password.request') }}">
                                                    {{ __('Забыл пароль ?') }}
                                                </a>
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
        <style>
    .login-container {
        margin-top: 7rem;
    }

    .col-md-88 {
        display: flex;
        justify-content: center;
    }

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

    .login-card-body {
        padding: 40px 30px;
        position: relative;
    }

    .decoration {
        position: absolute;
        border-radius: 50%;
        opacity: 0.1;
        z-index: 0;
    }

    .decoration-1 {
        top: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
        background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);
    }

    .decoration-2 {
        bottom: -30px;
        left: -30px;
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #1D4ED8 0%, #3B82F6 100%);
    }

    .login-form {
        position: relative;
        z-index: 1;
    }

    .form-row {
        align-items: center;
        margin-bottom: 25px !important;
    }

    .form-label {
        color: #374151;
        font-weight: 500;
        font-size: 16px;
        padding-right: 15px;
    }

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

    .error-message {
        display: block;
        color: #ef4444;
        font-size: 14px;
        margin-top: 5px;
    }

    .remember-check {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }

    .form-check-input {
        width: 18px;
        height: 18px;
        border: 2px solid #d1d5db;
        border-radius: 4px;
        cursor: pointer;
    }

    .remember-label {
        color: #374151;
        font-size: 14px;
        cursor: pointer;
        margin: 0;
    }

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

    .login-button:hover {
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3) !important;
    }

    .button-hover-effect {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, 0.1);
        left: -100%;
        transition: 0.4s;
    }

    .login-button:hover .button-hover-effect {
        left: 0 !important;
    }

    .auth-links {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        gap: 15px;
    }

    .auth-link {
        color: #3B82F6;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        padding: 8px 0;
        transition: color 0.3s ease;
    }

    .auth-link:hover {
        color: #1D4ED8 !important;
    }

    /* Темная тема */
    .dark-theme .login-card {
        background: rgba(45, 45, 45, 0.95) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
    }

    .dark-theme .form-control {
        background: rgba(61, 61, 61, 0.8) !important;
        border-color: #4a5568 !important;
        color: #e0e0e0 !important;
    }

    .dark-theme .form-control:focus {
        background: #4a5568 !important;
        border-color: #63B3ED !important;
        box-shadow: 0 0 0 3px rgba(99, 179, 237, 0.1) !important;
    }

    .dark-theme .form-label {
        color: #e0e0e0 !important;
    }

    .dark-theme .auth-link {
        color: #63B3ED !important;
    }

    .dark-theme .auth-link:hover {
        color: #90CDF4 !important;
    }

    /* Адаптивность */
    @media (max-width: 768px) {
        .col-md-88 {
            width: 100% !important;
            padding: 0 15px;
        }
        
        .login-card-body {
            padding: 30px 20px !important;
        }
        
        .auth-links {
            flex-direction: column;
            text-align: center;
            gap: 10px !important;
        }
        
        .remember-check {
            margin-left: 0 !important;
            justify-content: center;
        }
        
        .login-card {
            min-width: auto;
        }
    }
        </style>
    
    </div>
</div>
    <style>
        .dark-theme .hero_login_section{
            background-color: #0f141d;
        }
    </style>
    <style>
            .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(8px);
        z-index: 1000;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .modal-overlay.active {
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 1;
    }

    .modal-content {
        position: relative;
        max-width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        animation: modalAppear 0.3s ease-out;
    }

    .close-button {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 30px;
        color: white;
        cursor: pointer;
        z-index: 1001;
        background: rgba(0, 0, 0, 0.5);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .close-button:hover {
        background: rgba(0, 0, 0, 0.8);
        transform: scale(1.1);
    }

    </style>
    <style>
.cursor-glow {
    position: fixed;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, rgba(59, 130, 246, 0.1) 30%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
    z-index: 9999;
    filter: blur(60px);
    opacity: 0;
    transition: opacity 0.3s ease;
    transform: translate(-50%, -50%);
}

.cursor-glow.active {
    opacity: 1;
}

.cursor-glow-intense {
    position: fixed;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, 
        rgba(59, 130, 246, 0.25) 0%,
        rgba(59, 130, 246, 0.15) 40%,
        rgba(59, 130, 246, 0.05) 60%,
        transparent 80%
    );
    border-radius: 50%;
    pointer-events: none;
    z-index: 9999;
    filter: blur(40px);
    opacity: 0;
    transition: opacity 0.2s ease, transform 0.1s ease;
    transform: translate(-50%, -50%) scale(1);
}

.cursor-glow-intense.active {
    opacity: 1;
}

.cursor-glow-intense.hover {
    transform: translate(-50%, -50%) scale(1.2);
    filter: blur(30px);
    background: radial-gradient(circle, 
        rgba(59, 130, 246, 0.35) 0%,
        rgba(59, 130, 246, 0.2) 40%,
        rgba(59, 130, 246, 0.1) 60%,
        transparent 80%
    );
}

.cursor-glow-pulse {
    position: fixed;
    width: 350px;
    height: 350px;
    background: radial-gradient(circle, 
        rgba(59, 130, 246, 0.2) 0%,
        rgba(59, 130, 246, 0.1) 50%,
        transparent 70%
    );
    border-radius: 50%;
    pointer-events: none;
    z-index: 9999;
    filter: blur(50px);
    opacity: 0;
    transition: opacity 0.3s ease;
    transform: translate(-50%, -50%);
    animation: pulseGlow 3s ease-in-out infinite;
}

.cursor-glow-pulse.active {
    opacity: 1;
}

@keyframes pulseGlow {
    0%, 100% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 0.7;
    }
    50% {
        transform: translate(-50%, -50%) scale(1.1);
        opacity: 1;
    }
}
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
                    {{ __('Смена пароля') }}
                </div>

                <div class="card-body login-card-body">
                    <div class="decoration decoration-1"></div>
                    <div class="decoration decoration-2"></div>
                    
                    @if (session('status'))
                        <div class="alert alert-success alert-custom" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="login-form">
                        @csrf

                        <div class="row mb-3 form-row">
                            <label for="email" class="col-md-4 col-form-label text-md-end form-label">{{ __('Почта') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback error-message" role="alert">
                                        <strong>Аккаунта не существует</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-0">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn btn-primary login-button">
                                    {{ __('Отправить код') }}
                                    <div class="button-hover-effect"></div>
                                </button>

                                <div class="auth-links">
                                    <a class="btn btn-link auth-link" href="{{ route('login') }}">
                                        {{ __('Вернуться к входу') }}
                                    </a>
                                </div>
                                <div class="auth-legal-links">
                                    <a href="{{ route('privacy') }}" target="_blank" rel="noopener">Политика конфиденциальности</a>
                                    <span class="auth-legal-sep">·</span>
                                    <a href="{{ route('terms') }}" target="_blank" rel="noopener">Условия использования</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.auth-legal-links { text-align: center; margin-top: 20px; padding-top: 16px; border-top: 1px solid rgba(0,0,0,0.06); font-size: 13px; }
.auth-legal-links a { color: #3B82F6; text-decoration: none; font-weight: 500; }
.auth-legal-links a:hover { color: #1D4ED8; text-decoration: underline; }
.auth-legal-sep { color: #94a3b8; margin: 0 8px; }
.dark-theme .auth-legal-links { border-top-color: rgba(255,255,255,0.08); }
.dark-theme .auth-legal-links a { color: #63B3ED; }
.dark-theme .auth-legal-links a:hover { color: #90CDF4; }
.login-container {
    margin-top: 7rem;
}

.col-md-88 {
    display: flex;
    justify-content: center;
}

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

.login-card-body {
    padding: 40px 30px;
    position: relative;
}

.decoration {
    position: absolute;
    border-radius: 50%;
    opacity: 0.1;
    z-index: 0;
}

.decoration-1 {
    top: -50px;
    right: -50px;
    width: 150px;
    height: 150px;
    background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);
}

.decoration-2 {
    bottom: -30px;
    left: -30px;
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #1D4ED8 0%, #3B82F6 100%);
}

.login-form {
    position: relative;
    z-index: 1;
}

.form-row {
    align-items: center;
    margin-bottom: 25px !important;
}

.form-label {
    color: #374151;
    font-weight: 500;
    font-size: 16px;
    padding-right: 15px;
}

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

.error-message {
    display: block;
    color: #ef4444;
    font-size: 14px;
    margin-top: 5px;
}

.alert-custom {
    background: rgba(34, 197, 94, 0.1);
    border: 1px solid rgba(34, 197, 94, 0.3);
    border-radius: 10px;
    padding: 15px 20px;
    color: #16a34a;
    font-weight: 500;
    margin-bottom: 25px;
    text-align: center;
}

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

.login-button:hover {
    box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3) !important;
}

.button-hover-effect {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(255, 255, 255, 0.1);
    left: -100%;
    transition: 0.4s;
}

.login-button:hover .button-hover-effect {
    left: 0 !important;
}

.auth-links {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    gap: 15px;
}

.auth-link {
    color: #3B82F6;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    padding: 8px 0;
    transition: color 0.3s ease;
}

.auth-link:hover {
    color: #1D4ED8 !important;
}

/* Темная тема */
.dark-theme .login-card {
    background: rgba(45, 45, 45, 0.95) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
}

.dark-theme .form-control {
    background: rgba(61, 61, 61, 0.8) !important;
    border-color: #4a5568 !important;
    color: #e0e0e0 !important;
}

.dark-theme .form-control:focus {
    background: #4a5568 !important;
    border-color: #63B3ED !important;
    box-shadow: 0 0 0 3px rgba(99, 179, 237, 0.1) !important;
}

.dark-theme .form-label {
    color: #e0e0e0 !important;
}

.dark-theme .auth-link {
    color: #63B3ED !important;
}

.dark-theme .auth-link:hover {
    color: #90CDF4 !important;
}

.dark-theme .alert-custom {
    background: rgba(34, 197, 94, 0.15);
    border-color: rgba(34, 197, 94, 0.4);
    color: #4ade80;
}

/* Адаптивность */
@media (max-width: 768px) {
    .col-md-88 {
        width: 100% !important;
        padding: 0 15px;
    }
    
    .login-card-body {
        padding: 30px 20px !important;
    }
    
    .auth-links {
        flex-direction: column;
        text-align: center;
        gap: 10px !important;
    }
    
    .login-card {
        min-width: auto;
    }
    
    .form-row {
        margin-bottom: 20px !important;
    }
}
</style>
        </div>
    </section>
</body>
<script>
    function openModal() {
        const modal = document.getElementById('loginModal');
        modal.classList.add('active');
        document.body.style.overflow = 'hidden'; // Блокируем прокрутку фона
    }

    function closeModal() {
        const modal = document.getElementById('loginModal');
        modal.classList.remove('active');
        document.body.style.overflow = 'auto'; // Возвращаем прокрутку
    }

    // Закрытие модального окна при клике вне его
    document.getElementById('loginModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Закрытие модального окна при нажатии Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
</script>
@endsection