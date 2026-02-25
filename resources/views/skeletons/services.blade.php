{{-- Услуги: hero_two + сетка карточек услуг --}}
<div class="sk sk-services">
    <div class="sk-hero-two">
        <div class="skeleton sk-hero-two__label" style="height:1rem;width:140px;"></div>
        <div class="skeleton sk-hero-two__title" style="height:1.5rem;width:85%;max-width:400px;margin-top:0.5rem;"></div>
        <div class="skeleton sk-hero-two__desc" style="height:0.875rem;width:90%;margin-top:0.75rem;"></div>
    </div>
    <div class="sk-cards-grid">
        @for($i = 0; $i < 6; $i++)
        <div class="sk-card">
            <div class="skeleton sk-card__img"></div>
            <div class="skeleton sk-card__title"></div>
            <div class="skeleton sk-card__line"></div>
        </div>
        @endfor
    </div>
</div>
