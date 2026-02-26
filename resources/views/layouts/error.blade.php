<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', '404 — DesignCraft')</title>
    <link rel="icon" type="image/png" href="/favicon.png">
    <script>(function(){function loadFont(){var l=document.createElement('link');l.rel='stylesheet';l.href='https://fonts.bunny.net/css?family=Nunito';document.head.appendChild(l);}if(document.readyState==='complete')loadFont();else window.addEventListener('load',loadFont);})();</script>
    @stack('styles')
</head>
<body>
    @yield('content')
    <script>
        (function() {
            var theme = localStorage.getItem('theme');
            if (theme === 'dark') document.body.classList.add('dark-theme');
        })();
    </script>
</body>
</html>
