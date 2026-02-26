@extends('mobile.layouts.mobile-app')

@section('title', 'DesignCraft — Профессиональный дизайн')

@section('content')
<section class="m-hero m-hero--full">
    <div class="m-hero__bg" aria-hidden="true">
        <div class="m-hero__grid"></div>
        <span class="m-hero__orb m-hero__orb--1"></span>
        <span class="m-hero__orb m-hero__orb--2"></span>
        <span class="m-hero__orb m-hero__orb--3"></span>
        <div class="m-hero__noise"></div>
    </div>
    <div class="m-hero__content">
        <p class="m-hero__label">DesignCraft</p>
        <h1 class="m-hero__title">Дизайн, который <span class="m-hero__title-accent">запоминается</span></h1>
        <p class="m-hero__subtitle">Превью, аватарки, баннеры и анимации для стримеров, блогеров и брендов. Быстро, стильно, под ключ.</p>
        <div class="m-hero__actions">
            <a href="{{ route('mobile.services') }}" class="m-hero__btn m-hero__btn--primary">Услуги и цены</a>
            <a href="{{ route('mobile.contacts') }}" class="m-hero__btn m-hero__btn--outline">Связаться</a>
        </div>
    </div>
    <a href="#m-hero-next" class="m-hero__scroll-hint" aria-label="Листать вниз">
        <svg class="m-hero__scroll-arrow" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 5v14M19 12l-7 7-7-7"/></svg>
    </a>
</section>

<section class="m-section" id="m-hero-next">
    <h2 class="m-section__title m-title">Наши услуги</h2>
    <p class="m-text" style="text-align:center;">Широкий спектр услуг по дизайну в Photoshop для всех ваших проектов.</p>
    @if(isset($servicesList) && count($servicesList) > 0)
    <div style="display:flex; flex-direction:column; gap:var(--m-gap); margin-bottom:var(--m-gap);">
        @foreach($servicesList as $item)
        <div class="m-card">
            @if(!empty($item['badge']))
                <span class="m-text" style="font-size:0.75rem; color:var(--m-accent);">{{ $item['badge'] }}</span>
            @endif
            <p class="m-title">{{ $item['name'] }}</p>
            <p class="m-text">{{ $item['desc'] }}</p>
            <p class="m-price">{{ $item['price'] }} <span>₽</span></p>
            @auth
                <a href="{{ route('mobile.order.create') }}" class="m-btn m-btn--primary" style="margin-top:0.5rem;">Заказать</a>
            @else
                <a href="{{ route('mobile.login') }}" class="m-btn m-btn--primary" style="margin-top:0.5rem;">Войти для заказа</a>
            @endauth
        </div>
        @endforeach
    </div>
    @endif
    <a href="{{ route('mobile.services') }}" class="m-btn m-btn--primary m-btn--block">Посмотреть все услуги</a>
</section>

<section class="m-section">
    <h2 class="m-section__title m-title">Наше портфолио</h2>
    <p class="m-text" style="text-align:center;">Ознакомьтесь с нашими лучшими работами.</p>
    @if(isset($portfolioHomeImages) && count($portfolioHomeImages) > 0)
    <div class="m-portfolio-home">
        <div class="m-portfolio-home__top">
            @foreach(array_slice($portfolioHomeImages, 0, 3) as $path)
            <a href="{{ route('mobile.portfolio') }}" class="m-portfolio-home__img-wrap">
                <img src="{{ asset($path) }}" alt="" loading="lazy">
            </a>
            @endforeach
        </div>
        @if(count($portfolioHomeImages) > 3)
        <div class="m-portfolio-home__bottom">
            <a href="{{ route('mobile.portfolio') }}" class="m-portfolio-home__img-wrap">
                <img src="{{ asset($portfolioHomeImages[3]) }}" alt="" loading="lazy">
            </a>
        </div>
        @endif
    </div>
    @endif
    <a href="{{ route('mobile.portfolio') }}" class="m-btn m-btn--secondary m-btn--block" style="margin-top:1rem;">Смотреть портфолио</a>
</section>

{{-- До / После — блок с фотками (как на главной designcraft) --}}
<section class="m-section m-before-after">
    <h2 class="m-section__title m-title">До и после</h2>
    <p class="m-text" style="text-align:center;">Результат нашей работы — наглядно</p>
    <div class="m-before-after__wrap">
        <div class="m-before-after__inner">
            <img src="{{ asset('image/before-after/before.jpg') }}" alt="До" class="m-before-after__img m-before-after__img--before" loading="lazy">
            <div class="m-before-after__clip" id="mBeforeAfterClip">
                <img src="{{ asset('image/before-after/after.jpg') }}" alt="После" class="m-before-after__img m-before-after__img--after" loading="lazy">
            </div>
            <input type="range" id="mBeforeAfterRange" class="m-before-after__range" min="0" max="100" value="50" aria-label="Сравнение до и после">
            <div class="m-before-after__handle" id="mBeforeAfterHandle" aria-hidden="true">
                <span class="m-before-after__handle-dot"></span>
            </div>
        </div>
    </div>
