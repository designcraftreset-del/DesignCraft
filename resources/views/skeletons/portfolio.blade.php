{{-- Портфолио: hero с заголовком, затем категории + сетка баннеров --}}
<div class="sk sk-portfolio">
    <div class="sk-hero-portfolio">
        <div class="skeleton sk-hero-portfolio__badge" style="height:1.25rem;width:140px;"></div>
        <div class="skeleton sk-hero-portfolio__title" style="height:2rem;width:280px;margin-top:0.5rem;"></div>
        <div class="skeleton sk-hero-portfolio__desc" style="height:1rem;width:95%;margin-top:0.75rem;"></div>
    </div>
    <div class="sk-categories">
        @for($i = 0; $i < 5; $i++)
        <div class="skeleton sk-cat-btn" style="height:2.25rem;width:100px;border-radius:8px;"></div>
        @endfor
    </div>
    <div class="sk-banners-grid">
        @for($i = 0; $i < 8; $i++)
        <div class="sk-banner-card">
            <div class="skeleton sk-banner-card__img"></div>
            <div class="skeleton sk-banner-card__title" style="height:0.875rem;width:70%;margin-top:0.5rem;"></div>
        </div>
        @endfor
    </div>
</div>
