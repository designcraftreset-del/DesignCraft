@extends('layouts.app')
@section('hideHeader')

@endsection
@section('skeleton')
    @include('skeletons.home')
@endsection
@section('content')
<body>
<style>
    .rating-star{
        color: #ff8400 !important;
    }
    /* Улучшения доступности */
    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
    }
    
    /* Фокус состояния для доступности */
    button:focus,
    a:focus,
    input:focus,
    textarea:focus,
    select:focus {
        outline: 2px solid #0066ff;
        outline-offset: 2px;
    }
    
    /* Плавная прокрутка */
    html {
        scroll-behavior: smooth;
    }
    
    /* Оптимизация для слайдера отзывов */
    .reviews-slider {
        display: flex;
        transition: transform 0.3s ease;
    }
    
    .slider-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    /* Улучшение модального окна */
    .modal {
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        display: none;
    }
    
    .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 2rem;
        border-radius: 8px;
        width: 90%;
        max-width: 500px;
        position: relative;
    }
    
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        position: absolute;
        right: 1rem;
        top: 1rem;
    }
    
    .close:hover {
        color: black;
    }
</style>
<style>
    .rating-star{
        color: #ff8400 !important;
    }
    /* Звёзды рейтинга в тёмной теме — всегда видны при выборе */
    body.dark-theme .rating-stars .rating-star {
        color: #f59e0b !important;
    }
    body.dark-theme .rating-stars .rating-star:hover,
    body.dark-theme .rating-stars .rating-star.active {
        color: #fbbf24 !important;
    }
    body.dark-theme .rating-select label {
        color: #e2e8f0 !important;
    }