</section>

<section class="m-section">
    <h2 class="m-section__title m-title">Как мы работаем</h2>
    <div class="m-card"><strong>01. Обсуждение</strong><br><span class="m-text">Выясняем ваши потребности и детали проекта</span></div>
    <div class="m-card"><strong>02. Дизайн</strong><br><span class="m-text">Создаём первую версию вашего дизайна</span></div>
    <div class="m-card"><strong>03. Доработка</strong><br><span class="m-text">Вносим правки до полного утверждения</span></div>
    <div class="m-card"><strong>04. Результат</strong><br><span class="m-text">Передаём готовый дизайн и исходники</span></div>
</section>

@if(isset($news) && $news->count() > 0)
<section class="m-section">
    <h2 class="m-section__title m-title">Последние новости</h2>
    @foreach($news->take(3) as $item)
    <a href="{{ route('mobile.news.show', $item->slug) }}" class="m-card m-news-card" style="text-decoration:none; color:inherit; display:block; padding:0; overflow:hidden;">
        <div class="m-img-wrap" style="aspect-ratio:16/9;">
            @if($item->image_path)
                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" loading="lazy">
            @else
                <div style="width:100%; height:100%; background:var(--m-surface-2); display:flex; align-items:center; justify-content:center; color:var(--m-text-muted);">Новость</div>
            @endif
        </div>
        <div style="padding:var(--m-gap);">
            <p class="m-text" style="margin:0; font-size:0.75rem;">{{ $item->category ?? '' }} · {{ $item->published_at?->format('d.m.Y') }}</p>
            <p class="m-title" style="margin:0.25rem 0 0;">{{ $item->title }}</p>
            <p class="m-text" style="margin:0.25rem 0 0;">{{ Str::limit($item->excerpt, 80) }}</p>
        </div>
    </a>
    @endforeach
    <a href="{{ route('mobile.news') }}" class="m-btn m-btn--secondary m-btn--block">Все новости</a>
</section>
@endif

@if(isset($reviews) && $reviews->count() > 0)
<section class="m-section">
    <h2 class="m-section__title m-title">Отзывы клиентов</h2>
    @foreach($reviews->take(3) as $review)
    <div class="m-card">
        <p class="m-title">{{ $review->client_name }}</p>
        <p class="m-text">★ {{ $review->rating }}/5 · {{ $review->created_at->format('d.m.Y') }}</p>
        <p class="m-text">{{ Str::limit($review->review_text, 120) }}</p>
    </div>
    @endforeach
    <p style="text-align:center; margin-top:0.5rem;">
        <button type="button" class="m-btn m-btn--primary" id="mReviewOpenBtn">Оставить отзыв</button>
    </p>
</section>
@else
<section class="m-section">
    <p style="text-align:center;">
        <button type="button" class="m-btn m-btn--primary" id="mReviewOpenBtn">Оставить отзыв</button>
    </p>
</section>
@endif

{{-- Модалка: нет заказов / войти --}}
<div class="m-modal" id="mReviewModal" aria-hidden="true">
    <div class="m-modal__backdrop m-review-modal-close"></div>
    <div class="m-modal__box">
        <p class="m-text" id="mReviewModalText" style="margin:0 0 1rem;"></p>
        <div id="mReviewModalActions"></div>
        <button type="button" class="m-modal__close m-review-modal-close" aria-label="Закрыть">&times;</button>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Hero — стильный полноэкранный блок, без зазоров слева/справа */
