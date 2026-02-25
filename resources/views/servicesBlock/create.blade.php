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
    <a href="{{ route('services') }}" class="back-btn">
        ← Вернуться к услугам
    </a>
</div>
<div class="upload-container">

    <div class="upload-header">
        <h1>Загрузить услугу</h1>
        <p>Создайте новую услугу</p>
    </div>

    <form action="{{ route('servicesBlockPost') }}" method="POST" enctype="multipart/form-data" class="upload-form">
        @csrf
        
        <div class="form-group">
            <label for="title">Заголовок над услугой</label>
            <input type="text" id="title" name="title" class="form-input" required 
                   placeholder="Введите заголовок" value="{{ old('title') }}">
        </div>

        <div class="form-group">
            <label for="category">Выберите услугу</label>
            <select id="category" name="category" class="form-select" required>
                <option value="">Выберите услугу</option>
                <option value="stream" {{ old('category') == 'preview' ? 'selected' : '' }}>Превью</option>
                <option value="ava" {{ old('category') == 'ava' ? 'selected' : '' }}>Аватарка</option>
                <option value="banner" {{ old('category') == 'banner' ? 'selected' : '' }}>Баннер</option>
                <option value="video" {{ old('category') == 'video' ? 'selected' : '' }}>Видео/Анимация</option>
                <option value="logo" {{ old('category') == 'logo' ? 'selected' : '' }}>Логотип</option>
            </select>
        </div>

        <div class="form-group">
            <label for="titleTwo">Заголовок услуги</label>
            <input type="text" id="titleTwo" name="titleTwo" class="form-input" required 
                   placeholder="Введите заголовок" value="{{ old('titleTwo') }}">
        </div>

        <div class="form-group">
            <label for="subtitle">Подзаголовок</label>
            <input type="text" id="subtitle" name="subtitle" class="form-input" required 
                   placeholder="Краткое описание" value="{{ old('subtitle') }}">
        </div>

        <div class="form-group">
            <label for="money">Цена</label>
            <input type="string" id="money" name="money" class="form-input" required
                   placeholder="Введите цену" value="{{ old('money') }}">
        </div>

        <div class="form-group">
            <label for="">Колл-во концепций</label>
            <input type="string" id="concept" name="concept" class="form-input" required 
                   placeholder="Введите колличество концепций" value="{{ old('concept') }}">
        </div>

        <div class="form-group">
            <label for="">Колл-во правок</label>
            <input type="string" id="edits" name="edits" class="form-input" required 
                   placeholder="Введите колличество правок" value="{{ old('edits') }}">
        </div>

        <div class="form-group">
            <label for="">Формат исходника</label>
            <input type="text" id="formatTwo" name="formatTwo" class="form-input" required 
                   placeholder="Введите колличество правок" value="{{ old('formatTwo') }}">
        </div>

        <div class="form-group">
            <label for="">Сроки</label>
            <input type="text" id="term" name="term" class="form-input" required 
                   placeholder="Введите колличество правок" value="{{ old('term') }}">
        </div>


        <button type="submit" class="submit-btn" id="submitBtn">
            Загрузить услугу
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