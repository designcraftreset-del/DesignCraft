<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="admin2-theme" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Чат с пользователями') — DesignCraft</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect fill='%231d4ed8' width='32' height='32' rx='6'/%3E%3C/svg%3E">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class', theme: { extend: { colors: { primary: '#1d4ed8' } } } };
    </script>
    <style>
        :root, [data-theme="light"] { --admin-bg: #f8fafc; --admin-card: #ffffff; --admin-text: #0f172a; --admin-text-muted: #64748b; --admin-border: #e2e8f0; }
        [data-theme="dark"] { --admin-bg: #0f172a; --admin-card: #1e293b; --admin-text: #f1f5f9; --admin-text-muted: #94a3b8; --admin-border: #334155; }
        [data-theme="dark"] input, [data-theme="dark"] select, [data-theme="dark"] textarea { color-scheme: dark; }
        .admin2-theme { background-color: var(--admin-bg); color: var(--admin-text); }
        .admin2-card { background-color: var(--admin-card); border: 1px solid var(--admin-border); }
        .admin2-text-muted { color: var(--admin-text-muted); }
        .admin2-support-chat-layout { height: calc(100vh - 4rem); min-height: 420px; }
        #support-chat-messages { overflow-y: auto; overflow-x: hidden; }
        #support-chat-messages:not(:empty) { display: flex; flex-direction: column; align-items: flex-start; }
        #support-chat-messages .support-msg-item { width: 100%; max-width: 100%; }
    </style>
</head>
<body class="admin2-theme min-h-screen antialiased flex flex-col">
    <header class="border-b border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 px-4 py-3 flex items-center justify-between flex-shrink-0">
        <h1 class="text-lg font-semibold">Чат с пользователями</h1>
        <div class="flex items-center gap-3">
            <button type="button" id="admin2-chat-theme-toggle" class="p-2 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors" aria-label="Тема">
                <svg id="admin2-chat-icon-sun" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/></svg>
                <svg id="admin2-chat-icon-moon" class="hidden" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>
            </button>
            <a href="{{ route('adminPanel2', ['page' => 'messages']) }}" class="text-sm text-primary hover:underline">← В админ-панель</a>
        </div>
    </header>
    <main class="flex-1 min-h-0">
        @yield('content')
    </main>
    @stack('scripts')
    <script>
    (function() {
        var root = document.documentElement;
        var toggle = document.getElementById('admin2-chat-theme-toggle');
        var iconSun = document.getElementById('admin2-chat-icon-sun');
        var iconMoon = document.getElementById('admin2-chat-icon-moon');
        var key = 'admin2-theme';
        function applyTheme(isDark) {
            root.setAttribute('data-theme', isDark ? 'dark' : 'light');
            root.classList.toggle('dark', isDark);
            if (iconSun) iconSun.classList.toggle('hidden', isDark);
            if (iconMoon) iconMoon.classList.toggle('hidden', !isDark);
            try { localStorage.setItem(key, isDark ? 'dark' : 'light'); } catch (e) {}
        }
        var stored = null;
        try { stored = localStorage.getItem(key); } catch (e) {}
        var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        var isDark = stored === 'dark' || (stored !== 'light' && prefersDark);
        applyTheme(isDark);
        if (toggle) toggle.addEventListener('click', function() { isDark = !isDark; applyTheme(isDark); });
    })();
    </script>
</body>
</html>
