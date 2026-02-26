<nav class="m-nav" id="mNav" aria-hidden="true">
    <div class="m-nav__backdrop m-menu-close"></div>
    <div class="m-nav__drawer">
        <a href="{{ route('mobile.home') }}" class="m-nav__link">Главная</a>
        <a href="{{ route('mobile.about') }}" class="m-nav__link">О нас</a>
        <a href="{{ route('mobile.services') }}" class="m-nav__link">Услуги</a>
        <a href="{{ route('mobile.portfolio') }}" class="m-nav__link">Портфолио</a>
        <a href="{{ route('mobile.whyus') }}" class="m-nav__link">Почему мы?</a>
        <a href="{{ route('mobile.news') }}" class="m-nav__link">Новости</a>
        <a href="{{ route('mobile.contacts') }}" class="m-nav__link">Контакты</a>
        <a href="#" class="m-nav__link" id="support-chat-toggle">Чат с поддержкой</a>
        <div class="m-nav__theme">
            <button type="button" class="m-nav__link m-nav__link--btn m-nav__theme-btn" id="mThemeToggle" aria-label="Сменить тему">
                <span class="m-nav__theme-label">Тема: <span id="mThemeLabel">тёмная</span></span>
            </button>
        </div>
        @guest
            <a href="{{ route('mobile.login') }}" class="m-nav__link">Вход</a>
            @if(Route::has('mobile.register'))
                <a href="{{ route('mobile.register') }}" class="m-nav__link">Регистрация</a>
            @endif
        @else
            <a href="{{ route('mobile.account') }}" class="m-nav__link">Личный кабинет</a>
            <a href="{{ route('mobile.order.create') }}" class="m-nav__link">Оформление заказа</a>
            <form method="POST" action="{{ route('logout') }}" class="m-nav__form">
                @csrf
                <button type="submit" class="m-nav__link m-nav__link--btn">Выйти</button>
            </form>
        @endguest
    </div>
</nav>
