@extends('layouts.app')

@section('content')

<style>
    .btn-primary svg{
        fill: white !important;
    }
    .dark-theme .news-create-container {
        background: #111827;
    }

    .dark-theme .news-create-form {
        background: #1f2937;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        border: 1px solid #374151;
    }

    .dark-theme .news-create-title {
        color: #f9fafb;
    }

    .dark-theme .form-label {
        color: #e5e7eb;
    }

    .dark-theme .form-control {
        background: #374151;
        border-color: #4b5563;
        color: #f9fafb;
    }

    .dark-theme .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        background: #374151;
    }

    .dark-theme .form-control::placeholder {
        color: #9ca3af;
    }

    .dark-theme .form-select {
        background: #374151 url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%239ca3af'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E") no-repeat right 16px center;
        background-size: 16px;
        color: #f9fafb;
    }

    .dark-theme .form-textarea {
        background: #374151;
        color: #f9fafb;
    }

    .dark-theme .file-upload {
        border-color: #4b5563;
        background: #374151;
    }

    .dark-theme .file-upload:hover {
        border-color: #3b82f6;
        background: #4b5563;
    }

    .dark-theme .file-upload-label {
        color: #d1d5db;
        background-color: #3741510c;
    }

    .dark-theme .file-upload-label svg {
        stroke: #9ca3af;
    }

    .dark-theme .file-upload-label span:last-child {
        color: #6b7280;
    }

    .dark-theme .image-preview {
        border: 1px solid #4b5563;
        background: #374151;
    }

    .dark-theme .image-preview img {
        border: 1px solid #4b5563;
    }

    .dark-theme .form-actions {
        border-top-color: #374151;
    }

    .dark-theme .btn-secondary {
        background: #4b5563;
        color: #f9fafb;
    }

    .dark-theme .btn-secondary:hover {
        background: #6b7280;
    }

    .dark-theme .form-check-input {
        background: #374151;
        border-color: #6b7280;
    }

    .dark-theme .form-check-input:checked {
        background-color: #3b82f6;
        border-color: #3b82f6;
    }

    .dark-theme .form-check-input:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
    }

    /* Стили для ошибок в темной теме */
    .dark-theme [style*="color: #7195f8ff"] {
        color: #f87171 !important;
    }

    .dark-theme .form-control:invalid {
        border-color: #7195f8ff;
    }

    .dark-theme .form-control:invalid:focus {
        border-color: #7195f8ff;
        box-shadow: 0 0 0 3px rgba(248, 113, 113, 0.2);
    }

    /* Кастомизация datetime-local в темной теме */
    .dark-theme input[type="datetime-local"] {
        color-scheme: dark;
    }

    .dark-theme input[type="datetime-local"]::-webkit-calendar-picker-indicator {
        filter: invert(1);
        opacity: 0.7;
    }

    .dark-theme input[type="datetime-local"]::-webkit-calendar-picker-indicator:hover {
        opacity: 1;
    }

    /* Стили для состояний полей */
    .dark-theme .form-control:disabled {
        background: #4b5563;
        color: #9ca3af;
        border-color: #6b7280;
    }

    .dark-theme .form-control:read-only {
        background: #374151;
        color: #d1d5db;
    }

    /* Анимации для темной темы */
    .dark-theme .form-control {
        transition: all 0.3s ease;
    }

    .dark-theme .file-upload {
        transition: all 0.3s ease;
    }

    /* Стили для подсказок и вспомогательного текста */
    .dark-theme .form-text {
        color: #9ca3af;
        font-size: 0.875rem;
    }

    .dark-theme .form-helper {
        color: #6b7280;
        font-size: 0.75rem;
    }

    /* Стили для счетчика символов */
    .dark-theme .char-counter {
        color: #9ca3af;
        font-size: 0.75rem;
        text-align: right;
        margin-top: 0.25rem;
    }

    .dark-theme .char-counter.warning {
        color: #fbbf24;
    }

    .dark-theme .char-counter.error {
        color: #f87171;
    }

    /* Адаптивность для темной темы */
    @media (max-width: 768px) {
        .dark-theme .news-create-form {
            border: 1px solid #374151;
            margin: 0.5rem;
        }
        
        .dark-theme .form-control {
            font-size: 16px; /* Предотвращает zoom на iOS */
        }
    }

    /* Дополнительные улучшения для UX в темной теме */
    .dark-theme .form-group:focus-within .form-label {
        color: #3b82f6;
    }

    .dark-theme .file-upload.dragover {
        border-color: #3b82f6;
        background: #4b5563;
    }

    /* Стили для успешной валидации */
    .dark-theme .form-control:valid {
        border-color: #10b981;
    }

    .dark-theme .form-control:valid:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
    }
