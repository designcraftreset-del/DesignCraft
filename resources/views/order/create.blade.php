@extends('layouts.app')

@section('content')
<div class="order-page">
    <div class="order-page-hero">
        <div class="order-page-container">
            <h1 class="order-page-title">Оформление заказа</h1>
            <p class="order-page-subtitle">Опишите задачу — мы подготовим предложение и свяжемся с вами</p>
        </div>
    </div>
    <div class="order-page-container order-page-body">
        @if(session('success'))
            <div class="order-page-success">
                <div class="order-page-success-icon">✓</div>
                <h2>Заказ отправлен</h2>
                <p>Мы свяжемся с вами в ближайшее время.</p>
                <a href="{{ route('index') }}" class="order-page-btn order-page-btn-primary">На главную</a>
            </div>
        @else
        <form action="{{ route('new') }}" method="post" class="order-page-form" id="orderPageForm" enctype="multipart/form-data">
            @csrf
            @if(isset($forUser) && $forUser)
                <input type="hidden" name="for_user" value="{{ $forUser->id }}">
                <div class="order-page-card order-page-for-user-card">
                    <p class="order-page-for-user-text">Заказ создаётся за пользователя: <strong>{{ $forUser->name }}</strong> ({{ $forUser->email }})</p>
                </div>
            @endif
            <div class="order-page-card">
                <h2 class="order-page-card-title">Контактные данные</h2>
                <div class="order-page-grid">
                    <div class="order-page-field">
                        <label for="order-name">Ваше имя</label>
                        <input type="text" id="order-name" name="name" value="{{ Auth::user()->name ?? '' }}" placeholder="Как к вам обращаться" required>
                    </div>
                    <div class="order-page-field">
                        <label for="order-email">Email</label>
                        <input type="email" id="order-email" name="email" value="{{ Auth::user()->email ?? '' }}" placeholder="your@email.com" required>
                    </div>
                    <div class="order-page-field">
                        <label for="order-phone">Телефон</label>
                        <input type="tel" id="order-phone" name="phone" value="{{ old('phone', Auth::check() ? (Auth::user()->phone ?? '') : '') }}" placeholder="+7 (___) ___-__-__" maxlength="18" required>
                    </div>
                </div>
            </div>
            <div class="order-page-card">
                <h2 class="order-page-card-title">Услуга</h2>
                <div class="order-page-field">
                    <label for="order-service">Что нужно сделать?</label>
                    <select id="order-service" name="selectt" required>
                        <option value="">Выберите услугу</option>
                        <option value="design">Дизайн превью</option>
                        <option value="ava">Аватарка</option>
                        <option value="banner">Баннер</option>
                        <option value="animation">Анимация</option>
                        <option value="logo">Логотип</option>
                    </select>
                </div>
            </div>
            <div class="order-page-card">
                <h2 class="order-page-card-title">Пакет</h2>
                @php $presetPackage = request('package'); @endphp
                <div class="order-page-radio-group">
                    <label class="order-page-radio">
                        <input type="radio" name="radioo" value="Базовый" {{ $presetPackage === 'Базовый' ? 'checked' : '' }}>
                        <span class="order-page-radio-label">Базовый</span>
                    </label>
                    <label class="order-page-radio">
                        <input type="radio" name="radioo" value="Про" {{ $presetPackage === 'Про' ? 'checked' : '' }}>
                        <span class="order-page-radio-label">Про</span>
                    </label>
                    <label class="order-page-radio">
                        <input type="radio" name="radioo" value="Стандарт" {{ $presetPackage === 'Стандарт' ? 'checked' : '' }}>
                        <span class="order-page-radio-label">Стандарт</span>
                    </label>
                    <label class="order-page-radio">
                        <input type="radio" name="radioo" value="Продвинутая" {{ $presetPackage === 'Продвинутая' ? 'checked' : '' }}>
                        <span class="order-page-radio-label">Продвинутая</span>
                    </label>
                </div>
            </div>
            <div class="order-page-card">
                <h2 class="order-page-card-title">Описание заказа</h2>
                <div class="order-page-field">
                    <label for="order-description">Опишите задачу, пожелания и сроки</label>
                    <textarea id="order-description" name="text" rows="5" placeholder="Например: баннер для стрима 1920×1080, стиль минимализм, нужно к пятнице..." required></textarea>
                </div>
                <div class="order-page-field" style="margin-top: 1rem;">
                    <label>Изображения (до 10 фото)</label>
                    <div class="order-page-file-count" id="orderPhotosCount" style="font-size: 0.875rem; color: #64748b; margin-bottom: 4px;">Число файлов: 10</div>
                    <div class="order-page-file-upload">
                        <input type="file" id="order-photos" name="photos[]" class="order-page-file-input" accept="image/jpeg,image/png,image/gif,image/webp" multiple>
                        <label for="order-photos" class="order-page-file-label" id="orderPhotosLabel">
                            <div>
                                <span id="orderPhotosSelected" style="display: block; font-weight: 500; margin-bottom: 4px;">Выбрано: 0</span>
                                <div>Нажмите для загрузки изображения</div>
                                <div style="font-size: 0.8rem; margin-top: 4px; color: #6b7280;">PNG, JPG, GIF до 2MB · до 10 фото</div>
                            </div>
                        </label>
                    </div>
                    <div class="order-page-file-info" id="orderPhotosInfo"></div>
                </div>
            </div>
            <div class="order-page-actions">
                <a href="{{ url()->previous() }}" class="order-page-btn order-page-btn-outline">Назад</a>
                <button type="submit" class="order-page-btn order-page-btn-primary">Отправить заказ</button>
            </div>
        </form>
        @endif
    </div>