</style>
<main class="main">
        <section class="hero" style="height: 95vh;">
            <div class="container">
                <div class="hero_block">
                    <div class="hero_content_text">
                        <h1>Профессиональный <br><span>дизайн</span> для вашего <br>проекта <span>@auth{{ Str::limit(auth()->user()->name, 7) }}@endauth</span></h1>
                        <h2 class="h2">Мы создаем привлекательные визуальные решения, которые помогают вашему бренду выделяться. От превью до анимаций — мы делаем все!</h2>
                        <div class="hero_content_text_block">
                            <a class="hero_href" href="{{ Auth::check() ? url('/services') : route('login') }}">Наши услуги</a>
                            <a class="hero_href_two" href="{{ Auth::check() ? url('/contacts') : route('login') }}">Связаться с нами</a>
                        </div>
                    </div>
                    <style>
                        
                    </style>
                    <div class="content_block_hero">
                        <div class="hover_circle">Дизайн</div>
                        <div id="animatedBox" class="block_hero_design_1"><a href="{{ Auth::check() ? url('/services') : route('login') }}">Баннеры</a></div>
                        <div id="animatedBox" class="block_hero_design_1"><a href="{{ Auth::check() ? url('/services') : route('login') }}">Аватарки</a></div>
                        <div id="animatedBox" class="block_hero_design_1"><a href="{{ Auth::check() ? url('/services') : route('login') }}">Логотипы</a></div>
                        <div id="animatedBox" class="block_hero_design_1"><a href="{{ Auth::check() ? url('/services') : route('login') }}">Анимации</a></div>
                    </div>
                </div>
            </div>
            <a href="#services">
                <div class="svg_hero">
                    <svg data-lov-id="src/components/HeroSection.tsx:9:8" data-lov-name="svg" data-component-path="src/components/HeroSection.tsx" data-component-line="9" data-component-file="HeroSection.tsx" data-component-name="svg" data-component-content="%7B%7D" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"><defs data-lov-id="src/components/HeroSection.tsx:10:10" data-lov-name="defs" data-component-path="src/components/HeroSection.tsx" data-component-line="10" data-component-file="HeroSection.tsx" data-component-name="defs" data-component-content="%7B%7D"><pattern data-lov-id="src/components/HeroSection.tsx:11:12" data-lov-name="pattern" data-component-path="src/components/HeroSection.tsx" data-component-line="11" data-component-file="HeroSection.tsx" data-component-name="pattern" data-component-content="%7B%7D" id="grid" width="30" height="30" patternUnits="userSpaceOnUse"><path data-lov-id="src/components/HeroSection.tsx:12:14" data-lov-name="path" data-component-path="src/components/HeroSection.tsx" data-component-line="12" data-component-file="HeroSection.tsx" data-component-name="path" data-component-content="%7B%7D" d="M 30 0 L 0 0 0 30" fill="none" stroke="white" stroke-width="0.5"></path></pattern></defs><rect data-lov-id="src/components/HeroSection.tsx:15:10" data-lov-name="rect" data-component-path="src/components/HeroSection.tsx" data-component-line="15" data-component-file="HeroSection.tsx" data-component-name="rect" data-component-content="%7B%7D" width="100%" height="100%" fill="url(#grid)"></rect></svg>
                </div>
            </a>
        </section>
        <section class="inner_services" id="services" style="padding-top: 0rem !important;">

            <div class="container" style="padding-top: 7rem !important;">
                <div class="inner_services_block">
                    <h1 style=" padding: 5px 30px 10px 30px; color: #0066ffff;">Наши услуги</h1>
                    <h2 >Предлагаем широкий спектр услуг по дизайну в Photoshop для всех ваших проектов. От простых аватарок до сложных анимаций — мы делаем всё на высшем уровне.</h2>
                    <div class="inner_services_content">
                        <div class="inner_services_content_block_two">
                            <div class="inner_services_content_block_two_two"></div>
                            <div class="inner_services_content_block_two_two"></div>
                            <div class="inner_services_content_block_two_two"></div>
                            <div class="inner_services_content_block_two_two"></div>
                            <div class="inner_services_content__block">
                                <div class="inner_services_content___block">
                                    <div class="svg"><svg class="svgg" data-lov-id="src/pages/Index.tsx:27:8" data-lov-name="svg" data-component-path="src/pages/Index.tsx" data-component-line="27" data-component-file="Index.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-6%20h-6%22%7D" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path data-lov-id="src/pages/Index.tsx:28:10" data-lov-name="path" data-component-path="src/pages/Index.tsx" data-component-line="28" data-component-file="Index.tsx" data-component-name="path" data-component-content="%7B%7D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg></div>
                                    <p class="ava_text">Аватарки</p>
                                    <p class="text_inner_services">Профессиональные аватарки для соцсетей и игровых профилей</p>
                                    <p class="inner_services_text">1800 <span>₽</span></p>
                                    <div class="services_content_svg_text_block">
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>2 варианта на выбор</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Исходник в PSD</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Адаптация для разных платформ</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Быстрая работа</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="botton_services" onclick="openModal()">Заказать</p>
                            </div>
                        </div>
                        <div class="inner_services_content_block">
                            <p class="inner_services_content_block_h1">Популярный выбор</p>
                            <div class="inner_services_content__block">
                                <div class="inner_services_content___block">
                                    <div class="svg"><svg class="svgg" data-lov-id="src/pages/Index.tsx:16:8" data-lov-name="svg" data-component-path="src/pages/Index.tsx" data-component-line="16" data-component-file="Index.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-6%20h-6%22%7D" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path data-lov-id="src/pages/Index.tsx:17:10" data-lov-name="path" data-component-path="src/pages/Index.tsx" data-component-line="17" data-component-file="Index.tsx" data-component-name="path" data-component-content="%7B%7D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg></div>
                                    <p class="ava_text">Превью</p>
                                    <p class="text_inner_services">Привлекательные превью-изображения для ваших видео и контента</p>
                                    <p class="inner_services_text">2500 <span>₽</span></p>
                                    <div class="services_content_svg_text_block">
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Уникальный дизайн</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Правки до утверждения</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Исходник в PSD</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Быстрая работа</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="botton_services" onclick="openModal()">Заказать</p>
                            </div>
                        </div>
                        <div class="inner_services_content_block__two">
                            <div class="inner_services_content_block_two_two"></div>
                            <div class="inner_services_content_block_two_two"></div>
                            <div class="inner_services_content_block_two_two"></div>
                            <div class="inner_services_content_block_two_two"></div>
                            <div class="inner_services_content__block">
                                <div class="inner_services_content___block">
                                    <div class="svg"><svg class="svgg" data-lov-id="src/pages/Index.tsx:39:8" data-lov-name="svg" data-component-path="src/pages/Index.tsx" data-component-line="39" data-component-file="Index.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-6%20h-6%22%7D" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path data-lov-id="src/pages/Index.tsx:40:10" data-lov-name="path" data-component-path="src/pages/Index.tsx" data-component-line="40" data-component-file="Index.tsx" data-component-name="path" data-component-content="%7B%7D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>
                                    <p class="ava_text">Баннеры</p>
                                    <p class="text_inner_services">Эффектные баннеры для сайтов, соцсетей и рекламы</p>
                                    <p class="inner_services_text">3200 <span>₽</span></p>
                                    <div class="services_content_svg_text_block">
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Адаптивный дизайн</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Несколько форматов</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Исходник в PSD</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Неограниченные правки</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="botton_services" onclick="openModal()">Заказать</p>
                            </div>
                        </div>
                    </div>
                    <a class="botton_index-3" href="{{ Auth::check() ? url('/services') : route('login') }}">Посмотреть все услуги</a>
                </div>
            </div>
            <!-- <img class="img_inner_services" src="../../../localhost/image/img_inner_services_JPG.jpg" alt=""> -->
        </section>
        <section class="inner_portfolio">
            <div class="container">
                <div class="block_portfolio">
                    <h1>Наше портфолио</h1>
                    <h2>Ознакомьтесь с нашими лучшими работами. Каждый проект уникален и создан с учетом всех пожеланий клиента.</h2>
                    <div class="conten_block_portfolio__two">
                        <div class="content_portfolio">
                            <div class="conten_block_portfolio">
                                <div class="conten_block_portfolio_text_hover">
                                    <div class="">
                                        <p class="conten_block_portfolio_text">Дизайн для группы</p>
                                        <p class="conten_block_portfolio_text_two">Аватарка</p>
                                    </div>
                                </div>
                                <img class="img" src="{{ url('image/1/1.jpg') }}" alt="" loading="lazy">
                            </div>
                            <div class="conten_block_portfolio">
                                <div class="conten_block_portfolio_text_hover">
                                    <div class="">
                                        <p class="conten_block_portfolio_text">Кибер-спорт группа</p>
                                        <p class="conten_block_portfolio_text_two">Аватарка</p>
                                    </div>
                                </div>
                                <img class="img" src="{{ url('image/1/2.jpg') }}" alt="" loading="lazy">
                            </div>
                            <div class="conten_block_portfolio">
                                <div class="conten_block_portfolio_text_hover">
                                    <div class="">
                                        <p class="conten_block_portfolio_text">Дизайн для группы</p>
                                        <p class="conten_block_portfolio_text_two">Аватарка</p>
                                    </div>
                                </div>
                                <img class="img" src="{{ url('image/1/3.jpg') }}" alt="" loading="lazy">
                            </div>
                        </div>
                        <div class="conten_block_portfolio_two">
                            <div class="conten_block_portfolio_text_hover">
                                <div class="">
                                    <p class="conten_block_portfolio_text">Дизайн для группы</p>
                                    <p class="conten_block_portfolio_text_two">Баннер</p>
                                </div>
                            </div>
                            <img class="img" src="{{ url('image/1/4.jpg') }}" alt="" loading="lazy">
                        </div>
                    </div>
                    <a class="botton_index-3" href="{{ Auth::check() ? url('/portfolio') : route('login') }}">Посмотреть ещё</a>
                </div>
            </div>
        </section>

        {{-- Секция До / После --}}
        <section class="before-after-section">
            <div class="container">
                <div class="before-after-section__header">
                    <h1>До и После</h1>
                    <h2>Двигайте ползунок — слева исходный материал, справа готовый дизайн.</h2>
                </div>
                <div class="before-after-wrap">
                    <div class="before-after-inner">
                        <img src="/image/before-after/before.jpg" alt="До" class="before-after-img before-after-img--before" loading="lazy">
                        <div class="before-after-clip">
                            <img src="/image/before-after/after.jpg" alt="После" class="before-after-img before-after-img--after" loading="lazy">
                        </div>
                        <input type="range" id="beforeAfterSlider" class="before-after-range" min="0" max="100" value="50" aria-label="Сравнение до и после">
                        <div class="before-after-handle" id="beforeAfterHandle" aria-hidden="true">
                            <span class="before-after-handle-dot"></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <style>
        .before-after-section { padding: 4rem 0; background: #f8fafc; }
        .dark-theme .before-after-section { background: #0f172a; }
        .before-after-section__header { text-align: center; margin-bottom: 2rem; text-align: center; display: flex; flex-direction: column; align-items: center; gap: 20px; }
        .before-after-section__title { font-size: 1.75rem; margin: 0 0 0.5rem; color: #1e293b; }
        .dark-theme .before-after-section__title { color: #f1f5f9; }
        .before-after-section__subtitle { margin: 0; color: #64748b; font-size: 1rem; }
        .dark-theme .before-after-section__subtitle { color: #94a3b8; }
        .before-after-wrap { max-width: 800px; margin: 0 auto; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.12); }
        .dark-theme .before-after-wrap { box-shadow: 0 10px 40px rgba(0,0,0,0.4); }
        .before-after-inner { position: relative; aspect-ratio: 16/10; }
        .before-after-img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; display: block; }
        .before-after-clip { position: absolute; inset: 0; clip-path: inset(0 50% 0 0); }
        .before-after-range { position: absolute; inset: 0; width: 100%; height: 100%; margin: 0; opacity: 0; cursor: ew-resize; z-index: 2; }
        .before-after-handle { position: absolute; top: 0; bottom: 0; left: 50%; width: 4px; background: #fff; box-shadow: 0 0 12px rgba(0,0,0,0.4); pointer-events: none; z-index: 1; transition: left 0.05s ease; }
        .before-after-handle-dot { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 40px; height: 40px; background: #fff; border-radius: 50%; box-shadow: 0 2px 12px rgba(0,0,0,0.3); }
        @media (max-width: 768px) { .before-after-section { padding: 2.5rem 0; } .before-after-section__title { font-size: 1.4rem; } }
        </style>
        <script>
        (function() {
            var slider = document.getElementById('beforeAfterSlider');
            var clip = document.querySelector('.before-after-clip');
            var handle = document.getElementById('beforeAfterHandle');
            if (!slider || !clip || !handle) return;
            function move(v) {
                var pct = Math.min(100, Math.max(0, v));
                clip.style.clipPath = 'inset(0 ' + (100 - pct) + '% 0 0)';
                handle.style.left = pct + '%';
                slider.value = pct;
            }
            slider.addEventListener('input', function() { move(Number(this.value)); });
            move(50);
        })();
        </script>

        <section class="inner_working">
            <div class="container">
                <div class="block_working">
                    <p class="block_working_text_h1">Наш подход</p>
                    <h1>Как мы работаем</h1>
                    <h2>Наш процесс работы прост и эффективен. Мы делаем всё, чтобы вы получили идеальный результат.</h2>
                    <div class="content_working">
                        <div class="block_content_working">
                            <div class="svg"><svg class="svgg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users text-blue-600 h-8 w-8" data-lov-id="src/pages/Index.tsx:197:18" data-lov-name="Users" data-component-path="src/pages/Index.tsx" data-component-line="197" data-component-file="Index.tsx" data-component-name="Users" data-component-content="%7B%22className%22%3A%22text-blue-600%20h-8%20w-8%22%7D"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg></div>
                            <h5>01. Обсуждение</h5>
                            <h6>Выясняем ваши потребности и детали проекта</h6>
                        </div>
                        <div class="block_content_working">
                            <div class="svg"><svg class="svgg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wrench text-blue-600 h-8 w-8" data-lov-id="src/pages/Index.tsx:205:18" data-lov-name="Wrench" data-component-path="src/pages/Index.tsx" data-component-line="205" data-component-file="Index.tsx" data-component-name="Wrench" data-component-content="%7B%22className%22%3A%22text-blue-600%20h-8%20w-8%22%7D"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg></div>
                            <h5>02. Дизайн</h5>
                            <h6>Создаем первую версию вашего дизайна</h6>
                        </div>
                        <div class="block_content_working">
                            <div class="svg"><svg class="svgg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings text-blue-600 h-8 w-8" data-lov-id="src/pages/Index.tsx:213:18" data-lov-name="Settings" data-component-path="src/pages/Index.tsx" data-component-line="213" data-component-file="Index.tsx" data-component-name="Settings" data-component-content="%7B%22className%22%3A%22text-blue-600%20h-8%20w-8%22%7D"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path><circle cx="12" cy="12" r="3"></circle></svg></div>
                            <h5>03. Доработка</h5>
                            <h6>Вносим правки до полного утверждения</h6>
                        </div>
                        <div class="block_content_working">
                            <div class="svg"><svg class="svgg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big text-blue-600 h-8 w-8" data-lov-id="src/pages/Index.tsx:221:18" data-lov-name="CheckCircle" data-component-path="src/pages/Index.tsx" data-component-line="221" data-component-file="Index.tsx" data-component-name="CheckCircle" data-component-content="%7B%22className%22%3A%22text-blue-600%20h-8%20w-8%22%7D"><path d="M21.801 10A10 10 0 1 1 17 3.335"></path><path d="m9 11 3 3L22 4"></path></svg></div>
                            <h5>04. Результат</h5>
                            <h6>Передаем готовый дизайн и исходники</h6>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('partials.reviews-section', ['reviews' => $reviews])
        
    </main>
        @include('partials.footer')
 
</body>
<script>
    // Валидация телефона
    document.addEventListener('DOMContentLoaded', function() {
        const phoneInput = document.getElementById('phone');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.startsWith('7') || value.startsWith('8')) {
                    value = value.substring(1);
                }
                
                let formattedValue = '+7 (';
                if (value.length > 0) {
                    formattedValue += value.substring(0, 3);
                }
                if (value.length > 3) {
                    formattedValue += ') ' + value.substring(3, 6);
                }
                if (value.length > 6) {
                    formattedValue += '-' + value.substring(6, 8);
                }
                if (value.length > 8) {
                    formattedValue += '-' + value.substring(8, 10);
                }
                
                e.target.value = formattedValue;
            });
        }
    });

    // Ленивая загрузка изображений
    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('img[data-src]');
        
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        images.forEach(img => imageObserver.observe(img));
    });

    // Обработка ошибок форм
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.style.borderColor = '#ff4444';
                    } else {
                        field.style.borderColor = '';
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    alert('Пожалуйста, заполните все обязательные поля');
                }
            });
        });
    });
