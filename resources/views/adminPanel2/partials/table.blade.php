@php
    $f = $filters ?? [];
    $sortTable = request()->get('sort_table', 'created_at');
    $dirTable = request()->get('sort_dir_table', 'desc');
    $dirTableOpp = $dirTable === 'asc' ? 'desc' : 'asc';
    $baseTable = array_merge(request()->query(), ['page' => 'table']);
@endphp
<form method="get" action="{{ route('adminPanel2', ['page' => 'table']) }}" class="admin2-card rounded-xl p-4 mb-4">
    <input type="hidden" name="page" value="table">
    <div class="flex flex-wrap items-end gap-3">
        <div>
            <label class="block text-xs admin2-text-muted mb-1">Статус</label>
            <select name="filter_table_status" class="rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm w-40">
                <option value="">Все</option>
                <option value="new" {{ ($f['table_status'] ?? '') === 'new' ? 'selected' : '' }}>Новый</option>
                <option value="processing" {{ ($f['table_status'] ?? '') === 'processing' ? 'selected' : '' }}>В работе</option>
                <option value="completed" {{ ($f['table_status'] ?? '') === 'completed' ? 'selected' : '' }}>Завершён</option>
            </select>
        </div>
        <div>
            <label class="block text-xs admin2-text-muted mb-1">Поиск</label>
            <input type="text" name="filter_table_search" value="{{ $f['table_search'] ?? '' }}" placeholder="Имя, email, телефон, услуга" class="rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm w-56">
        </div>
        <button type="submit" class="px-4 py-2 rounded-lg bg-primary text-white text-sm font-medium hover:opacity-90">Применить</button>
        <a href="{{ route('adminPanel2', ['page' => 'table']) }}" class="px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 text-sm">Сбросить</a>
    </div>
</form>
<div class="admin2-card rounded-xl shadow-sm overflow-hidden">
    <div class="px-5 py-4 border-b border-slate-200 dark:border-slate-600 flex flex-wrap items-center justify-between gap-2">
        <h2 class="text-lg font-semibold">Общая таблица заявок</h2>
        <a href="{{ route('adminPanel2.export.table', request()->query()) }}" class="text-sm text-green-600 dark:text-green-400 hover:underline">Скачать в Excel</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="admin2-text-muted font-medium border-b border-slate-200 dark:border-slate-600">
                <tr>
                    <th class="px-4 py-3"><a href="{{ route('adminPanel2', array_merge($baseTable, ['sort_table' => 'id', 'sort_dir_table' => $sortTable === 'id' ? $dirTableOpp : 'desc'])) }}" class="hover:text-primary">ID</a></th>
                    <th class="px-4 py-3"><a href="{{ route('adminPanel2', array_merge($baseTable, ['sort_table' => 'name', 'sort_dir_table' => $sortTable === 'name' ? $dirTableOpp : 'asc'])) }}" class="hover:text-primary">Имя</a></th>
                    <th class="px-4 py-3"><a href="{{ route('adminPanel2', array_merge($baseTable, ['sort_table' => 'email', 'sort_dir_table' => $sortTable === 'email' ? $dirTableOpp : 'asc'])) }}" class="hover:text-primary">Email</a></th>
                    <th class="px-4 py-3">Телефон</th>
                    <th class="px-4 py-3"><a href="{{ route('adminPanel2', array_merge($baseTable, ['sort_table' => 'yslyga', 'sort_dir_table' => $sortTable === 'yslyga' ? $dirTableOpp : 'asc'])) }}" class="hover:text-primary">Услуга</a></th>
                    <th class="px-4 py-3">Пакет</th>
                    <th class="px-4 py-3"><a href="{{ route('adminPanel2', array_merge($baseTable, ['sort_table' => 'status', 'sort_dir_table' => $sortTable === 'status' ? $dirTableOpp : 'asc'])) }}" class="hover:text-primary">Статус</a></th>
                    <th class="px-4 py-3">Пользователь</th>
                    <th class="px-4 py-3"><a href="{{ route('adminPanel2', array_merge($baseTable, ['sort_table' => 'created_at', 'sort_dir_table' => $sortTable === 'created_at' ? $dirTableOpp : 'desc'])) }}" class="hover:text-primary">Дата</a></th>
                    <th class="px-4 py-3">Изменить</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applicationsAll as $app)
                <tr class="border-b border-slate-100 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800/50">
                    <td class="px-4 py-3">{{ $app->id }}</td>
                    <td class="px-4 py-3">{{ $app->name ?? '—' }}</td>
                    <td class="px-4 py-3">{{ $app->email ?? '—' }}</td>
                    <td class="px-4 py-3">{{ $app->nomer ?? '—' }}</td>
                    <td class="px-4 py-3">{{ $app->yslyga ?? '—' }}</td>
                    <td class="px-4 py-3">{{ $app->paket ?? '—' }}</td>
                    <td class="px-4 py-3">
                        @if($app->status === 'completed')<span class="px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-200">Завершён</span>
                        @elseif($app->status === 'processing')<span class="px-2 py-0.5 rounded text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-200">В работе</span>
                        @else<span class="px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-200">Новый</span>@endif
                    </td>
                    <td class="px-4 py-3">{{ $app->user->name ?? '—' }}</td>
                    <td class="px-4 py-3 admin2-text-muted">{{ $app->created_at?->format('d.m.Y H:i') ?? '—' }}</td>
                    <td class="px-4 py-3">
                        <form action="{{ route('orders.updateStatus', $app->id) }}" method="post" class="inline">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="text-xs rounded border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-2 py-1">
                                <option value="new" {{ ($app->status ?? '') === 'new' ? 'selected' : '' }}>Новый</option>
                                <option value="processing" {{ ($app->status ?? '') === 'processing' ? 'selected' : '' }}>В работе</option>
                                <option value="completed" {{ ($app->status ?? '') === 'completed' ? 'selected' : '' }}>Завершён</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="10" class="px-5 py-8 admin2-text-muted text-center">Нет данных</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($applicationsAll->hasPages())
    <div class="px-5 py-3 border-t border-slate-200 dark:border-slate-600 flex justify-center gap-2">
        @if($applicationsAll->onFirstPage())<span class="px-3 py-1 rounded bg-slate-100 dark:bg-slate-700 text-sm admin2-text-muted">Назад</span>
        @else<a href="{{ $applicationsAll->withQueryString()->previousPageUrl() }}" class="px-3 py-1 rounded bg-primary/10 text-primary text-sm hover:bg-primary/20">Назад</a>@endif
        <span class="px-3 py-1 text-sm admin2-text-muted">{{ $applicationsAll->currentPage() }} / {{ $applicationsAll->lastPage() }}</span>
        @if($applicationsAll->hasMorePages())<a href="{{ $applicationsAll->withQueryString()->nextPageUrl() }}" class="px-3 py-1 rounded bg-primary/10 text-primary text-sm hover:bg-primary/20">Вперёд</a>
        @else<span class="px-3 py-1 rounded bg-slate-100 dark:bg-slate-700 text-sm admin2-text-muted">Вперёд</span>@endif
    </div>
    @endif
</div>
