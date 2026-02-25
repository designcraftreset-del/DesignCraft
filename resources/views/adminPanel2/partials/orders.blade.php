@php
    $f = $filters ?? [];
    $sortOrder = request()->get('sort_order', 'created_at');
    $sortDir = request()->get('sort_dir', 'desc');
    $sortDirOpposite = $sortDir === 'asc' ? 'desc' : 'asc';
    $baseQuery = array_merge(request()->query(), ['page' => 'orders']);
@endphp
<form method="get" action="{{ route('adminPanel2', ['page' => 'orders']) }}" class="admin2-card rounded-xl p-4 mb-4">
    <input type="hidden" name="page" value="orders">
    <div class="flex flex-wrap items-end gap-3">
        <div>
            <label class="block text-xs admin2-text-muted mb-1">Статус</label>
            <select name="filter_order_status" class="rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm w-40">
                <option value="">Все</option>
                <option value="new" {{ ($f['order_status'] ?? '') === 'new' ? 'selected' : '' }}>Новый</option>
                <option value="processing" {{ ($f['order_status'] ?? '') === 'processing' ? 'selected' : '' }}>В работе</option>
                <option value="completed" {{ ($f['order_status'] ?? '') === 'completed' ? 'selected' : '' }}>Завершён</option>
            </select>
        </div>
        <div>
            <label class="block text-xs admin2-text-muted mb-1">Поиск</label>
            <input type="text" name="filter_order_search" value="{{ $f['order_search'] ?? '' }}" placeholder="Имя, email, услуга" class="rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm w-48">
        </div>
        <div>
            <label class="block text-xs admin2-text-muted mb-1">Дата от</label>
            <input type="date" name="filter_order_date_from" value="{{ $f['order_date_from'] ?? '' }}" class="rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm">
        </div>
        <div>
            <label class="block text-xs admin2-text-muted mb-1">Дата до</label>
            <input type="date" name="filter_order_date_to" value="{{ $f['order_date_to'] ?? '' }}" class="rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm">
        </div>
        <button type="submit" class="px-4 py-2 rounded-lg bg-primary text-white text-sm font-medium hover:opacity-90">Применить</button>
        <a href="{{ route('adminPanel2', ['page' => 'orders']) }}" class="px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 text-sm">Сбросить</a>
    </div>