.m-hero--full {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    margin-left: calc(-1 * var(--m-gap));
    margin-right: calc(-1 * var(--m-gap));
    width: calc(100% + 2 * var(--m-gap));
    padding: 1rem var(--m-gap) 3rem;
    overflow: hidden;
}
.m-hero__bg {
    position: absolute;
    inset: 0;
    background: linear-gradient(165deg, #0b0f1a 0%, #111827 35%, #0f172a 70%, #1e1b4b 100%);
    pointer-events: none;
}
/* Сетка: видна в центре, к краям скрыта круговым градиентом */
.m-hero__grid {
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(255,255,255,0.06) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.06) 1px, transparent 1px);
    background-size: 20px 20px;
    -webkit-mask-image: radial-gradient(ellipse 80% 70% at 50% 50%, black 0%, transparent 72%);
    mask-image: radial-gradient(ellipse 80% 70% at 50% 50%, black 0%, transparent 72%);
    pointer-events: none;
}
.m-theme-light .m-hero__grid {
    background-image:
        linear-gradient(rgba(0,0,0,0.06) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,0,0,0.06) 1px, transparent 1px);
}
.m-hero__orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0.5;
    animation: m-hero-orb 18s ease-in-out infinite;
}
.m-hero__orb--1 {
    width: 240px;
    height: 240px;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.4) 0%, transparent 70%);
    top: -80px;
    right: -60px;
    animation-delay: 0s;
}
.m-hero__orb--2 {
    width: 180px;
    height: 180px;
    background: radial-gradient(circle, rgba(99, 102, 241, 0.35) 0%, transparent 70%);
    bottom: 10%;
    left: -40px;
    animation-delay: -6s;
}
.m-hero__orb--3 {
    width: 120px;
    height: 120px;
    background: radial-gradient(circle, rgba(139, 92, 246, 0.3) 0%, transparent 70%);
    bottom: 30%;
    right: 20%;
    animation-delay: -12s;
}
@keyframes m-hero-orb {
    0%, 100% { transform: translate(0, 0) scale(1); }
    33% { transform: translate(15px, -20px) scale(1.05); }
    66% { transform: translate(-10px, 10px) scale(0.98); }
}
.m-hero__noise {
    position: absolute;
    inset: 0;
    opacity: 0.03;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
    pointer-events: none;
}
.m-hero__content {
    position: relative;
    z-index: 1;
    text-align: center;
    max-width: 360px;
    animation: m-hero-fade 0.8s ease-out;
}
@keyframes m-hero-fade {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.m-hero__label {
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--m-accent);
    margin: 0 0 1rem;
    opacity: 0.95;
}
.m-hero__title {
    font-size: clamp(1.75rem, 6vw, 2.25rem);
    font-weight: 800;
    line-height: 1.2;
    margin: 0 0 1rem;
    color: var(--m-text);
    letter-spacing: -0.02em;
}
.m-hero__title-accent {
    display: inline-block;
    background-image: linear-gradient(135deg, rgba(96, 165, 250, 1) 0%, rgba(140, 212, 243, 1) 50%, rgba(54, 86, 217, 1) 100%);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    -webkit-text-fill-color: transparent;
}
.m-hero__subtitle {
    font-size: 0.9375rem;
    line-height: 1.6;
    color: var(--m-text-muted);
    margin: 0 0 1.75rem;
    max-width: 320px;
    margin-left: auto;
    margin-right: auto;
}
.m-hero__actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    justify-content: center;
}
.m-hero__btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 48px;
    padding: 0 1.5rem;
    border-radius: 15px;
    font-size: 0.9375rem;
    font-weight: 600;
    text-decoration: none;
    transition: transform 0.2s, box-shadow 0.2s;
}
.m-hero__btn:active { transform: scale(0.98); }
.m-hero__btn--primary {
    background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
    color: #fff;
    box-shadow: 0 4px 20px rgba(59, 130, 246, 0.4);
}
.m-hero__btn--primary:hover { box-shadow: 0 6px 28px rgba(59, 130, 246, 0.5); }
.m-hero__btn--outline {
    background: transparent;
    color: var(--m-text);
    border: 2px solid var(--m-surface-2);
}
.m-hero__btn--outline:hover { border-color: var(--m-accent); color: var(--m-accent); }
/* Стрелка вниз — внизу экрана */
.m-hero__scroll-hint {
    position: absolute;
    bottom: 1.25rem;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    padding: 0;
    text-decoration: none;
    color: var(--m-text-muted);
    transition: color 0.2s;
    z-index: 2;
}
.m-hero__scroll-hint:hover { color: var(--m-accent); }
.m-hero__scroll-arrow {
    display: block;
    animation: m-hero-scroll-arrow 2s ease-in-out infinite;
}
@keyframes m-hero-scroll-arrow {
    0%, 100% { transform: translateY(0); opacity: 1; }
    50% { transform: translateY(6px); opacity: 0.6; }
}
/* Светлая тема — hero */
.m-theme-light .m-hero__bg { background: linear-gradient(165deg, #f0f9ff 0%, #e0f2fe 35%, #f5f3ff 70%, #ede9fe 100%); }
.m-theme-light .m-hero__orb--1 { background: radial-gradient(circle, rgba(59, 130, 246, 0.25) 0%, transparent 70%); }
.m-theme-light .m-hero__orb--2 { background: radial-gradient(circle, rgba(99, 102, 241, 0.2) 0%, transparent 70%); }
.m-theme-light .m-hero__orb--3 { background: radial-gradient(circle, rgba(139, 92, 246, 0.2) 0%, transparent 70%); }
.m-theme-light .m-hero__title { color: var(--m-text); }
.m-theme-light .m-hero__title-accent { background: linear-gradient(135deg, #2563eb 0%, #6366f1 50%, #7c3aed 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.m-theme-light .m-hero__btn--outline { border-color: var(--m-surface-2); color: var(--m-text); }
.m-theme-light .m-hero__scroll { border-color: var(--m-surface-2); }
.m-portfolio-home__top { display: grid; grid-template-columns: repeat(3, 1fr); gap: 6px; margin-bottom: 6px; }
.m-portfolio-home__bottom { display: block; }
.m-portfolio-home__img-wrap { display: block; border-radius: var(--m-radius); overflow: hidden; background: var(--m-surface-2); aspect-ratio: 1; }
.m-portfolio-home__img-wrap img { width: 100%; height: 100%; object-fit: cover; display: block; }
.m-portfolio-home__bottom .m-portfolio-home__img-wrap {
    aspect-ratio: 3 / 1;
    max-height: 120px;
    width: 100%;
}

/* До / После — слайдер с фотками */
.m-before-after__wrap { border-radius: var(--m-radius); overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,0.2); margin-top: 1rem; }
.m-before-after__inner { position: relative; aspect-ratio: 16/10; }
.m-before-after__img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; display: block; }
.m-before-after__clip { position: absolute; inset: 0; clip-path: inset(0 50% 0 0); }
.m-before-after__range { position: absolute; inset: 0; width: 100%; height: 100%; margin: 0; opacity: 0; cursor: ew-resize; z-index: 2; -webkit-appearance: none; appearance: none; background: none; }
.m-before-after__handle { position: absolute; top: 0; bottom: 0; left: 50%; width: 4px; background: #fff; box-shadow: 0 0 12px rgba(0,0,0,0.4); pointer-events: none; z-index: 1; transition: left 0.05s ease; }
.m-before-after__handle-dot { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 36px; height: 36px; background: #fff; border-radius: 50%; box-shadow: 0 2px 12px rgba(0,0,0,0.3); }
</style>
@endpush

@push('scripts')
<script>
(function() {
    var range = document.getElementById('mBeforeAfterRange');
    var clip = document.getElementById('mBeforeAfterClip');
    var handle = document.getElementById('mBeforeAfterHandle');
    if (!range || !clip || !handle) return;
    function update(v) {
        var p = (v || range.value) + '%';
        clip.style.clipPath = 'inset(0 ' + (100 - parseFloat(v || range.value)) + '% 0 0)';
        handle.style.left = p;
    }
    range.addEventListener('input', function() { update(range.value); });
    update(50);
})();
</script>
<script>
(function() {
    var btn = document.getElementById('mReviewOpenBtn');
    var modal = document.getElementById('mReviewModal');
    var modalText = document.getElementById('mReviewModalText');
    var modalActions = document.getElementById('mReviewModalActions');
    var canReview = {{ isset($canReview) && $canReview ? 'true' : 'false' }};
    var isAuth = {{ auth()->check() ? 'true' : 'false' }};

    function openModal(text, htmlActions) {
        if (modalText) modalText.textContent = text;
        if (modalActions) { modalActions.innerHTML = htmlActions || ''; }
        if (modal) modal.classList.add('is-open');
    }
    function closeModal() {
        if (modal) modal.classList.remove('is-open');
    }

    if (btn) {
        btn.addEventListener('click', function() {
            if (canReview) {
                window.location.href = '{{ route("mobile.review.create") }}';
                return;
            }
            if (!isAuth) {
                openModal('Войдите в аккаунт, чтобы оставить отзыв.', '<a href="{{ route("login") }}" class="m-btn m-btn--primary m-btn--block">Войти</a>');
                return;
            }
            openModal('Чтобы оставить отзыв, нужен хотя бы один заказ. Оформите заказ, и после его выполнения вы сможете написать отзыв.', '<a href="{{ route("mobile.order.create") }}" class="m-btn m-btn--primary m-btn--block">Оформить заказ</a>');
        });
    }
    document.querySelectorAll('.m-review-modal-close').forEach(function(el) {
        el.addEventListener('click', closeModal);
    });
})();
</script>
@endpush
