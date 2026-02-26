@extends('mobile.layouts.mobile-app')

@section('title', 'Чаты с дизайнерами — DesignCraft')

@section('content')
<section class="m-hero" style="display:flex; flex-direction:row; align-items:center; justify-content:flex-start; gap:12px; text-align:left;">
    <a href="{{ route('mobile.account') }}" class="m-chat-back-btn" aria-label="Назад в аккаунт">←</a>
    <div>
        <h1 class="m-hero__title" style="margin:0;">Чаты с дизайнерами</h1>
        <p class="m-hero__subtitle" style="margin:0.25rem 0 0;">Переписка по заказам</p>
    </div>
</section>

<section class="m-section">
    <div class="m-chats-toolbar">
        <input type="search" id="mChatsSearch" class="m-chats-search" placeholder="Поиск по заказам..." autocomplete="off">
        <button type="button" class="m-btn m-btn--secondary m-chats-filter-open" id="mChatsFilterOpen" aria-pressed="false">Только открытые</button>
    </div>
    @forelse($orders as $order)
    @php $chatClosed = $order->chat_closed_at || ($order->status ?? '') === 'completed'; @endphp
    <div class="m-card m-chat-order" data-order-id="{{ $order->id }}" data-chat-closed="{{ $chatClosed ? '1' : '0' }}" data-search-text="{{ e($order->id . ' ' . ($order->yslyga ?? '') . ' ' . $order->created_at->format('d.m.Y')) }}">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:8px;">
            <div>
                <p class="m-title" style="margin:0;">Заказ #{{ $order->id }}</p>
                <p class="m-text" style="margin:0.25rem 0 0;">{{ $order->yslyga ?? '—' }} · {{ $order->created_at->format('d.m.Y') }}</p>
            </div>
            @if($chatClosed)
                <span class="m-order-status m-order-status--completed">Закрыт</span>
            @endif
        </div>
        <button type="button" class="m-btn m-btn--primary" style="margin-top:0.75rem;" {{ $chatClosed ? 'disabled' : '' }} data-open-chat>
            {{ $chatClosed ? 'Чат закрыт' : 'Открыть чат' }}
        </button>
    </div>
    @empty
    <div class="m-card">
        <p class="m-text" style="text-align:center;">Нет заказов с чатами.</p>
        <a href="{{ route('mobile.order.create') }}" class="m-btn m-btn--primary m-btn--block" style="margin-top:0.75rem;">Оформить заказ</a>
    </div>
    @endforelse
</section>

{{-- Полноэкранный чат по заказу --}}
<div class="m-chat-fullscreen" id="mOrderChatPanel" aria-hidden="true">
    <div class="m-chat-fullscreen__header">
        <button type="button" class="m-chat-fullscreen__back" id="mOrderChatBack">&larr;</button>
        <span class="m-chat-fullscreen__title" id="mOrderChatTitle">Заказ #0</span>
    </div>
    <div class="m-chat-fullscreen__messages" id="mOrderChatMessages"></div>
    <form class="m-chat-fullscreen__form" id="mOrderChatForm">
        <input type="hidden" id="mOrderChatOrderId" value="">
        <input type="text" name="message" id="mOrderChatInput" placeholder="Сообщение..." class="m-order-input m-chat-input" autocomplete="off">
        <label class="m-chat-file-label" title="Прикрепить фото">
            <input type="file" name="image" accept="image/*" id="mOrderChatImage" style="position:absolute;left:-9999px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
        </label>
        <button type="submit" class="m-btn m-btn--primary m-chat-send-btn" aria-label="Отправить">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13"/><path d="M22 2L15 22L11 13L2 9L22 2Z"/></svg>
        </button>
    </form>
</div>
@endsection

