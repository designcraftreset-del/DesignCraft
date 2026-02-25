<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="admin2-card rounded-xl p-5 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="admin2-text-muted text-sm font-medium">Всего заказов</p>
                <p class="text-2xl font-bold text-primary mt-1">{{ $totalOrders }}</p>
            </div>
            <div class="p-3 rounded-lg bg-primary/10">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-primary"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg>
            </div>
        </div>
    </div>
    <div class="admin2-card rounded-xl p-5 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="admin2-text-muted text-sm font-medium">Пользователи</p>
                <p class="text-2xl font-bold text-primary mt-1">{{ $totalUsers }}</p>
            </div>
            <div class="p-3 rounded-lg bg-primary/10">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-primary"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
        </div>
    </div>
    <div class="admin2-card rounded-xl p-5 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="admin2-text-muted text-sm font-medium">Заказов за месяц</p>
                <p class="text-2xl font-bold text-primary mt-1">{{ $ordersThisMonth }}</p>
            </div>
            <div class="p-3 rounded-lg bg-primary/10">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-primary"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
            </div>
        </div>
    </div>
    <div class="admin2-card rounded-xl p-5 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="admin2-text-muted text-sm font-medium">Завершённые</p>
                <p class="text-2xl font-bold text-primary mt-1">{{ $completedOrders }}</p>
            </div>
            <div class="p-3 rounded-lg bg-primary/10">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-primary"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
            </div>
        </div>
    </div>
</div>
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="admin2-card rounded-xl p-5 shadow-sm">
        <h2 class="text-lg font-semibold mb-4">Заказы по месяцам</h2>
        <div class="h-64"><canvas id="admin2-bar-chart"></canvas></div>
    </div>
    <div class="admin2-card rounded-xl p-5 shadow-sm">
        <h2 class="text-lg font-semibold mb-4">Статусы заказов</h2>
        <div class="h-64 flex items-center justify-center"><canvas id="admin2-pie-chart"></canvas></div>
    </div>
</div>
<div class="admin2-card rounded-xl shadow-sm overflow-hidden">
    <div class="px-5 py-4 border-b border-slate-200 dark:border-slate-600"><h2 class="text-lg font-semibold">Последние заказы</h2></div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="admin2-text-muted text-sm font-medium border-b border-slate-200 dark:border-slate-600">
                <tr><th class="px-5 py-3">Клиент</th><th class="px-5 py-3">Услуга</th><th class="px-5 py-3">Статус</th><th class="px-5 py-3">Дата</th></tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr class="border-b border-slate-100 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800/50">
                    <td class="px-5 py-3">{{ $order->name ?? $order->user->name ?? '—' }}</td>
                    <td class="px-5 py-3">{{ $order->yslyga ?? '—' }}</td>
                    <td class="px-5 py-3">
                        @if($order->status === 'completed')<span class="px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-200">Завершён</span>
                        @elseif($order->status === 'processing')<span class="px-2 py-0.5 rounded text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-200">В работе</span>
                        @else<span class="px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-200">Новый</span>@endif
                    </td>
                    <td class="px-5 py-3 admin2-text-muted text-sm">{{ $order->created_at?->format('d.m.Y H:i') ?? '—' }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-5 py-8 admin2-text-muted text-center">Нет заказов</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