</script>
<script>
var orderFormEl = document.getElementById('order-form');
if (orderFormEl) orderFormEl.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitBtn');
    const form = this;
    const successMessage = document.getElementById('success-message');
    

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
        

        sendFormData(form);
        

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
    const form = document.getElementById('order-form');
    const successMessage = document.getElementById('success-message');
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
                const isDark = document.body.classList.contains('dark-theme');
                const activeColor = '#FBBF24';
                const inactiveColor = isDark ? '#94a3b8' : '#E5E7EB';
                stars.forEach(s => {
                    if (s.getAttribute('data-rating') <= rating) {
                        s.style.color = activeColor;
                    } else {
                        s.style.color = inactiveColor;
                    }
                });
            });
            
            star.addEventListener('mouseout', function() {
                const currentRating = ratingInput.value;
                const isDark = document.body.classList.contains('dark-theme');
                const activeColor = '#FBBF24';
                const inactiveColor = isDark ? '#94a3b8' : '#E5E7EB';
                stars.forEach(s => {
                    if (s.getAttribute('data-rating') <= currentRating) {
                        s.style.color = activeColor;
                    } else {
                        s.style.color = inactiveColor;
                    }
                });
            });
        });
        

        stars.forEach(star => {
            if (star.getAttribute('data-rating') <= ratingInput.value) {
                star.classList.add('active');
            }
        });

        // Начальное отображение звёзд (важно для тёмной темы)
        const isDark = document.body.classList.contains('dark-theme');
        const activeColor = '#FBBF24';
        const inactiveColor = isDark ? '#94a3b8' : '#E5E7EB';
        const currentRating = ratingInput.value;
        stars.forEach(s => {
            s.style.color = (s.getAttribute('data-rating') <= currentRating) ? activeColor : inactiveColor;
        });

    });
</script>
@endsection