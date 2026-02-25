@extends('layouts.app')

@section('skeleton')
    @include('skeletons.article')
@endsection
@section('content')
<style>
@media (max-width: 1280px) {
    .news-single-image-news-single-image{
        display: flex !important;
        flex-direction: column;
    }
    .news-single-content{
    max-width: 100% !important;
    margin: 0 !important;
    font-size: 1.125rem;
    line-height: 1.7;
    color: #374151;
    }
    .news-single-footer{
        max-width: 100% !important;
    }
}
.filter_blur{
    display: flex;
    align-items: center;
    gap: 20px;
    padding-top: 10px;
    filter: blur(2px);
    transition: 0.3s;
    opacity: 30%;
}
.filter_blur:hover{
    filter: blur(0px);
    opacity: 100%;
}
.related-news {
    margin-top: 4rem;
    padding-top: 3rem;
    border-top: 1px solid #E5E7EB;
}

.related-news h3 {
    font-size: 2rem;
    font-weight: 700;
    color: #1F2937;
    margin-bottom: 2rem;
    text-align: center;
}

.related-news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
}

.related-news-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    position: relative;
}

.related-news-image {
    position: relative;
    overflow: hidden;
    height: 200px;
}

.related-news-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.related-news-card:hover .related-news-image img {
    transform: scale(1.05);
}

.related-news-category {
    position: absolute;
    top: 1rem;
    left: 1rem;
    background: linear-gradient(135deg, #3B82F6, #1D4ED8);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.related-news-date {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: rgba(255, 255, 255, 0.95);
    color: #374151;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 500;
}

.related-news-content {
    padding: 1.5rem;
}

.related-news-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1F2937;
    margin-bottom: 1rem;
    line-height: 1.3;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.related-news-excerpt {
    color: #6B7280;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    font-size: 0.875rem;
}

.related-news-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
    padding-top: 1rem;
    border-top: 1px solid #F3F4F6;
}

