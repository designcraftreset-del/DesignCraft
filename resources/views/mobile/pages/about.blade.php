@extends('mobile.layouts.mobile-app')

@section('title', 'О нас — DesignCraft')

@section('content')
<section class="m-hero">
    <h1 class="m-hero__title">О нас</h1>
    <p class="m-hero__subtitle">Узнайте больше о команде профессиональных дизайнеров DesignCraft и о том, как мы помогаем клиентам реализовать их идеи.</p>
</section>

<section class="m-section">
    <h2 class="m-section__title m-title">Наша история</h2>
    <div class="m-card">
        <p class="m-text">DesignCraft был основан в 2022 году дизайнерами, объединёнными страстью создавать визуальные материалы, которые не только красивы, но и эффективны.</p>
        <p class="m-text">Мы начинали как небольшая студия (аватарки и баннеры для стримеров и блогеров). Сегодня команда — 15 профессиональных дизайнеров, полный спектр услуг для клиентов из разных отраслей.</p>
    </div>
</section>

<section class="m-section">
    <h2 class="m-section__title m-title">Цифры</h2>
    <div class="m-grid">
        <div class="m-card" style="text-align:center;"><span class="m-price">5+</span><br><span class="m-text">Лет опыта</span></div>
        <div class="m-card" style="text-align:center;"><span class="m-price">1000+</span><br><span class="m-text">Довольных клиентов</span></div>
        <div class="m-card" style="text-align:center;"><span class="m-price">5000+</span><br><span class="m-text">Проектов</span></div>
        <div class="m-card" style="text-align:center;"><span class="m-price">24/7</span><br><span class="m-text">Поддержка</span></div>
    </div>
</section>

<section class="m-section">
    <h2 class="m-section__title m-title">Наши ценности</h2>
    <div class="m-list-item">
        <div><strong>Креативность</strong><br><span class="m-text">Новые подходы и идеи для уникальных дизайнов.</span></div>
    </div>
    <div class="m-list-item">
        <div><strong>Профессионализм</strong><br><span class="m-text">Внимание к деталям и соблюдение сроков.</span></div>
    </div>
    <div class="m-list-item">
        <div><strong>Забота о клиентах</strong><br><span class="m-text">Тесное сотрудничество на каждом этапе.</span></div>
    </div>
</section>

<section class="m-section">
    <h2 class="m-section__title m-title">Наша команда</h2>
    <p class="m-text" style="text-align:center;">Познакомьтесь с профессионалами, которые воплощают ваши идеи.</p>
    <div class="m-card">
        <p class="m-title">Сандакрышин Иван</p>
        <p class="m-text">Основатель и арт-директор. Более 5 лет в графическом дизайне.</p>
    </div>
    <div class="m-card">
        <p class="m-title">Струцкая Наталья</p>
        <p class="m-text">Старший дизайнер. Баннеры и аватарки для игровой индустрии.</p>
    </div>
    <div class="m-card">
        <p class="m-title">Красный Алексей</p>
        <p class="m-text">Моушн-дизайнер. Анимация и динамические эффекты.</p>
    </div>
    <div class="m-card">
        <p class="m-title">Панин Олег</p>
        <p class="m-text">UI/UX дизайнер. Интерфейсы и баннеры.</p>
    </div>
</section>
@endsection
