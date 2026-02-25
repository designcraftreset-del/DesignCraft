<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'DesignCraft')</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect fill='%231d4ed8' width='32' height='32' rx='6'/%3E%3C/svg%3E">
    <script>(function(){function loadFont(){var l=document.createElement('link');l.rel='stylesheet';l.href='https://fonts.bunny.net/css?family=Nunito';document.head.appendChild(l);}if(document.readyState==='complete')loadFont();else window.addEventListener('load',loadFont);})();</script>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Nunito, ui-sans-serif, system-ui, sans-serif;
            min-height: 100vh;
            color: #1a1a1a;
            line-height: 1.6;
        }
        /* Секция в стиле главной (hero_login_section) */
        .legal-page {
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
            background-color: #ffffff;
            padding: 80px 20px 60px;
        }
        .legal-page::before {
            inset: 0;
            content: "";
            position: absolute;
            background-image:
                linear-gradient(to right, hsl(220 10% 80%) 1px, transparent 1px),
                linear-gradient(to bottom, hsl(220 10% 80%) 1px, transparent 1px);
            background-size: 4rem 4rem;
            -webkit-mask-image: radial-gradient(ellipse 60% 50% at 50% 50%, #000 70%, transparent 100%);
            mask-image: radial-gradient(ellipse 60% 50% at 50% 50%, #000 70%, transparent 100%);
            opacity: 0.3;
            pointer-events: none;
        }
        .legal-page .legal-blur-1 {
            position: absolute;
            width: 100px;
            height: 100px;
            filter: blur(100px);
            left: 100px;
            top: 100px;
            background-color: #165bc9;
            opacity: 0.25;
            pointer-events: none;
        }
        .legal-page .legal-blur-2 {
            position: absolute;
            width: 100px;
            height: 100px;
            filter: blur(120px);
            right: 150px;
            bottom: 150px;
            background-color: #165bc9;
            opacity: 0.25;
            pointer-events: none;
        }
        body.dark-theme .legal-page {
            background-color: #0f141d;
        }
        body.dark-theme .legal-page::before {
            background-image:
                linear-gradient(to right, hsl(220 20% 20%) 1px, transparent 1px),
                linear-gradient(to bottom, hsl(220 20% 20%) 1px, transparent 1px);
        }
        body.dark-theme .legal-page .legal-blur-1,
        body.dark-theme .legal-page .legal-blur-2 {
            background-color: #3B82F6;
            opacity: 0.2;
        }
        .legal-back {
            position: absolute;
            top: 24px;
            left: 24px;
            z-index: 10;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #374151;
            text-decoration: none;
            font-weight: 500;
            padding: 10px 18px;
            border-radius: 0.5rem;
            background-color: #f8fafd;
            border: 1px solid rgba(59, 130, 246, 0.25);
            transition: all 0.25s ease;
        }
        .legal-back:hover {
            color: #1D4ED8;
            background-color: #f0f7ff;
            border-color: #3B82F6;
        }
        body.dark-theme .legal-back {
            color: #e2e8f0;
            background: rgba(30, 41, 59, 0.9);
            border-color: rgba(255,255,255,0.1);
        }
        body.dark-theme .legal-back:hover {
            color: #93C5FD;
            background: rgba(59, 130, 246, 0.15);
            border-color: rgba(59, 130, 246, 0.4);
        }
        .legal-inner {
            position: relative;
            z-index: 2;
            max-width: 720px;
            width: 100%;
        }
        /* Карточка в стиле login-card с главной */
        .legal-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        body.dark-theme .legal-card {
            background: rgba(30, 41, 59, 0.95);
            border-color: rgba(255, 255, 255, 0.08);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }
        .legal-card-header {
            background: linear-gradient(135deg, #1D4ED8 0%, #3B82F6 100%);
            color: white;
            padding: 24px 32px;
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
        }
        .legal-card-body {
            padding: 36px 40px 40px;
            position: relative;
        }
        .legal-card-body .decoration-1 {
            position: absolute;
            top: -40px;
            right: -40px;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);
            opacity: 0.08;
        }
        .legal-card-body .decoration-2 {
            position: absolute;
            bottom: -30px;
            left: -30px;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1D4ED8 0%, #3B82F6 100%);
            opacity: 0.08;
        }
        .legal-content { position: relative; z-index: 1; }
        .legal-content h1 {
            font-size: 1.5rem;
            margin: 0 0 6px;
            color: #1a1a1a;
            font-weight: 700;
        }
        body.dark-theme .legal-content h1 { color: #f1f5f9; }
        .legal-updated {
            color: #64748b;
            font-size: 0.875rem;
            margin-bottom: 24px;
        }
        body.dark-theme .legal-updated { color: #94a3b8; }
        .legal-content h2 {
            font-size: 1.1rem;
            margin: 28px 0 10px;
            color: #334155;
            font-weight: 600;
        }
        body.dark-theme .legal-content h2 { color: #cbd5e1; }
        .legal-content p, .legal-content li {
            margin: 0 0 12px;
            color: #475569;
            font-size: 0.9375rem;
        }
        body.dark-theme .legal-content p,
        body.dark-theme .legal-content li { color: #94a3b8; }
        .legal-content ul {
            padding-left: 1.25rem;
            margin: 0 0 16px;
        }
        .legal-content a {
            color: #3B82F6;
            text-decoration: none;
            font-weight: 500;
        }
        .legal-content a:hover { text-decoration: underline; }
        body.dark-theme .legal-content a { color: #60A5FA; }
        @media (max-width: 768px) {
            .legal-page { padding: 70px 16px 40px; }
            .legal-back { top: 16px; left: 16px; padding: 8px 14px; font-size: 0.875rem; }
            .legal-card-body { padding: 24px 20px 28px; }
            .legal-card-header { padding: 20px 24px; font-size: 1.25rem; }
        }
    </style>
</head>
<body>
    <div class="legal-page">
        <div class="legal-blur-1"></div>
        <div class="legal-blur-2"></div>
        <a href="{{ url()->previous() ?? url('/') }}" class="legal-back">← Назад</a>
        <div class="legal-inner">
            <div class="legal-card">
                @yield('content')
            </div>
        </div>
    </div>
    <script>
        (function() {
            var theme = localStorage.getItem('theme');
            if (theme === 'dark') document.body.classList.add('dark-theme');
        })();
    </script>
</body>
</html>
