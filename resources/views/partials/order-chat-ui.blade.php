{{-- Чат заказов в стиле админки (список слева, сообщения справа). Использовать в ЛК и в модер-панели. --}}
@php
    $isModer = isset($moderOrder) && $moderOrder;
    $backUrl = $backUrl ?? route('moder.panel');
    $layoutHeight = $layoutHeight ?? 'min-height: 500px;';
    $showBackLink = $showBackLink ?? true;
@endphp
<style>
    .order-chat-layout {
        display: flex;
        flex-direction: column;
        flex: 1;
        min-height: 0;
        max-height: 520px;
        height: calc(100vh - 220px);
        min-height: 420px;
    }
    @media (min-width: 768px) { .order-chat-layout { flex-direction: row; } }
    .order-chat-threads-col { width: 100%; max-height: 400px; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; display: flex; flex-direction: column; }
    @media (min-width: 768px) { .order-chat-threads-col { width: 280px; max-width: 280px; max-height: none; border-right: 1px solid #e2e8f0; border-radius: 12px 0 0 12px; } }
    .order-chat-threads-list { flex: 1; overflow-y: auto; min-height: 0; }
    /* При более чем 6 заказах — ограничиваем высоту списка, чтобы появился скролл */
    .order-chat-threads-col.order-chat-threads-col--scroll .order-chat-threads-list { max-height: 420px; }
    .order-chat-thread { width: 100%; text-align: left; padding: 12px; border: none; border-bottom: 1px solid #e2e8f0; background: #fff; cursor: pointer; display: flex; align-items: center; gap: 10px; transition: background 0.2s; }
    .order-chat-thread:hover { background: #f8fafc; }
    .order-chat-thread.active { background: #eff6ff; }
    .order-chat-thread-icon { width: 40px; height: 40px; border-radius: 50%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: #64748b; }
    .order-chat-thread-title { font-weight: 600; font-size: 0.9rem; }
    .order-chat-thread-preview { font-size: 0.75rem; color: #64748b; margin-top: 2px; }
    .order-chat-thread-closed { font-size: 0.7rem; color: #94a3b8; }
    .order-chat-right { flex: 1; display: flex; flex-direction: column; min-height: 0; border: 1px solid #e2e8f0; border-radius: 0 12px 12px 0; border-top: 1px solid #e2e8f0; }
    @media (min-width: 768px) { .order-chat-right { border-top: none; border-left: none; } }
    .order-chat-header { padding: 12px; border-bottom: 1px solid #e2e8f0; flex-shrink: 0; }
    .order-chat-messages { flex: 1; overflow-y: auto; padding: 12px; display: flex; flex-direction: column; gap: 8px; min-height: 200px; background: #f8fafc; }
    .order-chat-placeholder { color: #64748b; text-align: center; padding: 2rem; }
    .order-chat-form-wrap { padding: 12px; border-top: 1px solid #e2e8f0; background: #fff; flex-shrink: 0; }
    .order-chat-msg-item { display: flex; gap: 8px; width: 100%; }
    .order-chat-msg-item.own { flex-direction: row-reverse; }
    .order-chat-msg-bubble { max-width: 80%; border-radius: 12px; padding: 8px 12px; }
    .order-chat-msg-bubble.own { background: #1e40af; color: #fff; padding-bottom: 1rem; }
    .order-chat-msg-bubble.own .name,
    .order-chat-msg-bubble.own .time,
    .order-chat-msg-bubble.own .text { color: #fff; }
    .order-chat-msg-bubble.own .text { margin-bottom: 0; }
    .order-chat-msg-bubble.other { background: #e2e8f0; color: #0f172a; }
    .order-chat-msg-bubble .name { font-weight: 600; font-size: 0.8rem; }
    .order-chat-msg-bubble .time { font-size: 0.7rem; opacity: 0.9; }
    .order-chat-msg-bubble .text { margin-top: 4px; white-space: pre-wrap; }
    .order-chat-msg-img { display: block; margin-top: 6px; border-radius: 8px; overflow: hidden; }
    .order-chat-msg-img img { max-height: 160px; cursor: pointer; }
    .order-chat-msg-file { display: inline-flex; align-items: center; gap: 6px; margin-top: 4px; font-size: 0.85rem; text-decoration: underline; color: inherit; }
    body.dark-theme .order-chat-thread { background: #1e293b; border-color: #334155; color: #e2e8f0; }
    body.dark-theme .order-chat-thread:hover { background: #334155; }
    body.dark-theme .order-chat-thread.active { background: #1e3a8a; }
    body.dark-theme .order-chat-thread-icon { background: #475569; color: #f1f5f9; }
    body.dark-theme .order-chat-thread-title { color: #f1f5f9; }
    body.dark-theme .order-chat-thread-preview { color: #94a3b8; }
    body.dark-theme .order-chat-thread-closed { color: #64748b; }
    body.dark-theme .order-chat-messages { background: #1e293b; }
    body.dark-theme .order-chat-msg-bubble.other { background: #334155; color: #f1f5f9; }
    body.dark-theme .order-chat-form-wrap { background: #1e293b; border-color: #334155; }
    body.dark-theme .order-chat-file-label { background: #334155 !important; border-color: #475569 !important; color: #e2e8f0 !important; }
    body.dark-theme .order-chat-file-label:hover { background: #475569 !important; color: #f1f5f9 !important; }
    body.dark-theme .order-chat-toolbar { border-color: #334155; }
    body.dark-theme .order-chat-toolbar input[type="text"] { background: #334155; border-color: #475569; color: #e2e8f0; }
    body.dark-theme .order-chat-hide-closed-wrap { color: #94a3b8; }
    .order-chat-hide-closed-toggle {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 0;
        border: none;
        background: none;
        cursor: pointer;
        font-size: 0.875rem;
        color: #64748b;
        font-family: inherit;
    }
    .order-chat-hide-closed-track {
        width: 36px;
        height: 20px;
        border-radius: 10px;
        background: #cbd5e1;
        position: relative;
        transition: background 0.2s;
    }
    .order-chat-hide-closed-thumb {
        position: absolute;
        top: 2px;
        left: 2px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #fff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        transition: transform 0.2s;
    }
    .order-chat-hide-closed-toggle[aria-checked="true"] .order-chat-hide-closed-track { background: #1e40af; }
    .order-chat-hide-closed-toggle[aria-checked="true"] .order-chat-hide-closed-thumb { transform: translateX(16px); }
    body.dark-theme .order-chat-hide-closed-toggle { color: #94a3b8; }
    body.dark-theme .order-chat-hide-closed-track { background: #475569; }
    body.dark-theme .order-chat-hide-closed-toggle[aria-checked="true"] .order-chat-hide-closed-track { background: #3b82f6; }
    .order-chat-attach-preview { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
    .order-chat-attach-preview-item { display: inline-flex; align-items: flex-start; gap: 4px; }
    .order-chat-attach-preview img { max-width: 80px; max-height: 80px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0; }
    .order-chat-attach-preview-file { display: inline-flex; align-items: center; gap: 6px; padding: 6px 10px; background: #f1f5f9; border-radius: 8px; font-size: 0.85rem; color: #475569; }
    .order-chat-attach-preview-remove { margin-left: 4px; padding: 2px 6px; border: none; background: #e2e8f0; border-radius: 4px; cursor: pointer; font-size: 0.75rem; color: #64748b; }
    .order-chat-attach-preview-remove:hover { background: #cbd5e1; color: #0f172a; }
    body.dark-theme .order-chat-attach-preview img { border-color: #475569; }
    body.dark-theme .order-chat-attach-preview-file { background: #334155; color: #94a3b8; }
    body.dark-theme .order-chat-attach-preview-remove { background: #475569; color: #94a3b8; }
    body.dark-theme .order-chat-attach-preview-remove:hover { background: #64748b; color: #f1f5f9; }
    #order-chat-lightbox.order-chat-lightbox { display: none !important; }
    #order-chat-lightbox.order-chat-lightbox.is-open { display: flex !important; }
</style>
@if($isModer && $showBackLink)
<div class="order-chat-back-row" style="margin-bottom: 10px;">
    <a href="{{ $backUrl }}" class="order-chat-back-link" style="color: #1e40af; text-decoration: none;">← К заказам</a>
</div>
@endif
<div class="order-chat-layout" id="order-chat-layout">
    <div class="order-chat-threads-col" id="order-chat-threads-col">
        <div class="order-chat-toolbar" style="padding: 8px; border-bottom: 1px solid #e2e8f0; flex-shrink: 0; display: flex; flex-direction: column; gap: 8px;">
            <input type="text" id="order-chat-search" placeholder="Поиск по заказам (№ или услуга)" style="width: 100%; padding: 8px 10px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 0.875rem;">
            <button type="button" id="order-chat-hide-closed" class="order-chat-hide-closed-toggle" role="switch" aria-checked="false" title="Скрыть закрытые чаты">
                <span class="order-chat-hide-closed-track">
                    <span class="order-chat-hide-closed-thumb"></span>
                </span>
                <span class="order-chat-hide-closed-label">Скрыть закрытые чаты</span>
            </button>
        </div>
        <div id="order-chat-threads-list" class="order-chat-threads-list"></div>
        <div id="order-chat-threads-empty" class="order-chat-placeholder" style="padding: 1.5rem;">Выберите заказ слева</div>
    </div>
    <div class="order-chat-right">
        <div id="order-chat-header" class="order-chat-header" style="display: none;">
            <p id="order-chat-title" class="order-chat-title" style="margin: 0; font-weight: 600;"></p>
            <p id="order-chat-closed-badge" class="order-chat-closed-badge" style="display: none; margin: 4px 0 0; font-size: 0.8rem; color: #94a3b8;">Чат закрыт</p>
        </div>
        <div id="order-chat-messages" class="order-chat-messages"></div>
        <div id="order-chat-placeholder" class="order-chat-placeholder">Выберите заказ слева</div>
        <div id="order-chat-form-wrap" class="order-chat-form-wrap" style="display: none;">
            <div id="order-chat-attach-preview" class="order-chat-attach-preview" style="display: none; padding: 8px 0; border-bottom: 1px solid #e2e8f0; margin-bottom: 8px;"></div>
            <form id="order-chat-reply-form" enctype="multipart/form-data" style="display: flex; gap: 8px; align-items: flex-end; flex-wrap: wrap; flex-direction: row;">
                <input type="hidden" name="order_id" id="order-chat-reply-order-id" value="">
                <input type="text" name="message" id="order-chat-reply-text" placeholder="Сообщение..." style="flex: 1; min-width: 120px; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px;">
                <label class="order-chat-file-label" title="Прикрепить фото" style="width: 40px; height: 40px; border: 1px solid #e2e8f0; border-radius: 8px; display: flex; align-items: center; justify-content: center; cursor: pointer; background: #fff; color: #64748b;">
                    <input type="file" name="image" accept="image/*" id="order-chat-input-image" style="display: none;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                </label>
                <label class="order-chat-file-label" title="Прикрепить файл" style="width: 40px; height: 40px; border: 1px solid #e2e8f0; border-radius: 8px; display: flex; align-items: center; justify-content: center; cursor: pointer; background: #fff; color: #64748b;">
                    <input type="file" name="file" id="order-chat-input-file" style="display: none;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg>
                </label>
                <button type="submit" style="padding: 10px 20px; background: #1e40af; color: #fff; border: none; border-radius: 8px; cursor: pointer;">Отправить</button>
            </form>
        </div>
    </div>
</div>
<div id="order-chat-lightbox" class="order-chat-lightbox" aria-hidden="true" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 99999; background: rgba(0,0,0,0.85); align-items: center; justify-content: center; flex-direction: column; padding: 1rem;">
    <button type="button" id="order-chat-lightbox-close" class="order-chat-lightbox-close" style="position: absolute; top: 1rem; right: 1rem; z-index: 1; width: 2.5rem; height: 2.5rem; border: none; border-radius: 50%; background: rgba(255,255,255,0.2); color: #fff; font-size: 1.5rem; line-height: 1; cursor: pointer;">&times;</button>
    <div class="order-chat-lightbox-content" style="display: flex; flex-direction: column; align-items: center; gap: 1rem; max-width: 100%; max-height: 100%;">
        <img id="order-chat-lightbox-img" src="" alt="" style="max-width: 90vw; max-height: 70vh; object-fit: contain; border-radius: 8px; display: block;">
        <a id="order-chat-lightbox-download" href="" download target="_blank" rel="noopener" class="order-chat-lightbox-download" style="padding: 10px 20px; background: #1e40af; color: #fff; border-radius: 8px; text-decoration: none; font-size: 0.9rem;">Скачать фото</a>
    </div>
</div>
