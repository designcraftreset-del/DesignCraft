@php
    $f = $filters ?? [];
    $sortProducts = request()->get('sort_products', 'created_at');
    $dirProducts = request()->get('sort_dir_products', 'desc');
    $dirProductsOpp = $dirProducts === 'asc' ? 'desc' : 'asc';
    $baseProducts = array_merge(request()->query(), ['page' => 'products']);
@endphp
<form method="get" action="{{ route('adminPanel2', ['page' => 'products']) }}" class="admin2-card rounded-xl p-4 mb-4">
    <input type="hidden" name="page" value="products">
    <div class="flex flex-wrap items-end gap-3">
        <div>
            <label class="block text-xs admin2-text-muted mb-1">Поиск</label>
            <input type="text" name="filter_product_search" value="{{ $f['product_search'] ?? '' }}" placeholder="Название, категория" class="rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm w-56">
        </div>
        <button type="submit" class="px-4 py-2 rounded-lg bg-primary text-white text-sm font-medium hover:opacity-90">Применить</button>
        <a href="{{ route('adminPanel2', ['page' => 'products']) }}" class="px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 text-sm">Сбросить</a>
    </div>
</form>
<div class="admin2-card rounded-xl shadow-sm overflow-hidden">
    <div class="px-5 py-4 border-b border-slate-200 dark:border-slate-600 flex flex-wrap items-center justify-between gap-2">
        <h2 class="text-lg font-semibold">Товары / Услуги</h2>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('services.create') }}" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg bg-primary text-white text-sm font-medium hover:opacity-90">+ Выложить услугу</a>
            <a href="{{ route('news.create') }}" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-600 text-sm hover:bg-slate-50 dark:hover:bg-slate-800">+ Новость</a>
            <a href="{{ route('adminPanel2.export.services', request()->query()) }}" class="text-sm text-green-600 dark:text-green-400 hover:underline">Скачать в Excel</a>
            <a href="{{ url('/services') }}" class="text-sm text-primary hover:underline">Управление на сайте</a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="admin2-text-muted text-sm font-medium border-b border-slate-200 dark:border-slate-600">
                <tr>
                    <th class="px-5 py-3"><a href="{{ route('adminPanel2', array_merge($baseProducts, ['sort_products' => 'id', 'sort_dir_products' => $sortProducts === 'id' ? $dirProductsOpp : 'desc'])) }}" class="hover:text-primary">ID</a></th>
                    <th class="px-5 py-3"><a href="{{ route('adminPanel2', array_merge($baseProducts, ['sort_products' => 'title', 'sort_dir_products' => $sortProducts === 'title' ? $dirProductsOpp : 'asc'])) }}" class="hover:text-primary">Название</a></th>
                    <th class="px-5 py-3"><a href="{{ route('adminPanel2', array_merge($baseProducts, ['sort_products' => 'category', 'sort_dir_products' => $sortProducts === 'category' ? $dirProductsOpp : 'asc'])) }}" class="hover:text-primary">Категория</a></th>
                    <th class="px-5 py-3"><a href="{{ route('adminPanel2', array_merge($baseProducts, ['sort_products' => 'money', 'sort_dir_products' => $sortProducts === 'money' ? $dirProductsOpp : 'asc'])) }}" class="hover:text-primary">Цена</a></th>
                    <th class="px-5 py-3"><a href="{{ route('adminPanel2', array_merge($baseProducts, ['sort_products' => 'term', 'sort_dir_products' => $sortProducts === 'term' ? $dirProductsOpp : 'asc'])) }}" class="hover:text-primary">Срок</a></th>
                    <th class="px-5 py-3"><a href="{{ route('adminPanel2', array_merge($baseProducts, ['sort_products' => 'created_at', 'sort_dir_products' => $sortProducts === 'created_at' ? $dirProductsOpp : 'desc'])) }}" class="hover:text-primary">Создано</a></th>
                    <th class="px-5 py-3">Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $s)
                <tr class="border-b border-slate-100 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800/50">
                    <td class="px-5 py-3">{{ $s->id }}</td>
                    <td class="px-5 py-3 font-medium">{{ $s->title ?? $s->titleTwo ?? '—' }}</td>
                    <td class="px-5 py-3">{{ $s->category ?? '—' }}</td>
                    <td class="px-5 py-3">{{ $s->money ?? '—' }}</td>
                    <td class="px-5 py-3">{{ $s->term ?? '—' }}</td>
                    <td class="px-5 py-3 admin2-text-muted text-sm">{{ $s->created_at?->format('d.m.Y') ?? '—' }}</td>
                    <td class="px-5 py-3">
                        <button type="button" class="admin2-service-edit-btn text-xs text-primary hover:underline" data-service-id="{{ $s->id }}">Редакт.</button>
                    </td>
                </tr>
                <tr class="admin2-service-edit-row hidden border-b border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-800/50" data-service-id="{{ $s->id }}">
                    <td colspan="7" class="px-5 py-3">
                        <form action="{{ route('services.update', $s->id) }}" method="post" class="flex flex-wrap gap-3 items-end">
                            @csrf
                            @method('PUT')
                            <input type="text" name="title" placeholder="Название" value="{{ old('title', $s->title) }}" class="rounded border px-2 py-1 text-sm w-40">
                            <input type="text" name="titleTwo" placeholder="Название 2" value="{{ old('titleTwo', $s->titleTwo) }}" class="rounded border px-2 py-1 text-sm w-40">
                            <input type="text" name="category" placeholder="Категория" value="{{ old('category', $s->category) }}" class="rounded border px-2 py-1 text-sm w-28">
                            <input type="text" name="money" placeholder="Цена" value="{{ old('money', $s->money) }}" class="rounded border px-2 py-1 text-sm w-24">
                            <input type="text" name="term" placeholder="Срок" value="{{ old('term', $s->term) }}" class="rounded border px-2 py-1 text-sm w-24">
                            <button type="submit" class="px-3 py-1 rounded bg-primary text-white text-sm">Сохранить</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="px-5 py-8 admin2-text-muted text-center">Нет услуг</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($services->hasPages())
    <div class="px-5 py-3 border-t border-slate-200 dark:border-slate-600 flex justify-center gap-2">
        @if($services->onFirstPage())<span class="px-3 py-1 rounded bg-slate-100 dark:bg-slate-700 text-sm admin2-text-muted">Назад</span>
        @else<a href="{{ $services->withQueryString()->previousPageUrl() }}" class="px-3 py-1 rounded bg-primary/10 text-primary text-sm hover:bg-primary/20">Назад</a>@endif
        <span class="px-3 py-1 text-sm admin2-text-muted">{{ $services->currentPage() }} / {{ $services->lastPage() }}</span>
        @if($services->hasMorePages())<a href="{{ $services->withQueryString()->nextPageUrl() }}" class="px-3 py-1 rounded bg-primary/10 text-primary text-sm hover:bg-primary/20">Вперёд</a>
        @else<span class="px-3 py-1 rounded bg-slate-100 dark:bg-slate-700 text-sm admin2-text-muted">Вперёд</span>@endif
    </div>
    @endif
</div>
@push('scripts')
<script>
document.querySelectorAll('.admin2-service-edit-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var id = this.dataset.serviceId;
        var row = document.querySelector('.admin2-service-edit-row[data-service-id="' + id + '"]');
        if (row) row.classList.toggle('hidden');
    });
});
</script>
@endpush
