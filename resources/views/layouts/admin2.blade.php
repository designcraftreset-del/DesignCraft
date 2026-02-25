<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="admin2-theme" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Админ-панель') — DesignCraft</title>
    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="stylesheet" href="{{ asset('css/skeleton.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#1d4ed8',
                    }
                }
            }
        }
    </script>
    <style>
        :root, [data-theme="light"] {
            --admin-bg: #f8fafc;
            --admin-sidebar: #0f172a;
            --admin-sidebar-text: #e2e8f0;
            --admin-sidebar-hover: #1e293b;
            --admin-card: #ffffff;
            --admin-text: #0f172a;
            --admin-text-muted: #64748b;
            --admin-border: #e2e8f0;
        }
        [data-theme="dark"] {
            --admin-bg: #0f172a;
            --admin-sidebar: #020617;
            --admin-sidebar-text: #e2e8f0;
            --admin-sidebar-hover: #1e293b;
            --admin-card: #1e293b;
            --admin-text: #f1f5f9;
            --admin-text-muted: #94a3b8;
            --admin-border: #334155;
        }
        [data-theme="dark"] input,
        [data-theme="dark"] select,
        [data-theme="dark"] textarea {
            color-scheme: dark;
        }
        .admin2-theme {
            background-color: var(--admin-bg);
            color: var(--admin-text);
        }
        .admin2-sidebar {
            background-color: var(--admin-sidebar);
            color: var(--admin-sidebar-text);
        }
        .admin2-sidebar a:hover {
            background-color: var(--admin-sidebar-hover);
        }
        .admin2-card {
            background-color: var(--admin-card);
            border: 1px solid var(--admin-border);
        }
        .admin2-text-muted { color: var(--admin-text-muted); }
        .admin2-link.active { background-color: rgba(29, 78, 216, 0.2); color: #60a5fa; }
        .admin2-header-dropdown { position: relative; }
        .admin2-header-dropdown .dropdown-menu { position: absolute; top: 100%; right: 0; margin-top: 4px; min-width: 180px; padding: 4px 0; background: var(--admin-card); border: 1px solid var(--admin-border); border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); z-index: 50; display: none; }
        .admin2-header-dropdown.show .dropdown-menu { display: block; }
        .admin2-header-dropdown .dropdown-toggle { display: flex; align-items: center; gap: 6px; padding: 6px 10px; border-radius: 8px; background: transparent; border: none; color: var(--admin-text); font-size: 14px; cursor: pointer; }
        .admin2-header-dropdown .dropdown-toggle:hover { background: rgba(0,0,0,0.05); }
        [data-theme="dark"] .admin2-header-dropdown .dropdown-toggle:hover { background: rgba(255,255,255,0.08); }
        .admin2-header-dropdown .dropdown-item { display: block; width: 100%; text-align: left; padding: 8px 12px; font-size: 14px; color: var(--admin-text); text-decoration: none; border: none; background: none; cursor: pointer; }
        .admin2-header-dropdown .dropdown-item:hover { background: rgba(29, 78, 216, 0.1); color: #1d4ed8; }
        .admin2-header-dropdown .dropdown-item.divider { border-top: 1px solid var(--admin-border); margin-top: 4px; padding-top: 8px; }
    </style>
</head>
<body class="min-h-screen antialiased">
    <div class="flex flex-col md:flex-row min-h-screen">
        {{-- Sidebar: фиксированная, навигация скроллится, «Выход» всегда внизу экрана --}}
        <aside class="admin2-sidebar w-full md:w-64 flex-shrink-0 flex flex-col md:fixed md:left-0 md:top-0 md:bottom-0 md:h-screen md:z-20">
            <div class="p-4 border-b border-slate-700 flex-shrink-0">
                <a href="{{ route('adminPanel2') }}" class="flex items-center gap-2 font-semibold text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/></svg>
                    DesignCraft
                </a>
            </div>
            <nav class="p-2 space-y-0.5 flex-1 overflow-y-auto min-h-0">
                @php $admin2Page = request()->get('page', 'dashboard'); @endphp
                <a href="{{ route('adminPanel2') }}" class="admin2-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $admin2Page === 'dashboard' ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                    <span>Дашборд</span>
                </a>
                <a href="{{ route('adminPanel2', ['page' => 'orders']) }}" class="admin2-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $admin2Page === 'orders' ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg>
                    <span>Заказы</span>
                </a>
                <a href="{{ route('adminPanel2', ['page' => 'users']) }}" class="admin2-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $admin2Page === 'users' ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    <span>Пользователи</span>
                </a>
                <a href="{{ route('adminPanel2', ['page' => 'table']) }}" class="admin2-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $admin2Page === 'table' ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="M18 17V9"/><path d="M13 17V5"/><path d="M8 17v-3"/></svg>
                    <span>Общая таблица</span>
                </a>
                <a href="{{ route('adminPanel2', ['page' => 'products']) }}" class="admin2-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $admin2Page === 'products' ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    <span>Товары/Услуги</span>
                </a>
                <a href="{{ route('adminPanel2', ['page' => 'messages']) }}" class="admin2-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $admin2Page === 'messages' ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    <span>Сообщения</span>
                    <span id="support-unread-badge" class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-0.5 min-w-[1.25rem] text-center {{ (isset($supportChatsCount) && $supportChatsCount > 0) ? '' : 'hidden' }}">{{ $supportChatsCount ?? 0 }}</span>
                </a>
                <a href="{{ route('adminPanel2', ['page' => 'analytics']) }}" class="admin2-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $admin2Page === 'analytics' ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>
                    <span>Аналитика</span>
                </a>
                <a href="{{ route('adminPanel2', ['page' => 'reports']) }}" class="admin2-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $admin2Page === 'reports' ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M16 18H8"/><path d="M16 14H8"/></svg>
                    <span>Отчёты</span>
                </a>
                <a href="{{ route('adminPanel2', ['page' => 'reviews']) }}" class="admin2-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $admin2Page === 'reviews' ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    <span>Отзывы</span>
                    @if(isset($reviewsPendingCount) && $reviewsPendingCount > 0)
                        <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-0.5">{{ $reviewsPendingCount }}</span>
                    @endif
                </a>
                <a href="{{ route('adminPanel2', ['page' => 'settings']) }}" class="admin2-link flex items-center gap-3 px-3 py-2.5 rounded-lg {{ $admin2Page === 'settings' ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                    <span>Настройки</span>
                </a>
            </nav>
            <div class="p-2 mt-auto border-t border-slate-700 flex-shrink-0">
                <a href="{{ route('index') }}" method="post" class="admin2-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-red-300 hover:bg-red-900/20">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                    <span>Выход</span>
                </a>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-h-screen md:ml-64">
            {{-- Header with theme toggle --}}
            <header class="admin2-card sticky top-0 z-10 px-4 py-3 flex items-center justify-between">
                <h1 class="text-lg font-semibold">@yield('heading', 'Дашборд')</h1>
                <div class="flex items-center gap-2">
                    <button type="button" id="admin2-theme-toggle" class="p-2 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors" aria-label="Переключить тему">
                        <svg id="admin2-icon-sun" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
                        <svg id="admin2-icon-moon" class="hidden" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>
                    </button>
                    <div class="admin2-header-dropdown relative" id="admin2-header-user-dropdown">
                        <button type="button" class="admin2-header-dropdown-toggle dropdown-toggle" id="admin2-header-user-btn" aria-expanded="false" aria-haspopup="true">
                            <span>{{ Auth::user()->name ?? 'Админ' }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
                        </button>
                        <div class="dropdown-menu" role="menu" aria-labelledby="admin2-header-user-btn">
                            <a class="dropdown-item" href="{{ route('admin.support-chat') }}">Чат с пользователями</a>
                            <a class="dropdown-item divider" href="{{ route('adminPanel2', ['page' => 'messages']) }}">Сообщения</a>
                            <a class="dropdown-item" href="{{ url('/') }}">На сайт</a>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-4 md:p-6 relative min-h-[300px]" id="admin2-main-wrap">
                <div class="skeleton-overlay absolute inset-0 p-4 md:p-6" id="admin2-skeleton" aria-hidden="true">
                    <div class="skeleton-page">
                        <div class="skeleton skeleton-title skeleton-page__title"></div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 my-4">
                            <div class="skeleton skeleton-card rounded-xl" style="min-height:180px;"></div>
                            <div class="skeleton skeleton-card rounded-xl" style="min-height:180px;"></div>
                        </div>
                        <div class="skeleton-list mt-4">
                            @for($i = 0; $i < 5; $i++)
                            <div class="skeleton-list__item py-2">
                                <div class="skeleton skeleton-avatar"></div>
                                <div class="skeleton skeleton-text skeleton-text--long" style="flex:1;"></div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="admin2-content-inner opacity-0 transition-opacity duration-300" id="admin2-content-inner">
                @if(session('error'))
                    <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-200">{{ session('error') }}</div>
                @endif
                @if(session('success'))
                    <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-200">{{ session('success') }}</div>
                @endif
                @yield('content')
                </div>
            </main>
            <script>
                (function(){
                    function ready(){ var w=document.getElementById('admin2-main-wrap'); var c=document.getElementById('admin2-content-inner'); var s=document.getElementById('admin2-skeleton'); if(w&&c){ w.classList.add('loaded'); c.style.opacity='1'; } if(s) s.style.display='none'; }
                    if(document.readyState==='complete') ready(); else window.addEventListener('load',ready);
                })();
            </script>
        </div>
    </div>

    @include('adminPanel2.partials.user-modal')

    <script>
        (function() {
            var root = document.documentElement;
            var toggle = document.getElementById('admin2-theme-toggle');
            var iconSun = document.getElementById('admin2-icon-sun');
            var iconMoon = document.getElementById('admin2-icon-moon');
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
        (function() {
            var dropdown = document.getElementById('admin2-header-user-dropdown');
            var btn = document.getElementById('admin2-header-user-btn');
            if (dropdown && btn) {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdown.classList.toggle('show');
                    btn.setAttribute('aria-expanded', dropdown.classList.contains('show'));
                });
                document.addEventListener('click', function() {
                    dropdown.classList.remove('show');
                    btn.setAttribute('aria-expanded', 'false');
                });
            }
        })();
    </script>
    @stack('scripts')
</body>
</html>
