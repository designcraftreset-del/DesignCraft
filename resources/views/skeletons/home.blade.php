{{-- Главная: hero, услуги, портфолио, как работаем, отзывы --}}
<div class="sk sk-home">
    {{-- Hero: левая колонка (заголовок, подзаголовок, 2 кнопки), правая — круг + 4 карточки --}}
    <div class="sk-hero">
        <div class="sk-hero__text">
            <div class="skeleton sk-hero__title" style="height:2.5rem;width:75%;max-width:400px;"></div>
            <div class="skeleton sk-hero__subtitle" style="height:1rem;width:95%;margin-top:0.75rem;"></div>
            <div class="skeleton sk-hero__subtitle" style="height:1rem;width:70%;margin-top:0.35rem;"></div>
            <div style="display:flex;gap:0.75rem;margin-top:1.25rem;">
                <div class="skeleton" style="height:2.75rem;width:140px;border-radius:8px;"></div>
                <div class="skeleton" style="height:2.75rem;width:160px;border-radius:8px;"></div>
            </div>
        </div>
        <div class="sk-hero__blocks">
            <div class="skeleton sk-hero__circle"></div>
            @for($i = 0; $i < 4; $i++)
            <div class="skeleton sk-hero__card"></div>
            @endfor
        </div>
    </div>
    {{-- Секция «Наши услуги» --}}
    <div class="sk-section">
        <div class="skeleton sk-section__title" style="height:1.75rem;width:220px;"></div>
        <div class="skeleton sk-section__desc" style="height:1rem;width:100%;margin-top:0.5rem;"></div>
        <div class="skeleton sk-section__desc" style="height:1rem;width:85%;margin-top:0.35rem;"></div>
        <div class="sk-services-grid">
            @for($i = 0; $i < 4; $i++)
            <div class="sk-service-card">
                <div class="skeleton sk-service-card__icon"></div>
                <div class="skeleton sk-service-card__name" style="height:1rem;width:70%;margin-top:0.5rem;"></div>
                <div class="skeleton sk-service-card__text" style="height:0.875rem;width:100%;margin-top:0.35rem;"></div>
                <div class="skeleton sk-service-card__price" style="height:1rem;width:80px;margin-top:0.5rem;"></div>
            </div>
            @endfor
        </div>
        <div class="skeleton sk-btn" style="height:2.5rem;width:200px;margin-top:1.5rem;border-radius:8px;"></div>
    </div>
    {{-- Портфолио --}}
    <div class="sk-section">
        <div class="skeleton sk-section__title" style="height:1.75rem;width:200px;"></div>
        <div class="skeleton sk-section__desc" style="height:1rem;width:90%;margin-top:0.5rem;"></div>
        <div class="sk-portfolio-grid">
            @for($i = 0; $i < 6; $i++)
            <div class="skeleton sk-portfolio__img"></div>
            @endfor
        </div>
        <div class="skeleton sk-btn" style="height:2.5rem;width:160px;margin-top:1rem;border-radius:8px;"></div>
    </div>
    {{-- Как мы работаем: 4 шага --}}
    <div class="sk-section">
        <div class="skeleton sk-section__label" style="height:0.875rem;width:120px;"></div>
        <div class="skeleton sk-section__title" style="height:1.75rem;width:240px;margin-top:0.35rem;"></div>
        <div class="skeleton sk-section__desc" style="height:1rem;width:95%;margin-top:0.5rem;"></div>
        <div class="sk-steps">
            @for($i = 0; $i < 4; $i++)
            <div class="sk-step">
                <div class="skeleton sk-step__icon"></div>
                <div class="skeleton sk-step__title" style="height:1rem;width:100px;"></div>
                <div class="skeleton sk-step__text" style="height:0.75rem;width:90%;margin-top:0.35rem;"></div>
            </div>
            @endfor
        </div>
    </div>
    {{-- Отзывы --}}
    <div class="sk-section">
        <div class="skeleton sk-section__label" style="height:0.875rem;width:80px;"></div>
        <div class="skeleton sk-section__title" style="height:1.75rem;width:280px;margin-top:0.35rem;"></div>
        <div class="skeleton sk-section__desc" style="height:1rem;width:90%;margin-top:0.5rem;"></div>
        <div class="sk-reviews-strip">
            @for($i = 0; $i < 3; $i++)
            <div class="sk-review-card">
                <div class="sk-review-card__head">
                    <div class="skeleton sk-review-card__avatar"></div>
                    <div style="flex:1;">
                        <div class="skeleton" style="height:0.875rem;width:100px;"></div>
                        <div class="skeleton" style="height:0.75rem;width:60%;margin-top:0.35rem;"></div>
                    </div>
                </div>
                <div class="skeleton sk-review-card__stars" style="height:1rem;width:100px;margin-top:0.5rem;"></div>
                <div class="skeleton sk-review-card__text" style="height:0.875rem;width:100%;margin-top:0.5rem;"></div>
                <div class="skeleton sk-review-card__text" style="height:0.875rem;width:75%;margin-top:0.35rem;"></div>
            </div>
            @endfor
        </div>
    </div>
</div>
