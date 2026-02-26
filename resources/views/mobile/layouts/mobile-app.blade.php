<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, viewport-fit=cover">
    <meta name="theme-color" content="#0f1419">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'DesignCraft')</title>
    <link rel="manifest" href="{{ asset('m-assets/manifest.json') }}">
    <link rel="stylesheet" href="{{ asset('m-assets/css/mobile-app.css') }}">
    @stack('styles')
</head>
<body class="m-body">
    <script>(function(){ try { if (localStorage.getItem('m_theme')==='light') document.body.classList.add('m-theme-light'); } catch(e){} })();</script>
    @include('mobile.components.mobile-header')
    <main class="m-main" role="main">
        @yield('content')
    </main>
    @include('mobile.components.mobile-footer')
    @include('mobile.components.mobile-menu')
    @auth
    @include('partials.support-chat')
    <style>.m-body #support-chat-panel { width: 100% !important; min-width: 100% !important; max-width: 100% !important; } .m-body #support-chat-panel.support-chat-open { transform: translateX(0); }</style>
    @endauth
    <script src="{{ asset('m-assets/js/mobile-app.js') }}"></script>
    @stack('scripts')
    <script>
      if ('serviceWorker' in navigator) {
        window.addEventListener('load', function () {
          navigator.serviceWorker.register('{{ asset('m-assets/sw.js') }}', { scope: '/mobile/' }).catch(function () {});
        });
      }
    </script>
</body>
</html>
