{{-- Новости: hero, сетка карточек новостей --}}
<div class="sk sk-news">
    <div class="sk-hero-news">
        <div class="skeleton sk-hero-news__title" style="height:2.5rem;width:220px;"></div>
        <div class="skeleton sk-hero-news__desc" style="height:1rem;width:70%;max-width:400px;margin-top:0.75rem;"></div>
    </div>
    <div class="sk-news-grid">
        <div class="sk-news-card sk-news-card--featured">
            <div class="skeleton sk-news-card__img"></div>
            <div class="sk-news-card__body">
                <div class="skeleton" style="height:0.875rem;width:80px;"></div>
                <div class="skeleton" style="height:1.25rem;width:90%;margin-top:0.5rem;"></div>
                <div class="skeleton" style="height:0.875rem;width:100%;margin-top:0.5rem;"></div>
                <div class="skeleton" style="height:0.875rem;width:60%;margin-top:0.35rem;"></div>
            </div>
        </div>
        @for($i = 0; $i < 6; $i++)
        <div class="sk-news-card">
            <div class="skeleton sk-news-card__img"></div>
            <div class="skeleton sk-news-card__title" style="height:1rem;width:85%;margin:0.5rem 0.75rem 0;"></div>
            <div class="skeleton sk-news-card__line" style="height:0.75rem;width:60%;margin:0.35rem 0.75rem 0.75rem;"></div>
        </div>
        @endfor
    </div>
</div>
