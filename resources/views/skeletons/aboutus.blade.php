{{-- О нас: hero_two, история (текст + картинка), цифры, ценности, команда --}}
<div class="sk sk-aboutus">
    <div class="sk-hero-two">
        <div class="skeleton sk-hero-two__label" style="height:1rem;width:80px;"></div>
        <div class="skeleton sk-hero-two__title" style="height:1.5rem;width:200px;margin-top:0.5rem;"></div>
        <div class="skeleton sk-hero-two__desc" style="height:0.875rem;width:95%;margin-top:0.75rem;"></div>
    </div>
    <div class="sk-history">
        <div class="sk-history__text">
            <div class="skeleton" style="height:1rem;width:160px;"></div>
            <div class="skeleton" style="height:0.875rem;width:100%;margin-top:1rem;"></div>
            <div class="skeleton" style="height:0.875rem;width:100%;margin-top:0.5rem;"></div>
            <div class="skeleton" style="height:0.875rem;width:85%;margin-top:0.5rem;"></div>
        </div>
        <div class="skeleton sk-history__img"></div>
    </div>
    <div class="sk-numbers">
        @for($i = 0; $i < 4; $i++)
        <div class="sk-number">
            <div class="skeleton sk-number__value" style="height:2rem;width:80px;"></div>
            <div class="skeleton sk-number__label" style="height:0.875rem;width:100px;margin-top:0.35rem;"></div>
        </div>
        @endfor
    </div>
    <div class="sk-section">
        <div class="skeleton sk-section__title" style="height:1.5rem;width:180px;"></div>
        <div class="skeleton sk-section__desc" style="height:0.875rem;width:70%;margin-top:0.5rem;"></div>
        <div class="sk-values">
            @for($i = 0; $i < 3; $i++)
            <div class="sk-value">
                <div class="skeleton sk-value__icon"></div>
                <div>
                    <div class="skeleton" style="height:0.875rem;width:120px;"></div>
                    <div class="skeleton" style="height:0.75rem;width:100%;margin-top:0.5rem;"></div>
                </div>
            </div>
            @endfor
        </div>
    </div>
    <div class="sk-section">
        <div class="skeleton sk-section__title" style="height:1.5rem;width:200px;"></div>
        <div class="skeleton sk-section__desc" style="height:0.875rem;width:80%;margin-top:0.5rem;"></div>
        <div class="sk-team-grid">
            @for($i = 0; $i < 4; $i++)
            <div class="sk-team-card">
                <div class="skeleton sk-team-card__img"></div>
                <div class="skeleton sk-team-card__name" style="height:1rem;width:70%;margin-top:0.5rem;"></div>
                <div class="skeleton sk-team-card__role" style="height:0.75rem;width:50%;margin-top:0.35rem;"></div>
                <div class="skeleton sk-team-card__text" style="height:0.75rem;width:100%;margin-top:0.5rem;"></div>
            </div>
            @endfor
        </div>
    </div>
</div>
