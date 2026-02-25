@extends('layouts.app')

@section('content')
<style>
    .moder-panel-page { padding: 2rem 1rem; }
    .moder-panel-page .moder-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; }
    .moder-panel-page .moder-table th { background: #f8fafc; border-bottom: 1px solid #e2e8f0; padding: 12px; text-align: left; }
    .moder-panel-page .moder-table td { padding: 12px; border-bottom: 1px solid #f1f5f9; }
    .moder-panel-page .moder-link { color: #1e40af; }
    .moder-panel-page .moder-muted { color: #64748b; }
    .moder-panel-layout { display: flex; gap: 1.5rem; align-items: flex-start; flex-wrap: wrap; }
    .moder-panel-sidebar { width: 260px; flex-shrink: 0; }
    .moder-panel-sidebar .moder-card { padding: 0.75rem; max-height: 70vh; overflow-y: auto; }
    .moder-panel-sidebar .moder-account-item { display: block; padding: 0.6rem 0.75rem; border-radius: 8px; text-decoration: none; color: inherit; margin-bottom: 4px; border: 1px solid transparent; }
    .moder-panel-sidebar .moder-account-item:hover { background: #f1f5f9; }
    .moder-panel-sidebar .moder-account-item.active { background: #dbeafe; border-color: #93c5fd; color: #1e40af; }
    .moder-panel-sidebar .moder-account-item .moder-account-name { font-weight: 600; font-size: 0.9rem; }
    .moder-panel-sidebar .moder-account-item .moder-account-email { font-size: 0.75rem; color: #64748b; }
    .moder-panel-main { flex: 1; min-width: 0; }
    .moder-panel-actions { display: flex; flex-wrap: wrap; gap: 0.75rem; align-items: center; margin-bottom: 1rem; }
    .moder-panel-actions .btn-moder { padding: 0.5rem 1rem; border-radius: 8px; text-decoration: none; font-size: 0.875rem; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem; }
    .moder-panel-actions .btn-moder-support { background: #1e40af; color: #fff; }
    .moder-panel-actions .btn-moder-orders { background: #16a34a; color: #fff; }
    .moder-panel-actions .btn-moder-clear { background: #64748b; color: #fff; }
    body.dark-theme .moder-panel-page { color: #e2e8f0; }
    body.dark-theme .moder-panel-page .moder-card { background: #1e293b; border-color: #334155; }
    body.dark-theme .moder-panel-page .moder-table th { background: #334155; border-color: #475569; color: #f1f5f9; }
    body.dark-theme .moder-panel-page .moder-table td { border-color: #334155; color: #e2e8f0; }
    body.dark-theme .moder-panel-page .moder-table select { background: #334155; border-color: #475569; color: #e2e8f0; }
    body.dark-theme .moder-panel-page .moder-link { color: #93c5fd; }
    body.dark-theme .moder-panel-page .moder-muted { color: #94a3b8; }
    body.dark-theme .moder-panel-page h1 { color: #f1f5f9; }
    body.dark-theme .moder-panel-page input[type="text"] { background: #334155; border-color: #475569; color: #e2e8f0; }
    body.dark-theme .moder-panel-page label { color: #94a3b8; }
    body.dark-theme .moder-panel-page .moder-pagination a { color: #93c5fd; }
    body.dark-theme .moder-panel-page .moder-pagination span { color: #94a3b8; }
    body.dark-theme .moder-panel-page .moder-pagination { border-top-color: #334155; }
    body.dark-theme .moder-panel-sidebar .moder-account-item:hover { background: #334155; }
    body.dark-theme .moder-panel-sidebar .moder-account-item.active { background: #1e3a5f; border-color: #3b82f6; color: #93c5fd; }
    body.dark-theme .moder-panel-sidebar .moder-account-item .moder-account-email { color: #94a3b8; }
    .moder-sources-lightbox { position: fixed; inset: 0; z-index: 9999; background: rgba(0,0,0,0.85); display: flex; align-items: center; justify-content: center; padding: 2rem; }
    .moder-sources-lightbox-inner { position: relative; max-width: 90vw; max-height: 85vh; display: flex; flex-direction: column; align-items: center; gap: 1rem; }
    .moder-sources-lightbox-img-wrap { display: flex; align-items: center; justify-content: center; min-height: 200px; }
    .moder-sources-lightbox-img-wrap img { max-width: 100%; max-height: 70vh; object-fit: contain; }
    .moder-sources-lightbox-close { position: absolute; top: -2.5rem; right: 0; width: 40px; height: 40px; border: none; background: rgba(255,255,255,0.2); color: #fff; border-radius: 50%; cursor: pointer; font-size: 1.5rem; line-height: 1; display: flex; align-items: center; justify-content: center; }
    .moder-sources-lightbox-close:hover { background: rgba(255,255,255,0.3); }
    .moder-sources-lightbox-nav { display: flex; align-items: center; gap: 1rem; flex-wrap: wrap; justify-content: center; }
    .moder-sources-lightbox-nav button { width: 44px; height: 44px; border: none; background: rgba(255,255,255,0.2); color: #fff; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; }
    .moder-sources-lightbox-nav button:hover:not(:disabled) { background: rgba(255,255,255,0.35); }
    .moder-sources-lightbox-nav button:disabled { opacity: 0.4; cursor: not-allowed; }
    .moder-sources-lightbox-download { width: 44px; height: 44px; border: none; background: rgba(34, 197, 94, 0.9); color: #fff; border-radius: 50%; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; }
    .moder-sources-lightbox-download:hover { background: #22c55e; color: #fff; }
    .moder-sources-lightbox-counter { color: rgba(255,255,255,0.9); font-size: 0.9rem; }
    .moder-sources-lightbox-placeholder { color: #94a3b8; padding: 2rem; text-align: center; }
    .moder-sources-lightbox.hidden { display: none !important; }
    .moder-table-scroll-top {
        height: 12px;
        overflow-x: auto;
        overflow-y: hidden;
        border-bottom: 1px solid #e2e8f0;
        flex-shrink: 0;
    }
    .moder-table-scroll-top::-webkit-scrollbar { height: 8px; }
    .moder-table-scroll-top { scrollbar-width: thin; }
    .moder-table-scroll-wrap {
        position: relative;
        overflow: hidden;
        cursor: grab;
        user-select: none;
    }
    .moder-table-scroll-wrap.moder-table-dragging { cursor: grabbing; }
    .moder-table-scroll-inner {
        overflow-x: auto;
        overflow-y: visible;
    }
    .moder-table-scroll-inner::-webkit-scrollbar { height: 8px; }
    .moder-table-scroll-inner { scrollbar-width: thin; }
    body.dark-theme .moder-table-scroll-top { border-color: #334155; }
</style>
<div class="container moder-panel-page">
    <header class="moder-panel-header">
        <div class="moder-panel-header-inner">
            <h1 class="moder-panel-title">Панель модератора</h1>
            <p class="moder-panel-subtitle">Заказы и чаты с клиентами</p>
        </div>
        <a href="{{ route('home') }}" class="moder-panel-back">← На главную</a>
    </header>

    <div class="moder-panel-layout">
        <aside class="moder-panel-sidebar">
            <div class="moder-card moder-card-sidebar">
                <h2 class="moder-sidebar-title">Пользователи с заказами</h2>
                <p class="moder-sidebar-hint">Выберите пользователя — ниже появятся его заказы. Чтобы ответить клиенту, нажмите «Открыть чат» у нужного заказа.</p>
                <div class="moder-account-list">
                    @forelse($accountUsers as $u)
                        @php $isActive = (int)($selectedUserId ?? 0) === (int)$u->id; @endphp
                        <a href="{{ route('moder.panel', array_filter(['user_id' => $u->id] + request()->only('filter_status', 'search'))) }}" class="moder-account-item {{ $isActive ? 'active' : '' }}">
                            <span class="moder-account-name">{{ $u->name ?? 'Пользователь #' . $u->id }}</span>
                            <span class="moder-account-email">{{ $u->email ?? '—' }}</span>
                        </a>
                    @empty
                        <p class="moder-muted moder-empty-hint">Нет пользователей с заказами</p>
                    @endforelse
                </div>
            </div>
        </aside>
        <div class="moder-panel-main">
            @if($selectedUser)
                <div class="moder-card moder-card-toolbar">
                    <div class="moder-toolbar-label">Выбран: <strong>{{ $selectedUser->name }}</strong> ({{ $selectedUser->email }})</div>
                    <div class="moder-toolbar-actions">
                        <a href="{{ route('adminPanel2', ['page' => 'messages', 'user_id' => $selectedUser->id]) }}" class="btn-moder btn-moder-support" target="_blank" rel="noopener">Чат поддержки</a>
                        <a href="{{ route('moder.panel', request()->only('filter_status', 'search')) }}" class="btn-moder btn-moder-clear">Сбросить выбор</a>
                    </div>
                </div>
            @endif

    <form method="get" action="{{ route('moder.panel') }}" class="moder-card" style="padding: 1rem; margin-bottom: 1rem;">
        @if($selectedUserId)
            <input type="hidden" name="user_id" value="{{ $selectedUserId }}">
        @endif
        <div style="display: flex; flex-wrap: wrap; gap: 1rem; align-items: flex-end;">
            <div>
                <label class="moder-muted" style="display: block; font-size: 0.75rem; margin-bottom: 4px;">Статус</label>
                <select name="filter_status" style="padding: 0.5rem; border-radius: 8px; border: 1px solid #e2e8f0;">
                    <option value="">Все</option>
                    <option value="new" {{ request('filter_status') === 'new' ? 'selected' : '' }}>Новый</option>
                    <option value="processing" {{ request('filter_status') === 'processing' ? 'selected' : '' }}>В работе</option>
                    <option value="completed" {{ request('filter_status') === 'completed' ? 'selected' : '' }}>Завершён</option>
                </select>
            </div>
            <div>
                <label class="moder-muted" style="display: block; font-size: 0.75rem; margin-bottom: 4px;">Поиск</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="ID, имя, email, услуга" style="padding: 0.5rem; border-radius: 8px; border: 1px solid #e2e8f0; min-width: 200px;">
            </div>
            <button type="submit" style="padding: 0.5rem 1rem; background: #1e40af; color: #fff; border: none; border-radius: 8px; cursor: pointer;">Применить</button>
        </div>
    </form>

    <div class="moder-card moder-table-card" style="overflow: hidden;">
        <div class="moder-table-scroll-top" id="moder-table-scroll-top" aria-hidden="true"><div id="moder-table-scroll-spacer" style="height:1px; min-width: 0;"></div></div>
        <div class="moder-table-scroll-wrap" id="moder-table-scroll-wrap">
            <div class="moder-table-scroll-inner" id="moder-table-scroll-inner" style="overflow-x: auto;">
            <table class="moder-table" style="width: 100%; border-collapse: collapse; font-size: 0.875rem; min-width: 800px;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Клиент</th>
                        <th>Email</th>
                        <th>Услуга</th>
                        <th>Статус</th>
                        <th>Превью</th>
                        <th>Исходники</th>
                        <th>Чат</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->name ?? $order->user->name ?? '—' }}</td>
                        <td>{{ $order->email ?? '—' }}</td>
                        <td>{{ $order->yslyga ?? '—' }}</td>
                        <td>
                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="post" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()" style="padding: 4px 8px; border-radius: 6px; border: 1px solid #e2e8f0;">
                                    <option value="new" {{ ($order->status ?? '') === 'new' ? 'selected' : '' }}>Новый</option>
                                    <option value="processing" {{ ($order->status ?? '') === 'processing' ? 'selected' : '' }}>В работе</option>
                                    <option value="completed" {{ ($order->status ?? '') === 'completed' ? 'selected' : '' }}>Завершён</option>
                                </select>
                            </form>
                        </td>
                        <td class="moder-preview-cell">
                            @if($order->preview_path)
                                <a href="{{ asset('storage/' . $order->preview_path) }}" target="_blank" rel="noopener" class="moder-link">Превью</a>
                            @else
                                <span class="moder-muted">—</span>
                            @endif
                        </td>
                        <td class="moder-sources-cell">
                            @php
                                $sourcesList = [];
                                if ($order->photos_paths && is_array($order->photos_paths)) {
                                    foreach ($order->photos_paths as $i => $p) {
                                        $sourcesList[] = ['url' => asset('storage/' . $p), 'label' => 'Фото ' . ($i + 1), 'img' => true];
                                    }
                                }
                                if ($order->sources_path) {
                                    $sourcesList[] = ['url' => asset('storage/' . $order->sources_path), 'label' => 'Исходник', 'img' => preg_match('/\.(jpe?g|png|gif|webp)$/i', $order->sources_path)];
                                }
                            @endphp
                            @if(count($sourcesList) > 0)
                                <button type="button" class="moder-sources-preview-btn" data-sources="{{ json_encode($sourcesList) }}" style="padding: 4px 10px; background: #1e40af; color: #fff; border: none; border-radius: 6px; cursor: pointer; font-size: 0.8rem;">Предпросмотр</button>
                            @else
                                <span class="moder-muted">—</span>
                            @endif
                        </td>
                        <td>
                            @if($order->chat_closed_at || ($order->status ?? '') === 'completed')
                                <span class="moder-muted">Закрыт</span>
                            @else
                                <span style="color: #16a34a;">Открыт</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('moder.order.chat', $order->id) }}" class="moder-link" style="margin-right: 8px;">Открыть чат</a>
                            <form class="moder-preview-upload-form" action="{{ route('orders.preview.upload', $order->id) }}" method="post" enctype="multipart/form-data" style="display: inline;" data-order-id="{{ $order->id }}">
                                @csrf
                                <input type="file" name="preview" accept=".jpg,.jpeg,.png,.gif,.webp,.pdf" style="display: none;" id="preview-{{ $order->id }}">
                                <button type="button" class="moder-preview-upload-btn" data-input-id="preview-{{ $order->id }}" style="padding: 4px 10px; background: #16a34a; color: #fff; border: none; border-radius: 6px; cursor: pointer; font-size: 0.8rem;">Отправить заказ</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" style="padding: 2rem; text-align: center;" class="moder-muted">Нет заказов</td></tr>
                    @endforelse
                </tbody>
            </table>
            </div>
        </div>
        @if($orders->hasPages())
        <div class="moder-pagination" style="padding: 12px; border-top: 1px solid #e2e8f0; display: flex; justify-content: center; gap: 8px;">
            @if($orders->onFirstPage())
                <span style="padding: 6px 12px;" class="moder-muted">Назад</span>
            @else
                <a href="{{ $orders->previousPageUrl() }}" style="padding: 6px 12px;">Назад</a>
            @endif
            <span style="padding: 6px 12px;">{{ $orders->currentPage() }} / {{ $orders->lastPage() }}</span>
            @if($orders->hasMorePages())
                <a href="{{ $orders->nextPageUrl() }}" style="padding: 6px 12px;">Вперёд</a>
            @else
                <span style="padding: 6px 12px;" class="moder-muted">Вперёд</span>
            @endif
        </div>
        @endif
    </div>
        </div>
    </div>
</div>

<div id="moder-sources-lightbox" class="moder-sources-lightbox hidden" style="display: none;" aria-hidden="true">
    <div class="moder-sources-lightbox-inner">
        <button type="button" id="moder-sources-lightbox-close" class="moder-sources-lightbox-close" aria-label="Закрыть">&times;</button>
        <div class="moder-sources-lightbox-img-wrap" id="moder-sources-lightbox-content">
            <img id="moder-sources-lightbox-img" src="" alt="" style="display: none;">
            <div id="moder-sources-lightbox-placeholder" class="moder-sources-lightbox-placeholder" style="display: none; color: #e2e8f0;">Файл не изображение — скачайте по кнопке ниже</div>
        </div>
        <div class="moder-sources-lightbox-nav">
            <button type="button" id="moder-sources-lightbox-prev" aria-label="Назад">&larr;</button>
            <span class="moder-sources-lightbox-counter" id="moder-sources-lightbox-counter">1 / 1</span>
            <button type="button" id="moder-sources-lightbox-next" aria-label="Вперёд">&rarr;</button>
            <a href="#" id="moder-sources-lightbox-download" class="moder-sources-lightbox-download" download aria-label="Скачать" title="Скачать">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            </a>
        </div>
    </div>
</div>

<script>
(function() {
    var scrollTop = document.getElementById('moder-table-scroll-top');
    var scrollInner = document.getElementById('moder-table-scroll-inner');
    var scrollWrap = document.getElementById('moder-table-scroll-wrap');
    var scrollSpacer = document.getElementById('moder-table-scroll-spacer');
    if (scrollSpacer && scrollInner) {
        function syncScrollSpacer() {
            scrollSpacer.style.width = scrollInner.scrollWidth + 'px';
        }
        syncScrollSpacer();
        if (typeof ResizeObserver !== 'undefined') {
            new ResizeObserver(syncScrollSpacer).observe(scrollInner);
        }
    }
    if (scrollTop && scrollInner) {
        scrollTop.addEventListener('scroll', function() { scrollInner.scrollLeft = scrollTop.scrollLeft; });
        scrollInner.addEventListener('scroll', function() { scrollTop.scrollLeft = scrollInner.scrollLeft; });
    }
    if (scrollWrap && scrollInner) {
        var dragging = false, startX, startLeft;
        scrollWrap.addEventListener('mousedown', function(e) {
            if (e.target.closest('a, button, input, select')) return;
            dragging = true;
            startX = e.pageX;
            startLeft = scrollInner.scrollLeft;
            scrollWrap.classList.add('moder-table-dragging');
        });
        document.addEventListener('mousemove', function(e) {
            if (!dragging) return;
            scrollInner.scrollLeft = startLeft - (e.pageX - startX);
            if (scrollTop) scrollTop.scrollLeft = scrollInner.scrollLeft;
        });
        document.addEventListener('mouseup', function() {
            dragging = false;
            scrollWrap.classList.remove('moder-table-dragging');
        });
    }

    var csrf = document.querySelector('meta[name="csrf-token"]');
    if (!csrf) return;
    csrf = csrf.getAttribute('content');
    document.querySelectorAll('.moder-preview-upload-form').forEach(function(form) {
        var input = form.querySelector('input[name="preview"]');
        var btn = form.querySelector('.moder-preview-upload-btn');
        if (!input || !btn) return;
        if (btn) btn.addEventListener('click', function() { input.click(); });
        input.addEventListener('change', function() {
            if (!this.files || !this.files.length) return;
            var fd = new FormData(form);
            fd.append('_token', csrf);
            fetch(form.action, { method: 'POST', body: fd, headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' } })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    if (data.success) {
                        var cell = form.closest('tr').querySelector('.moder-preview-cell');
                        if (cell && data.preview_url) {
                            cell.innerHTML = '<a href="' + data.preview_url + '" target="_blank" rel="noopener" class="moder-link">Превью</a>';
                        }
                        input.value = '';
                    }
                });
        });
    });

    var sourcesLightbox = document.getElementById('moder-sources-lightbox');
    var sourcesList = [];
    var sourcesIndex = 0;
    function openSourcesPreview(list) {
        sourcesList = list && list.length ? list : [];
        sourcesIndex = 0;
        if (sourcesList.length === 0) return;
        sourcesLightbox.style.display = 'flex';
        sourcesLightbox.classList.remove('hidden');
        sourcesLightbox.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        showSourceSlide();
    }
    function showSourceSlide() {
        var img = document.getElementById('moder-sources-lightbox-img');
        var placeholder = document.getElementById('moder-sources-lightbox-placeholder');
        var counter = document.getElementById('moder-sources-lightbox-counter');
        var downloadBtn = document.getElementById('moder-sources-lightbox-download');
        var prevBtn = document.getElementById('moder-sources-lightbox-prev');
        var nextBtn = document.getElementById('moder-sources-lightbox-next');
        if (sourcesList.length === 0) return;
        var cur = sourcesList[sourcesIndex];
        counter.textContent = (sourcesIndex + 1) + ' / ' + sourcesList.length;
        downloadBtn.href = cur.url;
        downloadBtn.download = (cur.label || 'file') + (cur.url.match(/\.[a-z0-9]+$/i) ? '' : '');
        if (cur.img) {
            img.src = cur.url;
            img.style.display = 'block';
            img.alt = cur.label || '';
            placeholder.style.display = 'none';
        } else {
            img.style.display = 'none';
            img.removeAttribute('src');
            placeholder.style.display = 'block';
        }
        if (prevBtn) { prevBtn.disabled = sourcesIndex <= 0; }
        if (nextBtn) { nextBtn.disabled = sourcesIndex >= sourcesList.length - 1; }
    }
    function closeSourcesPreview() {
        sourcesLightbox.style.display = 'none';
        sourcesLightbox.classList.add('hidden');
        sourcesLightbox.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }
    document.querySelectorAll('.moder-sources-preview-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            try {
                var data = this.getAttribute('data-sources');
                var list = data ? JSON.parse(data) : [];
                openSourcesPreview(list);
            } catch (e) {}
        });
    });
    document.getElementById('moder-sources-lightbox-close') && document.getElementById('moder-sources-lightbox-close').addEventListener('click', closeSourcesPreview);
    sourcesLightbox && sourcesLightbox.addEventListener('click', function(e) { if (e.target === sourcesLightbox) closeSourcesPreview(); });
    document.getElementById('moder-sources-lightbox-prev') && document.getElementById('moder-sources-lightbox-prev').addEventListener('click', function() {
        if (sourcesIndex > 0) { sourcesIndex--; showSourceSlide(); }
    });
    document.getElementById('moder-sources-lightbox-next') && document.getElementById('moder-sources-lightbox-next').addEventListener('click', function() {
        if (sourcesIndex < sourcesList.length - 1) { sourcesIndex++; showSourceSlide(); }
    });
    document.addEventListener('keydown', function(e) {
        if (!sourcesLightbox || sourcesLightbox.style.display !== 'flex') return;
        if (e.key === 'Escape') closeSourcesPreview();
        if (e.key === 'ArrowLeft') { if (sourcesIndex > 0) { sourcesIndex--; showSourceSlide(); } }
        if (e.key === 'ArrowRight') { if (sourcesIndex < sourcesList.length - 1) { sourcesIndex++; showSourceSlide(); } }
    });
})();
</script>
@endsection
