@extends('layouts.app')

@section('skeleton')
    @include('skeletons.news')
@endsection
@section('content')
<style>
    /* Ваши существующие стили остаются без изменений */
    .news-page {
        min-height: 100vh;
    }

    .news-hero {
        background: linear-gradient(135deg, #1E3A8A 0%, #1D4ED8 100%);
        padding: 150px 0;
        position: relative;
        overflow: hidden;
    }

    .news-hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
    }

    .news-hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 1rem;
    }

    .news-hero p {
        font-size: 1.25rem;
        color: #DBEAFE;
        margin-bottom: 2rem;
    }

    /* Остальные стили из предыдущего ответа */
</style>
<style>
.news-page {
    min-height: 100vh;
}

.news-hero {
    background: linear-gradient(135deg, #1E3A8A 0%, #1D4ED8 100%);
    padding: 150px 0;
    position: relative;
    overflow: hidden;
}

.news-hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.news-hero h1 {
    font-size: 3.5rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
}

.news-hero p {
    font-size: 1.25rem;
    color: #DBEAFE;
    margin-bottom: 2rem;
}

.news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    padding: 4rem 0;
}

.news-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    position: relative;
}



.news-card.featured {
    grid-column: 1 / -1;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0;
}

.news-image {
    position: relative;
    overflow: hidden;
    height: 250px;
}

.news-card.featured .news-image {
    height: 100%;
    min-height: 400px;
}

.news-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.news-card:hover .news-image img {
    transform: scale(1.05);
}

