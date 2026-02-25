<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DesignCraft</title>
    <link rel="stylesheet" href="/css/style.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="/css/skeleton.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="/css/style.css"><link rel="stylesheet" href="/css/skeleton.css"></noscript>
    <link rel="icon" type="image/png" href="/favicon.png">
    <script>
    (function(){ function loadFont(){ var l=document.createElement('link'); l.rel='stylesheet'; l.href='https://fonts.bunny.net/css?family=Nunito'; document.head.appendChild(l); }
    if (document.readyState==='complete') loadFont(); else window.addEventListener('load', loadFont); })();
    </script>
    <style>
        .banner-tags span{
            color: black !important;
        }
        .logo_navbar-brand_navbar-brand a{
            background-image: linear-gradient(to right, #1D4ED8 0%, #3B82F6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
            font-size: 24px;
        }
        .header_DesignCraft{
            width: 100%;
        }
        .header_DesignCraft .container{
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 80rem;
            margin: 0 auto;
            padding: 0 20px;
        }
        .navbar_navbar-expand-md_navbar-light_bg-white_shadow-sm{
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 0px 10px 0px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            width: 100%;
        }
        main {
            margin-top: 55px;
        }
        .nav-item.dropdown {
            position: relative;
        }
        .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
            color: #ffffffff !important;
            font-weight: 500;
            background: transparent;
            background-color: #1D4ED8;
            color: white;
            padding: 5px 10px;
            border-radius: 0.3rem;
        }
        .dropdown-toggle:hover {
            background: rgba(59, 130, 246, 0.1);
            color: #1D4ED8 !important;
            color: white !important;
            background-color: #143591ff;
        }
        .dropdown-toggle::after {
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-left: 0.3em solid transparent;
            transition: transform 0.3s ease;
        }
        .dropdown-toggle.show::after {
            transform: rotate(180deg);
        }
        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            min-width: 200px;
            background: white;
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(0, 0, 0, 0.05);
            padding: 8px;
            margin-top: 8px;
            opacity: 0;
            transform: translateY(-10px);
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
        }
        .dropdown-menu.show {
            opacity: 1;
            transform: translateY(0);
            visibility: visible;
        }
        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 10px 16px;
            border-radius: 8px;
            color: #374151;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
            text-decoration: none;
            margin-bottom: 2px;
            justify-content: space-between;
        }
        .dropdown-item:hover {
            background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);
            color: white;
        }
        .dropdown-item:last-child {
            margin-bottom: 0;
        }
        .dropdown-item:active {
            background: linear-gradient(135deg, #1D4ED8 0%, #1E40AF 100%);
            color: white;
        }
        .dropdown-item:nth-child(2) {
            margin-top: 4px;
            padding-top: 12px;
        }
        .dropdown-item span{
            position: relative;
            color: white;
            display: flex;
            padding: 5px;
            font-size: 13px;
            height: 25px;
            width: 25px;
            z-index: 1;
            align-content: center;
            justify-content: center;
            bottom: 2px;
        }
        .dropdown-item span::before{
            position: absolute;
            content: '';
            inset: 0;
            background-color: #3B82F6;
            z-index: -1;
            padding: 0px;
            width: 100%;
            height: 100%;
            display: flex;
            top: 2px;
            border-radius: 100%;
        }
        .dropdown-item:hover span::before{
            background-color: #ffffffff;
        }
        .dropdown-item:hover span{
            color: #3B82F6;
        }
        .dropdown-item-dropdown-item{
            width: 100%;
            background-color: #d3d3d3ff;
            height: 2px;
            margin: 2px;
        }
        .nav-link{
            list-style: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .dark-theme .dropdown-item{
            color: white !important;
        }
        .dark-theme .dropdown-toggle {
            color: #e0e0e0 !important;
        }
        .dark-theme .dropdown-toggle:hover {
            background: rgba(59, 130, 246, 0.2);
            color: #3B82F6 !important;
        }
        .dark-theme .dropdown-menu {
            background: #2d3748;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.1);
        }
        .dark-theme .dropdown-item {
            color: #e0e0e0;
        }
        .dark-theme .dropdown-item:hover {
            background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);
            color: white;
        }
        .dark-theme .dropdown-item:nth-child(2) {
            border-top-color: #4a5568;
        }
        @keyframes dropdownFadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        .dropdown-menu {
            animation: dropdownFadeIn 0.3s ease;
        }
        @media (max-width: 880px) {
            .dropdown-menu {
                position: fixed;
                top: auto;
                bottom: 0;
                left: 0;
                right: 0;
                width: 100%;
                max-width: 100%;
                border-radius: 20px 20px 0 0;
                margin-top: 0;
                transform: translateY(100%);
            }
            .dropdown-menu.show {
                transform: translateY(0);
            }
            .dropdown-item {
                padding: 14px 20px;
                font-size: 16px;
            }
        }
        .dropdown-submenu {
            position: relative;
        }
        .dropdown-submenu > .dropdown-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 16px;
            border-radius: 8px;
            color: #374151;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
            text-decoration: none;
            margin-bottom: 2px;
        }
        .dropdown-submenu > .dropdown-item::after {
            content: '›';
            font-size: 16px;
            transition: transform 0.3s ease;
        }
        .dropdown-submenu:hover > .dropdown-item::after {
            transform: translateX(3px);
        }
        .dropdown-submenu .dropdown-menu {
            position: absolute;
            top: -8px;
            left: 100%;
            margin-left: 8px;
            opacity: 0;
            transform: translateX(-10px);
            visibility: hidden;
            transition: all 0.3s ease;
        }
        .dropdown-submenu:hover .dropdown-menu {
            opacity: 1;
            transform: translateX(0);
            visibility: visible;
        }
        .dark-theme .dropdown-submenu .dropdown-menu {
            background: #2d3748;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.1);
        }
        .dark-theme .dropdown-submenu > .dropdown-item {
            color: #e0e0e0;
        }
        .dark-theme .dropdown-submenu > .dropdown-item:hover {
            background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);
            color: white;
        }
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(-10px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
        }
        .dropdown-submenu .dropdown-menu {
            animation: slideInRight 0.3s ease;
        }
        /* @media (max-width: 768px) {
            .dropdown-submenu .dropdown-menu {
                position: static;
                margin-left: 0;
                margin-top: 8px;
                box-shadow: none;
                border-left: 2px solid #3B82F6;
            }
            .dropdown-submenu > .dropdown-item::after {
                transform: rotate(90deg);
            }
            .dropdown-submenu:hover > .dropdown-item::after {
                transform: rotate(90deg) translateX(3px);
            }
        } */
        .night____theme{
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 999;
        }
        .night__theme {
            position: relative;
            width: 40px;
            height: 40px;
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
        .night___theme {
            background-color: #13171f;
            border: 2px solid #272d3a;
            opacity: 0;
            transform: scale(0.8) rotate(-90deg);
        }
        .night_theme svg, .night___theme svg {
            width: 17.6px;
            height: 17.6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .night_theme svg {
            stroke: #2b2e35;
        }
        .night___theme svg {
            stroke: #ccced1;
        }
        body.dark-theme .night_theme {
            opacity: 0;
            transform: scale(0.8) rotate(90deg);
        }
        body.dark-theme .night___theme {
            opacity: 1;
            transform: scale(1) rotate(0deg);
        }
        .night_theme:hover svg {
            transform: rotate(15deg) scale(1.1);
        }
        .night___theme:hover svg {
            transform: rotate(-15deg) scale(1.1);
        }
        body {
            transition: background-color 0.4s ease, color 0.4s ease;
        }
        .scroll-to-top {
            position: fixed;
            bottom: 70px;
            right: 20px;
            width: 40px;
            height: 40px;
            background: #0062ff;
            stroke: white !important;
            color: white !important;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 98, 255, 0.3);
            transition: all 0.3s ease;
            z-index: 1000;
        }
        .scroll-to-top>svg{
            color: white !important;
            stroke: white;
        }
        .scroll-to-top:hover {
            background: #0051d4;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 98, 255, 0.4);
        }
        .scroll-to-top svg {
            width: 20px;
            height: 20px;
        }
        .col-md-6{
            margin-top: 15px !important;
        }
        .admin_header {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }
    </style>
</head>

<div id="modal" class="modal" style="display: none;">
    <div class="modal-content">
        <div id="success-message" class="success-message" style="display: none;">
            <div class="success-icon">
                <svg viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="#4c87afff" stroke-width="5"/>
                    <path fill="none" stroke="#4c63afff" stroke-width="8" d="M30,50 L45,65 L70,35"/>
                </svg>
            </div>
            <h3>Заказ успешно создан!</h3>
            <p>Спасибо за ваш заказ! Мы свяжемся с вами в ближайшее время.</p>
            <div class="loading-bar">
                <div class="loading-progress"></div>
            </div>
            <p class="wait-text">Ожидайте обратной связи...</p>
        </div>
        <span class="close" onclick="closeModal()">&times;</span>
        <p class="text_modal">Закaзать дизайн</p>
        

        <form id="order-form" action="{{ route('new') }}" method="post">
            @csrf
            <label class="name_modal" for="name">Ваше имя</label>
            <input type="text" id="name" name="name" value="{{ Auth::check() ? Auth::user()->name : '' }}" placeholder="Введите ваше имя" readonly required>
            
            <label class="name_modal" for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" placeholder="your@email.com" required>
            
            <label class="name_modal" for="phone">Телефон</label>
            <input type="tel" id="phone" name="phone" placeholder="+7 (___) ___-__-__" required>
            
            <label class="name_modal" for="service">Интересующая услуга</label>
            <select id="service" name="selectt" required>
                <option value="">Выберите услугу</option>
                <option value="design">Дизайн превью</option>
                <option value="ava">Аватарка</option>
                <option value="banner">Баннер</option>
                <option value="animation">Анимация</option>
                <option value="logo">Логотип</option>
            </select>
            
            <div class="checkbox-group">
                <label class="name_modal">Выберите пакет</label>
                <div class="checkbox-options">
                    <label class="checkbox-container">
                        <input type="radio" name="radioo" value="Базовый">
                        <span class="checkmark radio"></span>
                        Базовый
                    </label>
                    <label class="checkbox-container">
                        <input type="radio" name="radioo" value="Про">
                        <span class="checkmark radio"></span>
                        Про
                    </label>
                    <label class="checkbox-container">
                        <input type="radio" name="radioo" value="Стандарт">
                        <span class="checkmark radio"></span>
                        Стандарт
                    </label>
                    <label class="checkbox-container">
                        <input type="radio" name="radioo" value="Продвинутая">
                        <span class="checkmark radio"></span>
                        Продвинутая
                    </label>
                </div>
            </div>

            <label class="name_modal" for="description">Описание заказа</label>
            <textarea class="textarea" name="text" id="description" placeholder="Опишите, что вы хотите заказать..." required></textarea>
            
            <div class="buttons">
                <button type="button" class="cancel" onclick="closeModal()">Отмена</button>
                <button type="submit" class="submit" id="submitBtn">Отправить заказ</button>
            </div>
        </form>
    </div>
</div>
<body class="page-loading">
    <div class="skeleton-overlay" id="skeletonOverlay" aria-hidden="true">
        <div class="skeleton-overlay__header"></div>
        <div class="skeleton-overlay__body">
            @hasSection('skeleton')
                @yield('skeleton')
            @else
                @include('skeletons.default')
            @endif
        </div>
    </div>
    @unless(isset($hideHeader) && $hideHeader)
        <nav class="dc-header navbar_navbar-expand-md_navbar-light_bg-white_shadow-sm">
            <div class="dc-header__inner header_DesignCraft">
                <div class="dc-container container">
                    <div class="dc-header__logo logo_navbar-brand_navbar-brand">
                        <a class="navbar-brand" href="{{ url('/index') }}">DesignCraft</a>
                    </div>
                    <button type="button" class="dc-header__toggler navbar-toggler" id="dcNavToggler" aria-label="Меню" aria-expanded="false">
                        <span class="dc-header__toggler-icon navbar-toggler-icon"></span>
                    </button>
                    <div class="dc-nav nav" id="dcNav" role="navigation">
                        @auth
                        <a class="dc-nav__link nav_text" href="{{ Auth::check() ? url('/aboutus') : route('login') }}">О нас</a>
                        <a class="dc-nav__link nav_text" href="{{ Auth::check() ? url('/services') : route('login') }}">Услуги</a>
                        <a class="dc-nav__link nav_text" href="{{ Auth::check() ? url('/portfolio') : route('login') }}">Портфолио</a>
                        <a class="dc-nav__link nav_text" href="{{ Auth::check() ? url('/websiteNews') : route('login') }}">Новости</a>
                        <a class="dc-nav__link nav_text" href="{{ Auth::check() ? url('/whyus') : route('login') }}">Почему мы?</a>
                        <a class="dc-nav__link nav_text" href="{{ Auth::check() ? url('/contacts') : route('login') }}">Контакты</a>
                        @endauth
                        <div class="dc-nav__user-links" aria-hidden="true">
                            @guest
                                @if (Route::has('login'))
                                    <a class="dc-nav__link dc-nav__link--user" href="{{ route('login') }}">{{ __('Логин') }}</a>
                                @endif
                                @if (Route::has('register'))
                                    <a class="dc-nav__link dc-nav__link--user" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                                @endif
                            @else
                                <span class="dc-nav__user-name">{{ Auth::user()->name }}</span>
                                <a class="dc-nav__link dc-nav__link--user" href="{{ url('/index') }}">{{ __('Главная') }}</a>
                                @if(in_array(Auth::user()->role ?? null, ['user', 'moderator', 'admin']))
                                    <a class="dc-nav__link dc-nav__link--user" href="{{ route('userPanel') }}">Аккаунт</a>
                                    <a class="dc-nav__link dc-nav__link--user" href="#" onclick="var p=document.getElementById('support-chat-panel'); if(p) p.classList.toggle('support-chat-open'); document.getElementById('dcNav').classList.remove('is-open'); return false;">Чат поддержки</a>
                                @endif
                                @if((Auth::user()->role ?? null) === 'admin')
                                    <a class="dc-nav__link dc-nav__link--user" href="{{ route('adminPanel2') }}">Админ панель</a>
                                    <a class="dc-nav__link dc-nav__link--user" href="{{ url('/aboutus') }}">О нас</a>
                                    <a class="dc-nav__link dc-nav__link--user" href="{{ url('/services') }}">Услуги</a>
                                    <a class="dc-nav__link dc-nav__link--user" href="{{ url('/portfolio') }}">Портфолио</a>
                                    <a class="dc-nav__link dc-nav__link--user" href="{{ url('/websiteNews') }}">Новости</a>
                                    <a class="dc-nav__link dc-nav__link--user" href="{{ url('/whyus') }}">Почему мы?</a>
                                    <a class="dc-nav__link dc-nav__link--user" href="{{ url('/contacts') }}">Контакты</a>
                                @endif
                                @if(Auth::check() && in_array(Auth::user()->role, ['moderator', 'admin']))
                                    <a class="dc-nav__link dc-nav__link--user" href="{{ route('moder.panel') }}">Модер панель</a>
                                @endif
                                <a class="dc-nav__link dc-nav__link--user dc-nav__link--logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Выйти') }}</a>
                            @endguest
                        </div>
                    </div>
                    <div class="dc-header__user navbarSupportedContent" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto"></ul>
                        <ul class="navbar-nav ms-auto" style="display: flex !important; flex-direction: row; gap: 20px;">
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Логин') }}</a>
                                    </li>
                                @endif
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <span class="dc-header__user-name-text">{{ Auth::user()->name }}</span>
                                        <svg class="svg_nav-link" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ url('/index') }}">{{ __('Главная') }}</a>
                                        <div class="dropdown-item-dropdown-item"></div>
                                        @if(in_array(Auth::user()->role ?? null, ['user', 'moderator', 'admin']))
                                            <a class="dropdown-item" href="{{ route('userPanel') }}">Аккаунт</a>
                                            <a class="dropdown-item" href="#" onclick="var p=document.getElementById('support-chat-panel'); if(p) p.classList.toggle('support-chat-open'); return false;">Чат поддержки</a>
                                        @endif
                                        <style>
                                            .dropdown--submenu{
                                                display: none;
                                            }
                                        </style>
                                        <div class="dropdown--submenu">
                                            <div class="dropdown-submenu">
                                                <a class="dropdown-item" href="#">Страницы</a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ Auth::check() ? url('/aboutus') : route('login') }}">О нас</a>
                                                    <a class="dropdown-item" href="{{ Auth::check() ? url('/services') : route('login') }}">Услуги</a>
                                                    <a class="dropdown-item" href="{{ Auth::check() ? url('/portfolio') : route('login') }}">Портфолио</a>
                                                    <a class="dropdown-item" href="{{ Auth::check() ? url('/websiteNews') : route('login') }}">Новости</a>
                                                    <a class="dropdown-item" href="{{ Auth::check() ? url('/whyus') : route('login') }}">Почему мы?</a>
                                                    <a class="dropdown-item" href="{{ Auth::check() ? url('/contacts') : route('login') }}">Контакты</a>
                                                </div>
                                            </div>
                                        </div>
                                        @if((Auth::user()->role ?? null) === 'admin')
                                            <!-- <a class="dropdown-item" href="{{ route('adminPanel') }}">Админ панель</a> -->
                                            <a class="dropdown-item" href="{{ route('adminPanel2') }}">Админ панель</a>
                                            <div class="dropdown-submenu">
                                                <a class="dropdown-item" href="#">Различные страницы</a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ url('/home') }}">Добро пожаловать</a>
                                                    <a class="dropdown-item" href="{{ url('/') }}">Главная (Вход)</a>
                                                </div>
                                            </div>
                                            <div class="dropdown-submenu">
                                                <a class="dropdown-item" href="#">Чаты</a>
                                                <div class="dropdown-menu">
                                                    @auth
                                                        <a class="dropdown-item" href="#" id="support-chat-toggle" onclick="document.getElementById('support-chat-panel').classList.toggle('support-chat-open'); return false;">
                                                            Чат поддержки
                                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="vertical-align:middle;margin-left:4px;"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" stroke="currentColor" stroke-width="2"/></svg>
                                                        </a>
                                                        @if(in_array(Auth::user()->role, ['admin', 'moderator']))
                                                            <a class="dropdown-item" href="{{ route('admin.support-chat') }}">
                                                                Чат с пользователями
                                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" stroke="currentColor" stroke-width="2"/>
                                                                </svg>
                                                            </a>
                                                            <a class="dropdown-item" href="{{ route('admin.chat') }}">
                                                                Админ Чат
                                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" stroke="currentColor" stroke-width="2"/>
                                                                </svg>
                                                            </a>
                                                        @endif
                                                    @endauth
                                                </div>
                                            </div>
                                            <div class="dropdown-submenu">
                                                <a class="dropdown-item" href="#">Быстрая навигация</a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ url('/aboutus') }}">О нас</a>
                                                    <a class="dropdown-item" href="{{ url('/services') }}">Услуги</a>
                                                    <a class="dropdown-item" href="{{ url('/portfolio') }}">Портфолио</a>
                                                    <a class="dropdown-item" href="{{ url('/websiteNews') }}">Новости</a>
                                                    <a class="dropdown-item" href="{{ url('/whyus') }}">Почему мы?</a>
                                                    <a class="dropdown-item" href="{{ url('/contacts') }}">Контакты</a>
                                                </div>
                                            </div>
                                            <div class="dropdown-submenu">
                                                <a class="dropdown-item" href="#">Быстрый доступ</a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ url('/banners/create') }}">Загрузить баннер</a>
                                                    <a class="dropdown-item" href="{{ url('/news/create') }}">Добавить новость</a>
                                                </div>
                                            </div>
                                        @endif
                                        @if(Auth::check() && in_array(Auth::user()->role, ['moderator', 'admin']))
                                            <a class="dropdown-item" href="{{ route('moder.panel') }}">Модер панель</a>
                                        @endif
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Выйти') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    @endunless
    <div class="app" id="app">
        <main class="dc-main">
            <div class="dc-main__inner main-content-inner">@yield('content')</div>
        </main>
    </div>
    <script>
        (function() {
            function hideSkeleton() {
                var el = document.getElementById('skeletonOverlay');
                if (el) el.classList.add('skeleton-overlay--hidden');
                document.body.classList.remove('page-loading');
                document.body.classList.add('page-loaded');
            }
            if (document.readyState === 'complete') {
                setTimeout(hideSkeleton, 80);
            } else {
                window.addEventListener('load', function() { setTimeout(hideSkeleton, 80); });
            }
        })();
    </script>
    <script>
        (function() {
            var toggler = document.getElementById('dcNavToggler');
            var dcNav = document.getElementById('dcNav');
            if (toggler && dcNav) {
                toggler.addEventListener('click', function() {
                    dcNav.classList.toggle('is-open');
                    toggler.setAttribute('aria-expanded', dcNav.classList.contains('is-open'));
                });
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.dc-header') && dcNav.classList.contains('is-open')) {
                        dcNav.classList.remove('is-open');
                        toggler.setAttribute('aria-expanded', 'false');
                    }
                });
            }
        })();
    </script>
    <div class="night____theme">
        <div class="night__theme">
            <div class="night_theme">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-moon h-5 w-5 text-foreground"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path></svg>
            </div>
            <div class="night___theme">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sun h-5 w-5 text-foreground"><circle cx="12" cy="12" r="4"></circle><path d="M12 2v2"></path><path d="M12 20v2"></path><path d="m4.93 4.93 1.41 1.41"></path><path d="m17.66 17.66 1.41 1.41"></path><path d="M2 12h2"></path><path d="M20 12h2"></path><path d="m6.34 17.66 -1.41 1.41"></path><path d="m19.07 4.93 -1.41 1.41"></path></svg>
            </div>
        </div>
    </div>
    <button id="scrollToTopBtn" class="scroll-to-top">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m18 15-6-6-6 6"/>
        </svg>
    </button>

    @auth
    {{-- Чат поддержки: панель справа, загрузка фото, ответы модераторов/админов --}}
    <div id="support-chat-panel" class="support-chat-panel">
        <div class="support-chat-inner">
            <div class="support-chat-header">
                <h3>Чат поддержки</h3>
                <div class="support-chat-header-actions">
                    <button type="button" class="support-chat-fullscreen-btn" id="support-chat-fullscreen-btn" title="На весь экран" aria-label="На весь экран">
                        <svg class="support-chat-icon-expand" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/></svg>
                        <svg class="support-chat-icon-exit-fullscreen hidden" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3v3a2 2 0 0 0-2 2H3m18 0h-3a2 2 0 0 0-2-2v-3m0 18v-3a2 2 0 0 0 2-2h3M3 16h3a2 2 0 0 0 2 2v3"/></svg>
                    </button>
                    <button type="button" class="support-chat-close" onclick="document.getElementById('support-chat-panel').classList.remove('support-chat-open')">&times;</button>
                </div>
            </div>
            <div class="support-chat-messages" id="support-chat-messages"></div>
            <div id="support-chat-attachments" class="support-chat-attachments"></div>
            <form class="support-chat-form" id="support-chat-form">
                <div class="support-chat-input-row">
                    <input type="text" name="message" id="support-chat-input" placeholder="Сообщение или прикрепите фото..." autocomplete="off" class="support-chat-text">
                    <label class="support-chat-file-label" title="Прикрепить фото (до 8)">
                        <input type="file" name="image" accept="image/*" id="support-chat-file" class="support-chat-file" multiple>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                    </label>
                    <label class="support-chat-file-label" title="Прикрепить файл (до 8)">
                        <input type="file" name="file" accept="video/*,.pdf,application/*,.doc,.docx,.xls,.xlsx,.zip" id="support-chat-attach-file" class="support-chat-file" multiple>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg>
                    </label>
                    <button type="submit" class="support-chat-send">Отправить</button>
                </div>
            </form>
        </div>
        <div id="support-chat-ctx-menu" class="support-chat-ctx-menu" style="display:none;position:fixed;left:0;top:0;min-width:140px;padding:4px 0;background:#fff;border:1px solid #e2e8f0;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,0.15);z-index:10001;">
            <button type="button" id="support-chat-ctx-edit" class="support-chat-ctx-btn">Редактировать</button>
            <button type="button" id="support-chat-ctx-delete" class="support-chat-ctx-btn support-chat-ctx-delete">Удалить</button>
        </div>
    </div>
    <style>
        .support-chat-ctx-btn { display: block; width: 100%; text-align: left; padding: 8px 12px; border: none; background: none; font-size: 14px; color: #0f172a; cursor: pointer; }
        .support-chat-ctx-btn:hover { background: #f1f5f9; }
        .support-chat-ctx-delete { color: #dc2626; }
        body.dark-theme .support-chat-ctx-menu { background: #1e293b; border-color: #334155; }
        body.dark-theme .support-chat-ctx-btn { color: #f1f5f9; }
        body.dark-theme .support-chat-ctx-btn:hover { background: #334155; }
        .support-chat-panel { position: fixed; top: 0; right: 0; width: 380px; min-width: 320px; max-width: 480px; height: 100%; background: #fff; box-shadow: -4px 0 20px rgba(0,0,0,0.15); z-index: 9999; transform: translateX(100%); transition: transform 0.3s ease, width 0.25s ease; }
        .support-chat-panel.support-chat-open { transform: translateX(0); }
        .support-chat-panel.support-chat-fullscreen { width: 100%; min-width: 100%; max-width: 100%; }
        .support-chat-inner { display: flex; flex-direction: column; height: 100%; }
        .support-chat-header { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: #fff; padding: 12px 16px; display: flex; justify-content: space-between; align-items: center; }
        .support-chat-header h3 { margin: 0; font-size: 1.1rem; font-weight: 600; color: #fff; }
        .support-chat-header-actions { display: flex; align-items: center; gap: 4px; }
        .support-chat-icon-expand { stroke: #fff; color: #fff; }
        .support-chat-msg.own .support-chat-msg-text { color: #fff; }
        .support-chat-fullscreen-btn { background: none; border: none; color: #fff; padding: 6px; cursor: pointer; line-height: 1; display: flex; align-items: center; justify-content: center; opacity: 0.9; }
        .support-chat-fullscreen-btn:hover { opacity: 1; }
        .support-chat-fullscreen-btn .hidden { display: none !important; }
        .support-chat-close { background: none; border: none; color: #fff; font-size: 24px; cursor: pointer; line-height: 1; padding: 0 4px; }
        .support-chat-messages { flex: 1; overflow-y: auto; padding: 12px; display: flex; flex-direction: column; gap: 10px; background: #f8fafc; scrollbar-width: thin; scrollbar-color: #94a3b8 #e2e8f0; }
        .support-chat-messages::-webkit-scrollbar { width: 8px; }
        .support-chat-messages::-webkit-scrollbar-track { background: #e2e8f0; border-radius: 4px; }
        .support-chat-messages::-webkit-scrollbar-thumb { background: linear-gradient(180deg, #94a3b8, #64748b); border-radius: 4px; }
        .support-chat-messages::-webkit-scrollbar-thumb:hover { background: linear-gradient(180deg, #64748b, #475569); }
        .support-chat-msg { max-width: 85%; padding: 8px 12px; border-radius: 12px; font-size: 14px; }
        .support-chat-msg.own { align-self: flex-end; background: #1d4ed8; color: #fff; }
        .support-chat-msg.own .support-chat-msg-name { color: rgba(255,255,255,0.95); }
        .support-chat-msg.other { align-self: flex-start; background: #fff; border: 1px solid #e2e8f0; color: #0f172a; }
        .support-chat-msg-name { font-size: 11px; color: #64748b; margin-bottom: 2px; }
        .support-chat-msg img.thumb { max-width: 120px; max-height: 100px; border-radius: 8px; cursor: pointer; margin-top: 4px; }
        .support-chat-form { padding: 10px; border-top: 1px solid #e2e8f0; background: #fff; }
        .support-chat-input-row { display: flex; gap: 8px; align-items: center; }
        .support-chat-text { flex: 1; padding: 10px 12px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; background: #fff; color: #0f172a; }
        .support-chat-file-label { width: 40px; height: 40px; border: 1px solid #e2e8f0; border-radius: 10px; display: flex; align-items: center; justify-content: center; cursor: pointer; background: #fff; color: #64748b; }
        .support-chat-file { display: none; }
        .support-chat-send { padding: 10px 16px; background: #1d4ed8; color: #fff; border: none; border-radius: 10px; font-size: 14px; cursor: pointer; }
        .support-chat-attachments { padding: 8px 10px; border-top: 1px solid #e2e8f0; background: #f1f5f9; display: flex; flex-direction: column; gap: 6px; max-height: 160px; overflow-y: auto; scrollbar-width: thin; scrollbar-color: #94a3b8 #e2e8f0; }
        .support-chat-attachments::-webkit-scrollbar { width: 6px; }
        .support-chat-attachments::-webkit-scrollbar-track { background: #e2e8f0; border-radius: 3px; }
        .support-chat-attachments::-webkit-scrollbar-thumb { background: linear-gradient(180deg, #94a3b8, #64748b); border-radius: 3px; }
        .support-chat-attachments::-webkit-scrollbar-thumb:hover { background: #64748b; }
        .support-chat-attachments:empty { display: none; }
        .support-chat-att-item { display: flex; align-items: center; gap: 8px; padding: 6px 10px; background: #fff; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 13px; }
        .support-chat-att-item.is-photo { border-left: 3px solid #3b82f6; }
        .support-chat-att-item.is-file { border-left: 3px solid #64748b; }
        .support-chat-att-name { flex: 1; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #334155; }
        .support-chat-att-ext { color: #64748b; flex-shrink: 0; }
        .support-chat-att-remove { width: 24px; height: 24px; min-width: 24px; border: none; background: #64748b; color: #fff; border-radius: 50%; font-size: 16px; line-height: 1; cursor: pointer; padding: 0; display: flex; align-items: center; justify-content: center; }
        .support-chat-att-remove:hover { background: #dc2626; }
        body.dark-theme .support-chat-attachments { background: #334155; border-top-color: #475569; }
        body.dark-theme .support-chat-att-item { background: #1e293b; border-color: #475569; }
        body.dark-theme .support-chat-att-name { color: #e2e8f0; }
        body.dark-theme .support-chat-att-ext { color: #94a3b8; }
        .support-chat-msg-buttons { margin-top: 8px; display: flex; flex-wrap: wrap; gap: 6px; }
        .support-chat-msg-btn { padding: 6px 12px; border: 1px solid #94a3b8; border-radius: 8px; background: #f1f5f9; color: #475569; font-size: 12px; cursor: pointer; }
        .support-chat-msg-btn:hover { background: #e2e8f0; color: #1e293b; }
        body.dark-theme .support-chat-msg-btn { background: #334155; border-color: #64748b; color: #e2e8f0; }
        body.dark-theme .support-chat-msg-btn:hover { background: #475569; color: #fff; }
        body.dark-theme .support-chat-preview { background: #334155; border-top-color: #475569; }
        /* Тёмная тема чата поддержки */
        body.dark-theme .support-chat-panel { background: #1e293b; }
        body.dark-theme .support-chat-messages { background: #0f172a; scrollbar-color: #475569 #334155; }
        body.dark-theme .support-chat-messages::-webkit-scrollbar-track { background: #334155; }
        body.dark-theme .support-chat-messages::-webkit-scrollbar-thumb { background: linear-gradient(180deg, #64748b, #475569); }
        body.dark-theme .support-chat-messages::-webkit-scrollbar-thumb:hover { background: #475569; }
        body.dark-theme .support-chat-attachments { scrollbar-color: #475569 #334155; }
        body.dark-theme .support-chat-attachments::-webkit-scrollbar-track { background: #334155; }
        body.dark-theme .support-chat-attachments::-webkit-scrollbar-thumb { background: #475569; }
        body.dark-theme .support-chat-attachments::-webkit-scrollbar-thumb:hover { background: #4b5563; }
        body.dark-theme .support-chat-msg.other { background: #334155; border-color: #475569; color: #f1f5f9; }
        body.dark-theme .support-chat-msg-name { color: #94a3b8; }
        body.dark-theme .support-chat-form { background: #1e293b; border-top-color: #334155; }
        body.dark-theme .support-chat-text { background: #334155; border-color: #475569; color: #f1f5f9; }
        body.dark-theme .support-chat-text::placeholder { color: #94a3b8; }
        body.dark-theme .support-chat-file-label { background: #334155; border-color: #475569; color: #94a3b8; }
        body.dark-theme .container { color: #e2e8f0; }
        /* Синий фон — всегда белый текст (контраст) */
        .btn-modern[style*="1e40af"], .btn-modern[style*="1D4ED8"], button[style*="background: #1e40af"], button[style*="background:#1e40af"], button[style*="background: #1D4ED8"], .moder-order-form-submit { color: #fff !important; }
    </style>
    <script>
    (function() {
        function initSupportChat() {
        var panel = document.getElementById('support-chat-panel');
        var messagesEl = document.getElementById('support-chat-messages');
        var form = document.getElementById('support-chat-form');
        if (!form) return;
        var input = form.querySelector('input[name="message"]');
        var fileInput = document.getElementById('support-chat-file');
        var attachFileInput = document.getElementById('support-chat-attach-file');
        var csrf = document.querySelector('meta[name="csrf-token"]');
        var currentUserId = {{ Auth::id() ?? 'null' }};
        var pollTimer;
        var attachmentsEl = document.getElementById('support-chat-attachments');
        var selectedImages = [];
        var selectedFiles = [];
        var MAX_ONE_TYPE = 8;
        var MAX_WHEN_BOTH = 4;
        function getExt(name) {
            if (!name) return '';
            var i = name.lastIndexOf('.');
            return i >= 0 ? name.slice(i) : '';
        }
        function renderAttachments() {
            if (!attachmentsEl) return;
            var html = '';
            selectedImages.forEach(function(file, idx) {
                var name = file.name || 'Фото';
                var ext = getExt(name);
                var baseName = ext ? name.slice(0, -ext.length) : name;
                html += '<div class="support-chat-att-item is-photo" data-type="image" data-index="' + idx + '">' +
                    '<span class="support-chat-att-name" title="' + (name.replace(/"/g, '&quot;')) + '">' + (baseName.replace(/</g, '&lt;')) + '</span>' +
                    '<span class="support-chat-att-ext">' + (ext.replace(/</g, '&lt;')) + '</span>' +
                    '<button type="button" class="support-chat-att-remove" title="Удалить">&times;</button></div>';
            });
            selectedFiles.forEach(function(file, idx) {
                var name = file.name || 'Файл';
                var ext = getExt(name);
                var baseName = ext ? name.slice(0, -ext.length) : name;
                html += '<div class="support-chat-att-item is-file" data-type="file" data-index="' + idx + '">' +
                    '<span class="support-chat-att-name" title="' + (name.replace(/"/g, '&quot;')) + '">' + (baseName.replace(/</g, '&lt;')) + '</span>' +
                    '<span class="support-chat-att-ext">' + (ext.replace(/</g, '&lt;')) + '</span>' +
                    '<button type="button" class="support-chat-att-remove" title="Удалить">&times;</button></div>';
            });
            attachmentsEl.innerHTML = html;
            attachmentsEl.querySelectorAll('.support-chat-att-remove').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var row = btn.closest('.support-chat-att-item');
                    if (!row) return;
                    var type = row.getAttribute('data-type');
                    var idx = parseInt(row.getAttribute('data-index'), 10);
                    if (type === 'image' && idx >= 0 && idx < selectedImages.length) {
                        selectedImages.splice(idx, 1);
                    } else if (type === 'file' && idx >= 0 && idx < selectedFiles.length) {
                        selectedFiles.splice(idx, 1);
                    }
                    renderAttachments();
                });
            });
        }
        function addImages(files) {
            var max = selectedFiles.length > 0 ? MAX_WHEN_BOTH : MAX_ONE_TYPE;
            for (var i = 0; i < files.length && selectedImages.length < max; i++) {
                if (files[i].type && files[i].type.indexOf('image') !== -1) selectedImages.push(files[i]);
            }
            renderAttachments();
        }
        function addFiles(files) {
            var max = selectedImages.length > 0 ? MAX_WHEN_BOTH : MAX_ONE_TYPE;
            for (var i = 0; i < files.length && selectedFiles.length < max; i++) {
                selectedFiles.push(files[i]);
            }
            renderAttachments();
        }
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                var list = this.files;
                if (list && list.length) {
                    addImages(Array.prototype.slice.call(list));
                    this.value = '';
                }
            });
        }
        if (attachFileInput) {
            attachFileInput.addEventListener('change', function() {
                var list = this.files;
                if (list && list.length) {
                    addFiles(Array.prototype.slice.call(list));
                    this.value = '';
                }
            });
        }
        function buildStorageUrl(path) {
            if (!path) return '';
            var pathStr = (path + '').replace(/\\/g, '/').replace(/^\//, '');
            var base = window.location.origin + (window.location.pathname.indexOf('/public') === 0 ? '/public/storage' : '/storage');
            return base + '/' + pathStr;
        }
        var BOT_BTN_DELIMITER = '\n__BTN__\n';
        function renderOneMessage(m, currentUserId) {
            var isOwn = m.user_id === currentUserId;
            var name = (m.user && m.user.name) ? m.user.name : 'Гость';
            if ((m.user && m.user.role) === 'admin' || (m.user && m.user.role) === 'moderator') name += ' (поддержка)';
            if (m.is_system) name = 'Бот';
            var timeStr = m.created_at ? (function(d) { try { var x = new Date(d); return x.toLocaleDateString('ru-RU', { day: '2-digit', month: '2-digit' }) + ' ' + x.toLocaleTimeString('ru-RU', { hour: '2-digit', minute: '2-digit' }); } catch(e) { return d; } })(m.created_at) : '';
            var img = '';
            var imgUrl = m.image_url || (m.image_path ? buildStorageUrl(m.image_path) : '');
            if (imgUrl) {
                img = '<a href="' + imgUrl + '" class="support-chat-msg-img support-chat-zoom-img" data-full="' + imgUrl + '"><img src="' + imgUrl + '" alt="Фото" class="thumb" onerror="this.onerror=null;this.parentElement.innerHTML=\'<span class=\\\'text-sm opacity-80\\\'>Фото</span>\';"></a>';
            }
            var fileUrl = m.file_url || (m.file_path ? buildStorageUrl(m.file_path) : '');
            var fileBlock = fileUrl ? '<a href="' + fileUrl + '" target="_blank" rel="noopener" class="block mt-2 text-sm opacity-90">📎 ' + (m.file_name || 'Файл').replace(/</g, '&lt;') + '</a>' : '';
            var msgRaw = m.message ? (m.message + '') : '';
            var displayText = msgRaw;
            var buttons = [];
            if (m.is_system && msgRaw.indexOf(BOT_BTN_DELIMITER) !== -1) {
                var parts = msgRaw.split(BOT_BTN_DELIMITER);
                displayText = parts[0] || '';
                try {
                    if (parts[1]) buttons = JSON.parse(parts[1]);
                } catch (e) { }
            }
            var textBlock = displayText ? ('<div class="support-chat-msg-text">' + displayText.replace(/</g, '&lt;').replace(/>/g, '&gt;') + '</div>') : (imgUrl ? '<div class="text-sm opacity-80">Фото</div>' : '');
            var buttonsHtml = '';
            if (Array.isArray(buttons) && buttons.length > 0) {
                buttonsHtml = '<div class="support-chat-msg-buttons">' + buttons.map(function(b) {
                    var label = (b && b.label) ? (b.label + '').replace(/</g, '&lt;').replace(/>/g, '&gt;') : '';
                    var sendText = (b && b.text) ? (b.text + '').replace(/"/g, '&quot;') : '';
                    return '<button type="button" class="support-chat-msg-btn" data-text="' + sendText + '">' + label + '</button>';
                }).join('') + '</div>';
            }
            var canDel = m.can_delete ? '1' : '0';
            var canEd = m.can_edit ? '1' : '0';
            return '<div class="support-chat-msg ' + (isOwn ? 'own' : 'other') + '" data-message-id="' + (m.id || '') + '" data-can-delete="' + canDel + '" data-can-edit="' + canEd + '">' +
                '<div class="support-chat-msg-name">' + name + (timeStr ? ' · ' + timeStr : '') + '</div>' +
                textBlock + img + fileBlock + buttonsHtml + '</div>';
        }
        function scrollChatToBottom() {
            if (messagesEl) { messagesEl.scrollTop = messagesEl.scrollHeight; }
        }
        function loadMessages() {
            if (!messagesEl) return;
            fetch('{{ route("support.chat.messages") }}', {
                credentials: 'same-origin',
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            })
                .then(function(r) {
                    if (!r.ok) return Promise.reject(r);
                    return r.json();
                })
                .then(function(data) {
                    var list = Array.isArray(data) ? data : (data && data.data && Array.isArray(data.data) ? data.data : []);
                    if (data && data.error) {
                        messagesEl.innerHTML = '<div class="support-chat-msg other"><div class="support-chat-msg-name">Ошибка загрузки</div></div>';
                        return;
                    }
                    if (list.length === 0) {
                        messagesEl.innerHTML = '<div class="support-chat-msg other"><div class="support-chat-msg-name">Пока нет сообщений. Напишите первым.</div></div>';
                        messagesEl.scrollTop = messagesEl.scrollHeight;
                        return;
                    }
                    messagesEl.innerHTML = list.map(function(m) { return renderOneMessage(m, currentUserId); }).join('');
                    scrollChatToBottom();
                    setTimeout(scrollChatToBottom, 80);
                    messagesEl.querySelectorAll('.support-chat-zoom-img').forEach(function(a) {
                        a.addEventListener('click', function(e) { e.preventDefault(); if (window.supportChatLightbox) window.supportChatLightbox.show(this.dataset.full || this.href); });
                    });
                }).catch(function() {
                    messagesEl.innerHTML = '<div class="support-chat-msg other"><div class="support-chat-msg-name">Не удалось загрузить сообщения</div></div>';
                });
        }
        window.supportChatLightbox = {
            overlay: null,
            img: null,
            downloadBtn: null,
            init: function() {
                if (this.overlay) return;
                var div = document.createElement('div');
                div.id = 'support-chat-lightbox';
                div.className = 'support-chat-lightbox';
                div.innerHTML = '<button type="button" class="support-chat-lb-close" title="Закрыть">&times;</button><a href="#" class="support-chat-lb-download" download title="Скачать"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg></a><img src="data:image/gif;base64,R0lGOODlhAQABAAAAACwAAAAAAQABAAACAkQBADs=" alt="">';
                div.style.cssText = 'display:none;position:fixed;inset:0;z-index:10000;background:rgba(0,0,0,0.85);align-items:center;justify-content:center;padding:20px;';
                div.querySelector('img').style.maxWidth = '95vw'; div.querySelector('img').style.maxHeight = '95vh'; div.querySelector('img').style.objectFit = 'contain';
                div.querySelector('.support-chat-lb-close').style.cssText = 'position:absolute;top:15px;right:15px;width:44px;height:44px;border:none;background:rgba(255,255,255,0.15);color:#fff;font-size:28px;cursor:pointer;border-radius:50%;display:flex;align-items:center;justify-content:center;';
                div.querySelector('.support-chat-lb-download').style.cssText = 'position:absolute;top:15px;right:68px;width:44px;height:44px;border:none;background:rgba(255,255,255,0.15);color:#fff;cursor:pointer;border-radius:50%;display:flex;align-items:center;justify-content:center;';
                div.querySelector('.support-chat-lb-close').addEventListener('click', function(e) { e.stopPropagation(); window.supportChatLightbox.hide(); });
                div.querySelector('.support-chat-lb-download').addEventListener('click', function(e) { e.stopPropagation(); });
                div.addEventListener('click', function(e) { if (e.target === div) window.supportChatLightbox.hide(); });
                document.body.appendChild(div);
                this.overlay = div; this.img = div.querySelector('img'); this.downloadBtn = div.querySelector('.support-chat-lb-download');
            },
            show: function(url) {
                this.init();
                this.img.src = url;
                if (this.downloadBtn) { this.downloadBtn.href = url; this.downloadBtn.download = (url.split('/').pop() || 'image').split('?')[0] || 'image'; }
                this.overlay.style.display = 'flex';
            },
            hide: function() { if (this.overlay) { this.overlay.style.display = 'none'; this.img.src = 'data:image/gif;base64,R0lGOODlhAQABAAAAACwAAAAAAQABAAACAkQBADs='; } }
        };
        function startPoll() {
            if (pollTimer) clearInterval(pollTimer);
            pollTimer = setInterval(loadMessages, 5000);
        }
        function stopPoll() {
            if (pollTimer) { clearInterval(pollTimer); pollTimer = null; }
        }
        panel && panel.addEventListener('transitionend', function() {
            if (panel.classList.contains('support-chat-open')) { loadMessages(); startPoll(); } else stopPoll();
        });
        document.getElementById('support-chat-toggle') && document.getElementById('support-chat-toggle').addEventListener('click', function() {
            if (panel.classList.contains('support-chat-open')) { loadMessages(); startPoll(); }
        });
        messagesEl && messagesEl.addEventListener('click', function(e) {
            var btn = e.target.closest('.support-chat-msg-btn');
            if (!btn || !btn.dataset.text) return;
            var input = document.getElementById('support-chat-input');
            if (input) { input.value = btn.dataset.text; input.focus(); }
            var f = document.getElementById('support-chat-form');
            if (f) f.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }));
        });
        var supportChatInput = document.getElementById('support-chat-input');
        if (supportChatInput) supportChatInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') { e.preventDefault(); if (form) form.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true })); }
        });
        form && form.addEventListener('submit', function(e) {
            e.preventDefault();
            var msgInput = form.querySelector('input[name="message"]');
            var textVal = (msgInput && msgInput.value || '').toString().trim();
            var hasText = textVal !== '';
            var hasImages = selectedImages && selectedImages.length > 0;
            var hasFiles = selectedFiles && selectedFiles.length > 0;
            if (!hasText && !hasImages && !hasFiles) return;
            var fd = new FormData();
            fd.append('message', textVal);
            if (hasImages) {
                for (var i = 0; i < selectedImages.length; i++) {
                    fd.append('images[]', selectedImages[i]);
                }
            }
            if (hasFiles) {
                for (var j = 0; j < selectedFiles.length; j++) {
                    fd.append('files[]', selectedFiles[j]);
                }
            }
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route("support.chat.send") }}');
            if (csrf) xhr.setRequestHeader('X-CSRF-TOKEN', csrf.getAttribute('content'));
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.setRequestHeader('Accept', 'application/json');
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    try {
                        var res = JSON.parse(xhr.responseText);
                        if (res.success && res.messages && Array.isArray(res.messages)) {
                            res.messages.forEach(function(m) {
                                var html = renderOneMessage(m, currentUserId);
                                var wrap = document.createElement('div');
                                wrap.innerHTML = html;
                                if (wrap.firstChild && messagesEl) {
                                    messagesEl.appendChild(wrap.firstChild);
                                    wrap.firstChild.querySelectorAll('.support-chat-zoom-img').forEach(function(a) {
                                        a.addEventListener('click', function(ev) { ev.preventDefault(); if (window.supportChatLightbox) window.supportChatLightbox.show(this.dataset.full || this.href); });
                                    });
                                }
                            });
                            scrollChatToBottom();
                        } else if (res.success && res.message) {
                            var html = renderOneMessage(res.message, currentUserId);
                            var wrap = document.createElement('div');
                            wrap.innerHTML = html;
                            if (wrap.firstChild && messagesEl) {
                                messagesEl.appendChild(wrap.firstChild);
                                wrap.firstChild.querySelectorAll('.support-chat-zoom-img').forEach(function(a) {
                                    a.addEventListener('click', function(ev) { ev.preventDefault(); if (window.supportChatLightbox) window.supportChatLightbox.show(this.dataset.full || this.href); });
                                });
                            }
                            scrollChatToBottom();
                        }
                    } catch (err) {}
                    form.reset();
                    if (fileInput) fileInput.value = '';
                    if (attachFileInput) attachFileInput.value = '';
                    selectedImages.length = 0;
                    selectedFiles.length = 0;
                    renderAttachments();
                    loadMessages();
                }
            };
            xhr.send(fd);
        });
        var ctxMenu = document.getElementById('support-chat-ctx-menu');
        var ctxEdit = document.getElementById('support-chat-ctx-edit');
        var ctxDelete = document.getElementById('support-chat-ctx-delete');
        var ctxMsgId = null;
        var ctxMsgEl = null;
        var csrfToken = csrf ? csrf.getAttribute('content') : '';
        function hideCtx() { if (ctxMenu) { ctxMenu.style.display = 'none'; ctxMsgId = null; ctxMsgEl = null; } }
        messagesEl && messagesEl.addEventListener('contextmenu', function(e) {
            var msg = e.target.closest('.support-chat-msg');
            if (!msg) return;
            e.preventDefault();
            var mid = msg.getAttribute('data-message-id');
            var canDel = msg.getAttribute('data-can-delete') === '1';
            var canEd = msg.getAttribute('data-can-edit') === '1';
            if (!mid || (!canDel && !canEd)) return;
            ctxMsgId = mid;
            ctxMsgEl = msg;
            if (ctxMenu) {
                ctxEdit.style.display = canEd ? 'block' : 'none';
                ctxDelete.style.display = canDel ? 'block' : 'none';
                ctxMenu.style.left = e.clientX + 'px';
                ctxMenu.style.top = e.clientY + 'px';
                ctxMenu.style.display = 'block';
            }
        });
        document.addEventListener('click', function(e) { if (ctxMenu && !ctxMenu.contains(e.target)) hideCtx(); });
        if (ctxDelete) ctxDelete.addEventListener('click', function() {
            if (!ctxMsgId || !ctxMsgEl) return;
            var id = ctxMsgId;
            var el = ctxMsgEl;
            hideCtx();
            fetch('{{ route("support.chat.delete-message") }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json', 'Accept': 'application/json' }, body: JSON.stringify({ message_id: parseInt(id, 10), _token: csrfToken }) })
                .then(function(r) { return r.json(); })
                .then(function(data) { if (data.success && el && el.parentNode) el.remove(); });
        });
        if (ctxEdit) ctxEdit.addEventListener('click', function() {
            if (!ctxMsgId || !ctxMsgEl) return;
            var id = ctxMsgId;
            var el = ctxMsgEl;
            var textEl = el.querySelector('.support-chat-msg-text');
            hideCtx();
            if (!textEl) return;
            var current = textEl.textContent || '';
            var wrap = document.createElement('div');
            wrap.innerHTML = '<textarea class="support-chat-edit-ta" rows="3" style="width:100%;padding:6px;border-radius:8px;border:1px solid #e2e8f0;font-size:14px;"></textarea><div style="margin-top:8px;"><button type="button" class="support-chat-edit-save" style="padding:6px 12px;background:#1d4ed8;color:#fff;border:none;border-radius:8px;margin-right:8px;">Сохранить</button><button type="button" class="support-chat-edit-cancel" style="padding:6px 12px;border:1px solid #e2e8f0;border-radius:8px;">Отмена</button></div>';
            wrap.querySelector('textarea').value = current;
            textEl.replaceWith(wrap);
            var ta = wrap.querySelector('textarea');
            wrap.querySelector('.support-chat-edit-cancel').addEventListener('click', function() { wrap.replaceWith(textEl); });
            wrap.querySelector('.support-chat-edit-save').addEventListener('click', function() {
                var newText = (ta && ta.value || '').trim();
                fetch('{{ route("support.chat.update-message") }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json', 'Accept': 'application/json' }, body: JSON.stringify({ message_id: parseInt(id, 10), message: newText, _token: csrfToken }) })
                    .then(function(r) { return r.json(); })
                    .then(function(data) {
                        if (data.success && data.message) {
                            var d = document.createElement('div');
                            d.className = 'support-chat-msg-text';
                            d.textContent = (data.message.message || '');
                            wrap.replaceWith(d);
                        } else { wrap.replaceWith(textEl); }
                    });
            });
        });

        document.getElementById('support-chat-fullscreen-btn') && document.getElementById('support-chat-fullscreen-btn').addEventListener('click', function() {
            if (!panel) return;
            panel.classList.toggle('support-chat-fullscreen');
            var expand = panel.querySelector('.support-chat-icon-expand');
            var exit = panel.querySelector('.support-chat-icon-exit-fullscreen');
            if (expand && exit) {
                expand.classList.toggle('hidden', panel.classList.contains('support-chat-fullscreen'));
                exit.classList.toggle('hidden', !panel.classList.contains('support-chat-fullscreen'));
            }
        });
        if (panel && panel.classList.contains('support-chat-open')) { loadMessages(); startPoll(); }
        }
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initSupportChat);
        } else {
            initSupportChat();
        }
    })();
    </script>
    @endauth

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const burgerMenu = document.querySelector('.burger-menu');
            const mobileNav = document.querySelector('.mobile-nav');
            const overlay = document.querySelector('.overlay');
            const nav = document.querySelector('.nav');
            const buttonHeader = document.querySelector('.button_header');
            function handleResize() {
                if (window.innerWidth > 1000) {
                    burgerMenu?.classList.remove('open');
                    mobileNav?.classList.remove('open');
                    overlay?.classList.remove('open');
                }
            }
            burgerMenu?.addEventListener('click', function() {
                this.classList.toggle('open');
                mobileNav?.classList.toggle('open');
                overlay?.classList.toggle('open');
            });
            overlay?.addEventListener('click', function() {
                burgerMenu?.classList.remove('open');
                mobileNav?.classList.remove('open');
                this.classList.remove('open');
            });
            window.addEventListener('resize', handleResize);
            var orderForm = document.querySelector('#modal form#order-form');
            if (orderForm) {
                orderForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    var loadingEl = document.getElementById('loading');
                    if (loadingEl) loadingEl.style.display = 'block';
                    orderForm.style.display = 'none';
                    setTimeout(function() {
                        if (loadingEl) loadingEl.style.display = 'none';
                        var successEl = document.getElementById('success-message');
                        if (successEl) successEl.style.display = 'block';
                        setTimeout(function() {
                            closeModal();
                            showNotification();
                        }, 2000);
                        orderForm.reset();
                    }, 1500);
                });
            }
            function showNotification() {
                const notification = document.getElementById('notification');
                notification.style.display = 'block';
                setTimeout(function() {
                    notification.style.animation = 'slideOut 0.5s forwards';
                    setTimeout(function() {
                        notification.style.display = 'none';
                        notification.style.animation = '';
                    }, 500);
                }, 5000);
            }
            function closeNotification() {
                const notification = document.getElementById('notification');
                notification.style.animation = 'slideOut 0.5s forwards';
                setTimeout(function() {
                    notification.style.display = 'none';
                    notification.style.animation = '';
                }, 500);
            }
            function closeModal() {
                var modal = document.getElementById('modal');
                if (modal) modal.style.display = 'none';
                document.body.classList.remove('modal-open');
                var orderFormEl = document.getElementById('order-form');
                if (orderFormEl) orderFormEl.style.display = 'block';
                var successEl = document.getElementById('success-message');
                if (successEl) successEl.style.display = 'none';
                var loadingEl = document.getElementById('loading');
                if (loadingEl) loadingEl.style.display = 'none';
            }
            function openModal() {
                window.location.href = '{{ route("order.create") }}';
            }
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const dropdownMenu = this.nextElementSibling;
                    dropdownMenu.classList.toggle('show');
                });
            });
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.nav-item.dropdown')) {
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        menu.classList.remove('show');
                    });
                }
            });
            const dropdownSubmenus = document.querySelectorAll('.dropdown-submenu');
            dropdownSubmenus.forEach(submenu => {
                const trigger = submenu.querySelector('.dropdown-item');
                trigger.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    document.querySelectorAll('.dropdown-submenu .dropdown-menu').forEach(menu => {
                        if (menu !== submenu.querySelector('.dropdown-menu')) {
                            menu.classList.remove('show');
                        }
                    });
                    const dropdownMenu = submenu.querySelector('.dropdown-menu');
                    dropdownMenu.classList.toggle('show');
                });
            });
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown-submenu')) {
                    document.querySelectorAll('.dropdown-submenu .dropdown-menu').forEach(menu => {
                        menu.classList.remove('show');
                    });
                }
            });
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    document.querySelectorAll('.dropdown-submenu .dropdown-menu').forEach(menu => {
                        menu.classList.remove('show');
                    });
                }
            });
            function toggleTheme() {
                const body = document.body;
                if (body.classList.contains('dark-theme')) {
                    body.classList.remove('dark-theme');
                    localStorage.setItem('theme', 'light');
                } else {
                    body.classList.add('dark-theme');
                    localStorage.setItem('theme', 'dark');
                }
            }
            function applySavedTheme() {
                const savedTheme = localStorage.getItem('theme');
                if (savedTheme === 'dark') {
                    document.body.classList.add('dark-theme');
                } else {
                    document.body.classList.remove('dark-theme');
                }
            }
            applySavedTheme();
            const themeContainer = document.querySelector('.night__theme');
            themeContainer?.addEventListener('click', toggleTheme);
            const scrollToTopBtn = document.getElementById('scrollToTopBtn');
            var scrollTick = false;
            window.addEventListener('scroll', function() {
                if (scrollTick) return;
                scrollTick = true;
                requestAnimationFrame(function() {
                    if (window.scrollY > 800) {
                        scrollToTopBtn.style.display = 'flex';
                    } else {
                        scrollToTopBtn.style.display = 'none';
                    }
                    scrollTick = false;
                });
            });
            scrollToTopBtn?.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });
        function subscribe() {
            const button = document.getElementById('subscribeButton');
            if (button?.classList.contains('subscribed')) return;
            const message = document.getElementById('congratulationsMessage');
            const canvas = document.getElementById('confettiCanvas');
            const ctx = canvas?.getContext('2d');
            if (!ctx) return;
            let W = canvas.width = canvas.offsetWidth;
            let H = canvas.height = canvas.offsetHeight;
            button.textContent = 'Вы подписаны';
            button.classList.add('subscribed');
            message.style.display = 'flex';
            message.style.opacity = '1';
            canvas.style.opacity = '1';
            const confettiCount = 150;
            const confetti = [];
            function randomRange(min, max) {
                return Math.random() * (max - min) + min;
            }
            function Confetto() {
                this.x = randomRange(0, W);
                this.y = randomRange(-H, 0);
                this.w = randomRange(5, 10);
                this.h = randomRange(10, 15);
                this.color = `hsl(${randomRange(0, 360)}, 100%, 50%)`;
                this.speed = randomRange(2, 5);
                this.angle = randomRange(0, 2 * Math.PI);
                this.rotationSpeed = randomRange(-0.1, 0.1);
            }
            Confetto.prototype.update = function() {
                this.y += this.speed;
                this.angle += this.rotationSpeed;
                if (this.y > H) {
                    this.y = randomRange(-H, 0);
                    this.x = randomRange(0, W);
                }
            };
            Confetto.prototype.draw = function() {
                ctx.save();
                ctx.translate(this.x, this.y);
                ctx.rotate(this.angle);
                ctx.fillStyle = this.color;
                ctx.fillRect(-this.w / 2, -this.h / 2, this.w, this.h);
                ctx.restore();
            };
            for (let i = 0; i < confettiCount; i++) {
                confetti.push(new Confetto());
            }
            let animationId;
            function render() {
                ctx.clearRect(0, 0, W, H);
                confetti.forEach(p => {
                    p.update();
                    p.draw();
                });
                animationId = requestAnimationFrame(render);
            }
            render();
            setTimeout(() => {
                message.classList.add('fade-out');
                canvas.classList.add('fade-out');
            }, 2000);
            setTimeout(() => {
                cancelAnimationFrame(animationId);
                ctx.clearRect(0, 0, W, H);
                message.style.display = 'none';
                message.classList.remove('fade-out');
                canvas.classList.remove('fade-out');
                canvas.style.opacity = '0';
            }, 3000);
            window.addEventListener('resize', () => {
                W = canvas.width = canvas.offsetWidth;
                H = canvas.height = canvas.offsetHeight;
            });
        }
    </script>
        <script>
            // Кнопка «Заказать» — переход на страницу оформления заказа
            function openModal() {
                closeBannerModal();
                window.location.href = '{{ route("order.create") }}';
            }

            // Остальной код без изменений
            function openBannerModal(imgSrc, title, description, category) {
                const modal = document.getElementById('bannerModal');
                const modalImg = document.getElementById('modalBannerImg');
                const modalTitle = document.getElementById('modalBannerTitle');
                const modalDesc = document.getElementById('modalBannerDescription');
                const modalCategory = document.getElementById('modalBannerCategory');
                
                modalImg.src = imgSrc;
                modalTitle.textContent = title;
                modalDesc.textContent = description;
                
                if (modalCategory && category) {
                    modalCategory.textContent = getCategoryDisplayName(category);
                }
                
                modal.style.display = "block";
                document.body.style.overflow = "hidden";
            }

            function closeBannerModal() {
                var el = document.getElementById('bannerModal');
                if (el) { el.style.display = "none"; }
                document.body.style.overflow = "auto";
            }

            function getCategoryDisplayName(categoryCode) {
                const categoryMap = {
                    'stream': 'Баннер для стрима',
                    'game': 'Игровой баннер',
                    'holiday': 'Яркое превью',
                    'esports': 'Киберспорт',
                    'travel': 'Туристический баннер',
                    'art': 'Арт',
                    'commercial': 'Коммерческий баннер',
                    'auto': 'Автомобильный баннер'
                };
                
                return categoryMap[categoryCode] || categoryCode;
            }

            // Закрытие модального окна при клике вне его
            window.onclick = function(event) {
                const modal = document.getElementById('bannerModal');
                if (event.target == modal) {
                    closeBannerModal();
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const viewButtons = document.querySelectorAll('.svggggggg_block');
                
                viewButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.stopPropagation();
                        
                        const banner = this.closest('.banner');
                        const imgSrc = banner.querySelector('.banner---img').src;
                        const title = banner.querySelector('.conten_block_portfolio_text').textContent;
                        const description = banner.querySelector('.conten_block_portfolio_text__two').textContent;
                        const category = banner.getAttribute('data-categories');
                        
                        openBannerModal(imgSrc, title, description, category);
                    });
                });
            });

            // Заглушка для не загруженных изображений — отложенно, чтобы не тормозить загрузку
            (function() {
                var placeholder = '/image/placeholder.svg';
                function attachPlaceholders() {
                    document.querySelectorAll('img').forEach(function(img) {
                        if (img.dataset.placeholderDone) return;
                        img.dataset.placeholderDone = '1';
                        img.addEventListener('error', function() { this.src = placeholder; });
                    });
                }
                if (document.readyState === 'complete') attachPlaceholders();
                else window.addEventListener('load', attachPlaceholders);
            })();
        </script>
</body>
</html>