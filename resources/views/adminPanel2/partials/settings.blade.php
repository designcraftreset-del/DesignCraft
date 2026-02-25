<div class="max-w-xl space-y-6">
    <div class="admin2-card rounded-xl p-5 shadow-sm">
        <h2 class="text-lg font-semibold mb-4">О панели</h2>
        <p class="admin2-text-muted text-sm">Админ-панель DesignCraft. Здесь доступны разделы: дашборд, заказы, пользователи, общая таблица, товары/услуги, сообщения, аналитика, отчёты.</p>
    </div>
    <div class="admin2-card rounded-xl p-5 shadow-sm">
        <h2 class="text-lg font-semibold mb-4">Тема оформления</h2>
        <p class="admin2-text-muted text-sm mb-2">Переключение светлой и тёмной темы доступно в правом верхнем углу. Выбор сохраняется в браузере.</p>
    </div>
    <div class="admin2-card rounded-xl p-5 shadow-sm">
        <h2 class="text-lg font-semibold mb-4">Ссылки</h2>
        <ul class="space-y-2 text-sm">
            <li><a href="{{ url('/') }}" class="text-primary hover:underline">Главная сайта</a></li>
            <li><a href="{{ route('adminPanel') }}" class="text-primary hover:underline">Админ панель (основная)</a></li>
            <li><a href="{{ route('contacts') }}" class="text-primary hover:underline">Контакты</a></li>
        </ul>
    </div>
</div>
