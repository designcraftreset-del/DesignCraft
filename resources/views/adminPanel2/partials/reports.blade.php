<div class="space-y-6">
    <div class="admin2-card rounded-xl p-5 shadow-sm">
        <h2 class="text-lg font-semibold mb-4">Краткий отчёт</h2>
        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div><dt class="admin2-text-muted text-sm">Всего заказов</dt><dd class="text-xl font-semibold text-primary">{{ $totalOrders }}</dd></div>
            <div><dt class="admin2-text-muted text-sm">Завершено</dt><dd class="text-xl font-semibold text-primary">{{ $completedOrders }}</dd></div>
            <div><dt class="admin2-text-muted text-sm">В работе</dt><dd class="text-xl font-semibold text-primary">{{ $inProgress }}</dd></div>
            <div><dt class="admin2-text-muted text-sm">Заказов за месяц</dt><dd class="text-xl font-semibold text-primary">{{ $ordersThisMonth }}</dd></div>
            <div><dt class="admin2-text-muted text-sm">Пользователей</dt><dd class="text-xl font-semibold text-primary">{{ $totalUsers }}</dd></div>
        </dl>
    </div>
    <div class="admin2-card rounded-xl p-5 shadow-sm">
        <h2 class="text-lg font-semibold mb-3">Скачать таблицу в Excel (CSV)</h2>
        <p class="admin2-text-muted text-sm mb-3">Выгрузить текущие данные в файл для открытия в Excel.</p>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('adminPanel2.export.orders') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-green-600 text-white text-sm font-medium hover:bg-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                Заказы
            </a>
            <a href="{{ route('adminPanel2.export.users') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-green-600 text-white text-sm font-medium hover:bg-green-700">Пользователи</a>
            <a href="{{ route('adminPanel2.export.table') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-green-600 text-white text-sm font-medium hover:bg-green-700">Общая таблица заявок</a>
            <a href="{{ route('adminPanel2.export.services') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-green-600 text-white text-sm font-medium hover:bg-green-700">Услуги</a>
            <a href="{{ route('adminPanel2.export.messages') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-green-600 text-white text-sm font-medium hover:bg-green-700">Сообщения</a>
        </div>
    </div>
    <div class="admin2-card rounded-xl p-5 shadow-sm">
        <h2 class="text-lg font-semibold mb-2">Быстрые ссылки</h2>
        <ul class="space-y-1 text-primary">
            <li><a href="{{ route('adminPanel2', ['page' => 'orders']) }}" class="hover:underline">Все заказы</a></li>
            <li><a href="{{ route('adminPanel2', ['page' => 'users']) }}" class="hover:underline">Пользователи</a></li>
            <li><a href="{{ route('adminPanel2', ['page' => 'table']) }}" class="hover:underline">Общая таблица заявок</a></li>
            <li><a href="{{ route('adminPanel2', ['page' => 'analytics']) }}" class="hover:underline">Аналитика</a></li>
        </ul>
    </div>
</div>
