@extends('layouts.app')

@section('content')
<style>
    .moder-order-chat-page { padding: 1rem; }
    .moder-order-chat-page .moder-chat-back { color: #1e40af; text-decoration: none; }
    body.dark-theme .moder-order-chat-page .moder-chat-back { color: #93c5fd; }
    body.dark-theme .moder-order-chat-page .moder-muted { color: #94a3b8; }
</style>
<div class="container moder-order-chat-page">
    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem; flex-wrap: wrap;">
        <a href="{{ route('moder.panel') }}" class="moder-chat-back">← К заказам</a>
        <h1 style="margin: 0; font-size: 1.25rem;">Чат по заказу #{{ $order->id }} — {{ $order->yslyga }}</h1>
        <span class="moder-muted" style="color: #64748b;">Клиент: {{ $order->name ?? $order->user->name ?? '—' }}</span>
        @if($order->chat_closed_at)
            <span style="color: #94a3b8;">Чат закрыт</span>
            <form id="moder-order-chat-reopen-form" action="{{ route('orders.chat.reopen', $order->id) }}" method="post" style="display: inline;">
                @csrf
                <button type="submit" style="padding: 6px 12px; background: #16a34a; color: #fff; border: none; border-radius: 8px; cursor: pointer;">Открыть чат</button>
            </form>
        @else
            <form id="moder-order-chat-close-form" action="{{ route('orders.chat.close', $order->id) }}" method="post" style="display: inline;">
                @csrf
                <button type="submit" style="padding: 6px 12px; background: #dc2626; color: #fff; border: none; border-radius: 8px; cursor: pointer;">Закрыть заказ</button>
            </form>
        @endif
    </div>

    @include('partials.order-chat-ui', ['moderOrder' => $order, 'showBackLink' => false, 'layoutHeight' => 'min-height: 500px;'])
    @include('partials.order-chat-script', ['moderOrder' => $order])
</div>

<script>
(function() {
    var csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    function postForm(form, done) {
        var fd = new FormData(form);
        fd.append('_token', csrf);
        fetch(form.action, { method: 'POST', body: fd, headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' } })
            .then(function(r) { return r.json(); })
            .then(function(data) { if (data.success) done(); });
    }
    var closeForm = document.getElementById('moder-order-chat-close-form');
    if (closeForm) closeForm.addEventListener('submit', function(e) { e.preventDefault(); postForm(closeForm, function() { window.location.reload(); }); });
    var reopenForm = document.getElementById('moder-order-chat-reopen-form');
    if (reopenForm) reopenForm.addEventListener('submit', function(e) { e.preventDefault(); postForm(reopenForm, function() { window.location.reload(); }); });
})();
</script>
@endsection
