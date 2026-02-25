<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'DesignCraft')</title>
    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">
    <style>
        :root {
            --auth-bg: #f8fafc;
            --auth-bg-end: #e2e8f0;
            --auth-card: #ffffff;
            --auth-card-border: rgba(0,0,0,0.06);
            --auth-text: #0f172a;
            --auth-text-muted: #64748b;
            --auth-input-bg: #f1f5f9;
            --auth-input-border: #e2e8f0;
            --auth-input-focus: #3b82f6;
            --auth-accent: #2563eb;
            --auth-accent-hover: #1d4ed8;
            --auth-link: #2563eb;
            --auth-error: #dc2626;
            --auth-success: #16a34a;
            --auth-shadow: 0 25px 50px -12px rgba(0,0,0,0.08);
            --auth-radius: 16px;
            --auth-radius-sm: 12px;
        }
        body.dark-theme {
            --auth-bg: #0f172a;
            --auth-bg-end: #1e293b;
            --auth-card: rgba(30, 41, 59, 0.95);
            --auth-card-border: rgba(255,255,255,0.08);
            --auth-text: #f1f5f9;
            --auth-text-muted: #94a3b8;
            --auth-input-bg: rgba(15, 23, 42, 0.8);
            --auth-input-border: rgba(255,255,255,0.1);
            --auth-input-focus: #60a5fa;
            --auth-accent: #3b82f6;
            --auth-accent-hover: #60a5fa;
            --auth-link: #60a5fa;
            --auth-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'DM Sans', system-ui, sans-serif;
            background: linear-gradient(160deg, var(--auth-bg) 0%, var(--auth-bg-end) 100%);
            color: var(--auth-text);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            transition: background 0.4s ease, color 0.2s ease;
            position: relative;
        }
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image:
                linear-gradient(to right, hsl(220 10% 80%) 1px, transparent 1px),
                linear-gradient(to bottom, hsl(220 10% 80%) 1px, transparent 1px);
            background-size: 4rem 4rem;
            -webkit-mask-image: radial-gradient(ellipse 60% 50% at 50% 50%, #000 70%, transparent 100%);
            mask-image: radial-gradient(ellipse 60% 50% at 50% 50%, #000 70%, transparent 100%);
            opacity: 0.35;
        }
        body.dark-theme::before {
            background-image:
                linear-gradient(to right, hsl(220 20% 22%) 1px, transparent 1px),
                linear-gradient(to bottom, hsl(220 20% 22%) 1px, transparent 1px);
            opacity: 0.4;
        }
        .auth-v2-page {
            width: 100%;
            max-width: 420px;
            position: relative;
        }
        .auth-v2-back {
            position: absolute;
            top: -52px;
            left: 0;
            color: var(--auth-text-muted);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s;
        }
        .auth-v2-back:hover { color: var(--auth-link); }
        .night____theme {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 999;
        }
        .night__theme {
            position: relative;
            width: 40px;
            height: 40px;
            cursor: pointer;
        }
        .night_theme, .night___theme {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            position: absolute;
            top: 0;
            left: 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .night_theme {
            background-color: #fefefe;
            border: 2px solid #dee0e5;
            opacity: 1;
            transform: scale(1) rotate(0deg);
        }
        .night_theme svg { stroke: #2b2e35; }
        .night___theme {
            background-color: #13171f;
            border: 2px solid #272d3a;
            opacity: 0;
            transform: scale(0.8) rotate(-90deg);
        }
        .night___theme svg { stroke: #ccced1; }
        body.dark-theme .night_theme {
            opacity: 0;
            transform: scale(0.8) rotate(90deg);
        }
        body.dark-theme .night___theme {
            opacity: 1;
            transform: scale(1) rotate(0deg);
        }
        .night_theme svg, .night___theme svg { width: 18px; height: 18px; }
        .auth-v2-card {
            background: var(--auth-card);
            border: 1px solid var(--auth-card-border);
            border-radius: var(--auth-radius);
            padding: 40px 36px;
            box-shadow: var(--auth-shadow);
            backdrop-filter: blur(12px);
        }
        .auth-v2-card h1 {
            margin: 0 0 8px;
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.02em;
        }
        .auth-v2-subtitle {
            margin: 0 0 28px;
            font-size: 0.9375rem;
            color: var(--auth-text-muted);
        }
        .auth-v2-form .field {
            margin-bottom: 20px;
        }
        .auth-v2-form label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 500;
            color: var(--auth-text-muted);
            margin-bottom: 8px;
        }
        .auth-v2-form input[type="text"],
        .auth-v2-form input[type="email"],
        .auth-v2-form input[type="password"] {
            width: 100%;
            padding: 14px 16px;
            font-size: 1rem;
            font-family: inherit;
            color: var(--auth-text);
            background: var(--auth-input-bg);
            border: 1px solid var(--auth-input-border);
            border-radius: var(--auth-radius-sm);
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .auth-v2-form .input-password-wrap {
            position: relative;
            display: flex;
        }
        .auth-v2-form .input-password-wrap input {
            padding-right: 48px;
        }
        .auth-v2-form .input-password-wrap .auth-v2-eye {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 36px;
            height: 36px;
            border: none;
            background: none;
            color: var(--auth-text-muted);
            cursor: pointer;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s;
        }
        .auth-v2-form .input-password-wrap .auth-v2-eye:hover {
            color: var(--auth-link);
        }
        .auth-v2-form .input-password-wrap .auth-v2-eye svg {
            width: 20px;
            height: 20px;
        }
        .auth-v2-form input::placeholder {
            color: var(--auth-text-muted);
            opacity: 0.8;
        }
        .auth-v2-form input:focus {
            outline: none;
            border-color: var(--auth-input-focus);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }
        .auth-v2-form input.is-invalid {
            border-color: var(--auth-error);
        }
        .auth-v2-form .field-error {
            font-size: 0.8125rem;
            color: var(--auth-error);
            margin-top: 6px;
        }
        .auth-v2-form .checkbox-wrap {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 20px;
        }
        .auth-v2-form .checkbox-wrap input {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            accent-color: var(--auth-accent);
        }
        .auth-v2-form .checkbox-wrap label {
            margin: 0;
            font-size: 0.875rem;
            color: var(--auth-text);
        }
        .auth-v2-form .checkbox-wrap a {
            color: var(--auth-link);
            text-decoration: none;
        }
        .auth-v2-form .checkbox-wrap a:hover { text-decoration: underline; }
        .auth-v2-form .btn-primary {
            width: 100%;
            padding: 14px 20px;
            font-size: 1rem;
            font-weight: 600;
            font-family: inherit;
            color: #fff;
            background: linear-gradient(135deg, var(--auth-accent) 0%, var(--auth-accent-hover) 100%);
            border: none;
            border-radius: var(--auth-radius-sm);
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.2s;
        }
        .auth-v2-form .btn-primary:active { transform: translateY(0); }
        .auth-v2-links {
            margin-top: 24px;
            text-align: center;
            font-size: 0.875rem;
        }
        .auth-v2-links a {
            color: var(--auth-link);
            text-decoration: none;
            font-weight: 500;
        }
        .auth-v2-links a:hover { text-decoration: underline; }
        .auth-v2-links .divider {
            color: var(--auth-text-muted);
            margin: 0 8px;
        }
        .auth-v2-alert {
            padding: 12px 16px;
            border-radius: var(--auth-radius-sm);
            margin-bottom: 20px;
            font-size: 0.875rem;
        }
        .auth-v2-alert-success {
            background: rgba(22, 163, 74, 0.12);
            color: var(--auth-success);
        }
        .auth-v2-alert-error {
            background: rgba(220, 38, 38, 0.1);
            color: var(--auth-error);
        }
    </style>
</head>
<body class="@yield('body_class', '')">
    <div class="auth-v2-page">
        <a href="{{ url('/') }}" class="auth-v2-back">← На главную</a>
        <div class="auth-v2-card">
            @yield('content')
        </div>
    </div>
    <div class="night____theme">
        <div class="night__theme" role="button" aria-label="Сменить тему">
            <div class="night_theme">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>
            </div>
            <div class="night___theme">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/></svg>
            </div>
        </div>
    </div>
    <script>
        (function() {
            var body = document.body;
            function applySavedTheme() {
                var saved = localStorage.getItem('theme');
                if (saved === 'dark') body.classList.add('dark-theme');
                else body.classList.remove('dark-theme');
            }
            function toggleTheme() {
                if (body.classList.contains('dark-theme')) {
                    body.classList.remove('dark-theme');
                    localStorage.setItem('theme', 'light');
                } else {
                    body.classList.add('dark-theme');
                    localStorage.setItem('theme', 'dark');
                }
            }
            applySavedTheme();
            var themeBtn = document.querySelector('.night__theme');
            if (themeBtn) themeBtn.addEventListener('click', toggleTheme);
        })();
    </script>
    <script>
        document.querySelectorAll('.input-password-wrap').forEach(function(wrap) {
            var input = wrap.querySelector('input');
            var btn = wrap.querySelector('.auth-v2-eye');
            if (!input || !btn) return;
            var eyeOn = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>';
            var eyeOff = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>';
            btn.innerHTML = eyeOn;
            btn.setAttribute('aria-label', 'Показать пароль');
            btn.addEventListener('click', function() {
                var isPass = input.type === 'password';
                input.type = isPass ? 'text' : 'password';
                btn.innerHTML = isPass ? eyeOff : eyeOn;
                btn.setAttribute('aria-label', isPass ? 'Скрыть пароль' : 'Показать пароль');
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