.news-category {
    position: absolute;
    top: 1rem;
    left: 1rem;
    background: linear-gradient(135deg, #3B82F6, #1D4ED8);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.news-date {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: rgba(255, 255, 255, 0.95);
    color: #374151;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
}

.news-content {
    padding: 2rem;
}

.news-card.featured .news-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.news-title {
    font-size: 1.5rem;
    min-height: 90px;
    font-weight: 700;
    color: #1F2937;
    margin-bottom: 1rem;
    line-height: 1.3;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.news-card.featured .news-title {
    font-size: 2rem;
}
.filter_blur{
    filter: blur(2px);
    transition: 0.3s;
    opacity: 30%;
}
.filter_blur:hover{
    filter: blur(0px);
    opacity: 100%;
}
.news-excerpt {
    color: #6B7280;
    line-height: 1.6;
    min-height: 76px;
    margin-bottom: 1.5rem;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.news-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
    padding-top: 1.5rem;
    border-top: 1px solid #F3F4F6;
}

.news-author {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.author-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #3B82F6, #1D4ED8);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 0.875rem;
}
.author-avatar-author-avatar{
    width: 80px;
}

.author-info h4 {
    font-size: 0.875rem;
    font-weight: 600;
    color: #374151;
    margin: 0;
}

.author-info p {
    font-size: 0.75rem;
    color: #9CA3AF;
    margin: 0;
}

.news-read-more {
    background: linear-gradient(135deg, #3B82F6, #1D4ED8);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.875rem;
    transition: all 0.3s ease;
    text-decoration: none !important;
}
.news-read-more-news-read-more-news-read-more{
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0px 0px 0px 3px inset #0077B5;
    color: #0077B5;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.875rem;
    transition: all 0.3s ease;
    text-decoration: none !important;
}
.news-read-more-news-read-more-news-read-more>svg{
    stroke: #0077B5 !important;
}


/* Пагинация */
.news-pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1rem;
    padding: 3rem 0;
}

.pagination-btn {
    background: white;
    border: 2px solid #E5E7EB;
    color: #374151;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.pagination-btn:hover:not(:disabled) {
    background: #3B82F6;
    border-color: #3B82F6;
    color: white;
}

.pagination-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.pagination-numbers {
    display: flex;
    gap: 0.5rem;
}

.page-number {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.page-number.active {
    background: linear-gradient(135deg, #3B82F6, #1D4ED8);
    color: white;
}

.page-number:not(.active):hover {
    background: #F3F4F6;
}

/* Фильтры новостей */
.news-filters {
    background: white;
    padding: 2rem 0;
    border-bottom: 1px solid #E5E7EB;
    position: sticky;
    top: 50px;
    z-index: 100;
}

.filter-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.filter-categories {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.filter-category {
    padding: 0.5rem 1rem;
    border: 2px solid #E5E7EB;
    border-radius: 20px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.filter-category.active,
.filter-category:hover {
    background: linear-gradient(135deg, #3B82F6, #1D4ED8);
    border-color: #3B82F6;
    color: white;
}

.search-box {
    position: relative;
    min-width: 300px;
}

.search-box input {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    border: 2px solid #E5E7EB;
    border-radius: 20px;
    font-size: 0.875rem;
    transition: all 0.3s ease;
}

.search-box input:focus {
    outline: none;
    border-color: #3B82F6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.search-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #9CA3AF;
}

/* Страница отдельной новости */
.news-single {
    padding: 4rem 0;
}

.news-single-header {
    text-align: center;
    max-width: 800px;
    margin: 0 auto 4rem;
}

.news-single-title {
    font-size: 3rem;
    font-weight: 700;
    color: #1F2937;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.news-single-meta {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 2rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.news-single-date,
.news-single-category,
.news-single-views {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #6B7280;
    font-weight: 500;
}

.news-single-image {
    width: 100%;
    height: 500px;
    border-radius: 20px;
    overflow: hidden;
    margin-bottom: 3rem;
}

.news-single-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.news-single-content {
    max-width: 800px;
    margin: 0 auto;
    font-size: 1.125rem;
    line-height: 1.7;
    color: #374151;
}

.news-single-content h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #1F2937;
    margin: 3rem 0 1.5rem;
}

.news-single-content h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1F2937;
    margin: 2rem 0 1rem;
}

.news-single-content p {
    margin-bottom: 1.5rem;
}

.news-single-content blockquote {
    border-left: 4px solid #3B82F6;
    padding-left: 2rem;
    margin: 2rem 0;
    font-style: italic;
    color: #6B7280;
    background: #F8FAFC;
    padding: 2rem;
    border-radius: 0 8px 8px 0;
}

.news-single-content img {
    width: 100%;
    height: auto;
    border-radius: 12px;
    margin: 2rem 0;
}

.news-single-footer {
    max-width: 800px;
    margin: 4rem auto 0;
    padding-top: 3rem;
    border-top: 1px solid #E5E7EB;
}

.news-tags {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
    margin-bottom: 2rem;
}

.news-tag {
    background: #F3F4F6;
    color: #374151;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 500;
}

.news-share {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.news-share span {
    font-weight: 600;
    color: #374151;
}

.share-buttons {
    display: flex;
    gap: 0.5rem;
}

.share-button {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #F3F4F6;
    color: #374151;
    transition: all 0.3s ease;
    text-decoration: none;
}

.share-button:hover {
    transform: translateY(-2px);
    color: white;
}

.share-button.facebook:hover { background: #1877F2; }
.share-button.twitter:hover { background: #1DA1F2; }
.share-button.linkedin:hover { background: #0077B5; }
.share-button.telegram:hover { background: #0088CC; }

/* Адаптивность */
@media (max-width: 768px) {
    .news-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
        padding: 2rem 0;
    }
    
    .news-card.featured {
        grid-column: 1;
        grid-template-columns: 1fr;
    }
    
    .news-hero h1 {
        font-size: 2.5rem;
    }
    
    .news-single-title {
        font-size: 2rem;
    }
    
    .news-single-image {
        height: 300px;
    }
    
    .filter-container {
        flex-direction: column;
        align-items: stretch;
    }
    
    .search-box {
        min-width: auto;
    }
    
    .news-pagination {
        flex-wrap: wrap;
    }
}

/* Темная тема */
.dark-theme .news-card,
.dark-theme .news-filters,
.dark-theme .pagination-btn,
.dark-theme .search-box input {
    background: #2D3748;
    color: #E2E8F0;
}

.dark-theme .news-title,
.dark-theme .news-single-title {
    color: #F7FAFC;
}

.dark-theme .news-excerpt,
.dark-theme .news-single-content {
    color: #CBD5E0;
}

.dark-theme .news-date,
.dark-theme .filter-category,
.dark-theme .search-box input {
    background: #4A5568;
    border-color: #4A5568;
    color: #E2E8F0;
}

.dark-theme .news-meta,
.dark-theme .news-single-footer {
    border-color: #4A5568;
}

.dark-theme .news-tag,
.dark-theme .share-button {
    background: #4A5568;
    color: #CBD5E0;
}

.dark-theme .search-box input:focus {
    border-color: #63B3ED;
    box-shadow: 0 0 0 3px rgba(99, 179, 237, 0.1);
}

/* Анимации */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.news-card {
    animation: fadeInUp 0.6s ease-out;
}

.news-card:nth-child(2) { animation-delay: 0.1s; }
.news-card:nth-child(3) { animation-delay: 0.2s; }
.news-card:nth-child(4) { animation-delay: 0.3s; }
.news-card:nth-child(5) { animation-delay: 0.4s; }
.news-card:nth-child(6) { animation-delay: 0.5s; }

/* Индикатор загрузки */
.news-loading {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 4rem;
}

.loading-spinner {
    width: 40px;
    height: 40px;
    border: 4px solid #F3F4F6;
    border-top: 4px solid #3B82F6;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
.account-avatar-account-avatar{
    width: 40px;
    height: 40px;
    box-shadow: 0px 0px 1px 1px #0077B5;
    border-radius: 50%;
}
</style>
<section class="news-page">
    <div class="news-hero">
        <div class="dc-container container">
            <div class="news-hero-content">
                <h1>Новости и Статьи</h1>
                <p>Будьте в курсе последних событий и тенденций в мире дизайна</p>
            </div>
        </div>
    </div>

    <div class="news-filters">
        <div class="dc-container container">
            <div class="filter-container">
                <div class="filter-categories">
                    <div class="filter-category {{ $category == 'all' ? 'active' : '' }}" 
                         onclick="window.location='{{ route('websiteNews', ['category' => 'all']) }}'">
                        Все новости
                    </div>
                    <div class="filter-category {{ $category == 'Дизайн' ? 'active' : '' }}" 
                         onclick="window.location='{{ route('websiteNews', ['category' => 'Дизайн']) }}'">
                        Дизайн
                    </div>
                    <div class="filter-category {{ $category == 'Разработка' ? 'active' : '' }}" 
                         onclick="window.location='{{ route('websiteNews', ['category' => 'Разработка']) }}'">
                        Разработка
                    </div>
                    <div class="filter-category {{ $category == 'Маркетинг' ? 'active' : '' }}" 
                         onclick="window.location='{{ route('websiteNews', ['category' => 'Маркетинг']) }}'">
                        Маркетинг
                    </div>
                    <div class="filter-category {{ $category == 'События' ? 'active' : '' }}" 
                         onclick="window.location='{{ route('websiteNews', ['category' => 'События']) }}'">
                        События
                    </div>
                </div>
            <form class="search-box" method="GET" action="{{ route('websiteNews') }}" id="searchForm">
                <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <input type="text" name="search" id="searchInput" placeholder="Поиск новостей..." value="{{ $search }}">
                <input type="hidden" name="category" value="{{ $category }}">
            </form>

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('searchInput');
                const searchForm = document.getElementById('searchForm');
                let searchTimeout;

                searchInput.addEventListener('input', function() {

                    clearTimeout(searchTimeout);
                    

                    searchTimeout = setTimeout(function() {
                        searchForm.submit();
                    }, 1000);
                });

                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        clearTimeout(searchTimeout);
                        searchForm.submit();
                    }
                });
            });
            </script>
            </div>
        </div>
    </div>

    <div class="container">
        @if(auth()->check() && in_array(auth()->user()->role, ['admin', 'moderator']))
        <div style="text-align: right; margin-top: 2rem;">
            <a href="{{ route('news.create') }}" class="news-read-more-news-read-more-news-read-more" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path d="M12 5V19M5 12H19" stroke="#0077B5" stroke-width="2" stroke-linecap="round"/>
                </svg>
                Добавить новость
            </a>
        </div>
        @endif
        
        <div class="news-grid">
            @php
                $newsItems = $news->items();
                $featuredItems = $news->where('is_featured', true);
                $regularItems = $news->where('is_featured', false);
            @endphp
            

            @foreach($featuredItems as $item)
                <article class="news-card featured">
                    <div class="news-image">
                        @if($item->image_path && Storage::disk('public')->exists($item->image_path))
                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}">
                        @else
                            <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #3B82F6, #1D4ED8); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                <span>Featured</span>
                            </div>
                        @endif
                        <div class="news-category">{{ $item->category }}</div>
                        <div class="news-date">{{ $item->published_at->format('d M Y') }}</div>
                    </div>
                    <div class="news-content">
                        <h3 class="news-title">{{ $item->title }}</h3>
                        <p class="news-excerpt">{{ $item->excerpt }}</p>
                        <div class="news-meta">
                            <div class="news-author">
                                <div class="account-avatar-account-avatar">
                                    @if($item->user && $item->user->avatar)
                                        <img src="{{ asset('storage/' . $item->user->avatar) }}" 
                                            alt="Аватар" 
                                            style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                    @else
                                        <img class="avatar" src="{{ asset('image/3/1.png') }}" alt="Аватар по умолчанию">
                                    @endif
                                </div>
                                <div class="author-info">
                                    <h4>{{ $item->user->name ?? ($item->author->name ?? 'Автор') }}</h4>
                                    <p>Автор</p>
                                </div>
                            </div>
                            <a href="{{ route('news.show', $item->slug) }}" class="news-read-more">Читать</a>
                        </div>
                        @if(auth()->check() && in_array(auth()->user()->role, ['admin', 'moderator']))
                        <div class="filter_blur" style="margin-top: 1rem; display: flex; gap: 0.5rem;">
                            <a href="{{ route('news.edit', $item->id) }}" class="news-read-more" style="background: #0076a5ff; padding: 0.5rem 1rem; font-size: 0.75rem;">
                                Редактировать
                            </a>
                            <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="news-read-more" style="background: #002d52ff; padding: 0.5rem 1rem; font-size: 0.75rem; border: none; cursor: pointer;" 
                                        onclick="return confirm('Удалить эту новость?')">
                                    Удалить
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </article>
            @endforeach
            
            @foreach($regularItems as $item)
                <article class="news-card">
                    <div class="news-image">
                        @if($item->image_path && Storage::disk('public')->exists($item->image_path))
                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}">
                        @else
                            <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #3B82F6, #1D4ED8); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                <span></span>
                            </div>
                        @endif
                        <div class="news-category">{{ $item->category }}</div>
                        <div class="news-date">{{ $item->published_at->format('d M Y') }}</div>
                    </div>
                    <div class="news-content">
                        <h3 class="news-title">{{ $item->title }}</h3>
                        <p class="news-excerpt">{{ $item->excerpt }}</p>
                        <div class="news-meta">
                            <div class="news-author">
                                <div class="account-avatar-account-avatar">
                                    @if($item->user && $item->user->avatar)
                                        <img src="{{ asset('storage/' . $item->user->avatar) }}" 
                                            alt="Аватар" 
                                            style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                    @else
                                        <img class="avatar" src="{{ asset('image/3/1.png') }}" alt="Аватар по умолчанию">
                                    @endif
                                </div>
                                <div class="author-info">
                                    <h4>{{ $item->user->name ?? ($item->author->name ?? 'Автор') }}</h4>
                                    <p>Автор</p>
                                </div>
                            </div>
                            <a href="{{ route('news.show', $item->slug) }}" class="news-read-more">Читать</a>
                        </div>
                        @if(auth()->check() && in_array(auth()->user()->role, ['admin', 'moderator']))
                        <div class="filter_blur" style="margin-top: 1rem; display: flex; gap: 0.5rem;">
                            <a href="{{ route('news.edit', $item->id) }}" class="news-read-more" style="background: #0076a5ff; padding: 0.5rem 1rem; font-size: 0.75rem;">
                                Редактировать
                            </a>
                            <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="news-read-more" style="background: #002d52ff; padding: 0.5rem 1rem; font-size: 0.75rem; border: none; cursor: pointer;" 
                                        onclick="return confirm('Удалить эту новость?')">
                                    Удалить
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </article>
            @endforeach
            
            @if($news->count() == 0)
                <div style="grid-column: 1 / -1; text-align: center; padding: 4rem;">
                    <h3 style="color: #6B7280; margin-bottom: 1rem;">Новости не найдены</h3>
                    <p style="color: #9CA3AF;">Попробуйте изменить параметры поиска или фильтрации</p>
                </div>
            @endif
        </div>

    </div>

</section>


@endsection