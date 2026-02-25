<footer>
    <section class="inner_footer_two">
        <div class="container">
            <div class="block_footer_two">
                <p class="text_botton_footer_two">Готовы начать проект?</p>
                <p class="text_botton_footer__two">Свяжитесь с нами сегодня и получите консультацию по вашему проекту. Мы поможем воплотить ваши идеи в реальность!</p>
                <div class="botton_footer_two_block">
                    <a class="botton_footer_two" href="{{ Auth::check() ? route('contacts') : route('login') }}">Связаться с нами</a>
                    <a class="botton_footer__two" href="{{ Auth::check() ? route('services') : route('login') }}">Посмотреть услуги</a>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="footer_block">
            <div class="footer_nav">
                <a class="logo_footer" href="{{ route('hellow') }}">DesignCraft</a>
                <p class="p">Профессиональный дизайн для вашего бизнеса. Превью, аватарки, баннеры, анимации и многое другое.</p>
            </div>
            <div class="footer_nav">
                <p class="logo_footer">Страницы сайта</p>
                <div class="footer__nav">
                    <div class="footer___nav">
                        <svg class="svg_footer__nav" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"></path><path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
                        <a href="{{ route('hellow') }}" class="p">Главная</a>
                    </div>
                    <div class="footer___nav">
                        <svg class="svg_footer__nav" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        <a href="{{ route('aboutus') }}" class="p">О нас</a>
                    </div>
                    <div class="footer___nav">
                        <svg class="svg_footer__nav" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"></path></svg>
                        <a href="{{ route('services') }}" class="p">Услуги</a>
                    </div>
                    <div class="footer___nav">
                        <svg class="svg_footer__nav" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                        <a href="{{ route('portfolio') }}" class="p">Портфолио</a>
                    </div>
                    <div class="footer___nav">
                        <svg class="svg_footer__nav" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M12 16v-4"></path><path d="M12 8h.01"></path></svg>
                        <a href="{{ route('whyus') }}" class="p">Почему мы?</a>
                    </div>
                    <div class="footer___nav">
                        <svg class="svg_footer__nav" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"></path><path d="M18 14h-8"></path><path d="M15 18h-5"></path><path d="M10 6h8v4h-8V6Z"></path></svg>
                        <a href="{{ route('websiteNews') }}" class="p">Новости</a>
                    </div>
                    <div class="footer___nav">
                        <svg class="svg_footer__nav" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>
                        <a href="{{ route('contacts') }}" class="p">Контакты</a>
                    </div>
                </div>
            </div>
            <div class="footer_nav">
                <p class="logo_footer">Аккаунт</p>
                <div class="footer__nav">
                    @guest
                    <div class="footer___nav">
                        <a href="{{ route('login') }}" class="p">Вход</a>
                    </div>
                    <div class="footer___nav">
                        <a href="{{ route('register') }}" class="p">Регистрация</a>
                    </div>
                    @endguest
                    @auth
                    <div class="footer___nav">
                        <a href="{{ route('userPanel') }}" class="p">Личный кабинет</a>
                    </div>
                    <div class="footer___nav">
                        <a href="{{ route('order.create') }}" class="p">Оформление заказа</a>
                    </div>
                    @endauth
                </div>
            </div>
            <div class="footer_nav">
                <p class="logo_footer">Документы</p>
                <div class="footer__nav">
                    <div class="footer___nav">
                        <a href="{{ route('privacy') }}" class="p">Политика конфиденциальности</a>
                    </div>
                    <div class="footer___nav">
                        <a href="{{ route('terms') }}" class="p">Условия использования</a>
                    </div>
                </div>
            </div>
            <div class="footer_nav">
                <p class="logo_footer">Контакты</p>
                <div class="footer__nav">
                    <p class="p">Омск, ул. Дизайна 1</p>
                    <p class="p">Email: info@designcraft.ru</p>
                    <p class="p">Тел.: +7 (000) 000-00-00</p>
                </div>
            </div>
        </div>
        <div class="line___text_block">
            <div class="line"></div>
            <p class="text">© {{ date('Y') }} DesignCraft. Все права защищены.</p>
        </div>
    </div>
</footer>
