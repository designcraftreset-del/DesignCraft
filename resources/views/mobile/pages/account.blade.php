@extends('mobile.layouts.mobile-app')

@section('title', 'Аккаунт — DesignCraft')

@section('content')
@if(session('success'))
<div class="m-card" style="background: rgba(34, 197, 94, 0.15); border-color: #22c55e;">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="m-card" style="background: rgba(239, 68, 68, 0.15); border-color: #ef4444;">{{ session('error') }}</div>
@endif

<section class="m-hero">
    <div class="m-account-header">
        <button type="button" class="m-account-avatar-wrap" id="mAccountAvatarBtn" aria-label="Сменить аватарку">
            @if($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="" class="m-account-avatar" id="mAccountAvatarImg">
            @else
                <div class="m-account-avatar m-account-avatar--initials" id="mAccountAvatarInit">{{ mb_substr($user->name, 0, 1) }}</div>
            @endif
        </button>
        <div style="flex:1; min-width:0; text-align:left;">
            <form method="POST" action="{{ route('profile.update') }}" id="mAccountNameForm" class="m-account-name-form">
                @csrf
                <input type="hidden" name="redirect_mobile" value="1">
                <input type="hidden" name="email" value="{{ $user->email }}">
                <input type="hidden" name="phone" value="{{ $user->phone ?? '' }}">
                <input type="text" name="name" value="{{ $user->name }}" class="m-account-name-input" id="mAccountNameInput" maxlength="255" required style="display:none;">
            </form>
            <h1 class="m-hero__title m-account-name-display" id="mAccountNameDisplay" style="text-align:left; margin:0; cursor:pointer;" title="Нажмите, чтобы изменить">{{ $user->name }}</h1>
            <p class="m-text" style="margin:0.25rem 0 0; text-align:left;">{{ $user->email }}</p>
            <p class="m-text" style="margin:0.25rem 0 0; font-size:0.75rem; text-align:left;">С нами {{ $userStats['user_since'] }}</p>
        </div>
    </div>
</section>

<section class="m-section">
    <a href="{{ route('mobile.settings') }}" class="m-btn m-btn--secondary m-btn--block">Настройки</a>
    <a href="{{ route('mobile.chats') }}" class="m-btn m-btn--secondary m-btn--block" style="margin-top:0.5rem;">Чаты с дизайнерами</a>
</section>

<section class="m-section">
    <h2 class="m-section__title m-title">Статистика</h2>
    <div class="m-grid">
        <div class="m-card" style="text-align:center;">
            <span class="m-price">{{ $userStats['total_orders'] }}</span>
            <p class="m-text" style="margin:0;">Заказов</p>
        </div>
        <div class="m-card" style="text-align:center;">
            <span class="m-price">{{ $userStats['active_orders'] }}</span>
            <p class="m-text" style="margin:0;">Активных</p>
        </div>
        <div class="m-card" style="text-align:center;">
            <span class="m-price">{{ $userStats['completed_orders'] }}</span>
            <p class="m-text" style="margin:0;">Выполнено</p>
        </div>
        <div class="m-card" style="text-align:center;">
            <span class="m-price">{{ $userStats['total_reviews'] }}</span>
            <p class="m-text" style="margin:0;">Отзывов</p>
        </div>
    </div>
</section>

<section class="m-section">
    <h2 class="m-section__title m-title">Мои заказы</h2>
    @php
        $statusLabels = ['new' => 'Новый', 'pending' => 'Ожидание', 'processing' => 'В работе', 'confirmed' => 'Подтверждён', 'completed' => 'Выполнен', 'cancelled' => 'Отменён'];
    @endphp
    @forelse($orders as $index => $order)
    <div class="m-card m-order-card {{ $index >= 3 ? 'm-order-card--hidden' : '' }}" data-order-index="{{ $index }}">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:8px;">
            <div>
                <p class="m-title" style="margin:0;">Заказ #{{ $order->id }}</p>
                <p class="m-text" style="margin:0.25rem 0 0;">{{ $order->created_at->format('d.m.Y') }} в {{ $order->created_at->format('H:i') }}</p>
            </div>
            <span class="m-order-status m-order-status--{{ $order->status }}">{{ $statusLabels[$order->status] ?? $order->status }}</span>
        </div>
        <p class="m-text" style="margin:0.5rem 0 0; font-size:0.875rem;"><strong>{{ $order->yslyga ?? '—' }}</strong></p>
        <p class="m-text" style="margin:0.25rem 0 0; font-size:0.875rem;">Пакет: {{ $order->paket ?? '—' }}</p>
        <p class="m-text" style="margin:0.25rem 0 0; font-size:0.875rem;">Email: {{ $order->email ?? '—' }}</p>
        <p class="m-text" style="margin:0.25rem 0 0; font-size:0.875rem;">Телефон: {{ $order->nomer ?? '—' }}</p>
        <p class="m-text" style="margin:0.25rem 0 0; font-size:0.875rem;">Клиент: {{ $order->name ?? '—' }}</p>
        @if($order->info)
            <p class="m-text" style="margin:0.5rem 0 0; font-size:0.875rem;">Описание проекта: {{ $order->info }}</p>
        @endif
        <div style="display:flex; flex-wrap:wrap; gap:8px; margin-top:0.75rem;">
            <a href="{{ route('mobile.chats') }}?order={{ $order->id }}" class="m-btn m-btn--primary">Открыть чат</a>
            <div class="m-order-actions">
                <button type="button" class="m-btn m-btn--secondary m-order-other-btn" data-order-id="{{ $order->id }}" data-order-yslyga="{{ $order->yslyga ?? '' }}" data-order-paket="{{ $order->paket ?? '' }}" data-order-info="{{ e($order->info ?? '') }}" data-order-name="{{ e($order->name ?? '') }}" data-order-email="{{ e($order->email ?? '') }}" data-order-phone="{{ e($order->nomer ?? '') }}">Другое</button>
                <div class="m-order-dropdown" id="mOrderDropdown{{ $order->id }}" aria-hidden="true">
                    @if(($order->status ?? '') === 'new')
                    <form action="{{ route('orders.cancel', $order->id) }}" method="post" style="margin:0;" onsubmit="return confirm('Отменить заказ #{{ $order->id }}?');">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="m-order-dropdown-item m-order-dropdown-item--danger">Отменить заказ</button>
                    </form>
                    @endif
                    <button type="button" class="m-order-dropdown-item m-order-problem-btn" data-order-id="{{ $order->id }}" data-order-yslyga="{{ $order->yslyga ?? '' }}" data-order-paket="{{ $order->paket ?? '' }}" data-order-info="{{ e($order->info ?? '') }}" data-order-name="{{ e($order->name ?? '') }}" data-order-email="{{ e($order->email ?? '') }}" data-order-phone="{{ e($order->nomer ?? '') }}">Проблема с заказом</button>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="m-card">
        <p class="m-text" style="text-align:center;">У вас пока нет заказов.</p>
        <a href="{{ route('mobile.order.create') }}" class="m-btn m-btn--primary m-btn--block" style="margin-top:0.75rem;">Оформить заказ</a>
    </div>
    @endforelse
    @if($orders->count() > 3)
    <p style="text-align:center; margin-top:0.5rem;">
        <button type="button" class="m-btn m-btn--secondary" id="mOrdersShowMore">Показать ещё</button>
    </p>
    @endif
</section>

{{-- Модальное окно смены аватарки --}}
<div class="m-modal" id="mAvatarModal" aria-hidden="true">
    <div class="m-modal__backdrop" id="mAvatarModalBackdrop"></div>
    <div class="m-modal__box">
        <h3 class="m-title" style="margin:0 0 1rem;">Новая аватарка</h3>
        <p class="m-text" style="margin:0 0 0.75rem;">Как будет отображаться:</p>
        <div class="m-avatar-preview-wrap">
            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : '' }}" alt="" class="m-avatar-preview" id="mAvatarPreview" style="{{ $user->avatar ? '' : 'display:none;' }}">
            <div class="m-account-avatar m-account-avatar--initials m-avatar-preview-initials" id="mAvatarPreviewInit" style="{{ $user->avatar ? 'display:none;' : '' }}">{{ mb_substr($user->name, 0, 1) }}</div>
        </div>
        <form action="{{ route('avatar.upload') }}" method="post" enctype="multipart/form-data" id="mAvatarForm">
            @csrf
            <input type="file" name="avatar" accept="image/jpeg,image/png,image/jpg,image/gif" id="mAvatarFile" class="m-order-file-input">
            <label for="mAvatarFile" class="m-btn m-btn--secondary m-btn--block" style="margin-top:0.75rem;">Выбрать фото</label>
            <button type="submit" class="m-btn m-btn--primary m-btn--block" style="margin-top:0.5rem;">Сохранить</button>
        </form>
        <button type="button" class="m-modal__close" id="mAvatarModalClose">&times;</button>
    </div>
