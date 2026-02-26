@extends('mobile.layouts.mobile-app')

@section('title', 'Оформление заказа — DesignCraft')

@section('content')
<section class="m-hero">
    <h1 class="m-hero__title">Оформление заказа</h1>
    <p class="m-hero__subtitle">Опишите задачу — мы подготовим предложение и свяжемся с вами</p>
</section>

<section class="m-section">
    @if(session('success'))
        <div class="m-card" style="text-align:center;">
            <div style="width:56px; height:56px; margin:0 auto 1rem; background:linear-gradient(135deg,#22c55e,#16a34a); color:#fff; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:1.5rem; font-weight:700;">✓</div>
            <h2 class="m-title">Заказ отправлен</h2>
            <p class="m-text">Мы свяжемся с вами в ближайшее время.</p>
            <a href="{{ route('mobile.home') }}" class="m-btn m-btn--primary m-btn--block" style="margin-top:1rem;">На главную</a>
        </div>
    @else
        <form action="{{ route('new') }}" method="post" id="mOrderForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="redirect_mobile" value="1">
            @if(isset($forUser) && $forUser)
                <input type="hidden" name="for_user" value="{{ $forUser->id }}">
                <div class="m-card" style="background:var(--m-surface-2); border-color:var(--m-accent);">
                    <p class="m-text" style="margin:0;">Заказ за: <strong>{{ $forUser->name }}</strong> ({{ $forUser->email }})</p>
                </div>
            @endif

            <div class="m-card">
                <h2 class="m-title" style="margin-bottom:0.75rem;">Контактные данные</h2>
                <div class="m-order-field">
                    <label for="m-order-name">Ваше имя</label>
                    <input type="text" id="m-order-name" name="name" value="{{ Auth::user()->name ?? '' }}" placeholder="Как к вам обращаться" required class="m-order-input">
                </div>
                <div class="m-order-field">
                    <label for="m-order-email">Email</label>
                    <input type="email" id="m-order-email" name="email" value="{{ Auth::user()->email ?? '' }}" placeholder="your@email.com" required class="m-order-input">
                </div>
                <div class="m-order-field">
                    <label for="m-order-phone">Телефон</label>
                    <input type="tel" id="m-order-phone" name="phone" value="{{ old('phone', Auth::user()->phone ?? '') }}" placeholder="+7 (___) ___-__-__" maxlength="18" required class="m-order-input">
                </div>
            </div>

            <div class="m-card">
                <h2 class="m-title" style="margin-bottom:0.75rem;">Услуга</h2>
                <div class="m-order-field">
                    <label for="m-order-service">Что нужно сделать?</label>
                    <select id="m-order-service" name="selectt" required class="m-order-input">
                        <option value="">Выберите услугу</option>
                        <option value="design">Дизайн превью</option>
                        <option value="ava">Аватарка</option>
                        <option value="banner">Баннер</option>
                        <option value="animation">Анимация</option>
                        <option value="logo">Логотип</option>
                    </select>
                </div>
            </div>

            <div class="m-card">
                <h2 class="m-title" style="margin-bottom:0.75rem;">Пакет</h2>
                @php $presetPackage = request('package'); @endphp
                <div class="m-order-radio-group">
                    <label class="m-order-radio"><input type="radio" name="radioo" value="Базовый" {{ $presetPackage === 'Базовый' ? 'checked' : '' }}><span>Базовый</span></label>
                    <label class="m-order-radio"><input type="radio" name="radioo" value="Про" {{ $presetPackage === 'Про' ? 'checked' : '' }}><span>Про</span></label>
                    <label class="m-order-radio"><input type="radio" name="radioo" value="Стандарт" {{ $presetPackage === 'Стандарт' ? 'checked' : '' }}><span>Стандарт</span></label>
                    <label class="m-order-radio"><input type="radio" name="radioo" value="Продвинутая" {{ $presetPackage === 'Продвинутая' ? 'checked' : '' }}><span>Продвинутая</span></label>
                </div>
            </div>

            <div class="m-card">
                <h2 class="m-title" style="margin-bottom:0.75rem;">Описание заказа</h2>
                <div class="m-order-field">
                    <label for="m-order-description">Опишите задачу, пожелания и сроки</label>
                    <textarea id="m-order-description" name="text" rows="4" placeholder="Например: баннер для стрима 1920×1080, стиль минимализм..." required class="m-order-input m-order-textarea"></textarea>
                </div>
                <div class="m-order-field" style="margin-top:1rem;">
                    <label>Изображения (до 10 фото)</label>
                    <div class="m-order-file-count" id="mOrderPhotosCount">Выбрано: 0</div>
                    <label for="m-order-photos" class="m-order-file-label" id="mOrderPhotosLabel">
                        <span>Нажмите для загрузки</span>
                        <small>PNG, JPG, GIF до 2 МБ · до 10 фото</small>
                    </label>
                    <input type="file" id="m-order-photos" name="photos[]" class="m-order-file-input" accept="image/jpeg,image/png,image/gif,image/webp" multiple>
                </div>
            </div>

            <div style="display:flex; gap:var(--m-gap); margin-top:1rem;">
                <a href="{{ route('mobile.home') }}" class="m-btn m-btn--secondary" style="flex:1;">Назад</a>
                <button type="submit" class="m-btn m-btn--primary" style="flex:1;">Отправить заказ</button>
            </div>
        </form>
    @endif