.related-news-author {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.related-author-avatar {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    overflow: hidden;
    border: 2px solid #F3F4F6;
}

.related-author-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.related-author-info h4 {
    font-size: 0.75rem;
    font-weight: 600;
    color: #374151;
    margin: 0;
}

.related-author-info p {
    font-size: 0.625rem;
    color: #9CA3AF;
    margin: 0;
}

.related-news-read-more {
    background: linear-gradient(135deg, #3B82F6, #1D4ED8);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.75rem;
    transition: all 0.3s ease;
    text-decoration: none !important;
}

.related-news-actions {
    margin-top: 1rem;
    display: flex;
    gap: 0.5rem;
    opacity: 0.7;
    transition: opacity 0.3s ease;
}

.related-news-card:hover .related-news-actions {
    opacity: 1;
}

.related-edit-btn {
    background: #0076a5;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.related-edit-btn:hover {
    background: #005a7a;
}

.related-delete-btn {
    background: #002e72ff;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.related-delete-btn:hover {
    background: #00192eff;
}

.related-news-empty {
    text-align: center;
    padding: 3rem 2rem;
    color: #9CA3AF;
    background: #F9FAFB;
    border-radius: 12px;
    border: 2px dashed #E5E7EB;
}

/* Темная тема для похожих новостей */
.dark-theme .related-news {
    border-top-color: #4A5568;
}

.dark-theme .related-news h3 {
    color: #F7FAFC;
}

.dark-theme .related-news-card {
    background: #2D3748;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

.dark-theme .related-news-title {
    color: #F7FAFC;
}

.dark-theme .related-news-excerpt {
    color: #CBD5E0;
}

.dark-theme .related-news-date {
    background: #4A5568;
    color: #E2E8F0;
}

.dark-theme .related-news-meta {
    border-top-color: #4A5568;
}

.dark-theme .related-author-info h4 {
    color: #E2E8F0;
}

.dark-theme .related-news-empty {
    background: #4A5568;
    border-color: #718096;
    color: #CBD5E0;
}

/* Адаптивность */
@media (max-width: 768px) {
    .related-news-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .related-news h3 {
        font-size: 1.5rem;
    }
    
    .related-news-content {
        padding: 1rem;
    }
    
    .related-news-title {
        font-size: 1.125rem;
    }
    
    .related-news-meta {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .related-news-actions {
        width: 100%;
        justify-content: center;
    }
}
    .back-btn {
        display: inline-block;
        margin-top: 1rem;
        color: #64748b;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .back-btn:hover {
        color: #374151;
    }
    .news-single-content-block{
        display: flex;
        flex-direction: column;
    }
    /* Стили для страницы отдельной новости */
    .news-single {
        padding: 20px 0 4rem 0;
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
        height: 400px;
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
        margin-top: 2rem;
        padding-top: 1rem;
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

    @media (max-width: 768px) {
        .news-single-title {
            font-size: 2rem;
        }
        
        .news-single-image {
            height: 300px;
        }
        
        .news-single-meta {
            flex-direction: column;
            gap: 1rem;
        }
    }
</style>
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
    /* Стили для страницы новостей */
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

/* Сетка новостей */
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
.account-avatar{
    width: 50px !important;
    height: 50px !important;
}
</style>


<div class="container">
    <a href="{{ url()->previous() }}" class="back-btn">
        ← Вернуться назад
    </a>
</div>
<section class="news-single">
    <div class="container">
        <article>
            <div class="news-single-header">
                <h1 class="news-single-title">{{ $news->title }}</h1>
                <div class="news-single-meta">
                    <div class="news-single-date">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path d="M8 7V3M16 7V3M7 11H17M5 21H19C20.1046 21 21 20.1046 21 19V7C21 5.89543 20.1046 5 19 5H5C3.89543 5 3 5.89543 3 7V19C3 20.1046 3.89543 21 5 21Z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        {{ $news->published_at->format('d M Y') }}
                    </div>
                    <div class="news-single-category">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path d="M21 16V8.00002C20.9996 7.6493 20.9071 7.30483 20.7315 7.00119C20.556 6.69754 20.3037 6.44539 20 6.27002L13 2.27002C12.696 2.09449 12.3511 2.00208 12 2.00208C11.6489 2.00208 11.304 2.09449 11 2.27002L4 6.27002C3.69626 6.44539 3.44398 6.69754 3.26846 7.00119C3.09294 7.30483 3.00036 7.6493 3 8.00002V16C3.00036 16.3508 3.09294 16.6952 3.26846 16.9989C3.44398 17.3025 3.69626 17.5547 4 17.73L11 21.73C11.304 21.9056 11.6489 21.998 12 21.998C12.3511 21.998 12.696 21.9056 13 21.73L20 17.73C20.3037 17.5547 20.556 17.3025 20.7315 16.9989C20.9071 16.6952 20.9996 16.3508 21 16Z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        {{ $news->category }}
                    </div>
                    <div class="news-single-views">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        {{ $news->views_count }} просмотров
                    </div>
                </div>
            </div>
            <style>
                .news-single-image-news-single-image{
                    display: grid;
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                    gap: 20px;
                }
            </style>
            <div class="news-single-image-news-single-image">
                @if($news->image_path)
                <div class="news-single-image">
                    <img src="{{ asset('storage/' . $news->image_path) }}" alt="{{ $news->title }}">
                </div>
                @endif
                <div class="news-single-content-block">
                    <div class="news-single-content">
                        {!! nl2br(e($news->content)) !!}
                    </div>
                    <div class="news-single-footer">
                        <div class="news-author" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem;">
                            <div class="account-avatar">
                                @if($news->user && $news->user->avatar)
                                    <img src="{{ asset('storage/' . $news->user->avatar) }}" 
                                        alt="Аватар" 
                                        style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                @else
                                    <img class="avatar" src="{{ asset('image/3/1.png') }}" alt="">
                                    <style>
                                        .avatar{
                                            padding: 20px;
                                        }
                                    </style>
                                @endif
                            </div>
                            <div class="author-info">
                                <h4 style="font-size: 1.125rem; margin-bottom: 0.25rem;">{{ $news->author->name ?? 'Автор' }}</h4>
                                <p style="color: #6B7280;">Автор статьи</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </article>
    </div>
</section>
<div class="container" style="margin-bottom: 3rem">
    @if($relatedNews->count())
    <section class="related-news">
        <h3>Похожие новости</h3>
        <div class="related-news-grid">
            @foreach($relatedNews as $related)
                <article class="related-news-card">
                    <div class="related-news-image">
                        @if($related->image_path && Storage::disk('public')->exists($related->image_path))
                            <img src="{{ asset('storage/' . $related->image_path) }}" alt="{{ $related->title }}">
                        @else
                            <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #3B82F6, #1D4ED8); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                <span></span>
                            </div>
                        @endif
                        <div class="related-news-category">{{ $related->category }}</div>
                        <div class="related-news-date">{{ $related->published_at->format('d M Y') }}</div>
                    </div>
                    <div class="related-news-content">
                        <h3 class="related-news-title">{{ $related->title }}</h3>
                        <p class="related-news-excerpt">{{ $related->excerpt }}</p>
                        <div class="related-news-meta">
                            <div class="related-news-author">
                                <div class="related-author-avatar">
                                    @if($related->user && $related->user->avatar)
                                        <img src="{{ asset('storage/' . $related->user->avatar) }}" 
                                            alt="Аватар" 
                                            style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                    @else
                                        <img class="avatar" src="{{ asset('image/3/1.png') }}" alt="Аватар по умолчанию">
                                    @endif
                                </div>
                                <div class="related-author-info">
                                    <h4>{{ $related->user->name ?? ($related->author->name ?? 'Автор') }}</h4>
                                    <p>Автор</p>
                                </div>
                            </div>
                            <a href="{{ route('news.show', $related->slug) }}" class="related-news-read-more">Читать</a>
                        </div>
                        @if(auth()->check() && in_array(auth()->user()->role, ['admin', 'moderator']))
                        <div class="filter_blur">
                            <a href="{{ route('news.edit', $related->id) }}" class="related-edit-btn">
                                Редактировать
                            </a>
                            <form action="{{ route('news.destroy', $related->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="related-delete-btn" 
                                        onclick="return confirm('Удалить эту новость?')">
                                    Удалить
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@else
    <div class="related-news-empty">
        <p>Нет похожих новостей</p>
    </div>
@endif
</div>
@endsection