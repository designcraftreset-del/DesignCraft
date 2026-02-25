{{-- Статья: картинка, дата, заголовок, строки текста, блок «похожие» --}}
<div class="sk sk-article">
    <div class="skeleton sk-article__img"></div>
    <div class="sk-article__meta">
        <div class="skeleton sk-article__date" style="height:0.875rem;width:100px;"></div>
    </div>
    <div class="skeleton sk-article__title" style="height:1.75rem;width:90%;margin-top:0.5rem;"></div>
    <div class="sk-article__lines">
        @for($i = 0; $i < 8; $i++)
        <div class="skeleton sk-article__line" style="height:0.875rem;{{ $i === 7 ? 'width:70%;' : 'width:100%;' }}"></div>
        @endfor
    </div>
    <div class="sk-article__related">
        <div class="skeleton" style="height:1.5rem;width:200px;margin-bottom:1rem;"></div>
        <div class="sk-article-related-grid">
            @for($i = 0; $i < 3; $i++)
            <div class="sk-related-card">
                <div class="skeleton sk-related-card__img"></div>
                <div class="skeleton sk-related-card__title" style="height:0.875rem;width:80%;margin-top:0.5rem;"></div>
            </div>
            @endfor
        </div>
    </div>
</div>
