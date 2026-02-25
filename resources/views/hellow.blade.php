@extends('layouts.app')

@section('skeleton')
<div class="skeleton-page">
    <div class="skeleton skeleton-block skeleton-block--xl" style="width:70%;max-width:400px;height:120px;border-radius:12px;"></div>
    <div class="skeleton skeleton-text" style="width:100%;max-width:500px;"></div>
    <div class="skeleton skeleton-text skeleton-text--short" style="width:60%;"></div>
    <div class="skeleton-grid" style="grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:1rem;margin-top:1.5rem;">
        @for($i = 0; $i < 6; $i++)<div class="skeleton skeleton-card" style="min-height:160px;border-radius:12px;"></div>@endfor
    </div>
</div>
@endsection

@section('content')
<body>
    @auth
        <div class="admin_block">
                        <div class="navbarSupportedContent" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav me-auto">

                            </ul>
                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ms-auto" style="display: flex !important;    flex-direction: row; gap: 20px;">
                                <!-- Authentication Links -->
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
                                <style>
                                    .dropdown-toggle{
                                        background-color: #1D4ED8;
                                        color: white;
                                        padding: 5px 10px;
                                        border-radius: 0.3rem;
                                    }
                                    .dropdown-toggle:hover{
                                        color: white !important;
                                        background-color: #143591ff;
                                    }
                                    .nav-link{
                                        list-style: none;
                                        display: flex;
                                        align-items: center;
                                        gap: 5px;
                                    }
                                    .dropdown-item-dropdown-item{
                                        width: 100%;
                                        background-color: #d3d3d3ff;
                                        height: 2px;
                                        margin: 2px;
                                    }
                                </style>
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                            <svg class="svg_nav-link" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                            <a class="dropdown-item" href="{{ url('/index') }}">
                                                {{ __('Главная') }}
                                            </a>
                                            <div class="dropdown-item-dropdown-item"></div>
                                            @if(in_array(Auth::user()->role ?? null, ['user', 'moderator', 'admin']))
                                                <a class="dropdown-item" href="{{ route('userPanel') }}">
                                                    Аккаунт 
                                                    

                                                
                                                </a>
                                                <style>
                                                    .admin_header {
                                                        text-decoration: none;
                                                        color: black;
                                                        font-weight: bold;
                                                    }
                                                </style>
                                            @endif
                                            <style>
                                                .nav-item.dropdown {
                                                    position: relative;
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

                                                /* Стили для вложенного меню */
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

                                                /* Боковое подменю */
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

                                                /* Темная тема для бокового меню */
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

                                                /* Анимация появления */
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

                                                /* Адаптивность для мобильных устройств */
                                                @media (max-width: 768px) {
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
                                                }
                                            </style>
                                            @if(in_array(Auth::user()->role, ['admin', 'moderator']))
                                                <a class="dropdown-item" href="{{ route('admin.chat') }}">
                                                    Админ Чат
                                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" stroke="currentColor" stroke-width="2"/>
                                                    </svg>
                                                </a>
                                            @endif
                                            @if((Auth::user()->role ?? null) === 'admin')
                                                <a class="dropdown-item" href="{{ route('adminPanel') }}">
                                                    Админ панель
                                                </a>
                                                <div class="dropdown-submenu">
                                                    <a class="dropdown-item" href="#">
                                                        Различные страницы
                                                        
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ url('/home') }}">
                                                            Добро пожаловать
                                                        </a>
                                                        <a class="dropdown-item" href="{{ url('/') }}">
                                                            Главная (Вход)
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="dropdown-submenu">
                                                    <a class="dropdown-item" href="#">
                                                        Быстрая навигация
                                                        
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ url('/aboutus') }}">
                                                            О нас
                                                        </a>
                                                        <a class="dropdown-item" href="{{ url('/services') }}">
                                                            Услуги
                                                        </a>
                                                        <a class="dropdown-item" href="{{ url('/portfolio') }}">
                                                            Портфолио
                                                        </a>
                                                        <a class="dropdown-item" href="{{ url('/websiteNews') }}">
                                                            Новости
                                                        </a>
                                                        <a class="dropdown-item" href="{{ url('/whyus') }}">
                                                            Почему мы?
                                                        </a>
                                                        <a class="dropdown-item" href="{{ url('/contacts') }}">
                                                            Контакты
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="dropdown-submenu">
                                                    <a class="dropdown-item" href="#">
                                                        Быстрый доступ
                                                        
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ url('/banners/create') }}">
                                                            Загрузить баннер
                                                        </a>
                                                        <a class="dropdown-item" href="{{ url('/news/create') }}">
                                                            Добавить новость
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                            <script>
                                                // Улучшение работы выпадающих меню
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    const dropdownSubmenus = document.querySelectorAll('.dropdown-submenu');
                                                    
                                                    dropdownSubmenus.forEach(submenu => {
                                                        const trigger = submenu.querySelector('.dropdown-item');
                                                        
                                                        trigger.addEventListener('click', function(e) {
                                                            e.preventDefault();
                                                            e.stopPropagation();
                                                            
                                                            // Закрываем другие открытые подменю
                                                            document.querySelectorAll('.dropdown-submenu .dropdown-menu').forEach(menu => {
                                                                if (menu !== submenu.querySelector('.dropdown-menu')) {
                                                                    menu.classList.remove('show');
                                                                }
                                                            });
                                                            
                                                            // Переключаем текущее подменю
                                                            const dropdownMenu = submenu.querySelector('.dropdown-menu');
                                                            dropdownMenu.classList.toggle('show');
                                                        });
                                                    });
                                                    
                                                    // Закрытие подменю при клике вне их
                                                    document.addEventListener('click', function(e) {
                                                        if (!e.target.closest('.dropdown-submenu')) {
                                                            document.querySelectorAll('.dropdown-submenu .dropdown-menu').forEach(menu => {
                                                                menu.classList.remove('show');
                                                            });
                                                        }
                                                    });
                                                    
                                                    // Закрытие подменю при нажатии Escape
                                                    document.addEventListener('keydown', function(e) {
                                                        if (e.key === 'Escape') {
                                                            document.querySelectorAll('.dropdown-submenu .dropdown-menu').forEach(menu => {
                                                                menu.classList.remove('show');
                                                            });
                                                        }
                                                    });
                                                });
                                            </script>
                                            <style>
                                                .dropdown-item{
                                                    justify-content: space-between;
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
                                            </style>
                                            <?php if(Auth::check() && in_array(Auth::user()->role, ['moderator', 'admin'])): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('adminPanel')); ?>">
                                                    Модер панель 
                                                    <span>
                                                        <?php if(isset($PublicFunc) && method_exists($PublicFunc, 'count')): ?>
                                                            <?php echo e($PublicFunc->count()); ?>

                                                        <?php else: ?>
                                                            0
                                                        <?php endif; ?>
                                                    </span>
                                                </a>
                                            <?php endif; ?>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
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
    @endauth
    <style>
        .admin_block{
            position: fixed;
            z-index: 999;
            top: 20px;
            left: 47.5%;
            box-shadow: 0px 0px 40px 0px #0066ffbe;
        }
    </style>
    <style>
        @media (max-width: 1200px) {
            .container {
                max-width: 1140px;
                padding: 0 20px;
            }
            .hero_login_block_gl{
                width: 100% !important;
            }
            
            .hero_login {
                flex-direction: column;
                gap: 40px;
            }
            
            .hero_login_text {
                text-align: center;
            }
            
            .content_tools {
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
            }
            
            .block_advantages {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .content_block_team {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 992px) {
            .container {
                max-width: 960px;
                padding: 0 15px;
            }
            
            .col-md-88 {
                width: 100% !important;
            }
            
            .login-card {
                min-width: auto;
                margin: 0 15px;
            }
            
            .hero_login_buttons {
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }
            
            .hero_login_block_gl {
                flex-direction: column;
                gap: 20px;
            }
            
            .block_numbers {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }
            
            .news-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .block___questions_block_text_h1 h1 {
                font-size: 1.2rem !important;
            }
            
            .block___questions_block_text_h1 h2 {
                font-size: 0.9rem !important;
            }
        }

        @media (max-width: 768px) {
            .hero_login_text h1{
                transform: scale(0.7);
            }
            .hero_login_text_h2{
                margin-top: 5rem;
            }
            .container {
                max-width: 720px;
            }
            
            .login-container {
                margin-top: 5rem;
            }
            
            .login-card-body {
                padding: 30px 20px !important;
            }
            
            .login-card-header {
                font-size: 20px;
                padding: 15px 20px;
            }
            
            .form-row {
                margin-bottom: 20px !important;
            }
            
            .form-label {
                text-align: left;
                margin-bottom: 8px;
            }
            
            .col-md-6 {
                width: 100%;
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
            
            /* Hero section */
            .hero_login_text h1 {
                font-size: 2rem;
            }
            
            .hero_login_text h2 {
                font-size: 1rem;
            }
            
            /* Tools section */
            .content_tools {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }
            
            /* Advantages section */
            .block_advantages {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .content_advantages {
                padding: 20px;
            }
            
            /* Numbers section */
            .block_numbers {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .content_block_numbers {
                padding: 20px;
            }
            
            /* Reviews section */
            .reviews-slider-container {
                padding: 0 10px;
            }
            
            .review-card {
                min-width: 300px;
            }
            
            .review-form-container {
                padding: 25px;
            }
            
            /* Team section */
            .content_block_team {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .content_team {
                flex-direction: column;
                text-align: center;
            }
            
            /* News section */
            .news-grid {
                grid-template-columns: 1fr;
            }
            
            .news-card.featured {
                grid-template-columns: 1fr;
            }
            
            /* Footer section */
            .botton_footer_two_block {
                flex-direction: column;
                gap: 15px;
            }
            
            .botton_footer_two,
            .botton_footer__two {
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding: 0 10px;
            }
            
            .login-card {
                margin: 0 10px;
            }
            
            .form-control {
                padding: 10px 12px;
                font-size: 14px;
            }
            
            .login-button {
                padding: 12px 20px;
                font-size: 14px;
            }
            
            /* Hero section */
            .hero_login_text h1 {
                font-size: 1.5rem;
            }
            
            .hero_login_text_h2 {
                font-size: 0.8rem;
            }
            
            .hero_login__block,
            .hero_login___block {
                padding: 15px;
                font-size: 0.9rem;
            }
            
            /* Sections padding */
            .inner_tools,
            .inner_advantages,
            .inner_numbers,
            .inner_reviews,
            .inner_team,
            .inner_questions,
            .inner_footer_two {
                padding: 40px 0;
            }
            
            /* Headers */
            .block_tools h1,
            .block___advantages h1,
            .block_reviews h1,
            .block_team h1,
            .block___questions h1 {
                font-size: 1.8rem;
            }
            
            .block_tools h2,
            .block___advantages h2,
            .block_reviews h2,
            .block_team h2,
            .block___questions h2 {
                font-size: 1rem;
            }
            
            /* Tools */
            .content_tools {
                grid-template-columns: 1fr;
            }
            
            .content_block_tools {
                padding: 20px;
            }
            
            /* Reviews */
            .review-card {
                min-width: 280px;
                padding: 20px;
            }
            
            .review-header {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }
            
            .review-client-info {
                text-align: center;
            }
            
            /* Forms */
            .review-form-container {
                padding: 20px;
            }
            
            .form-group label {
                font-size: 0.9rem;
            }
            
            .form-group input,
            .textarea {
                font-size: 14px;
                padding: 10px 12px;
            }
            
            /* Questions */
            .block___questions_block_text_h1 {
                padding: 20px;
            }
            
            .block___questions_block_text_h1 h1 {
                font-size: 1.1rem;
            }
            
            .block___questions_block_text_h1 h2 {
                font-size: 0.85rem;
            }
            
            /* Cursor effects */
            .cursor-glow,
            .cursor-glow-intense,
            .cursor-glow-pulse {
                display: none;
            }
        }

        @media (max-width: 375px) {
            .login-card-body {
                padding: 20px 15px !important;
            }
            
            .hero_login_text h1 {
                font-size: 1.3rem;
            }
            
            .hero_login_buttons_h1,
            .hero_login_buttons_h2 {
                padding: 12px 20px;
                font-size: 0.9rem;
            }
            
            .content_advantages_text {
                font-size: 1.1rem;
            }
            
            .content_advantages_text_two {
                font-size: 0.85rem;
            }
            
            .text_content_block_numbers {
                font-size: 2rem;
            }
            
            .text_two_content_block_numbers {
                font-size: 0.9rem;
            }
        }

        /* Высота экрана */
        @media (max-height: 700px) {
            .login-container {
                margin-top: 4rem;
            }
            
            .login-card {
                max-height: 90vh;
                overflow-y: auto;
            }
        }

        /* Портретная ориентация */
        @media (max-width: 768px) and (orientation: portrait) {
            .hero_login_section {
                padding: 60px 0;
            }
            
            .inner_tools,
            .inner_advantages,
            .inner_numbers {
                padding: 50px 0;
            }
        }

        /* Ландшафтная ориентация для мобильных */
        @media (max-height: 500px) and (orientation: landscape) {
            .login-container {
                margin-top: 2rem;
            }
            
            .login-card {
                max-height: 80vh;
            }
            
            .form-row {
                margin-bottom: 15px !important;
            }
        }
    </style>
    <style>
.dark-theme {
    background-color: #13171f;
    color: #e0e0e0;
}

.dark-theme .hero_login_section {
    background-color: #13171f;
}

.dark-theme .inner_reviews {
    background-color: #13171f;
}

.dark-theme .login-card {
    background: rgba(25, 29, 40, 0.95) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    color: #e0e0e0;
}

.dark-theme .form-control {
    background: rgba(35, 40, 52, 0.8) !important;
    border-color: #4a5568 !important;
    color: #e0e0e0 !important;
}

.dark-theme .form-control:focus {
    background: #2d3748 !important;
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

.dark-theme .remember-label {
    color: #e0e0e0 !important;
}

.dark-theme .inner_tools {
    background-color: #1a1f2b !important;
}

.dark-theme .block_tools h1,
.dark-theme .block_tools h2 {
    color: #e0e0e0;
}

.dark-theme .content_block_tools {
    background: rgba(25, 29, 40, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #e0e0e0;
}

.dark-theme .inner_advantages {
    background-color: #13171f !important;
}

.dark-theme .block___advantages h1,
.dark-theme .block___advantages h2 {
    color: #e0e0e0;
}

.dark-theme .content_advantages {
    background: rgba(25, 29, 40, 0.8) !important;
    border: 1px inset #7ebeff40;
    border-style: solid;
    box-shadow: 0 8px 32px 0 rgba(59, 131, 246, 0.06) !important;
}

.dark-theme .content_advantages_text,
.dark-theme .content_advantages_text_two {
    color: #e0e0e0;
}

.dark-theme .svgggg {
    stroke: #63B3ED;
}

.dark-theme .inner_numbers {
    background-color: #1a1f2b;
}

.dark-theme .content_block_numbers {
}

.dark-theme .text_content_block_numbers,
.dark-theme .text_two_content_block_numbers {
    color: #e0e0e0;
}

.dark-theme .block_reviews h1,
.dark-theme .block_reviews h2,
.dark-theme .block_working_text_h1 {
    color: #e0e0e0;
}

.dark-theme .review-card {
    background: rgba(25, 29, 40, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #e0e0e0;
}

.dark-theme .review-client-info h4 {
    color: #e0e0e0;
}

.dark-theme .review-client-info p {
    color: #a0a0a0;
}

.dark-theme .review-text {
    color: #e0e0e0;
}

.dark-theme .review-date {
    color: #a0a0a0;
}

.dark-theme .review-form-container {
    background: rgba(25, 29, 40, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.dark-theme .review-form-title,
.dark-theme .review-form-subtitle {
    color: #e0e0e0;
}

.dark-theme .form-group label {
    color: #e0e0e0;
}

.dark-theme .form-group input,
.dark-theme .textarea {
    background: rgba(35, 40, 52, 0.8);
    border-color: #4a5568;
    color: #e0e0e0;
}

.dark-theme .form-group input:focus,
.dark-theme .textarea:focus {
    background: #2d3748;
    border-color: #63B3ED;
}

.dark-theme .inner_team {
    background-color: #1a1f2b;
}

.dark-theme .block_team h1,
.dark-theme .block_team h2 {
    color: #e0e0e0;
}

.dark-theme .content_team {
    background: rgba(25, 29, 40, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.dark-theme .content_team_block_text_h1,
.dark-theme .content_team_block_text_h2,
.dark-theme .content_team_block_text_h3 {
    color: #e0e0e0;
}

.dark-theme .news-card {
    background: #2D3748;
    color: #E2E8F0;
}

.dark-theme .news-title {
    color: #F7FAFC;
}

.dark-theme .news-excerpt {
    color: #CBD5E0;
}

.dark-theme .news-date {
    background: #4A5568;
    color: #E2E8F0;
}

.dark-theme .author-info h4 {
    color: #F7FAFC;
}

.dark-theme .author-info p {
    color: #CBD5E0;
}

.dark-theme .inner_footer_two {
    background-color: #1a1f2b;
}

.dark-theme .text_botton_footer_two,
.dark-theme .text_botton_footer__two {
    color: #e0e0e0;
}

.dark-theme .inner_questions {
    background-color: #13171f;
}

.dark-theme .block___questions h1,
.dark-theme .block___questions h2 {
    color: #e0e0e0;
}

.dark-theme .block___questions_block_text_h1 {
    background: rgba(25, 29, 40, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.dark-theme .block___questions_block_text_h1 h1,
.dark-theme .block___questions_block_text_h1 h2 {
    color: #e0e0e0;
}

.dark-theme .hero_login_text h1,
.dark-theme .hero_login_text h2,
.dark-theme .hero_login_text_h2 {
    color: #e0e0e0;
}

.dark-theme .hero_login_buttons_h1,
.dark-theme .hero_login_buttons_h2 {
    background: rgba(25, 29, 40, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #e0e0e0;
}

.dark-theme .hero_login__block,
.dark-theme .hero_login___block {
    background: rgba(25, 29, 40, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #e0e0e0;
}

.dark-theme .slider-btn {
    background: rgba(25, 29, 40, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #e0e0e0;
}

.dark-theme .slider-dot {
    background: rgba(255, 255, 255, 0.3);
}

.dark-theme .slider-dot.active {
    background: #63B3ED;
}

.dark-theme .rating-star {
    color: #E5E7EB;
}

.dark-theme .rating-star.active {
    color: #FBBF24;
}

.dark-theme .submit-review-btn_two {
    background: rgba(25, 29, 40, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #e0e0e0;
}

.dark-theme .botton_footer_two,
.dark-theme .botton_footer__two {
    background: rgba(25, 29, 40, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #e0e0e0;
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
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
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
    <section class="dc-section hero_login_section hero_login_section--desktop" id="hero">
        
        <div class="hero_login__section"></div>
        <div class="hero_login___section"></div>
        <div class="dc-container container">
            <div class="hero_login">
                <div class="hero_login_text">
                    <a class="hero_login_text_h2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-4 h-4 text-primary animate-glow"><path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path><path d="M20 3v4"></path><path d="M22 5h-4"></path><path d="M4 17v2"></path><path d="M5 18H3"></path></svg>Профессиональный дизайн</a>
                    <h1>Мастерство дизайна в <span>Photoshop</span> & <span>Figma</span></h1>
                    <h2>Воплощаем ваши идеи в жизнь с помощью современных инструментов дизайна. Создаем уникальные визуальные решения, которые выделяют ваш бренд.</h2>
                    <div class="hero_login_buttons">
                        <a href="{{ url('/login') }}" class="hero_login_buttons_h1"><p>Начать проект</p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg></a>
                        <a href="#whyus" class="hero_login_buttons_h2">Почему мы <p>?</p></a>                                  
                    </div>                                       
                </div>   
                <div class="hero_login_block">
                    <div class="hero_login_block_gl">
                        <div class="hero_login_block_block_gl">
                            <div class="hero_login__block"><span>Photoshop</span></div>
                            <div class="hero_login__block"><span>Figma</span></div>
                            <div class="hero_login__block"><span>Design<br>Systems</span></div>
                        </div>
                        <div class="hero_login_block_block_gl_two">
                            <div class="hero_login___block"><span></span>UI/UX Design</div>
                            <div class="hero_login___block"><span></span>Branding</div>
                        </div>
                    </div>
                </div>                       
            </div>
        </div>
    </section>
    <section class="hero_mobile" id="hero-mobile" aria-label="Главный экран">
        <div class="hero_mobile__bg"></div>
    </section>
    <section class="dc-section dc-section--content inner_tools" id="whyus">
        <div class="dc-container container">
            <div class="block_tools">
                <h1>Наши инструменты</h1>
                <h2>Мы используем самые современные программы и технологии для создания высококачественных дизайнов.</h2>
                <div class="content_tools">
                    <div class="content_block_tools">
                        <p class="ps">Ps</p>
                        <p class="text_tools">Photoshop</p>
                    </div>
                    <div class="content_block_tools">
                        <p class="ps" style="color: rgb(234, 88, 12);">Ai</p>
                        <p class="text_tools">Illustrator</p>
                    </div>
                    <div class="content_block_tools">
                        <p class="ps" style="color: rgb(126, 34, 206);">Ae</p>
                        <p class="text_tools">After Effects</p>
                    </div>
                    <div class="content_block_tools">
                        <p class="ps" style="color: rgb(219, 39, 119);">Id</p>
                        <p class="text_tools">InDesign</p>
                    </div>
                    <div class="content_block_tools">
                        <p class="ps" style="color: rgb(37, 99, 235);">Xd</p>
                        <p class="text_tools">Adobe XD</p>
                    </div>
                    <div class="content_block_tools">
                        <p class="ps" style="color: rgb(22, 163, 74);">Dw</p>
                        <p class="text_tools">Dreamweaver</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="dc-section dc-section--content inner_advantages">
        <div class="dc-container container">
            <div class="block___advantages">
                <h1>Наши преимущества</h1>
                <h2>Что делает нас лучшим выбором для ваших дизайн-проектов.</h2>
                <div class="block_advantages">
                    <div class="content_advantages">
                        <div class="svg"><svg class="svgggg" data-lov-id="src/pages/WhyUs.tsx:11:8" data-lov-name="svg" data-component-path="src/pages/WhyUs.tsx" data-component-line="11" data-component-file="WhyUs.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22h-10%20w-10%22%7D" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path data-lov-id="src/pages/WhyUs.tsx:12:10" data-lov-name="path" data-component-path="src/pages/WhyUs.tsx" data-component-line="12" data-component-file="WhyUs.tsx" data-component-name="path" data-component-content="%7B%7D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg></div>
                        <p class="content_advantages_text">Профессиональная команда</p>
                        <p class="content_advantages_text_two">Наша команда состоит из опытных дизайнеров с профильным образованием и многолетним опытом работы</p>
                    </div>
                    <div class="content_advantages">
                        <div class="svg"><svg class="svgggg" data-lov-id="src/pages/WhyUs.tsx:20:8" data-lov-name="svg" data-component-path="src/pages/WhyUs.tsx" data-component-line="20" data-component-file="WhyUs.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22h-10%20w-10%22%7D" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path data-lov-id="src/pages/WhyUs.tsx:21:10" data-lov-name="path" data-component-path="src/pages/WhyUs.tsx" data-component-line="21" data-component-file="WhyUs.tsx" data-component-name="path" data-component-content="%7B%7D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg></div>
                        <p class="content_advantages_text">Индивидуальный подход</p>
                        <p class="content_advantages_text_two">Мы тщательно изучаем потребности каждого клиента и предлагаем персонализированные решения.</p>
                    </div>
                    <div class="content_advantages">
                        <div class="svg"><svg class="svgggg" data-lov-id="src/pages/WhyUs.tsx:29:8" data-lov-name="svg" data-component-path="src/pages/WhyUs.tsx" data-component-line="29" data-component-file="WhyUs.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22h-10%20w-10%22%7D" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path data-lov-id="src/pages/WhyUs.tsx:30:10" data-lov-name="path" data-component-path="src/pages/WhyUs.tsx" data-component-line="30" data-component-file="WhyUs.tsx" data-component-name="path" data-component-content="%7B%7D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg></div>
                        <p class="content_advantages_text">Гарантия качества</p>
                        <p class="content_advantages_text_two">Мы не считаем проект завершенным, пока клиент полностью не удовлетворен результатом.</p>
                    </div>
                    <div class="content_advantages">
                        <div class="svg"><svg class="svgggg" data-lov-id="src/pages/WhyUs.tsx:38:8" data-lov-name="svg" data-component-path="src/pages/WhyUs.tsx" data-component-line="38" data-component-file="WhyUs.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22h-10%20w-10%22%7D" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path data-lov-id="src/pages/WhyUs.tsx:39:10" data-lov-name="path" data-component-path="src/pages/WhyUs.tsx" data-component-line="39" data-component-file="WhyUs.tsx" data-component-name="path" data-component-content="%7B%7D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                        <p class="content_advantages_text">Соблюдение сроков</p>
                        <p class="content_advantages_text_two">Мы ценим ваше время и всегда сдаем проекты в срок, а часто даже раньше оговоренной даты.</p>
                    </div>
                    <div class="content_advantages">
                        <div class="svg"><svg class="svgggg" data-lov-id="src/pages/WhyUs.tsx:47:8" data-lov-name="svg" data-component-path="src/pages/WhyUs.tsx" data-component-line="47" data-component-file="WhyUs.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22h-10%20w-10%22%7D" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path data-lov-id="src/pages/WhyUs.tsx:48:10" data-lov-name="path" data-component-path="src/pages/WhyUs.tsx" data-component-line="48" data-component-file="WhyUs.tsx" data-component-name="path" data-component-content="%7B%7D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path></svg></div>
                        <p class="content_advantages_text">Передача исходников</p>
                        <p class="content_advantages_text_two">По завершении работы вы получаете полные исходники проекта с возможностью дальнейших модификаций.</p>
                    </div>
                    <div class="content_advantages">
                        <div class="svg"><svg class="svgggg" data-lov-id="src/pages/WhyUs.tsx:56:8" data-lov-name="svg" data-component-path="src/pages/WhyUs.tsx" data-component-line="56" data-component-file="WhyUs.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22h-10%20w-10%22%7D" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path data-lov-id="src/pages/WhyUs.tsx:57:10" data-lov-name="path" data-component-path="src/pages/WhyUs.tsx" data-component-line="57" data-component-file="WhyUs.tsx" data-component-name="path" data-component-content="%7B%7D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                        <p class="content_advantages_text">Доступные цены</p>
                        <p class="content_advantages_text_two">Мы предлагаем конкурентные цены на все наши услуги с оптимальным соотношением цена-качество.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(isset($banners) && $banners->isNotEmpty())
    <section class="dc-section dc-section--content inner_portfolio_preview" style="padding: 4rem 0; background: linear-gradient(180deg, #f8fafc 0%, #fff 100%);">
        <style>
            .inner_portfolio_preview .container { max-width: 1200px; margin: 0 auto; padding: 0 1rem; }
            .inner_portfolio_preview .block_portfolio_preview { text-align: center; margin-bottom: 2.5rem; }
            .inner_portfolio_preview .block_portfolio_preview h1 { font-size: 2rem; margin-bottom: 0.5rem; color: #1e293b; }
            .inner_portfolio_preview .block_portfolio_preview h2 { font-size: 1rem; font-weight: 400; color: #64748b; max-width: 560px; margin: 0 auto; }
            .inner_portfolio_preview .portfolio_preview_grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 1.5rem; }
            .inner_portfolio_preview .portfolio_preview_card { background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08); transition: transform 0.2s, box-shadow 0.2s; }
            .inner_portfolio_preview .portfolio_preview_card:hover { transform: translateY(-4px); box-shadow: 0 12px 24px rgba(0,0,0,0.12); }
            .inner_portfolio_preview .portfolio_preview_card a { text-decoration: none; color: inherit; display: block; }
            .inner_portfolio_preview .portfolio_preview_card img { width: 100%; height: 200px; object-fit: cover; display: block; }
            .inner_portfolio_preview .portfolio_preview_card .portfolio_preview_title { padding: 1rem; font-weight: 600; color: #1e293b; }
            .inner_portfolio_preview .portfolio_preview_card .portfolio_preview_subtitle { padding: 0 1rem 1rem; font-size: 0.875rem; color: #64748b; }
            .inner_portfolio_preview .portfolio_preview_more { margin-top: 2rem; }
            .inner_portfolio_preview .portfolio_preview_more a { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: #1e40af; color: #fff; border-radius: 8px; font-weight: 600; text-decoration: none; transition: background 0.2s; }
            .inner_portfolio_preview .portfolio_preview_more a:hover { background: #1e3a8a; }
            .dark-theme .inner_portfolio_preview { background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%); }
            .dark-theme .inner_portfolio_preview .block_portfolio_preview h1 { color: #f1f5f9; }
            .dark-theme .inner_portfolio_preview .block_portfolio_preview h2 { color: #94a3b8; }
            .dark-theme .inner_portfolio_preview .portfolio_preview_card { background: #1e293b; }
            .dark-theme .inner_portfolio_preview .portfolio_preview_card .portfolio_preview_title { color: #f1f5f9; }
            .dark-theme .inner_portfolio_preview .portfolio_preview_card .portfolio_preview_subtitle { color: #94a3b8; }
        </style>
        <div class="container">
            <div class="block_portfolio_preview">
                <h1>Портфолио работ</h1>
                <h2>Примеры наших работ в различных направлениях дизайна</h2>
            </div>
            <div class="portfolio_preview_grid">
                @foreach($banners as $banner)
                <div class="portfolio_preview_card">
                    <a href="{{ route('portfolio') }}">
                        <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title }}">
                        <p class="portfolio_preview_title">{{ $banner->title }}</p>
                        <p class="portfolio_preview_subtitle">{{ $banner->subtitle }}</p>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="portfolio_preview_more">
                <a href="{{ route('portfolio') }}">Смотреть всё портфолио →</a>
            </div>
        </div>
    </section>
    @endif
    <section class="dc-section dc-section--content inner_numbers">
        <div class="container">
            <div class="block_numbers">
                <div class="content_block_numbers">
                    <p class="text_content_block_numbers">5+</p>
                    <p class="text_two_content_block_numbers">Лет опыта</p>
                </div>
                <div class="content_block_numbers">
                    <p class="text_content_block_numbers">1000+</p>
                    <p class="text_two_content_block_numbers">Довольных клиентов</p>
                </div>
                <div class="content_block_numbers">
                    <p class="text_content_block_numbers">5000+</p>
                    <p class="text_two_content_block_numbers">Завершенных проектов</p>
                </div>
                <div class="content_block_numbers">
                    <p class="text_content_block_numbers">24/7</p>
                    <p class="text_two_content_block_numbers">Поддержка клиентов</p>
                </div>
            </div>
        </div>
    </section>
    <section class="dc-section dc-section--content inner_reviews">
        <style>
            .inner_reviews{
                background-color: white;
            }
            .dark-theme .inner_reviews{
                background-color: #0f141d;
            }
        </style>
        <div class="container">
            <div class="block_reviews">
                <p class="block_working_text_h1">Отзывы</p>
                <div class="svg_reviews_block"></div>
                <h1>Что говорят наши клиенты</h1>
                <h2>Нас выбирают за качество, скорость и профессионализм. Вот что говорят те, кто уже воспользовался нашими услугами.</h2>
                @if($reviews->count() > 0)
                    <div class="reviews-slider-container">
                        <div class="reviews-slider" id="reviewsSlider">
                            @foreach($reviews as $review)
                                <div class="review-card">
                                    <div class="review-header">
                                        <div class="account-avatar">
                                            @if($review->user && $review->user->avatar)
                                                <img src="{{ asset('storage/' . $review->user->avatar) }}" 
                                                    alt="Аватар" 
                                                    style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                            @else
                                                <img class="avatar" src="{{ asset('image/3/1.png') }}" alt="">
                                                <style>
                                                    .avatar{
                                                        padding: 20px;
                                                    }
                                                </style>
                                            @endif
                                        </div>
                                        <div class="review-client-info">
                                            <h4>{{ $review->client_name }}</h4>
                                            @if($review->client_position)
                                                <p>{{ $review->client_position }}</p>
                                            @endif
                                        </div>

                                        @auth
                                            @if(Auth::user()->role === 'admin' || $review->user_id === Auth::id())
                                                <div class="review-actions">
                                                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="delete-review-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="delete-review-btn" onclick="return confirm('Вы уверены, что хотите удалить этот отзыв?')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M3 6h18"></path>
                                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>

                                    <div class="review-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="star {{ $i <= $review->rating ? '' : 'empty' }}" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="review-text">"{{ $review->review_text }}"</p>
                                    <div class="review-date">
                                        {{ $review->created_at->format('d.m.Y') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="slider-nav">
                            <button class="slider-btn" id="prevBtn"><span>‹</span></button>
                            <div class="slider-dots" id="sliderDots"></div>
                            <button class="slider-btn" id="nextBtn"><span>›</span></button>
                        </div>
                    </div>
                @else
                    <div style="text-align: center; padding: 40px 0;">
                        <p style="color: #6B7280; font-size: 16px;">Пока нет отзывов. Будьте первым!</p>
                    </div>
                @endif
                    @auth                                   
                <div class="review-form-container">
                    <h3 class="review-form-title">Оставьте свой отзыв</h3>
                    <p class="review-form-subtitle">Поделитесь вашим опытом работы с нами</p>
                    
                    <form class="review-form" action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="client_name">Ваше имя *</label>
                            <input type="text" id="client_name" name="client_name" required 
                                placeholder="Введите ваше имя" value="{{ Auth::check() ? Auth::user()->name : '' }}">
                            @error('client_name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="client_position">Ваша должность/род деятельности</label>
                            <input type="text" id="client_position" name="client_position" 
                                placeholder="Например: Блогер, Предприниматель, Студент">
                            @error('client_position')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label>Оценка *</label>
                            <div class="rating-select">
                                <div class="rating-stars" id="ratingStars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="rating-star" data-rating="{{ $i }}">★</span>
                                    @endfor
                                </div>
                                <input type="hidden" name="rating" id="ratingInput" value="5" required>
                            </div>
                            @error('rating')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="review_text">Текст отзыва *</label>
                            <textarea class="textarea" id="review_text" name="review_text" rows="5" required 
                                    placeholder="Расскажите о вашем опыте работы с нами..."></textarea>
                            @error('review_text')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="submit-review-btn_two">
                            Отправить отзыв
                            <button type="submit" class="submit-review-btn">
                                Спасибо за отзыв!
                            </button>
                        </div>
                    </form>
                </div>
                @endauth
            </div>
        </div>
    </section>
    <section class="dc-section dc-section--content inner_team">
        <style>
            .inner_team{
                background-color: #dff3ffff;
            }
        </style>
        <div class="container">
            <div class="block_team">
                <h1>Наша команда</h1>
                <h2>Познакомьтесь с профессионалами, которые воплощают ваши идеи в реальность.</h2>
                <div class="content_block_team">
                    <div class="content_team">
                        <div class="content_team_img_block"><img class="img_content_team_img_block" src="{{ asset('image/2/1.jpg') }}" alt=""></div>
                        <div class="content_team_block_text">
                            <p class="content_team_block_text_h1">Сандакрышин Иван</p>
                            <p class="content_team_block_text_h2">Основатель и арт-директор</p>
                            <p class="content_team_block_text_h3">Более 5 лет опыта в графическом дизайне. Специализируется на создании уникальных визуальных концепций.</p>
                        </div>
                    </div>
                    <div class="content_team">
                        <div class="content_team_img_block"><img class="img_content_team_img_block" src="{{ asset('image/2/2.jpg') }}" alt=""></div>
                        <div class="content_team_block_text">
                            <p class="content_team_block_text_h1">Струцкая Наталья</p>
                            <p class="content_team_block_text_h2">Старший дизайнер</p>
                            <p class="content_team_block_text_h3">Эксперт по Photoshop с особым талантом к созданию баннеров и аватарок для игровой индустрии.</p>
                        </div>
                    </div>
                    <div class="content_team">
                        <div class="content_team_img_block"><img class="img_content_team_img_block" src="{{ asset('image/2/3.jpg') }}" alt=""></div>
                        <div class="content_team_block_text">
                            <p class="content_team_block_text_h1">Красный Алексей</p>
                            <p class="content_team_block_text_h2">Moушн-дизайнер</p>
                            <p class="content_team_block_text_h3">Специалист по анимации и динамическим эффектам. Преображает статичные изображения в живые произведения искусства.</p>
                        </div>
                    </div>
                    <div class="content_team">
                        <div class="content_team_img_block"><img class="img_content_team_img_block" src="{{ asset('image/2/4.jpg') }}" alt=""></div>
                        <div class="content_team_block_text">
                            <p class="content_team_block_text_h1">Панин Олег</p>
                            <p class="content_team_block_text_h2">UI/UX дизайнер</p>
                            <p class="content_team_block_text_h3">Эксперт по созданию эффективных интерфейсов и баннеров, которые не только выглядят отлично, но и конвертируют.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="inner_advantages">
        <div class="container">
            <div class="news-grid">
                    <style>
                        /* Ваши существующие стили остаются без изменений */
                        .news-page {
                            min-height: 100vh;
                        }

                        .news-hero {
                            background: linear-gradient(135deg, #1E3A8A 0%, #1D4ED8 100%);
                            padding: 150px 0;
                            position: relative;
                            overflow: hidden;
                        }

                        .news-hero-content {
                            position: relative;
                            z-index: 2;
                            text-align: center;
                            max-width: 800px;
                            margin: 0 auto;
                        }

                        .news-hero h1 {
                            font-size: 3.5rem;
                            font-weight: 700;
                            color: white;
                            margin-bottom: 1rem;
                        }

                        .news-hero p {
                            font-size: 1.25rem;
                            color: #DBEAFE;
                            margin-bottom: 2rem;
                        }

                        /* Остальные стили из предыдущего ответа */
                    </style>
                    <style>
                        /* Стили для страницы новостей */
                    .news-page {
                        min-height: 100vh;
                    }

                    .news-hero {
                        background: linear-gradient(135deg, #1E3A8A 0%, #1D4ED8 100%);
                        padding: 150px 0;
                        position: relative;
                        overflow: hidden;
                    }

                    .news-hero-content {
                        position: relative;
                        z-index: 2;
                        text-align: center;
                        max-width: 800px;
                        margin: 0 auto;
                    }

                    .news-hero h1 {
                        font-size: 3.5rem;
                        font-weight: 700;
                        color: white;
                        margin-bottom: 1rem;
                    }

                    .news-hero p {
                        font-size: 1.25rem;
                        color: #DBEAFE;
                        margin-bottom: 2rem;
                    }

                    /* Сетка новостей */
                    .news-grid {
                        display: grid;
                        grid-template-columns: repeat(3, minmax(300px, 1fr));
                        gap: 2rem;
                        padding: 4rem 0;
                    }

                    .news-card {
                        background: white;
                        border-radius: 16px;
                        overflow: hidden;
                        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                        transition: all 0.3s ease;
                        position: relative;
                    }



                    .news-card.featured {
                        grid-column: 1 / -1;
                        display: grid;
                        grid-template-columns: 1fr 1fr;
                        gap: 0;
                    }

                    .news-image {
                        position: relative;
                        overflow: hidden;
                        height: 250px;
                    }

                    .news-card.featured .news-image {
                        height: 100%;
                        min-height: 400px;
                    }

                    .news-image img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                        transition: transform 0.5s ease;
                    }

                    .news-card:hover .news-image img {
                        transform: scale(1.05);
                    }

                    .news-category {
                        position: absolute;
                        top: 1rem;
                        left: 1rem;
                        background: linear-gradient(135deg, #3B82F6, #1D4ED8);
                        color: white;
                        padding: 0.5rem 1rem;
                        border-radius: 20px;
                        font-size: 0.875rem;
                        font-weight: 600;
                        text-transform: uppercase;
                        letter-spacing: 0.5px;
                    }

                    .news-date {
                        position: absolute;
                        top: 1rem;
                        right: 1rem;
                        background: rgba(255, 255, 255, 0.95);
                        color: #374151;
                        padding: 0.5rem 1rem;
                        border-radius: 8px;
                        font-size: 0.875rem;
                        font-weight: 500;
                    }

                    .news-content {
                        padding: 2rem;
                    }

                    .news-card.featured .news-content {
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                    }

                    .news-title {
                        font-size: 1.5rem;
                        min-height: 90px;
                        font-weight: 700;
                        color: #1F2937;
                        margin-bottom: 1rem;
                        line-height: 1.3;
                        display: -webkit-box;
                        -webkit-line-clamp: 3;
                        -webkit-box-orient: vertical;
                        overflow: hidden;
                    }

                    .news-card.featured .news-title {
                        font-size: 2rem;
                    }
                    .filter_blur{
                        filter: blur(2px);
                        transition: 0.3s;
                        opacity: 30%;
                    }
                    .filter_blur:hover{
                        filter: blur(0px);
                        opacity: 100%;
                    }
                    .news-excerpt {
                        color: #6B7280;
                        line-height: 1.6;
                        min-height: 76px;
                        margin-bottom: 1.5rem;
                        display: -webkit-box;
                        -webkit-line-clamp: 3;
                        -webkit-box-orient: vertical;
                        overflow: hidden;
                    }

                    .news-meta {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        margin-top: auto;
                        padding-top: 1.5rem;
                        border-top: 1px solid #F3F4F6;
                    }

                    .news-author {
                        display: flex;
                        align-items: center;
                        gap: 0.75rem;
                    }

                    .author-avatar {
                        width: 40px;
                        height: 40px;
                        border-radius: 50%;
                        background: linear-gradient(135deg, #3B82F6, #1D4ED8);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: white;
                        font-weight: 600;
                        font-size: 0.875rem;
                    }
                    .author-avatar-author-avatar{
                        width: 80px;
                    }

                    .author-info h4 {
                        font-size: 0.875rem;
                        font-weight: 600;
                        color: #374151;
                        margin: 0;
                    }

                    .author-info p {
                        font-size: 0.75rem;
                        color: #9CA3AF;
                        margin: 0;
                    }

                    .news-read-more {
                        background: linear-gradient(135deg, #3B82F6, #1D4ED8);
                        color: white;
                        padding: 0.75rem 1.5rem;
                        border-radius: 8px;
                        font-weight: 600;
                        font-size: 0.875rem;
                        transition: all 0.3s ease;
                        text-decoration: none !important;
                    }
                    .news-read-more-news-read-more-news-read-more{
                        display: flex;
                        align-items: center;
                        gap: 10px;
                        box-shadow: 0px 0px 0px 3px inset #0077B5;
                        color: #0077B5;
                        padding: 0.75rem 1.5rem;
                        border-radius: 8px;
                        font-weight: 600;
                        font-size: 0.875rem;
                        transition: all 0.3s ease;
                        text-decoration: none !important;
                    }
                    .news-read-more-news-read-more-news-read-more>svg{
                        stroke: #0077B5 !important;
                    }


                    /* Пагинация */
                    .news-pagination {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        gap: 1rem;
                        padding: 3rem 0;
                    }

                    .pagination-btn {
                        background: white;
                        border: 2px solid #E5E7EB;
                        color: #374151;
                        padding: 0.75rem 1.5rem;
                        border-radius: 8px;
                        font-weight: 600;
                        cursor: pointer;
                        transition: all 0.3s ease;
                    }

                    .pagination-btn:hover:not(:disabled) {
                        background: #3B82F6;
                        border-color: #3B82F6;
                        color: white;
                    }

                    .pagination-btn:disabled {
                        opacity: 0.5;
                        cursor: not-allowed;
                    }

                    .pagination-numbers {
                        display: flex;
                        gap: 0.5rem;
                    }

                    .page-number {
                        width: 40px;
                        height: 40px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border-radius: 8px;
                        font-weight: 600;
                        cursor: pointer;
                        transition: all 0.3s ease;
                    }

                    .page-number.active {
                        background: linear-gradient(135deg, #3B82F6, #1D4ED8);
                        color: white;
                    }

                    .page-number:not(.active):hover {
                        background: #F3F4F6;
                    }

                    /* Фильтры новостей */
                    .news-filters {
                        background: white;
                        padding: 2rem 0;
                        border-bottom: 1px solid #E5E7EB;
                        position: sticky;
                        top: 50px;
                        z-index: 100;
                    }

                    .filter-container {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        flex-wrap: wrap;
                        gap: 1rem;
                    }

                    .filter-categories {
                        display: flex;
                        gap: 0.5rem;
                        flex-wrap: wrap;
                    }

                    .filter-category {
                        padding: 0.5rem 1rem;
                        border: 2px solid #E5E7EB;
                        border-radius: 20px;
                        font-weight: 500;
                        cursor: pointer;
                        transition: all 0.3s ease;
                    }

                    .filter-category.active,
                    .filter-category:hover {
                        background: linear-gradient(135deg, #3B82F6, #1D4ED8);
                        border-color: #3B82F6;
                        color: white;
                    }

                    .search-box {
                        position: relative;
                        min-width: 300px;
                    }

                    .search-box input {
                        width: 100%;
                        padding: 0.75rem 1rem 0.75rem 2.5rem;
                        border: 2px solid #E5E7EB;
                        border-radius: 20px;
                        font-size: 0.875rem;
                        transition: all 0.3s ease;
                    }

                    .search-box input:focus {
                        outline: none;
                        border-color: #3B82F6;
                        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
                    }

                    .search-icon {
                        position: absolute;
                        left: 1rem;
                        top: 50%;
                        transform: translateY(-50%);
                        color: #9CA3AF;
                    }

                    /* Страница отдельной новости */
                    .news-single {
                        padding: 4rem 0;
                    }

                    .news-single-header {
                        text-align: center;
                        max-width: 800px;
                        margin: 0 auto 4rem;
                    }

                    .news-single-title {
                        font-size: 3rem;
                        font-weight: 700;
                        color: #1F2937;
                        margin-bottom: 1rem;
                        line-height: 1.2;
                    }

                    .news-single-meta {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        gap: 2rem;
                        margin-bottom: 2rem;
                        flex-wrap: wrap;
                    }

                    .news-single-date,
                    .news-single-category,
                    .news-single-views {
                        display: flex;
                        align-items: center;
                        gap: 0.5rem;
                        color: #6B7280;
                        font-weight: 500;
                    }

                    .news-single-image {
                        width: 100%;
                        height: 500px;
                        border-radius: 20px;
                        overflow: hidden;
                        margin-bottom: 3rem;
                    }

                    .news-single-image img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }

                    .news-single-content {
                        max-width: 800px;
                        margin: 0 auto;
                        font-size: 1.125rem;
                        line-height: 1.7;
                        color: #374151;
                    }

                    .news-single-content h2 {
                        font-size: 2rem;
                        font-weight: 700;
                        color: #1F2937;
                        margin: 3rem 0 1.5rem;
                    }

                    .news-single-content h3 {
                        font-size: 1.5rem;
                        font-weight: 600;
                        color: #1F2937;
                        margin: 2rem 0 1rem;
                    }

                    .news-single-content p {
                        margin-bottom: 1.5rem;
                    }

                    .news-single-content blockquote {
                        border-left: 4px solid #3B82F6;
                        padding-left: 2rem;
                        margin: 2rem 0;
                        font-style: italic;
                        color: #6B7280;
                        background: #F8FAFC;
                        padding: 2rem;
                        border-radius: 0 8px 8px 0;
                    }

                    .news-single-content img {
                        width: 100%;
                        height: auto;
                        border-radius: 12px;
                        margin: 2rem 0;
                    }

                    .news-single-footer {
                        max-width: 800px;
                        margin: 4rem auto 0;
                        padding-top: 3rem;
                        border-top: 1px solid #E5E7EB;
                    }

                    .news-tags {
                        display: flex;
                        gap: 0.5rem;
                        flex-wrap: wrap;
                        margin-bottom: 2rem;
                    }

                    .news-tag {
                        background: #F3F4F6;
                        color: #374151;
                        padding: 0.5rem 1rem;
                        border-radius: 20px;
                        font-size: 0.875rem;
                        font-weight: 500;
                    }

                    .news-share {
                        display: flex;
                        align-items: center;
                        gap: 1rem;
                    }

                    .news-share span {
                        font-weight: 600;
                        color: #374151;
                    }

                    .share-buttons {
                        display: flex;
                        gap: 0.5rem;
                    }

                    .share-button {
                        width: 40px;
                        height: 40px;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        background: #F3F4F6;
                        color: #374151;
                        transition: all 0.3s ease;
                        text-decoration: none;
                    }

                    .share-button:hover {
                        transform: translateY(-2px);
                        color: white;
                    }

                    .share-button.facebook:hover { background: #1877F2; }
                    .share-button.twitter:hover { background: #1DA1F2; }
                    .share-button.linkedin:hover { background: #0077B5; }
                    .share-button.telegram:hover { background: #0088CC; }

                    /* Адаптивность */
                    @media (max-width: 768px) {
                        .news-grid {
                            grid-template-columns: 1fr;
                            gap: 1.5rem;
                            padding: 2rem 0;
                        }
                        
                        .news-card.featured {
                            grid-column: 1;
                            grid-template-columns: 1fr;
                        }
                        
                        .news-hero h1 {
                            font-size: 2.5rem;
                        }
                        
                        .news-single-title {
                            font-size: 2rem;
                        }
                        
                        .news-single-image {
                            height: 300px;
                        }
                        
                        .filter-container {
                            flex-direction: column;
                            align-items: stretch;
                        }
                        
                        .search-box {
                            min-width: auto;
                        }
                        
                        .news-pagination {
                            flex-wrap: wrap;
                        }
                    }

                    /* Темная тема */
                    .dark-theme .news-card,
                    .dark-theme .news-filters,
                    .dark-theme .pagination-btn,
                    .dark-theme .search-box input {
                        background: #2D3748;
                        color: #E2E8F0;
                    }

                    .dark-theme .news-title,
                    .dark-theme .news-single-title {
                        color: #F7FAFC;
                    }

                    .dark-theme .news-excerpt,
                    .dark-theme .news-single-content {
                        color: #CBD5E0;
                    }

                    .dark-theme .news-date,
                    .dark-theme .filter-category,
                    .dark-theme .search-box input {
                        background: #4A5568;
                        border-color: #4A5568;
                        color: #E2E8F0;
                    }

                    .dark-theme .news-meta,
                    .dark-theme .news-single-footer {
                        border-color: #4A5568;
                    }

                    .dark-theme .news-tag,
                    .dark-theme .share-button {
                        background: #4A5568;
                        color: #CBD5E0;
                    }

                    .dark-theme .search-box input:focus {
                        border-color: #63B3ED;
                        box-shadow: 0 0 0 3px rgba(99, 179, 237, 0.1);
                    }

                    /* Анимации */
                    @keyframes fadeInUp {
                        from {
                            opacity: 0;
                            transform: translateY(30px);
                        }
                        to {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }

                    .news-card {
                        animation: fadeInUp 0.6s ease-out;
                    }

                    .news-card:nth-child(2) { animation-delay: 0.1s; }
                    .news-card:nth-child(3) { animation-delay: 0.2s; }
                    .news-card:nth-child(4) { animation-delay: 0.3s; }
                    .news-card:nth-child(5) { animation-delay: 0.4s; }
                    .news-card:nth-child(6) { animation-delay: 0.5s; }

                    /* Индикатор загрузки */
                    .news-loading {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        padding: 4rem;
                    }

                    .loading-spinner {
                        width: 40px;
                        height: 40px;
                        border: 4px solid #F3F4F6;
                        border-top: 4px solid #3B82F6;
                        border-radius: 50%;
                        animation: spin 1s linear infinite;
                    }

                    @keyframes spin {
                        0% { transform: rotate(0deg); }
                        100% { transform: rotate(360deg); }
                    }
                    .account-avatar-account-avatar{
                        width: 40px;
                        height: 40px;
                        box-shadow: 0px 0px 1px 1px #0077B5;
                        border-radius: 50%;
                    }
                    </style>
                    @php
                        $regularItems = $news->where('is_featured', false)->take(3);
                    @endphp
                @foreach($regularItems as $item)
                    <article class="news-card">
                        <div class="news-image">
                            @if($item->image_path && Storage::disk('public')->exists($item->image_path))
                                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}">
                            @else
                                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #3B82F6, #1D4ED8); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                    <span></span>
                                </div>
                            @endif
                            <div class="news-category">{{ $item->category }}</div>
                            <div class="news-date">{{ $item->published_at->format('d M Y') }}</div>
                        </div>
                        <div class="news-content">
                            <h3 class="news-title">{{ $item->title }}</h3>
                            <p class="news-excerpt">{{ $item->excerpt }}</p>
                            <div class="news-meta">
                                <div class="news-author">
                                    <div class="account-avatar-account-avatar">
                                        @if($item->user && $item->user->avatar)
                                            <img src="{{ asset('storage/' . $item->user->avatar) }}" 
                                                alt="Аватар" 
                                                style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                        @else
                                            <img class="avatar" src="{{ asset('image/3/1.png') }}" alt="Аватар по умолчанию">
                                        @endif
                                    </div>
                                    <div class="author-info">
                                        <h4>{{ $item->user->name ?? ($item->author->name ?? 'Автор') }}</h4>
                                        <p>Автор</p>
                                    </div>
                                </div>
                                <a href="{{ route('news.show', $item->slug) }}" class="news-read-more">Читать</a>
                            </div>
                            @if(auth()->check() && in_array(auth()->user()->role, ['admin', 'moderator']))
                            <div class="filter_blur" style="margin-top: 1rem; display: flex; gap: 0.5rem;">
                                <a href="{{ route('news.edit', $item->id) }}" class="news-read-more" style="background: #0076a5ff; padding: 0.5rem 1rem; font-size: 0.75rem;">
                                    Редактировать
                                </a>
                                <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="news-read-more" style="background: #002d52ff; padding: 0.5rem 1rem; font-size: 0.75rem; border: none; cursor: pointer;" 
                                            onclick="return confirm('Удалить эту новость?')">
                                        Удалить
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
    <section class="dc-section dc-section--content inner_questions" id="question">
        <style>
            .inner_questions{
                background-color: white;
            }
        </style>
        <div class="container">
            <div class="block___questions">
                <h1>Часто задаваемые вопросы</h1>
                <h2>Ответы на наиболее часто задаваемые вопросы о нашем процессе работы.</h2>
                <div class="block___questions_block_text">
                    <div class="block___questions_block_text_h1">
                        <h1>Как быстро вы выполняете заказы?</h1>
                        <h2>Сроки выполнения зависят от сложности проекта. Простые аватарки могут быть готовы за 1-2 дня, для более сложных проектов может потребоваться до 7-10 рабочих дней.</h2>
                    </div>
                    <div class="block___questions_block_text_h1">
                        <h1>Работаете ли вы по выходным?</h1>
                        <h2>Мы работаем в субботу по предварительной договоренности. Воскресенье — выходной день.</h2>
                    </div>
                    <div class="block___questions_block_text_h1">
                        <h1>Есть ли у вас скидки для постоянных клиентов?</h1>
                        <h2>Да, для постоянных клиентов у нас предусмотрена система скидок. Также действуют специальные предложения при заказе нескольких услуг одновременно.</h2>
                    </div>
                    <div class="block___questions_block_text_h1">
                        <h1>Как происходит процесс оплаты?</h1>
                        <h2>Мы работаем по предоплате 50%. После утверждения финальной версии и внесения оставшейся оплаты вы получаете все готовые файлы.</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="dc-section dc-footer-cta inner_footer_two">
        <div class="container">
            <div class="block_footer_two">
                <p class="text_botton_footer_two">Готовы начать проект?</p>
                <p class="text_botton_footer__two">Свяжитесь с нами сегодня и получите консультацию по вашему проекту. Мы поможем воплотить ваши идеи в реальность!</p>
                <div class="botton_footer_two_block">
                    <a class="botton_footer_two" href="{{ Auth::check() ? url('/contacts') : route('login') }}">Связаться с нами</a>
                    <a class="botton_footer__two" href="{{ Auth::check() ? url('/services') : route('login') }}">Посмотреть услуги</a>
                </div>
            </div>
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
<script>
document.getElementById('orderForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitBtn');
    const form = document.querySelector('form');
    const successMessage = document.getElementById('successMessage');
    

    submitBtn.classList.add('loading');
    submitBtn.disabled = true;
    

    form.style.opacity = '0';
    form.style.transform = 'scale(0.9) translateY(-20px)';
    form.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
    
    setTimeout(() => {

        form.style.display = 'none';
        

        successMessage.style.display = 'block';
        

        setTimeout(() => {
            successMessage.style.opacity = '1';
            successMessage.style.transform = 'translate(-50%, -50%) scale(1)';
        }, 50);
        

        sendFormData(this);
        

        setTimeout(closeModal, 5000);
        
    }, 400);
});

function sendFormData(form) {
    const formData = new FormData(form);
    
    fetch('{{ route('new') }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('Форма успешно отправлена:', data);
    })
    .catch(error => {
        console.error('Ошибка отправки формы:', error);
    });
}

function closeModal() {
    const modal = document.getElementById('modal');
    const form = document.querySelector('form');
    const successMessage = document.getElementById('successMessage');
    const submitBtn = document.getElementById('submitBtn');
    

    modal.style.display = 'none';
    

    form.reset();
    form.style.display = 'block';
    form.style.opacity = '1';
    form.style.transform = 'scale(1) translateY(0)';
    form.style.transition = 'none';
    

    successMessage.style.display = 'none';
    successMessage.style.opacity = '0';
    successMessage.style.transform = 'translate(-50%, -50%) scale(0.9)';
    

    submitBtn.classList.remove('loading');
    submitBtn.disabled = false;
}

function openModal() {
    window.location.href = '{{ route("order.create") }}';
}
</script>
<script>

    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('.rating-star');
        const ratingInput = document.getElementById('ratingInput');
        
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = this.getAttribute('data-rating');
                ratingInput.value = rating;
                

                stars.forEach(s => {
                    if (s.getAttribute('data-rating') <= rating) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });
            });
            
            star.addEventListener('mouseover', function() {
                const rating = this.getAttribute('data-rating');
                stars.forEach(s => {
                    if (s.getAttribute('data-rating') <= rating) {
                        s.style.color = '#FBBF24';
                    } else {
                        s.style.color = '#E5E7EB';
                    }
                });
            });
            
            star.addEventListener('mouseout', function() {
                const currentRating = ratingInput.value;
                stars.forEach(s => {
                    if (s.getAttribute('data-rating') <= currentRating) {
                        s.style.color = '#FBBF24';
                    } else {
                        s.style.color = '#E5E7EB';
                    }
                });
            });
        });
        

        stars.forEach(star => {
            if (star.getAttribute('data-rating') <= ratingInput.value) {
                star.classList.add('active');
            }
        });


        initReviewsSlider();
    });


    function initReviewsSlider() {
        const slider = document.getElementById('reviewsSlider');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const dotsContainer = document.getElementById('sliderDots');
        
        if (!slider) return;
        
        const cards = slider.querySelectorAll('.review-card');
        if (cards.length === 0) return;
        
        let currentIndex = 0;
        const cardWidth = 350;
        const visibleCards = Math.floor(slider.parentElement.offsetWidth / cardWidth);
        

        cards.forEach((_, index) => {
            const dot = document.createElement('div');
            dot.className = `slider-dot ${index === 0 ? 'active' : ''}`;
            dot.addEventListener('click', () => goToSlide(index));
            dotsContainer.appendChild(dot);
        });
        
        const dots = document.querySelectorAll('.slider-dot');
        

        function updateSlider() {
            const translateX = -currentIndex * cardWidth;
            slider.style.transform = `translateX(${translateX}px)`;
            

            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentIndex);
            });
            

            prevBtn.disabled = currentIndex === 0;
            nextBtn.disabled = currentIndex >= cards.length - visibleCards;
        }
        

        function goToSlide(index) {
            currentIndex = Math.max(0, Math.min(index, cards.length - visibleCards));
            updateSlider();
        }

        prevBtn.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateSlider();
            }
        });
        
        nextBtn.addEventListener('click', () => {
            if (currentIndex < cards.length - visibleCards) {
                currentIndex++;
                updateSlider();
            }
        });
        

        window.addEventListener('resize', () => {
            const newVisibleCards = Math.floor(slider.parentElement.offsetWidth / cardWidth);
            if (currentIndex > cards.length - newVisibleCards) {
                currentIndex = Math.max(0, cards.length - newVisibleCards);
            }
            updateSlider();
        });
        

        updateSlider();
    }
</script>
@endsection