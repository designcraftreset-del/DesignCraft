@extends('mobile.layouts.mobile-app')

@section('title', $news->title . ' — DesignCraft')

@section('content')
<section class="m-section">
    <a href="{{ route('mobile.news') }}" class="m-text" style="display:inline-block; margin-bottom:1rem; color:var(--m-accent); text-decoration:none;">← Все новости</a>
    <article>
        <h1 class="m-hero__title" style="text-align:left;">{{ $news->title }}</h1>
        <p class="m-text" style="margin:0.5rem 0 1rem;">{{ $news->category }} · {{ $news->published_at?->format('d.m.Y') }} · {{ $news->views_count }} просмотров</p>
        @if($news->image_path)
        <div class="m-img-wrap" style="aspect-ratio:16/10; margin-bottom:1rem;">
            <img src="{{ asset('storage/' . $news->image_path) }}" alt="{{ $news->title }}" loading="lazy">
        </div>
        @endif
        <div class="m-card" style="white-space:pre-wrap; font-size:0.9375rem;">{!! nl2br(e($news->content)) !!}</div>
        <div class="m-card" style="display:flex; align-items:center; gap:12px;">
            @if($news->user && $news->user->avatar)
                <img src="{{ asset('storage/' . $news->user->avatar) }}" alt="" style="width:48px; height:48px; border-radius:50%; object-fit:cover;">
            @else
                <div style="width:48px; height:48px; border-radius:50%; background:var(--m-surface-2); display:flex; align-items:center; justify-content:center; color:var(--m-text-muted); font-weight:600;">{{ mb_substr($news->author->name ?? 'А', 0, 1) }}</div>
            @endif
            <div>
                <p class="m-title" style="margin:0; font-size:1rem;">{{ $news->author->name ?? 'Автор' }}</p>
                <p class="m-text" style="margin:0; font-size:0.75rem;">Автор статьи</p>
            </div>
        </div>
    </article>
</section>

@if(isset($relatedNews) && $relatedNews->count() > 0)
<section class="m-section">
    <h2 class="m-section__title m-title">Похожие новости</h2>
    @foreach($relatedNews as $related)
    <a href="{{ route('mobile.news.show', $related->slug) }}" class="m-card" style="text-decoration:none; color:inherit; display:block;">
        <div class="m-img-wrap" style="aspect-ratio:16/9;">
            @if($related->image_path)
                <img src="{{ asset('storage/' . $related->image_path) }}" alt="{{ $related->title }}" loading="lazy">
            @else
                <div style="width:100%; height:100%; background:var(--m-surface-2); display:flex; align-items:center; justify-content:center; color:var(--m-text-muted);">Новость</div>
            @endif
        </div>
        <p class="m-text" style="margin:0.5rem 0 0; font-size:0.75rem;">{{ $related->category }} · {{ $related->published_at?->format('d.m.Y') }}</p>
        <p class="m-title" style="margin:0.25rem 0 0;">{{ $related->title }}</p>
        <p class="m-text" style="margin:0.25rem 0 0;">{{ Str::limit($related->excerpt, 80) }}</p>
        <span class="m-btn m-btn--primary" style="margin-top:0.75rem;">Читать</span>
    </a>
    @endforeach
</section>
@endif
@endsection