</section>

@push('styles')
<style>
.m-order-field { margin-bottom: 1rem; }
.m-order-field label { display: block; font-size: 0.875rem; font-weight: 500; color: var(--m-text-muted); margin-bottom: 0.35rem; }
.m-order-input { width: 100%; padding: 12px; border-radius: var(--m-radius); border: 1px solid var(--m-surface-2); background: var(--m-bg); color: var(--m-text); font-size: 1rem; }
.m-order-textarea { min-height: 100px; resize: vertical; }
.m-order-radio-group { display: flex; flex-wrap: wrap; gap: 0.5rem; }
.m-order-radio { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.6rem 1rem; border: 1px solid var(--m-surface-2); border-radius: var(--m-radius); background: var(--m-bg); cursor: pointer; }
.m-order-radio input { margin: 0; accent-color: var(--m-accent); }
.m-order-radio:has(input:checked) { border-color: var(--m-accent); background: rgba(59, 130, 246, 0.15); }
.m-order-file-input { position: absolute; left: -9999px; }
.m-order-file-label { display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 1.25rem; border: 2px dashed var(--m-surface-2); border-radius: var(--m-radius); background: var(--m-surface); cursor: pointer; text-align: center; }
.m-order-file-label small { font-size: 0.75rem; color: var(--m-text-muted); margin-top: 0.25rem; }
.m-order-file-count { font-size: 0.875rem; color: var(--m-text-muted); margin-bottom: 0.5rem; }
.m-theme-light .m-order-input { background: var(--m-surface); border-color: var(--m-surface-2); color: var(--m-text); }
.m-theme-light .m-order-radio { background: var(--m-surface); }
.m-theme-light .m-order-file-label { background: var(--m-surface-2); }
</style>
@endpush

@push('scripts')
<script>
(function() {
    var phoneInput = document.getElementById('m-order-phone');
    if (phoneInput) {
        function formatPhone() {
            var v = phoneInput.value.replace(/\D/g, '');
            if (v.length > 0) {
                if (v[0] === '8' || v[0] === '7') v = v.substring(1);
                if (v[0] !== '7') v = '7' + v;
            }
            v = v.substring(0, 11);
            var s = v.length > 0 ? '+7' : '';
            if (v.length > 1) s += ' (' + v.substring(1, 4);
            if (v.length >= 4) s += ') ';
            if (v.length > 4) s += v.substring(4, 7);
            if (v.length > 7) s += '-' + v.substring(7, 9);
            if (v.length > 9) s += '-' + v.substring(9, 11);
            phoneInput.value = s;
        }
        phoneInput.addEventListener('input', formatPhone);
        phoneInput.addEventListener('paste', function() { setTimeout(formatPhone, 0); });
    }
    var photos = document.getElementById('m-order-photos');
    var countEl = document.getElementById('mOrderPhotosCount');
    if (photos && countEl) {
        photos.addEventListener('change', function() {
            var n = (this.files || []).length;
            if (n > 10) {
                var dt = new DataTransfer();
                for (var i = 0; i < 10; i++) dt.items.add(this.files[i]);
                this.files = dt.files;
                n = 10;
            }
            countEl.textContent = 'Выбрано: ' + n;
        });
    }
})();
</script>
@endpush
@endsection
