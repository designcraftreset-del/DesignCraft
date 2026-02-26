@extends('mobile.layouts.mobile-app')

@section('title', 'Контакты — DesignCraft')

@section('content')
<section class="m-hero">
    <h1 class="m-hero__title">Свяжитесь с нами</h1>
    <p class="m-hero__subtitle">Вопросы или готовы начать проект? Мы всегда рады помочь!</p>
</section>

<section class="m-section">
    <div class="m-card">
        <p class="m-title">Реклама</p>
        <p class="m-text">По вопросам рекламы: support@designcraft.ru. Ответ в течение 2 рабочих дней.</p>
    </div>
    <div class="m-card">
        <p class="m-title">Контактная информация</p>
        <p class="m-text"><strong>Email:</strong><br>hello@designstudio.ru, projects@designstudio.ru</p>
        <p class="m-text"><strong>Телефон:</strong><br>+7 (000) 000-00-00, +7 (111) 111-11-11</p>
        <p class="m-text"><strong>Адреса:</strong><br>г. Омск, Улица дизайна, 1<br>г. Омск, Улица дизайна, 2</p>
        <p class="m-text"><strong>Часы работы:</strong><br>Пн–Пт: 9:00 – 20:00, Сб: 10:00 – 17:00</p>
    </div>
</section>

<section class="m-section">
    <h2 class="m-section__title m-title">Часто задаваемые вопросы</h2>
    <div class="m-card">
        <p class="m-title">Как быстро вы выполняете заказы?</p>
        <p class="m-text">Сроки зависят от сложности. Простые аватарки — 1–2 дня, сложные проекты — до 7–10 рабочих дней.</p>
    </div>
    <div class="m-card">
        <p class="m-title">Есть ли скидки для постоянных клиентов?</p>
        <p class="m-text">Да, предусмотрена система скидок и специальные предложения при заказе нескольких услуг.</p>
    </div>
    <div class="m-card">
        <p class="m-title">Как происходит оплата?</p>
        <p class="m-text">Работаем по предоплате 50%. После утверждения финальной версии и внесения оставшейся оплаты вы получаете все файлы.</p>
    </div>
</section>
@endsection
