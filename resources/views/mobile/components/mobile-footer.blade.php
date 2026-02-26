<footer class="m-footer">
    <div class="m-footer__cta">
        <p class="m-footer__title">Готовы начать проект?</p>
        <p class="m-footer__text">Свяжитесь с нами сегодня и получите консультацию.</p>
        <div class="m-footer__actions">
            <a href="{{ route('mobile.contacts') }}" class="m-btn m-btn--primary">Связаться с нами</a>
            <a href="{{ route('mobile.services') }}" class="m-btn m-btn--secondary">Услуги</a>
        </div>
    </div>
    <div class="m-footer__nav">
        <a href="{{ route('mobile.home') }}">Главная</a>
        <a href="{{ route('mobile.about') }}">О нас</a>
        <a href="{{ route('mobile.services') }}">Услуги</a>
        <a href="{{ route('mobile.portfolio') }}">Портфолио</a>
        <a href="{{ route('mobile.whyus') }}">Почему мы?</a>
        <a href="{{ route('mobile.news') }}">Новости</a>
        <a href="{{ route('mobile.contacts') }}">Контакты</a>
        <a href="{{ route('mobile.privacy') }}">Политика</a>
        <a href="{{ route('mobile.terms') }}">Условия</a>
        <a href="#" class="m-footer__desktop-link" id="mDesktopLink">Полная версия</a>
    </div>
    <p class="m-footer__copy">© {{ date('Y') }} DesignCraft. Все права защищены.</p>
</footer>
<script>
(function(){
    var path = window.location.pathname;
    var base = path.replace(/^\/mobile\/?/, '') || '';
    var desktopPaths = {
        '': '/',
        'about': '/aboutus',
        'services': '/services',
        'portfolio': '/portfolio',
        'whyus': '/whyus',
        'contacts': '/contacts',
        'news': '/websiteNews',
        'privacy': '/privacy',
        'terms': '/terms',
        'order': '/order',
        'account': '/userPanel'
    };
    var desktopPath = desktopPaths[base];
    if (!desktopPath && base.indexOf('news/') === 0) desktopPath = '/newsTwo/' + base.slice(5);
    if (!desktopPath) desktopPath = '/';
    var link = document.getElementById('mDesktopLink');
    if (link) {
        link.href = desktopPath + (window.location.search || '');
        link.addEventListener('click', function(e) {
            e.preventDefault();
            sessionStorage.forceDesktopView = '1';
            window.location.href = link.href;
        });
    }
})();
</script>
