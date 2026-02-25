@extends('layouts.app')

@section('skeleton')
    @include('skeletons.whyus')
@endsection
@section('content')

<body>
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p class="text_modal">Закaзать дизайн</p>
        

        <form id="orderForm" action="{{ route('new') }}" method="post">
            @csrf
            <label class="name_modal" for="name">Ваше имя</label>
            <input type="text" id="name" name="name" placeholder="Введите ваше имя" required>
            
            <label class="name_modal" for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="your@email.com" required>
            
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


        <div id="successMessage" class="success-message" style="display: none;">
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
    </div>
</div>
    <div class="mobile-nav">
        <a href="index.html">Главная</a>
        <a href="index-2.html">О нас</a>
        <a href="index-3.html">Услуги</a>
        <a href="index-4.html">Почему мы?</a>
        <a href="index-5.html">Контакты</a>
        <div class="mobile-button" onclick="window.location.href='{{ route('order.create') }}'">Заказать дизайн</div>
    </div>
    <div class="overlay"></div>
    <main class="main dc-main">
        <section class="dc-section dc-section--hero hero_two">
            <div class="dc-container container">
                <div class="dc-hero__block hero_two_block">
                    <p class="dc-hero__title h7">Почему мы ?</p>
                    <p class="dc-hero__subtitle h8">Узнайте, почему сотни клиентов выбирают DesignCraft для своих дизайн-проектов и возвращаются снова и снова.</p>
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
        <section class="dc-section dc-section--content inner_competitors">
            <div class="dc-container container">
                <div class="block_competitors">
                    <h1>Мы и конкуренты</h1>
                    <h2>Объективное сравнение наших услуг с конкурентами.</h2>
                    <table class="comparison-table">
                        <thead>
                            <tr class="header-row">
                                <th class="header--row">ОСОБЕННОСТЬ</th>
                                <th class="header---row" style="text-align: center;"><span>DESIGNCRAFT</span></th>
                                <th class="header----row" style="text-align: center;">ДРУГИЕ СТУДИИ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="feature-column">Профессиональный дизайн</td>
                                <td class="designcraft-column"><svg class="svggg" data-lov-id="src/pages/WhyUs.tsx:169:24" data-lov-name="svg" data-component-path="src/pages/WhyUs.tsx" data-component-line="169" data-component-file="WhyUs.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22h-6%20w-6%20mx-auto%22%7D" class="h-6 w-6 mx-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/pages/WhyUs.tsx:170:26" data-lov-name="path" data-component-path="src/pages/WhyUs.tsx" data-component-line="170" data-component-file="WhyUs.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg></td>
                                <td class="others-column">Не всегда</td>
                            </tr>
                            <tr>
                                <td class="feature-column">Неограниченные правки (в премиум)</td>
                                <td class="designcraft-column"><svg class="svggg" data-lov-id="src/pages/WhyUs.tsx:169:24" data-lov-name="svg" data-component-path="src/pages/WhyUs.tsx" data-component-line="169" data-component-file="WhyUs.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22h-6%20w-6%20mx-auto%22%7D" class="h-6 w-6 mx-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/pages/WhyUs.tsx:170:26" data-lov-name="path" data-component-path="src/pages/WhyUs.tsx" data-component-line="170" data-component-file="WhyUs.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg></td>
                                <td class="others-column">Редко</td>
                            </tr>
                            <tr>
                                <td class="feature-column">Передача исходников</td>
                                <td class="designcraft-column"><svg class="svggg" data-lov-id="src/pages/WhyUs.tsx:169:24" data-lov-name="svg" data-component-path="src/pages/WhyUs.tsx" data-component-line="169" data-component-file="WhyUs.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22h-6%20w-6%20mx-auto%22%7D" class="h-6 w-6 mx-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/pages/WhyUs.tsx:170:26" data-lov-name="path" data-component-path="src/pages/WhyUs.tsx" data-component-line="170" data-component-file="WhyUs.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg></td>
                                <td class="others-column">За доп. плату</td>
                            </tr>
                            <tr>
                                <td class="feature-column">Соблюдение сроков</td>
                                <td class="designcraft-column"><svg class="svggg" data-lov-id="src/pages/WhyUs.tsx:169:24" data-lov-name="svg" data-component-path="src/pages/WhyUs.tsx" data-component-line="169" data-component-file="WhyUs.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22h-6%20w-6%20mx-auto%22%7D" class="h-6 w-6 mx-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/pages/WhyUs.tsx:170:26" data-lov-name="path" data-component-path="src/pages/WhyUs.tsx" data-component-line="170" data-component-file="WhyUs.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg></td>
                                <td class="others-column">Часто с задержками</td>
                            </tr>
                            <tr>
                                <td class="feature-column">Гарантия качества</td>
                                <td class="designcraft-column"><svg class="svggg" data-lov-id="src/pages/WhyUs.tsx:169:24" data-lov-name="svg" data-component-path="src/pages/WhyUs.tsx" data-component-line="169" data-component-file="WhyUs.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22h-6%20w-6%20mx-auto%22%7D" class="h-6 w-6 mx-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/pages/WhyUs.tsx:170:26" data-lov-name="path" data-component-path="src/pages/WhyUs.tsx" data-component-line="170" data-component-file="WhyUs.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg></td>
                                <td class="others-column">Не всегда</td>
                            </tr>
                            <tr class="tr">
                                <td class="feature-column">Постпроектная поддержка</td>
                                <td class="designcraft-column"><svg class="svggg" data-lov-id="src/pages/WhyUs.tsx:169:24" data-lov-name="svg" data-component-path="src/pages/WhyUs.tsx" data-component-line="169" data-component-file="WhyUs.tsx" data-component-name="svg" data-component-content="%7B%22className%22%3A%22h-6%20w-6%20mx-auto%22%7D" class="h-6 w-6 mx-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path data-lov-id="src/pages/WhyUs.tsx:170:26" data-lov-name="path" data-component-path="src/pages/WhyUs.tsx" data-component-line="170" data-component-file="WhyUs.tsx" data-component-name="path" data-component-content="%7B%7D" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg></td>
                                <td class="others-column">За доп. плату</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <section class="dc-section dc-section--content inner_tools">
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
    </main>
    @include('partials.footer')
</body>

@endsection