@push('styles')
<style>
.m-chat-order [disabled] { opacity: 0.7; cursor: not-allowed; }
.m-chat-fullscreen { position: fixed; inset: 0; z-index: 200; background: var(--m-bg); display: flex; flex-direction: column; transform: translateX(100%); transition: transform 0.25s; }
.m-chat-fullscreen.is-open { transform: translateX(0); }
.m-chat-fullscreen__header { display: flex; align-items: center; gap: 12px; padding: 12px var(--m-gap); background: var(--m-surface); border-bottom: 1px solid var(--m-surface-2); flex-shrink: 0; }
.m-chat-fullscreen__back { width: 44px; height: 44px; border: none; background: var(--m-surface-2); color: var(--m-text); font-size: 1.25rem; cursor: pointer; border-radius: var(--m-radius); padding: 0; }
.m-chat-fullscreen__title { font-weight: 600; }
.m-chat-fullscreen__messages { flex: 1; overflow-y: auto; padding: var(--m-gap); display: flex; flex-direction: column; gap: 10px; }
.m-chat-msg { max-width: 85%; padding: 10px 14px; border-radius: 12px; font-size: 0.9375rem; }
.m-chat-msg.own { align-self: flex-end; background: var(--m-accent); color: #fff; }
.m-chat-msg.other { align-self: flex-start; background: var(--m-surface); border: 1px solid var(--m-surface-2); }
.m-chat-msg-name { font-size: 0.7rem; opacity: 0.9; margin-bottom: 4px; }
.m-chat-msg-text { margin: 0; white-space: pre-wrap; }
.m-chat-msg img { max-width: 100%; border-radius: 8px; margin-top: 6px; }
.m-chat-fullscreen__form { display: flex; gap: 8px; padding: var(--m-gap); border-top: 1px solid var(--m-surface-2); background: var(--m-surface); flex-shrink: 0; align-items: center; }
.m-chat-fullscreen__form .m-chat-input { flex: 1; margin: 0; min-height: 44px; padding: 10px 14px; border: 1px solid var(--m-surface-2); background: var(--m-bg); color: var(--m-text); border-radius: var(--m-radius); }
.m-chat-fullscreen__form .m-chat-input::placeholder { color: var(--m-text-muted); }
.m-chat-file-label { width: 44px; height: 44px; min-width: 44px; display: flex; align-items: center; justify-content: center; background: var(--m-surface-2); border-radius: var(--m-radius); cursor: pointer; color: var(--m-text-muted); }
.m-chat-file-label:hover { color: var(--m-accent); }
.m-chat-file-label svg { display: block; }
.m-chat-send-btn { flex-shrink: 0; width: 44px; height: 44px; padding: 0; display: flex; align-items: center; justify-content: center; }
.m-chat-send-btn svg { display: block; }
.m-chat-back-btn { display: flex; align-items: center; justify-content: center; width: 44px; height: 44px; min-width: 44px; background: var(--m-surface-2); color: var(--m-text); border-radius: var(--m-radius); text-decoration: none; font-size: 1.25rem; }
.m-chat-back-btn:hover { background: var(--m-surface); color: var(--m-accent); }
.m-chats-toolbar { display: flex; flex-direction: column; gap: 8px; margin-bottom: 1rem; }
.m-chats-search { width: 100%; padding: 12px 14px; border-radius: var(--m-radius); border: 1px solid var(--m-surface-2); background: var(--m-surface); color: var(--m-text); font-size: 1rem; }
.m-chats-search::placeholder { color: var(--m-text-muted); }
.m-chats-filter-open { width: 100%; }
.m-chats-filter-open[aria-pressed="true"] { background: var(--m-accent); color: #fff; }
.m-chat-order.m-chats-hidden { display: none !important; }
</style>
@endpush

@push('scripts')
<script>
(function() {
    var panel = document.getElementById('mOrderChatPanel');
    var messagesEl = document.getElementById('mOrderChatMessages');
    var form = document.getElementById('mOrderChatForm');
    var orderIdInput = document.getElementById('mOrderChatOrderId');
    var textInput = document.getElementById('mOrderChatInput');
    var imageInput = document.getElementById('mOrderChatImage');
    var titleEl = document.getElementById('mOrderChatTitle');
    var backBtn = document.getElementById('mOrderChatBack');
    var csrf = document.querySelector('meta[name="csrf-token"]');
    var currentUserId = {{ Auth::id() }};
    var pollTimer;

    function messagesUrl(id) { return '{{ url("/orders") }}/' + id + '/chat/messages'; }
    function sendUrl(id) { return '{{ url("/orders") }}/' + id + '/chat/send'; }

    function openChat(orderId, title) {
        orderIdInput.value = orderId;
        titleEl.textContent = title || ('Заказ #' + orderId);
        panel.classList.add('is-open');
        loadMessages(orderId);
        pollTimer = setInterval(function() { loadMessages(orderId); }, 4000);
    }

    function closeChat() {
        panel.classList.remove('is-open');
        if (pollTimer) { clearInterval(pollTimer); pollTimer = null; }
    }

    function loadMessages(orderId) {
        if (!orderId || !messagesEl) return;
        fetch(messagesUrl(orderId), { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
            .then(function(r) { return r.ok ? r.json() : Promise.reject(); })
            .then(function(data) {
                var list = (data && data.messages) ? data.messages : [];
                messagesEl.innerHTML = list.map(function(m) {
                    var isOwn = m.user_id === currentUserId;
                    var name = (m.user && m.user.name) ? m.user.name : 'Дизайнер';
                    var time = m.created_at ? new Date(m.created_at).toLocaleString('ru-RU', { day: '2-digit', month: '2-digit', hour: '2-digit', minute: '2-digit' }) : '';
                    var text = (m.message || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                    var imgUrl = m.image_url || (m.image_path ? '{{ asset("storage") }}/' + m.image_path : '');
                    var img = imgUrl ? ('<img src="' + imgUrl + '" alt="">') : '';
                    return '<div class="m-chat-msg ' + (isOwn ? 'own' : 'other') + '"><div class="m-chat-msg-name">' + name + (time ? ' · ' + time : '') + '</div><div class="m-chat-msg-text">' + text + '</div>' + img + '</div>';
                }).join('');
                messagesEl.scrollTop = messagesEl.scrollHeight;
                messagesEl.querySelectorAll('.m-chat-msg').forEach(function(msgEl) {
                    var textEl = msgEl.querySelector('.m-chat-msg-text');
                    var copyText = textEl ? textEl.textContent.trim() : '';
                    if (copyText) {
                        msgEl.style.cursor = 'pointer';
                        msgEl.title = 'Нажмите, чтобы скопировать';
                        msgEl.addEventListener('click', function() {
                            try {
                                if (navigator.clipboard && navigator.clipboard.writeText) navigator.clipboard.writeText(copyText);
                                else { var ta = document.createElement('textarea'); ta.value = copyText; ta.style.position = 'fixed'; ta.style.left = '-9999px'; document.body.appendChild(ta); ta.select(); document.execCommand('copy'); document.body.removeChild(ta); }
                            } catch (e) {}
                        });
                    }
                });
            })
            .catch(function() {});
    }

    form && form.addEventListener('submit', function(e) {
        e.preventDefault();
        var id = orderIdInput.value;
        if (!id) return;
        var text = (textInput && textInput.value || '').trim();
        var file = imageInput && imageInput.files && imageInput.files[0];
        if (!text && !file) return;
        var fd = new FormData();
        fd.append('message', text);
        if (file) fd.append('image', file);
        if (csrf) fd.append('_token', csrf.getAttribute('content'));
        fetch(sendUrl(id), { method: 'POST', body: fd, credentials: 'same-origin', headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data && data.success) {
                    textInput.value = '';
                    imageInput.value = '';
                    loadMessages(id);
                }
            });
    });

    backBtn && backBtn.addEventListener('click', closeChat);

    var searchInput = document.getElementById('mChatsSearch');
    var filterOpenBtn = document.getElementById('mChatsFilterOpen');
    function applyChatsFilter() {
        var query = (searchInput && searchInput.value || '').toLowerCase().trim();
        var onlyOpen = filterOpenBtn && filterOpenBtn.getAttribute('aria-pressed') === 'true';
        document.querySelectorAll('.m-chat-order').forEach(function(card) {
            var closed = card.getAttribute('data-chat-closed') === '1';
            var searchText = (card.getAttribute('data-search-text') || '').toLowerCase();
            var matchSearch = !query || searchText.indexOf(query) !== -1;
            var matchOpen = !onlyOpen || !closed;
            card.classList.toggle('m-chats-hidden', !matchSearch || !matchOpen);
        });
    }
    if (searchInput) searchInput.addEventListener('input', applyChatsFilter);
    if (filterOpenBtn) {
        filterOpenBtn.addEventListener('click', function() {
            var pressed = this.getAttribute('aria-pressed') !== 'true';
            this.setAttribute('aria-pressed', pressed ? 'true' : 'false');
            this.textContent = pressed ? 'Только открытые' : 'Все чаты';
            applyChatsFilter();
        });
    }

    document.querySelectorAll('[data-open-chat]').forEach(function(btn) {
        var card = btn.closest('.m-chat-order');
        if (!card || card.dataset.orderId === undefined) return;
        btn.addEventListener('click', function() {
            if (btn.disabled) return;
            openChat(card.dataset.orderId, 'Заказ #' + card.dataset.orderId);
        });
    });

    var openOrderId = new URLSearchParams(window.location.search).get('order');
    if (openOrderId) {
        var card = document.querySelector('.m-chat-order[data-order-id="' + openOrderId + '"]');
        if (card) openChat(openOrderId, 'Заказ #' + openOrderId);
    }
})();
</script>
@endpush
