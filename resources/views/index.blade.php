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
        <section class="inner_reviews">
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
                                                    <img src="{{ url('storage/' . $review->user->avatar) }}" 
                                                        alt="Аватар" 
                                                        loading="lazy"
                                                        style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                                @else
                                                    <img class="avatar" src="{{ url('image/3/1.png') }}" alt="" loading="lazy">
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
                                                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'moderator' || (Auth::user()->role === 'user' && $review->user_id === Auth::id()))
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
                                            <span style="color: #ff8400 !important;" class="rating-star" data-rating="{{ $i }}">★</span>
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