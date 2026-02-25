@extends('layouts.app')

@section('skeleton')
    @include('skeletons.services')
@endsection

@section('content')

<body>
    <style>
        @media (max-width: 880px) {
            .block_tovar{
                display: flex;
                flex-direction: column;
            }
        }
    </style>
    <div class="overlay"></div>
    <main class="main dc-main">
        <section class="dc-section dc-section--hero hero_two">
            <div class="dc-container container">
                <div class="dc-hero__block hero_two_block">
                    <p class="dc-hero__title h7">Наши услуги</p>
                    <p class="dc-hero__subtitle h8">Широкий спектр услуг по дизайну в Photoshop для ваших проектов. От превью до анимаций, мы создаем всё!</p>
                </div>
            </div>
        </section>
        <!-- <section class="inner_tovar">
            <div class="container">
                <div class="block_tovar">
                    <div class="inner_services_content_block">
                        <p class="inner_services_content_block_h1">Лучший рейтинг</p>
                        <div class="inner_services_content__block">
                            <div class="inner_services_content___block">
                                <div class="svg"><svg class="svgg" data-lov-id="src/pages/Index.tsx:16:8" data-lov-name="svg" data-component-path="src/pages/Index.tsx" data-component-line="16" data-component-file="Index.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-6%20h-6%22%7D" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path data-lov-id="src/pages/Index.tsx:17:10" data-lov-name="path" data-component-path="src/pages/Index.tsx" data-component-line="17" data-component-file="Index.tsx" data-component-name="path" data-component-content="%7B%7D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg></div>
                                <p class="ava_text">Базовый дизайн превью</p>
                                <p class="text_inner_services">Простой и эффективный дизайн превью для видео, статей или продуктов</p>
                                <p class="inner_services_text">2000 <span>₽</span></p>
                                <div class="services_content_svg_text_block">
                                    <div class="services_content_svg_text">
                                        <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        <p>1 концепция</p>
                                    </div>
                                    <div class="services_content_svg_text">
                                        <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        <p>2 правки</p>
                                    </div>
                                    <div class="services_content_svg_text">
                                        <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        <p>Исходник в JPG</p>
                                    </div>
                                    <div class="services_content_svg_text">
                                        <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        <p>Срок: 2 дня</p>
                                    </div>
                                </div>
                            </div>
                            <p class="botton_services"  onclick="openModal()">Заказать</p>
                        </div>
                    </div>
                        <div class="inner_services_content_block">
                            <p class="inner_services_content_block_h1">Популярный выбор</p>
                            <div class="inner_services_content__block">
                                <div class="inner_services_content___block">
                                    <div class="svg"><svg class="svgg" data-lov-id="src/pages/Index.tsx:16:8" data-lov-name="svg" data-component-path="src/pages/Index.tsx" data-component-line="16" data-component-file="Index.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-6%20h-6%22%7D" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path data-lov-id="src/pages/Index.tsx:17:10" data-lov-name="path" data-component-path="src/pages/Index.tsx" data-component-line="17" data-component-file="Index.tsx" data-component-name="path" data-component-content="%7B%7D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg></div>
                                    <p class="ava_text">Превью Про</p>
                                    <p class="text_inner_services">Профессиональный дизайн превью с уникальными элементами и эффектами</p>
                                    <p class="inner_services_text">3500 <span>₽</span></p>
                                    <div class="services_content_svg_text_block">
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>2 концепции на выбор</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Неограниченные правки</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Исходник в PSD</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Срок: 3 дня</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="botton_services"  onclick="openModal()">Заказать</p>
                            </div>
                        </div>
                        <div class="inner_services_content_block">
                            <p class="inner_services_content_block_h1">Самый выгодный</p>
                            <div class="inner_services_content__block">
                                <div class="inner_services_content___block">
                                    <div class="svg"><svg class="svgg" data-lov-id="src/pages/Index.tsx:27:8" data-lov-name="svg" data-component-path="src/pages/Index.tsx" data-component-line="27" data-component-file="Index.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-6%20h-6%22%7D" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path data-lov-id="src/pages/Index.tsx:28:10" data-lov-name="path" data-component-path="src/pages/Index.tsx" data-component-line="28" data-component-file="Index.tsx" data-component-name="path" data-component-content="%7B%7D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg></div>
                                    <p class="ava_text">Базовая аватарка</p>
                                    <p class="text_inner_services">Стильная аватарка для социальных сетей или игровых профилей</p>
                                    <p class="inner_services_text">1500 <span>₽</span></p>
                                    <div class="services_content_svg_text_block">
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>1 дизайн</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>2 правки</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Исходник в JPG/PNG</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Срок: 1-2 дня</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="botton_services"  onclick="openModal()">Заказать</p>
                            </div>
                        </div>
                        <div class="inner_services_content_block">
                            <div class="inner_services_content__block">
                                <div class="inner_services_content___block">
                                    <div class="svg"><svg class="svgg" data-lov-id="src/pages/Index.tsx:39:8" data-lov-name="svg" data-component-path="src/pages/Index.tsx" data-component-line="39" data-component-file="Index.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-6%20h-6%22%7D" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path data-lov-id="src/pages/Index.tsx:40:10" data-lov-name="path" data-component-path="src/pages/Index.tsx" data-component-line="40" data-component-file="Index.tsx" data-component-name="path" data-component-content="%7B%7D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>
                                    <p class="ava_text">Стандартный баннер</p>
                                    <p class="text_inner_services">Баннер для социальных сетей, сайта или рекламы</p>
                                    <p class="inner_services_text">3000 <span>₽</span></p>
                                    <div class="services_content_svg_text_block">
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>1 размер</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>2 правки</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Исходник в JPG/PNG</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Срок: 2-3 дня</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="botton_services"  onclick="openModal()">Заказать</p>
                            </div>
                        </div>
                        <div class="inner_services_content_block">
                            <div class="inner_services_content__block">
                                <div class="inner_services_content___block">
                                    <div class="svg"><svg class="svgg" data-lov-id="src/pages/Index.tsx:27:8" data-lov-name="svg" data-component-path="src/pages/Index.tsx" data-component-line="27" data-component-file="Index.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-6%20h-6%22%7D" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path data-lov-id="src/pages/Index.tsx:28:10" data-lov-name="path" data-component-path="src/pages/Index.tsx" data-component-line="28" data-component-file="Index.tsx" data-component-name="path" data-component-content="%7B%7D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg></div>
                                    <p class="ava_text">Аватарка Про</p>
                                    <p class="text_inner_services">Уникальная аватарка с индивидуальным стилем и эффектами</p>
                                    <p class="inner_services_text">2500 <span>₽</span></p>
                                    <div class="services_content_svg_text_block">
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>2 варианта дизайна</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Неограниченные правки</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Исходник в PSD</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Срок: 2-3 дня</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="botton_services"  onclick="openModal()">Заказать</p>
                            </div>
                        </div>
                        <div class="inner_services_content_block">
                            <div class="inner_services_content__block">
                                <div class="inner_services_content___block">
                                    <div class="svg"><svg class="svgg" data-lov-id="src/pages/Index.tsx:39:8" data-lov-name="svg" data-component-path="src/pages/Index.tsx" data-component-line="39" data-component-file="Index.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-6%20h-6%22%7D" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path data-lov-id="src/pages/Index.tsx:40:10" data-lov-name="path" data-component-path="src/pages/Index.tsx" data-component-line="40" data-component-file="Index.tsx" data-component-name="path" data-component-content="%7B%7D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>
                                    <p class="ava_text">Премиум баннер</p>
                                    <p class="text_inner_services">Профессиональный баннер с адаптацией под различные платформы</p>
                                    <p class="inner_services_text">5000 <span>₽</span></p>
                                    <div class="services_content_svg_text_block">
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>3 разных размера</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Неограниченные правки</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Исходник в PSD</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Срок: 3-5 дней</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="botton_services"  onclick="openModal()">Заказать</p>
                            </div>
                        </div>
                        <div class="inner_services_content_block">
                            <div class="inner_services_content__block">
                                <div class="inner_services_content___block">
                                    <div class="svg"><svg class="svgg" data-lov-id="src/pages/Services.tsx:106:8" data-lov-name="svg" data-component-path="src/pages/Services.tsx" data-component-line="106" data-component-file="Services.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-6%20h-6%22%7D" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path data-lov-id="src/pages/Services.tsx:107:10" data-lov-name="path" data-component-path="src/pages/Services.tsx" data-component-line="107" data-component-file="Services.tsx" data-component-name="path" data-component-content="%7B%7D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path></svg></div>
                                    <p class="ava_text">Базовая анимация</p>
                                    <p class="text_inner_services">Простая анимация логотипа или элементов дизайна</p>
                                    <p class="inner_services_text">4000 <span>₽</span></p>
                                    <div class="services_content_svg_text_block">
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>До 5 сек длительности</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>2 правки</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Формат GIF/MP4</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Срок: 3-4 дня</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="botton_services"  onclick="openModal()">Заказать</p>
                            </div>
                        </div>
                        <div class="inner_services_content_block">
                            <div class="inner_services_content__block">
                                <div class="inner_services_content___block">
                                    <div class="svg"><svg class="svgg" data-lov-id="src/pages/Services.tsx:106:8" data-lov-name="svg" data-component-path="src/pages/Services.tsx" data-component-line="106" data-component-file="Services.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-6%20h-6%22%7D" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path data-lov-id="src/pages/Services.tsx:107:10" data-lov-name="path" data-component-path="src/pages/Services.tsx" data-component-line="107" data-component-file="Services.tsx" data-component-name="path" data-component-content="%7B%7D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path></svg></div>
                                    <p class="ava_text">Продвинутая анимация</p>
                                    <p class="text_inner_services">Сложная анимация с уникальными переходами и эффектами</p>
                                    <p class="inner_services_text">7000 <span>₽</span></p>
                                    <div class="services_content_svg_text_block">
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>До 15 сек длительности</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Неограниченные правки</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Формат по выбору</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Срок: 5-7 дней</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="botton_services"  onclick="openModal()">Заказать</p>
                            </div>
                        </div>
                        <div class="inner_services_content_block">
                            <div class="inner_services_content__block">
                                <div class="inner_services_content___block">
                                    <div class="svg"><svg class="svgg" data-lov-id="src/pages/Services.tsx:145:8" data-lov-name="svg" data-component-path="src/pages/Services.tsx" data-component-line="145" data-component-file="Services.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-6%20h-6%22%7D" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path data-lov-id="src/pages/Services.tsx:146:10" data-lov-name="path" data-component-path="src/pages/Services.tsx" data-component-line="146" data-component-file="Services.tsx" data-component-name="path" data-component-content="%7B%7D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg></div>
                                    <p class="ava_text">Продвинутый логотип</p>
                                    <p class="text_inner_services">Профессиональный логотип с брендбуком и различными форматами</p>
                                    <p class="inner_services_text">8000 <span>₽</span></p>
                                    <div class="services_content_svg_text_block">
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>3+ концепции</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Неограниченные правки</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Все форматы файлов</p>
                                        </div>
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" data-lov-id="src/components/ServiceCard.tsx:55:14" data-lov-name="svg" data-component-path="src/components/ServiceCard.tsx" data-component-line="55" data-component-file="ServiceCard.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-2%20text-blue-500%22%7D" class="w-4 h-4 mr-2 text-blue-500" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/components/ServiceCard.tsx:56:16" data-lov-name="path" data-component-path="src/components/ServiceCard.tsx" data-component-line="56" data-component-file="ServiceCard.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>Срок: 7-10 дней</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="botton_services"  onclick="openModal()">Заказать</p>
                            </div>
                        </div>
                </div>
            </div>
        </section> -->
        <section class="inner_tovar">
            <div class="container">
                <style>
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
                        margin-bottom: 2rem;
                        min-width: 190px;
                    }
                    .news-read-more-news-read-more-news-read-more>svg{
                        stroke: #0077B5 !important;
                    }
                    .servicesBlock{
                        width: 100%;
                        display: flex;
                        align-items: flex-end;
                        flex-direction: column;
                    }
                </style>
                <div class="servicesBlock">
                    <a href="{{ url("servicesBlock/create") }}" class="news-read-more-news-read-more-news-read-more" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M12 5V19M5 12H19" stroke="#0077B5" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        Создать услугу
                    </a>
                </div>
                <div class="block_tovar">



                    @foreach ($servicesList ?? [] as $s)
                        <div class="inner_services_content_block">
                            @if(!empty($s['badge']))<p class="inner_services_content_block_h1">{{ $s['badge'] }}</p>@endif
                            <div class="inner_services_content__block">
                                <div class="inner_services_content___block">
                                    @php $cat = $s['select_value'] ?? ''; @endphp
                                    @if($cat === 'design' || $cat === 'preview')
                                        <div class="svg"><svg class="svgg" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg></div>
                                    @elseif($cat === 'ava')
                                        <div class="svg"><svg class="svgg" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg></div>
                                    @elseif($cat === 'banner')
                                        <div class="svg"><svg class="svgg" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>
                                    @elseif($cat === 'animation' || $cat === 'video')
                                        <div class="svg"><svg class="svgg" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path></svg></div>
                                    @elseif($cat === 'logo')
                                        <div class="svg"><svg class="svgg" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg></div>
                                    @else
                                        <div class="svg"><svg class="svgg" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"></path></svg></div>
                                    @endif
                                    <p class="ava_text">{{ $s['name'] ?? '' }}</p>
                                    <p class="text_inner_services">{{ $s['desc'] ?? '' }}</p>
                                    <p class="inner_services_text">{{ $s['price'] ?? '' }} <span>₽</span></p>
                                    <div class="services_content_svg_text_block">
                                        @foreach($s['features'] ?? [] as $feature)
                                        <div class="services_content_svg_text">
                                            <svg class="svg_two" fill="#0062ff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <p>{{ $feature }}</p>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <a href="{{ route('order.create', ['service' => $s['select_value'] ?? '', 'package' => $s['package'] ?? '']) }}" class="botton_services">Заказать</a>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </section>

        <section class="inner_works">
            <div class="container">
                <div class="block_works">
                    <h1>Часто задаваемые вопросы</h1>
                    <h2>Ответы на популярные вопросы о наших услугах.</h2>
                    <div class="content_works">
                        <div class="content_works_block">
                            <p class="content_works_block_text">Сколько времени занимает создание дизайна?</p>
                            <p class="content_works_block_text_two">Сроки выполнения зависят от сложности проекта и выбранной услуги. В среднем, для аватарок это 1-3 дня, для баннеров 2-5 дней, для анимаций 3-10 дней.</p>
                        </div>
                        <div class="content_works_block">
                            <p class="content_works_block_text">Какие форматы файлов я получу?</p>
                            <p class="content_works_block_text_two">В зависимости от выбранного пакета, вы получите файлы в форматах JPG, PNG, PSD (исходники для редактирования), для анимаций — GIF и/или MP4.</p>
                        </div>
                        <div class="content_works_block">
                            <p class="content_works_block_text">Сколько правок входит в стоимость?</p>
                            <p class="content_works_block_text_two">Базовые пакеты включают 2-3 правки. Премиум пакеты обычно включают неограниченное количество правок до финального утверждения.</p>
                        </div>
                        <div class="content_works_block">
                            <p class="content_works_block_text">Как происходит оплата?</p>
                            <p class="content_works_block_text_two">Мы работаем по схеме 50% предоплата перед началом работы, 50% после утверждения финальной версии, перед отправкой готовых файлов.</p>
                        </div>
                        <div class="content_works_block">
                            <p class="content_works_block_text">Можно ли заказать индивидуальный проект?</p>
                            <p class="content_works_block_text_two">Да, мы рады работать над нестандартными проектами. Свяжитесь с нами, чтобы обсудить ваши требования и получить индивидуальное предложение.</p>
                        </div>
                        <div class="content_works_block">
                            <p class="content_works_block_text">Работаете ли вы с международными клиентами?</p>
                            <p class="content_works_block_text_two">Да, мы работаем с клиентами по всему миру. Общение возможно на русском и английском языках, а оплата принимается через международные платежные системы.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('partials.footer')
</body>
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
@endsection