</div>
<style>
.order-page { min-height: 100vh; background: linear-gradient(180deg, #f8fafc 0%, #e2e8f0 100%); }
body.dark-theme .order-page { background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%); }
.order-page-hero { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #60a5fa 100%); color: #fff; padding: 3rem 1.5rem; text-align: center; }
.order-page-hero .order-page-title,
.order-page-hero .order-page-subtitle { color: #fff; }
.order-page-container { max-width: 640px; margin: 0 auto; padding: 0 1rem; }
.order-page-title { font-size: 2rem; font-weight: 700; margin: 0 0 0.5rem; letter-spacing: -0.02em; }
.order-page-subtitle { margin: 0; opacity: 0.95; font-size: 1.05rem; }
.order-page-body { padding: 2rem 1rem 4rem; }
.order-page-card { background: #fff; border-radius: 16px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
body.dark-theme .order-page-card { background: #1e293b; box-shadow: 0 1px 3px rgba(0,0,0,0.3); }
.order-page-card-title { font-size: 1.1rem; font-weight: 600; margin: 0 0 1rem; color: #0f172a; }
body.dark-theme .order-page-card-title { color: #f1f5f9; }
.order-page-grid { display: grid; gap: 1rem; }
@media (min-width: 500px) { .order-page-grid { grid-template-columns: 1fr 1fr; } .order-page-grid .order-page-field:last-child { grid-column: 1 / -1; } }
.order-page-field { display: flex; flex-direction: column; gap: 0.35rem; }
.order-page-field label { font-size: 0.875rem; font-weight: 500; color: #475569; }
body.dark-theme .order-page-field label { color: #94a3b8; }
.order-page-field input, .order-page-field select, .order-page-field textarea {
    width: 100%; padding: 0.75rem 1rem; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 1rem; background: #fff; color: #0f172a;
}
body.dark-theme .order-page-field input, body.dark-theme .order-page-field select, body.dark-theme .order-page-field textarea {
    border-color: #475569; background: #334155; color: #f1f5f9;
}
.order-page-field input:focus, .order-page-field select:focus, .order-page-field textarea:focus {
    outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
}
.order-page-field textarea { resize: vertical; min-height: 120px; }
.order-page-radio-group { display: flex; flex-wrap: wrap; gap: 0.75rem; }
.order-page-radio { display: inline-flex; align-items: center; gap: 0.5rem; cursor: pointer; padding: 0.6rem 1rem; border: 1px solid #e2e8f0; border-radius: 10px; background: #f8fafc; }
body.dark-theme .order-page-radio { border-color: #475569; background: #334155; }
.order-page-radio input { width: auto; margin: 0; accent-color: #3b82f6; }
.order-page-radio-label { font-size: 0.95rem; }
.order-page-radio:has(input:checked) { border-color: #3b82f6; background: #eff6ff; }
body.dark-theme .order-page-radio:has(input:checked) { border-color: #60a5fa; background: #1e3a8a; }
.order-page-actions { display: flex; gap: 1rem; justify-content: flex-end; margin-top: 1.5rem; flex-wrap: wrap; }
.order-page-btn { display: inline-flex; align-items: center; justify-content: center; padding: 0.75rem 1.5rem; border-radius: 10px; font-size: 1rem; font-weight: 600; text-decoration: none; cursor: pointer; border: none; transition: opacity 0.2s; }
.order-page-btn-primary { background: linear-gradient(135deg, #1d4ed8, #3b82f6); color: #fff; }
.order-page-btn-primary:hover { opacity: 0.95; }
.order-page-btn-outline { background: transparent; color: #64748b; border: 1px solid #e2e8f0; }
body.dark-theme .order-page-btn-outline { color: #94a3b8; border-color: #475569; }
.order-page-btn-outline:hover { background: #f1f5f9; }
body.dark-theme .order-page-btn-outline:hover { background: #334155; }
.order-page-success { text-align: center; background: #fff; border-radius: 16px; padding: 3rem; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
body.dark-theme .order-page-success { background: #1e293b; }
.order-page-success-icon { width: 64px; height: 64px; margin: 0 auto 1rem; background: linear-gradient(135deg, #22c55e, #16a34a); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 700; }
.order-page-success h2 { margin: 0 0 0.5rem; font-size: 1.5rem; }
.order-page-success p { margin: 0 0 1.5rem; color: #64748b; }
body.dark-theme .order-page-success p { color: #94a3b8; }
.order-page-for-user-card { background: #eff6ff; border: 1px solid #3b82f6; }
.order-page-for-user-text { font-size: 0.875rem; font-weight: 500; color: #1e40af; margin: 0; }
body.dark-theme .order-page-for-user-card { background: rgba(30, 64, 175, 0.25); border-color: #3b82f6; }
body.dark-theme .order-page-for-user-text { color: #93c5fd; }
.order-page-field-hint { display: block; }
body.dark-theme .order-page-field-hint { color: #94a3b8; }
.order-page-file-upload { position: relative; display: block; }
.order-page-file-input { position: absolute; left: -9999px; }
.order-page-file-label {
    display: flex; align-items: center; justify-content: center; padding: 20px;
    border: 2px dashed #d1d5db; border-radius: 10px; background: #f8fafc;
    cursor: pointer; transition: all 0.3s ease; text-align: center;
}
.order-page-file-label:hover { border-color: #3b82f6; background: #f0f7ff; }
.order-page-file-label.dragover { border-color: #3b82f6; background: #e0f2fe; }
body.dark-theme .order-page-file-label { border-color: #475569; background: #334155; }
body.dark-theme .order-page-file-label:hover { border-color: #3b82f6; background: #1e3a8a; }
.order-page-file-info { margin-top: 0.5rem; font-size: 0.875rem; color: #6b7280; }
body.dark-theme .order-page-file-info { color: #94a3b8; }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var phoneInput = document.getElementById('order-phone');
    if (!phoneInput) return;
    function formatPhone(e) {
        var v = phoneInput.value.replace(/\D/g, '');
        if (v.length > 0) {
            if (v[0] === '8' || v[0] === '7') v = v.substring(1);
            if (v[0] !== '7') v = '7' + v;
        }
        v = v.substring(0, 11);
        var s = '';
        if (v.length > 0) s = '+7';
        if (v.length > 1) s += ' (' + v.substring(1, 4);
        if (v.length >= 4) s += ') ';
        if (v.length > 4) s += v.substring(4, 7);
        if (v.length > 7) s += '-' + v.substring(7, 9);
        if (v.length > 9) s += '-' + v.substring(9, 11);
        phoneInput.value = s;
    }
    phoneInput.addEventListener('input', formatPhone);
    phoneInput.addEventListener('paste', function() { setTimeout(formatPhone, 0); });
    phoneInput.addEventListener('keydown', function(e) {
        if (e.key === 'Backspace' && phoneInput.value.replace(/\D/g, '').length <= 1) {
            phoneInput.value = '';
            e.preventDefault();
        }
    });

    var orderPhotos = document.getElementById('order-photos');
    var orderPhotosLabel = document.getElementById('orderPhotosLabel');
    var orderPhotosInfo = document.getElementById('orderPhotosInfo');
    var maxPhotos = 10;
    if (orderPhotos && orderPhotosLabel) {
        orderPhotos.addEventListener('change', function() {
            var files = this.files || [];
            if (files.length > maxPhotos) {
                var dt = new DataTransfer();
                for (var i = 0; i < maxPhotos; i++) dt.items.add(files[i]);
                this.files = dt.files;
                files = this.files;
            }
            var msg = files.length ? 'Выбрано файлов: ' + files.length + (files.length >= maxPhotos ? ' (макс. ' + maxPhotos + ')' : '') : '';
            var selEl = document.getElementById('orderPhotosSelected');
            if (selEl) selEl.textContent = 'Выбрано: ' + files.length;
            if (orderPhotosInfo) orderPhotosInfo.textContent = msg;
        });
        orderPhotosLabel.addEventListener('dragover', function(e) { e.preventDefault(); this.classList.add('dragover'); });
        orderPhotosLabel.addEventListener('dragleave', function() { this.classList.remove('dragover'); });
        orderPhotosLabel.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            if (orderPhotos && e.dataTransfer.files.length) orderPhotos.files = e.dataTransfer.files;
            orderPhotos.dispatchEvent(new Event('change'));
        });
    }
});
</script>
@endsection
