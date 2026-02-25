@extends('layouts.app')

@section('content')
<style>
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
    .news-create-container {
        padding: 40px 0 4rem 0;
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

    .dark-theme .news-create-form {
        background: #2D3748;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        border: 1px solid #4A5568;
    }

    .news-create-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1F2937;
        margin-bottom: 2rem;
        text-align: center;
    }

    .dark-theme .news-create-title {
        color: #F7FAFC;
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

    .dark-theme .form-label {
        color: #E2E8F0;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #E5E7EB;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
        color: #1F2937;
    }

    .dark-theme .form-control {
        background: #4A5568;
        border-color: #718096;
        color: #E2E8F0;
    }

    .form-control:focus {
        outline: none;
        border-color: #3B82F6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .dark-theme .form-control:focus {
        border-color: #63B3ED;
        box-shadow: 0 0 0 3px rgba(99, 179, 237, 0.1);
    }

    .form-textarea {
        min-height: 150px;
        resize: vertical;
    }

    .form-select {
        background: white;
    }

    .dark-theme .form-select {
        background: #4A5568;
        color: #E2E8F0;
    }

    .dark-theme .form-select option {
        background: #4A5568;
        color: #E2E8F0;
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

    .dark-theme .form-check-input {
        background: #4A5568;
        border-color: #718096;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #E5E7EB;
    }

    .dark-theme .form-actions {
        border-top-color: #4A5568;
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


    .dark-theme .btn-primary:hover {
        box-shadow: 0 4px 15px rgba(99, 179, 237, 0.4);
    }

    .btn-secondary {
        background: #6B7280;
        color: white;
    }

    .btn-secondary:hover {
        background: #4B5563;
    }

    .dark-theme .btn-secondary {
        background: #4A5568;
    }

    .dark-theme .btn-secondary:hover {
        background: #2D3748;
    }

    .file-upload {
        border: 2px dashed #D1D5DB;
        border-radius: 8px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .dark-theme .file-upload {
        border-color: #718096;
        background: #4A5568;
    }

    .file-upload:hover {
        border-color: #3B82F6;
    }

    .dark-theme .file-upload:hover {
        border-color: #63B3ED;
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

    .dark-theme .file-upload-label {
        color: #CBD5E0;
    }

    .file-upload-label svg {
        width: 48px;
        height: 48px;
        stroke: #9CA3AF;
    }

    .dark-theme .file-upload-label svg {
        stroke: #A0AEC0;
    }

    .image-preview {
        margin-top: 1rem;
    }

    .image-preview img {
        max-width: 200px;
        max-height: 200px;
        border-radius: 8px;
        border: 2px solid #E5E7EB;
    }

    .dark-theme .image-preview img {
        border-color: #4A5568;
    }

    .current-image {
        margin-top: 1rem;
    }

    .current-image p {
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        color: #6B7280;
    }

    .dark-theme .current-image p {
        color: #A0AEC0;
    }

    .current-image img {
        max-width: 300px;
        height: auto;
        border-radius: 8px;
        border: 2px solid #E5E7EB;
    }

    .dark-theme .current-image img {
        border-color: #4A5568;
    }

    .error-message {
        color: #EF4444;
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    .dark-theme .error-message {
        color: #FC8181;
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
<div class="container">
    <a href="{{ route('websiteNews') }}" class="back-btn">
        ← Вернуться к новостям
    </a>
</div>
<section class="news-create-container">
    <div class="container">
        <div class="news-create-form">
            <h1 class="news-create-title">Редактировать новость</h1>
            
            <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="title" class="form-label">Заголовок новости *</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $news->title) }}" required>
                    @error('title')
                        <div style="color: #EF4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="excerpt" class="form-label">Краткое описание *</label>
                    <textarea id="excerpt" name="excerpt" class="form-control form-textarea" required>{{ old('excerpt', $news->excerpt) }}</textarea>
                    @error('excerpt')
                        <div style="color: #EF4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content" class="form-label">Содержание новости *</label>
                    <textarea id="content" name="content" class="form-control form-textarea" rows="8" required>{{ old('content', $news->content) }}</textarea>
                    @error('content')
                        <div style="color: #EF4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category" class="form-label">Категория *</label>
                    <select id="category" name="category" class="form-control form-select" required>
                        <option value="">Выберите категорию</option>
                        <option value="Дизайн" {{ old('category', $news->category) == 'Дизайн' ? 'selected' : '' }}>Дизайн</option>
                        <option value="Разработка" {{ old('category', $news->category) == 'Разработка' ? 'selected' : '' }}>Разработка</option>
                        <option value="Маркетинг" {{ old('category', $news->category) == 'Маркетинг' ? 'selected' : '' }}>Маркетинг</option>
                        <option value="События" {{ old('category', $news->category) == 'События' ? 'selected' : '' }}>События</option>
                        <option value="Общее" {{ old('category', $news->category) == 'Общее' ? 'selected' : '' }}>Общее</option>
                    </select>
                    @error('category')
                        <div style="color: #EF4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Изображение</label>
                    
                    @if($news->image_path)
                    <div class="current-image">
                        <p style="margin-bottom: 0.5rem; font-size: 0.875rem; color: #6B7280;">Текущее изображение:</p>
                        <img src="{{ asset('storage/' . $news->image_path) }}" alt="Текущее изображение" 
                            style="max-width: 300px; height: auto; border-radius: 8px; border: 2px solid #E5E7EB;">
                    </div>
                    @endif

                    
                    <div class="file-upload" style="margin-top: 1rem;">
                        <label for="image" class="file-upload-label">
                            <span>Загрузить новое изображение</span>
                            <span style="font-size: 0.875rem; color: #9CA3AF;">Оставьте пустым, чтобы сохранить текущее</span>
                        </label>
                        <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                    </div>
                    <div class="image-preview" id="imagePreview" style="display: none;">
                        <p style="margin-bottom: 0.5rem; font-size: 0.875rem; color: #6B7280;">Новое изображение:</p>
                        <img id="preview" src="" alt="Предпросмотр">
                    </div>
                    @error('image')
                        <div style="color: #EF4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="published_at" class="form-label">Дата публикации</label>
                    <input type="datetime-local" id="published_at" name="published_at" class="form-control" 
                           value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') }}">
                    @error('published_at')
                        <div style="color: #EF4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1" class="form-check-input" 
                               {{ old('is_featured', $news->is_featured) ? 'checked' : '' }}>
                        <label for="is_featured" class="form-label" style="margin: 0;">Сделать главной новостью</label>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('websiteNews') }}" class="btn btn-secondary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Назад
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path d="M5 13l4 4L19 7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Обновить новость
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
</script>
@endsection