</style>

<style>
    .news-create-container {
        padding: 120px 0 4rem 0;
        min-height: 100vh;
    }

    .news-create-form {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        padding: 2rem;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .news-create-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1F2937;
        margin-bottom: 2rem;
        text-align: center;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #374151;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #E5E7EB;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #3B82F6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-textarea {
        min-height: 150px;
        resize: vertical;
    }

    .form-select {
        background: white;
    }

    .form-check {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-check-input {
        width: 18px;
        height: 18px;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #E5E7EB;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, #3B82F6, #1D4ED8);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
    }

    .btn-secondary {
        background: #6B7280;
        color: white;
    }

    .btn-secondary:hover {
        background: #4B5563;
    }

    .file-upload {
        border: 2px dashed #D1D5DB;
        border-radius: 8px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .file-upload:hover {
        border-color: #3B82F6;
    }

    .file-upload input {
        display: none;
    }

    .file-upload-label {
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        color: #6B7280;
    }

    .file-upload-label svg {
        width: 48px;
        height: 48px;
        stroke: #9CA3AF;
    }

    .image-preview {
        margin-top: 1rem;
        display: none;
    }

    .image-preview img {
        max-width: 200px;
        max-height: 200px;
        border-radius: 8px;
    }

    @media (max-width: 768px) {
        .news-create-form {
            margin: 1rem;
            padding: 1.5rem;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<section class="news-create-container">
    <div class="container">
        <div class="news-create-form">
            <h1 class="news-create-title">Создать новость</h1>
            
            <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="title" class="form-label">Заголовок новости *</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
                    @error('title')
                        <div style="color: #EF4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="excerpt" class="form-label">Краткое описание *</label>
                    <textarea id="excerpt" name="excerpt" class="form-control form-textarea" required>{{ old('excerpt') }}</textarea>
                    @error('excerpt')
                        <div style="color: #EF4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content" class="form-label">Содержание новости *</label>
                    <textarea id="content" name="content" class="form-control form-textarea" rows="8" required>{{ old('content') }}</textarea>
                    @error('content')
                        <div style="color: #EF4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category" class="form-label">Категория *</label>
                    <select id="category" name="category" class="form-control form-select" required>
                        <option value="">Выберите категорию</option>
                        <option value="Дизайн" {{ old('category') == 'Дизайн' ? 'selected' : '' }}>Дизайн</option>
                        <option value="Разработка" {{ old('category') == 'Разработка' ? 'selected' : '' }}>Разработка</option>
                        <option value="Маркетинг" {{ old('category') == 'Маркетинг' ? 'selected' : '' }}>Маркетинг</option>
                        <option value="События" {{ old('category') == 'События' ? 'selected' : '' }}>События</option>
                        <option value="Общее" {{ old('category') == 'Общее' ? 'selected' : '' }}>Общее</option>
                    </select>
                    @error('category')
                        <div style="color: #EF4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Изображение</label>
                    <div class="file-upload">
                        <label for="image" class="file-upload-label">
                            <span>Нажмите для загрузки изображения</span>
                            <span style="font-size: 0.875rem; color: #9CA3AF;">Рекомендуемый размер: 800x400px</span>
                        </label>
                        <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                    </div>
                    <div class="image-preview" id="imagePreview">
                        <img id="preview" src="" alt="Предпросмотр">
                    </div>
                    @error('image')
                        <div style="color: #EF4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="published_at" class="form-label">Дата публикации</label>
                    <input type="datetime-local" id="published_at" name="published_at" class="form-control" value="{{ old('published_at') }}">
                    @error('published_at')
                        <div style="color: #EF4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1" class="form-check-input" {{ old('is_featured') ? 'checked' : '' }}>
                        <label for="is_featured" class="form-label" style="margin: 0;">Сделать главной новостью</label>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('websiteNews') }}" class="btn btn-secondary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path style="stroke: white;" d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Назад
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" style="color: #f9fafb;">
                            <path style="stroke: white;" d="M5 12H19M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Создать новость
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('imagePreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        previewContainer.style.display = 'none';
    }
}

// Устанавливаем минимальную дату для поля даты публикации
document.addEventListener('DOMContentLoaded', function() {
    const now = new Date();
    const localDateTime = now.toISOString().slice(0, 16);
    const publishedAtField = document.getElementById('published_at');
    if (publishedAtField) {
        publishedAtField.min = localDateTime;
    }
});
</script>
@endsection