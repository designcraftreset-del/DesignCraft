@extends('layouts.app')

@section('content')
<style>
    .upload-container {
        max-width: 600px;
        margin: 2rem auto;
        padding: 2rem;
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .upload-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .upload-header h1 {
        color: #1e3a8a;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .upload-header p {
        color: #64748b;
        font-size: 1rem;
    }

    .upload-form {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .form-group label {
        color: #374151;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .form-input {
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-select {
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 1rem;
        background: white;
        cursor: pointer;
    }

    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }

    .file-upload {
        position: relative;
        display: inline-block;
    }

    .file-upload-input {
        position: absolute;
        left: -9999px;
    }

    .file-upload-label {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        border: 2px dashed #d1d5db;
        border-radius: 10px;
        background: #f8fafc;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }

    .file-upload-label:hover {
        border-color: #3b82f6;
        background: #f0f7ff;
    }

    .file-upload-label.dragover {
        border-color: #3b82f6;
        background: #e0f2fe;
    }

    .file-info {
        margin-top: 0.5rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .preview-container {
        margin-top: 1rem;
        text-align: center;
    }

    .preview-image {
        max-width: 100%;
        max-height: 300px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .submit-btn {
        background: linear-gradient(135deg, #1D4ED8 0%, #3B82F6 100%);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 1rem;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
    }

    .submit-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
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
</style>
<div class="container">
    <a href="{{ route('portfolio') }}" class="back-btn">
        ← Вернуться в портфолио
    </a>
</div>
<div class="upload-container">

    <div class="upload-header">
        <h1>Загрузить баннер</h1>
        <p>Поделитесь своей работой с сообществом</p>
    </div>

    <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data" class="upload-form">
        @csrf
        
        <div class="form-group">
            <label for="title">Название баннера</label>
            <input type="text" id="title" name="title" class="form-input" required 
                   placeholder="Введите название баннера" value="{{ old('title') }}">
        </div>

        <div class="form-group">
            <label for="subtitle">Подзаголовок</label>
            <input type="text" id="subtitle" name="subtitle" class="form-input" required 
                   placeholder="Краткое описание" value="{{ old('subtitle') }}">
        </div>

        <div class="form-group">
            <label for="description">Описание</label>
            <textarea id="description" name="description" class="form-input form-textarea" required 
                      placeholder="Подробное описание баннера...">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="category">Категория</label>
            <select id="category" name="category" class="form-select" required>
                <option value="">Выберите категорию</option>
                <option value="stream" {{ old('category') == 'stream' ? 'selected' : '' }}>Баннер для стрима</option>
                <option value="game" {{ old('category') == 'game' ? 'selected' : '' }}>Игровой баннер</option>
                <option value="holiday" {{ old('category') == 'holiday' ? 'selected' : '' }}>Яркое превью</option>
                <option value="esports" {{ old('category') == 'esports' ? 'selected' : '' }}>Киберспорт</option>
                <option value="travel" {{ old('category') == 'travel' ? 'selected' : '' }}>Туристический баннер</option>
                <option value="art" {{ old('category') == 'art' ? 'selected' : '' }}>Арт</option>
                <option value="commercial" {{ old('category') == 'commercial' ? 'selected' : '' }}>Коммерческий баннер</option>
                <option value="auto" {{ old('category') == 'auto' ? 'selected' : '' }}>Автомобильный баннер</option>
            </select>
        </div>

        <div class="form-group">
            <label>Изображение баннера</label>
            <div class="file-upload">
                <input type="file" id="image" name="image" class="file-upload-input" accept="image/*" required>
                <label for="image" class="file-upload-label" id="fileUploadLabel">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 8px;">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="17 8 12 3 7 8"></polyline>
                            <line x1="12" y1="3" x2="12" y2="15"></line>
                        </svg>
                        <div>Нажмите для загрузки изображения</div>
                        <div style="font-size: 0.8rem; margin-top: 4px; color: #6b7280;">
                            PNG, JPG, GIF до 2MB
                        </div>
                    </div>
                </label>
            </div>
            <div class="file-info" id="fileInfo"></div>
        </div>

        <div class="preview-container" id="previewContainer" style="display: none;">
            <img id="previewImage" class="preview-image" src="" alt="Предпросмотр">
        </div>

        <button type="submit" class="submit-btn" id="submitBtn">
            Загрузить баннер
        </button>


    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('image');
    const fileUploadLabel = document.getElementById('fileUploadLabel');
    const fileInfo = document.getElementById('fileInfo');
    const previewContainer = document.getElementById('previewContainer');
    const previewImage = document.getElementById('previewImage');
    const submitBtn = document.getElementById('submitBtn');

    // Drag and drop
    fileUploadLabel.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('dragover');
    });

    fileUploadLabel.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');
    });

    fileUploadLabel.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');
        if (e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            handleFileSelect();
        }
    });

    fileInput.addEventListener('change', handleFileSelect);

    function handleFileSelect() {
        const file = fileInput.files[0];
        if (file) {
            // Проверка размера файла
            // if (file.size > 10 * 1024 * 1024) {
            //     alert('Файл слишком большой. Максимальный размер: 10MB');
            //     fileInput.value = '';
            //     return;
            // }

            // Показ информации о файле
            fileInfo.textContent = `Выбран файл: ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;

            // Превью изображения
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }

    // Валидация формы
    document.querySelector('form').addEventListener('submit', function(e) {
        const file = fileInput.files[0];
        if (!file) {
            e.preventDefault();
            alert('Пожалуйста, выберите изображение');
            return;
        }

        submitBtn.disabled = true;
        submitBtn.textContent = 'Загрузка...';
    });
});
</script>
@endsection