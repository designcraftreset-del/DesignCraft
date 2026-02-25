{{-- Универсальный скелетон для страниц без своего шаблона --}}
<div class="sk sk-default">
    <div class="skeleton sk-page-title"></div>
    <div class="sk-default-blocks">
        @for($i = 0; $i < 4; $i++)
        <div class="skeleton sk-default-block"></div>
        @endfor
    </div>
</div>