</div>
@endsection

@push('styles')
<style>
.m-account-header { display: flex; align-items: center; gap: var(--m-gap); }
.m-account-avatar-wrap { padding: 0; border: none; background: none; cursor: pointer; border-radius: 50%; flex-shrink: 0; }
.m-account-avatar { width: 64px; height: 64px; border-radius: 50%; object-fit: cover; display: block; }
.m-account-avatar--initials { width: 64px; height: 64px; display: flex; align-items: center; justify-content: center; background: var(--m-accent); color: #fff; font-size: 1.5rem; font-weight: 700; }
.m-account-name-form { margin: 0; }
.m-account-name-input { width: 100%; padding: 8px 12px; border-radius: var(--m-radius); border: 1px solid var(--m-accent); background: var(--m-bg); color: var(--m-text); font-size: 1.25rem; font-weight: 600; }
.m-order-status { font-size: 0.75rem; padding: 4px 8px; border-radius: 6px; font-weight: 600; text-transform: uppercase; }
.m-order-status--new, .m-order-status--pending { background: rgba(59, 130, 246, 0.2); color: var(--m-accent); }
.m-order-status--processing, .m-order-status--confirmed { background: rgba(245, 158, 11, 0.2); color: #f59e0b; }
.m-order-status--completed { background: rgba(34, 197, 94, 0.2); color: #22c55e; }
.m-order-status--cancelled { background: rgba(239, 68, 68, 0.2); color: #ef4444; }
.m-order-card--hidden { display: none !important; }
.m-order-actions { position: relative; }
.m-order-other-btn { position: relative; }
.m-order-dropdown { position: absolute; left: 0; top: 100%; margin-top: 4px; background: var(--m-surface); border: 1px solid var(--m-surface-2); border-radius: var(--m-radius); box-shadow: 0 4px 12px rgba(0,0,0,0.3); z-index: 10; min-width: 180px; padding: 4px 0; display: none; }
.m-order-dropdown[aria-hidden="false"] { display: block; }
.m-order-dropdown-item { display: block; width: 100%; padding: 10px var(--m-gap); border: none; background: none; color: var(--m-text); font-size: 0.9375rem; text-align: left; cursor: pointer; }
.m-order-dropdown-item:hover { background: var(--m-surface-2); }
.m-order-dropdown-item--danger { color: #ef4444; }
.m-avatar-preview-wrap { width: 96px; height: 96px; margin: 0 auto 1rem; border-radius: 50%; overflow: hidden; background: var(--m-surface-2); display: flex; align-items: center; justify-content: center; }
.m-avatar-preview { width: 100%; height: 100%; object-fit: cover; }
.m-avatar-preview-initials { width: 96px; height: 96px; font-size: 2.5rem; }
</style>
@endpush

@push('scripts')
<script>
(function() {
    var nameDisplay = document.getElementById('mAccountNameDisplay');
    var nameInput = document.getElementById('mAccountNameInput');
    var nameForm = document.getElementById('mAccountNameForm');
    if (nameDisplay && nameInput && nameForm) {
        nameDisplay.addEventListener('click', function() {
            nameDisplay.style.display = 'none';
            nameInput.style.display = 'block';
            nameInput.value = nameDisplay.textContent.trim();
            nameInput.focus();
        });
        nameInput.addEventListener('blur', function() {
            var v = nameInput.value.trim();
            if (v && v !== nameDisplay.textContent.trim()) {
                nameForm.submit();
                return;
            }
            nameDisplay.style.display = '';
            nameInput.style.display = 'none';
        });
        nameInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') { e.preventDefault(); nameInput.blur(); }
        });
    }
    var avatarBtn = document.getElementById('mAccountAvatarBtn');
    var avatarModal = document.getElementById('mAvatarModal');
    var avatarBackdrop = document.getElementById('mAvatarModalBackdrop');
    var avatarClose = document.getElementById('mAvatarModalClose');
    var avatarFile = document.getElementById('mAvatarFile');
    var avatarPreview = document.getElementById('mAvatarPreview');
    var avatarPreviewInit = document.getElementById('mAvatarPreviewInit');
    function openAvatarModal() {
        if (avatarModal) avatarModal.classList.add('is-open');
    }
    function closeAvatarModal() {
        if (avatarModal) avatarModal.classList.remove('is-open');
    }
    if (avatarBtn) avatarBtn.addEventListener('click', openAvatarModal);
    if (avatarBackdrop) avatarBackdrop.addEventListener('click', closeAvatarModal);
    if (avatarClose) avatarClose.addEventListener('click', closeAvatarModal);
    if (avatarFile) {
        avatarFile.addEventListener('change', function() {
            var f = this.files && this.files[0];
            if (!f || !f.type.match('image.*')) return;
            var r = new FileReader();
            r.onload = function() {
                if (avatarPreview) { avatarPreview.src = r.result; avatarPreview.style.display = 'block'; }
                if (avatarPreviewInit) avatarPreviewInit.style.display = 'none';
            };
            r.readAsDataURL(f);
        });
    }

    var showMoreBtn = document.getElementById('mOrdersShowMore');
    var orderCards = document.querySelectorAll('.m-order-card');
    var visibleCount = 3;
    if (showMoreBtn && orderCards.length > 3) {
        showMoreBtn.addEventListener('click', function() {
            for (var i = visibleCount; i < visibleCount + 3 && i < orderCards.length; i++) {
                orderCards[i].classList.remove('m-order-card--hidden');
            }
            visibleCount += 3;
            if (visibleCount >= orderCards.length) showMoreBtn.style.display = 'none';
        });
    }

    document.querySelectorAll('.m-order-other-btn').forEach(function(btn) {
        var orderId = btn.getAttribute('data-order-id');
        var dropdown = document.getElementById('mOrderDropdown' + orderId);
        if (!dropdown) return;
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            var isOpen = dropdown.getAttribute('aria-hidden') === 'false';
            document.querySelectorAll('.m-order-dropdown').forEach(function(d) { d.setAttribute('aria-hidden', 'true'); });
            if (!isOpen) { dropdown.setAttribute('aria-hidden', 'false'); }
        });
    });
    document.addEventListener('click', function() {
        document.querySelectorAll('.m-order-dropdown').forEach(function(d) { d.setAttribute('aria-hidden', 'true'); });
    });

    document.querySelectorAll('.m-order-problem-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var id = btn.getAttribute('data-order-id');
            var yslyga = btn.getAttribute('data-order-yslyga') || '';
            var paket = btn.getAttribute('data-order-paket') || '';
            var info = btn.getAttribute('data-order-info') || '';
            var name = btn.getAttribute('data-order-name') || '';
            var email = btn.getAttribute('data-order-email') || '';
            var phone = btn.getAttribute('data-order-phone') || '';
            var text = 'Проблема с заказом #' + id + ' Услуга: ' + yslyga + ' Пакет: ' + paket + ' Описание: ' + info + ' Клиент: ' + name + ', ' + email + ', ' + phone;
            var panel = document.getElementById('support-chat-panel');
            var input = document.getElementById('support-chat-input');
            if (panel) panel.classList.add('support-chat-open');
            var mNav = document.getElementById('mNav');
            if (mNav) mNav.classList.remove('is-open');
            if (input) { input.value = text; input.focus(); }
            document.querySelectorAll('.m-order-dropdown').forEach(function(d) { d.setAttribute('aria-hidden', 'true'); });
        });
    });
})();
</script>
@endpush
