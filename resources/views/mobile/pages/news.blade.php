@extends('mobile.layouts.mobile-app')

@section('title', 'Новости — DesignCraft')

@section('content')
<section class="m-hero">
    <h1 class="m-hero__title">Новости</h1>
    <p class="m-hero__subtitle">Актуальные статьи и обновления от команды DesignCraft.</p>
</section>

<section class="m-section">
    <form action="{{ route('mobile.news') }}" method="get" class="m-card">
        <input type="hidden" name="category" value="{{ $category }}">
        <div class="m-news-search">
            <input type="search" name="search" value="{{ $search }}" placeholder="Поиск по новостям" class="m-news-search__input" id="mNewsSearchInput">
            <button type="submit" class="m-news-search__btn" aria-label="Найти">
                <svg class="m-news-search__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            </button>
        </div>
        <div style="display:flex; flex-wrap:wrap; gap:8px;">
            <a href="{{ route('mobile.news', ['category' => 'all']) }}" class="m-btn m-btn--secondary" style="padding:0.5rem 0.75rem; font-size:0.875rem;">Все</a>
            @foreach(['Дизайн', 'Обновления', 'Советы', 'Кейсы'] as $cat)
                <a href="{{ route('mobile.news', ['category' => $cat]) }}" class="m-btn m-btn--secondary" style="padding:0.5rem 0.75rem; font-size:0.875rem;">{{ $cat }}</a>
            @endforeach
        </div>
    </form>
</section>

@if($featuredNews->count() > 0)
<section class="m-section">
    <h2 class="m-section__title m-title">Главная новость</h2>
    @foreach($featuredNews as $item)
    <a href="{{ route('mobile.news.show', $item->slug) }}" class="m-card" style="text-decoration:none; color:inherit; display:block;">
        <div class="m-img-wrap">
            @if($item->image_path)
                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" loading="lazy">
            @else
                <div style="width:100%; height:100%; background:var(--m-surface-2); display:flex; align-items:center; justify-content:center; color:var(--m-text-muted);">Новость</div>
            @endif
        </div>
        <p class="m-text" style="margin:0.5rem 0 0; font-size:0.75rem; color:var(--m-accent);">{{ $item->category }} · {{ $item->published_at?->format('d.m.Y') }}</p>
        <p class="m-title" style="margin:0.25rem 0 0;">{{ $item->title }}</p>
        <p class="m-text" style="margin:0.25rem 0 0;">{{ Str::limit($item->excerpt, 100) }}</p>
    </a>
    @endforeach
</section>
@endif

<section class="m-section">
    <h2 class="m-section__title m-title">Все новости</h2>
    @forelse($news as $item)
    <a href="{{ route('mobile.news.show', $item->slug) }}" class="m-card" style="text-decoration:none; color:inherit; display:block;">
        <div class="m-img-wrap" style="aspect-ratio:16/9;">
            @if($item->image_path)
                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" loading="lazy">
            @else
                <div style="width:100%; height:100%; background:var(--m-surface-2); display:flex; align-items:center; justify-content:center; color:var(--m-text-muted);">Новость</div>
            @endif
        </div>
        <p class="m-text" style="margin:0.5rem 0 0; font-size:0.75rem;">{{ $item->category }} · {{ $item->published_at?->format('d.m.Y') }}</p>
        <p class="m-title" style="margin:0.25rem 0 0;">{{ $item->title }}</p>
        <p class="m-text" style="margin:0.25rem 0 0;">{{ Str::limit($item->excerpt, 80) }}</p>
    </a>
    @empty
    <div class="m-card">
        <p class="m-text" style="text-align:center;">Новостей не найдено.</p>
    </div>
    @endforelse
</section>

@if($news->hasPages())
<section class="m-section">
    <div style="display:flex; justify-content:center; gap:8px; flex-wrap:wrap;">
        @if($news->onFirstPage())
            <span class="m-btn m-btn--secondary" style="opacity:0.5; pointer-events:none;">Назад</span>
        @else
            <a href="{{ $news->previousPageUrl() }}" class="m-btn m-btn--secondary">Назад</a>
        @endif
        <span class="m-text" style="align-self:center;">Стр. {{ $news->currentPage() }} из {{ $news->lastPage() }}</span>
        @if($news->hasMorePages())
            <a href="{{ $news->nextPageUrl() }}" class="m-btn m-btn--secondary">Вперёд</a>
        @else
            <span class="m-btn m-btn--secondary" style="opacity:0.5; pointer-events:none;">Вперёд</span>
        @endif
    </div>
</section>
@endif
@endsection