</form>
<div class="admin2-card rounded-xl shadow-sm overflow-hidden">
    <div class="px-5 py-4 border-b border-slate-200 dark:border-slate-600 flex flex-wrap items-center justify-between gap-2">
        <h2 class="text-lg font-semibold">Все заказы</h2>
        <a href="{{ route('adminPanel2.export.orders', request()->query()) }}" class="text-sm text-green-600 dark:text-green-400 hover:underline">Скачать в Excel</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="admin2-text-muted text-sm font-medium border-b border-slate-200 dark:border-slate-600">
                <tr>
                    <th class="px-5 py-3"><a href="{{ route('adminPanel2', array_merge($baseQuery, ['sort_order' => 'id', 'sort_dir' => $sortOrder === 'id' ? $sortDirOpposite : 'desc'])) }}" class="hover:text-primary">#</a></th>
                    <th class="px-5 py-3"><a href="{{ route('adminPanel2', array_merge($baseQuery, ['sort_order' => 'name', 'sort_dir' => $sortOrder === 'name' ? $sortDirOpposite : 'asc'])) }}" class="hover:text-primary">Клиент</a></th>
                    <th class="px-5 py-3"><a href="{{ route('adminPanel2', array_merge($baseQuery, ['sort_order' => 'email', 'sort_dir' => $sortOrder === 'email' ? $sortDirOpposite : 'asc'])) }}" class="hover:text-primary">Email</a></th>
                    <th class="px-5 py-3"><a href="{{ route('adminPanel2', array_merge($baseQuery, ['sort_order' => 'yslyga', 'sort_dir' => $sortOrder === 'yslyga' ? $sortDirOpposite : 'asc'])) }}" class="hover:text-primary">Услуга</a></th>
                    <th class="px-5 py-3">Пакет</th>
                    <th class="px-5 py-3"><a href="{{ route('adminPanel2', array_merge($baseQuery, ['sort_order' => 'status', 'sort_dir' => $sortOrder === 'status' ? $sortDirOpposite : 'asc'])) }}" class="hover:text-primary">Статус</a></th>
                    <th class="px-5 py-3"><a href="{{ route('adminPanel2', array_merge($baseQuery, ['sort_order' => 'created_at', 'sort_dir' => $sortOrder === 'created_at' ? $sortDirOpposite : 'desc'])) }}" class="hover:text-primary">Дата</a></th>
                    <th class="px-5 py-3">Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ordersAll as $order)
                <tr class="border-b border-slate-100 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800/50 admin2-order-row">
                    <td class="px-5 py-3">{{ $order->id }}</td>
                    <td class="px-5 py-3">{{ $order->name ?? $order->user->name ?? '—' }}</td>
                    <td class="px-5 py-3 text-sm">{{ $order->email ?? '—' }}</td>
                    <td class="px-5 py-3">{{ $order->yslyga ?? '—' }}</td>
                    <td class="px-5 py-3">{{ $order->paket ?? '—' }}</td>
                    <td class="px-5 py-3">
                        @if($order->status === 'completed')<span class="px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-200">Завершён</span>
                        @elseif($order->status === 'processing')<span class="px-2 py-0.5 rounded text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-200">В работе</span>
                        @else<span class="px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-200">Новый</span>@endif
                    </td>
                    <td class="px-5 py-3 admin2-text-muted text-sm">{{ $order->created_at?->format('d.m.Y H:i') ?? '—' }}</td>
                    <td class="px-5 py-3">
                        <button type="button" class="admin2-order-edit-btn text-xs text-primary hover:underline mr-1" data-order-id="{{ $order->id }}" data-name="{{ e($order->name ?? '') }}" data-email="{{ e($order->email ?? '') }}" data-nomer="{{ e($order->nomer ?? '') }}" data-yslyga="{{ e($order->yslyga ?? '') }}" data-paket="{{ e($order->paket ?? '') }}" data-status="{{ $order->status ?? 'new' }}">Редакт.</button>
                        <form action="{{ route('orders.updateStatus', $order->id) }}" method="post" class="inline">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="text-xs rounded border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-2 py-1">
                                <option value="new" {{ ($order->status ?? '') === 'new' ? 'selected' : '' }}>Новый</option>
                                <option value="processing" {{ ($order->status ?? '') === 'processing' ? 'selected' : '' }}>В работе</option>
                                <option value="completed" {{ ($order->status ?? '') === 'completed' ? 'selected' : '' }}>Завершён</option>
                            </select>
                        </form>
                    </td>
                </tr>
                <tr class="admin2-order-edit-row hidden border-b border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-800/50" data-order-id="{{ $order->id }}">
                    <td colspan="8" class="px-5 py-3">
                        <form action="{{ route('orders.update', $order->id) }}" method="post" class="flex flex-wrap gap-3 items-end">
                            @csrf
                            @method('PUT')
                            <input type="text" name="name" placeholder="Имя" value="{{ old('name', $order->name) }}" class="rounded border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 px-2 py-1 text-sm w-32">
                            <input type="email" name="email" placeholder="Email" value="{{ old('email', $order->email) }}" class="rounded border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 px-2 py-1 text-sm w-40">
                            <input type="text" name="nomer" placeholder="Телефон" value="{{ old('nomer', $order->nomer) }}" class="rounded border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 px-2 py-1 text-sm w-32">
                            <input type="text" name="yslyga" placeholder="Услуга" value="{{ old('yslyga', $order->yslyga) }}" class="rounded border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 px-2 py-1 text-sm w-40">
                            <select name="paket" class="rounded border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 px-2 py-1 text-sm w-32">
                                <option value="">—</option>
                                <option value="Базовый" {{ ($order->paket ?? '') === 'Базовый' ? 'selected' : '' }}>Базовый</option>
                                <option value="Про" {{ ($order->paket ?? '') === 'Про' ? 'selected' : '' }}>Про</option>
                                <option value="Стандарт" {{ ($order->paket ?? '') === 'Стандарт' ? 'selected' : '' }}>Стандарт</option>
                                <option value="Продвинутая" {{ ($order->paket ?? '') === 'Продвинутая' ? 'selected' : '' }}>Продвинутая</option>
                            </select>
                            <select name="status" class="rounded border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 px-2 py-1 text-sm">
                                <option value="new" {{ ($order->status ?? '') === 'new' ? 'selected' : '' }}>Новый</option>
                                <option value="processing" {{ ($order->status ?? '') === 'processing' ? 'selected' : '' }}>В работе</option>
                                <option value="completed" {{ ($order->status ?? '') === 'completed' ? 'selected' : '' }}>Завершён</option>
                            </select>
                            <button type="submit" class="px-3 py-1 rounded bg-primary text-white text-sm">Сохранить</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="px-5 py-8 admin2-text-muted text-center">Нет заказов</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($ordersAll->hasPages())
    <div class="px-5 py-3 border-t border-slate-200 dark:border-slate-600 flex justify-center gap-2">
        @if($ordersAll->onFirstPage())<span class="px-3 py-1 rounded bg-slate-100 dark:bg-slate-700 text-sm admin2-text-muted">Назад</span>
        @else<a href="{{ $ordersAll->withQueryString()->previousPageUrl() }}" class="px-3 py-1 rounded bg-primary/10 text-primary text-sm hover:bg-primary/20">Назад</a>@endif
        <span class="px-3 py-1 text-sm admin2-text-muted">{{ $ordersAll->currentPage() }} / {{ $ordersAll->lastPage() }}</span>
        @if($ordersAll->hasMorePages())<a href="{{ $ordersAll->withQueryString()->nextPageUrl() }}" class="px-3 py-1 rounded bg-primary/10 text-primary text-sm hover:bg-primary/20">Вперёд</a>
        @else<span class="px-3 py-1 rounded bg-slate-100 dark:bg-slate-700 text-sm admin2-text-muted">Вперёд</span>@endif
    </div>
    @endif
</div>
@push('scripts')
<script>
document.querySelectorAll('.admin2-order-edit-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var id = this.dataset.orderId;
        var row = document.querySelector('.admin2-order-edit-row[data-order-id="' + id + '"]');
        if (row) row.classList.toggle('hidden');
    });
});
(function() {
    var params = new URLSearchParams(window.location.search);
    var openId = params.get('open_order');
    if (openId) {
        var row = document.querySelector('.admin2-order-edit-row[data-order-id="' + openId + '"]');
        if (row) {
            row.classList.remove('hidden');
            row.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    }
})();
</script>
@endpush
