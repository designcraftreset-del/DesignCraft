@extends('mobile.layouts.mobile-app')

@section('title', 'Портфолио — DesignCraft')

@section('content')
<section class="m-hero">
    <h1 class="m-hero__title">Портфолио проектов</h1>
    <p class="m-hero__subtitle">Лучшие работы в различных сферах дизайна. Нажмите на работу, чтобы увидеть описание и заказать похожее.</p>
</section>

<section class="m-section">
    @if(isset($galleryItems) && count($galleryItems) > 0)
    <div class="m-portfolio-gallery">
        @foreach($galleryItems as $index => $item)
        <button type="button" class="m-portfolio-gallery__item" data-index="{{ $index }}" data-src="{{ asset($item['path']) }}" data-title="{{ e($item['title']) }}" data-subtitle="{{ e($item['subtitle']) }}" data-description="{{ e($item['description']) }}">
            <img src="{{ asset($item['path']) }}" alt="" loading="lazy">
        </button>
        @endforeach
    </div>
    @else
    <div class="m-card">
        <p class="m-text" style="text-align:center;">Пока нет работ в портфолио.</p>
        <div class="m-img-wrap" style="margin-top:1rem;">
            <img src="{{ asset('image/placeholder.svg') }}" alt="" loading="lazy">
        </div>
    </div>
    @endif
</section>

{{-- Модалка с подписью и кнопкой «Заказать похожее» --}}
<div class="m-modal" id="mPortfolioModal" aria-hidden="true">
    <div class="m-modal__backdrop m-portfolio-modal-close"></div>
    <div class="m-modal__box m-portfolio-modal-box">
        <img id="mPortfolioModalImg" src="" alt="" style="width:100%; border-radius:var(--m-radius); margin-bottom:1rem;">
        <h3 class="m-title" id="mPortfolioModalTitle" style="margin:0 0 0.25rem;"></h3>
        <p class="m-text" id="mPortfolioModalSubtitle" style="margin:0 0 0.5rem; font-size:0.875rem;"></p>
        <p class="m-text" id="mPortfolioModalDesc" style="margin:0 0 1rem;"></p>
        <a href="{{ route('mobile.order.create') }}" class="m-btn m-btn--primary m-btn--block">Заказать похожее</a>
        <button type="button" class="m-modal__close m-portfolio-modal-close">&times;</button>
    </div>
</div>
@endsection

@push('styles')
<style>
.m-portfolio-gallery { display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px; }
.m-portfolio-gallery__item { padding: 0; border: none; background: none; cursor: pointer; border-radius: var(--m-radius); overflow: hidden; aspect-ratio: 1; }
.m-portfolio-gallery__item img { width: 100%; height: 100%; object-fit: cover; display: block; }
.m-portfolio-modal-box { max-width: 360px; }
</style>
@endpush

@push('scripts')
<script>
(function() {
    var modal = document.getElementById('mPortfolioModal');
    var modalImg = document.getElementById('mPortfolioModalImg');
    var modalTitle = document.getElementById('mPortfolioModalTitle');
    var modalSubtitle = document.getElementById('mPortfolioModalSubtitle');
    var modalDesc = document.getElementById('mPortfolioModalDesc');

    function openModal(src, title, subtitle, description) {
        if (modalImg) modalImg.src = src || '';
        if (modalTitle) modalTitle.textContent = title || '';
        if (modalSubtitle) { modalSubtitle.textContent = subtitle || ''; modalSubtitle.style.display = subtitle ? '' : 'none'; }
        if (modalDesc) modalDesc.textContent = description || '';
        if (modal) modal.classList.add('is-open');
    }
    function closeModal() {
        if (modal) modal.classList.remove('is-open');
    }

    document.querySelectorAll('.m-portfolio-gallery__item').forEach(function(btn) {
        btn.addEventListener('click', function() {
            openModal(
                btn.getAttribute('data-src'),
                btn.getAttribute('data-title'),
                btn.getAttribute('data-subtitle'),
                btn.getAttribute('data-description')
            );
        });
    });
    document.querySelectorAll('.m-portfolio-modal-close').forEach(function(el) {
        el.addEventListener('click', closeModal);
    });
})();
</script>
@endpush
