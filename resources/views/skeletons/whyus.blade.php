{{-- Почему мы: hero_two + карточки причин --}}
<div class="sk sk-whyus">
    <div class="sk-hero-two">
        <div class="skeleton sk-hero-two__label" style="height:1rem;width:120px;"></div>
        <div class="skeleton sk-hero-two__title" style="height:1.5rem;width:90%;max-width:380px;margin-top:0.5rem;"></div>
        <div class="skeleton sk-hero-two__desc" style="height:0.875rem;width:95%;margin-top:0.75rem;"></div>
    </div>
    <div class="sk-whyus-grid">
        @for($i = 0; $i < 6; $i++)
        <div class="sk-why-card">
            <div class="skeleton sk-why-card__icon"></div>
            <div class="skeleton sk-why-card__title" style="height:1rem;width:80%;margin-top:0.5rem;"></div>
            <div class="skeleton sk-why-card__text" style="height:0.875rem;width:100%;margin-top:0.35rem;"></div>
            <div class="skeleton sk-why-card__text" style="height:0.875rem;width:70%;margin-top:0.35rem;"></div>
        </div>
        @endfor
    </div>
</div>
