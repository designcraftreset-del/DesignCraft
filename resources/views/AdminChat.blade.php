@extends('layouts.app')

@section('content')
<style>
    .preview-container {
        display: inline-block;
        margin-top: 15px;
        padding: 10px;
        border-radius: 12px;
        text-align: center;
    }
    .preview-container {
        position: absolute;
        top: -220px;
        left: 700px;
        display: inline-block;
    }
    .chat-image-preview {
        max-width: 100%;
        max-height: 200px;
        border-radius: 8px;
        display: block;
        margin: 0 auto;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .image-remove-btn {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #ef4444;
        color: white;
        border: none;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
        z-index: 10;
    }

    .image-remove-btn:hover {
        background: #dc2626;
        transform: scale(1.1);
    }

    /* Дополнительные стили для лучшего отображения */
    .preview-container.show {
        display: block !important;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
<style>
    @media (max-width: 1380px) {
        .chat-input-form{
            width: 1200px !important;
        }
    }
    @media (max-width: 1250px) {
        .chat-input-form{
            width: 1150px !important;
        }
    }
    @media (max-width: 1200px) {
        .chat-input-form{
            width: 1100px !important;
        }
    }
    @media (max-width: 1150px) {
        .chat-input-form{
            width: 1050px !important;
        }
    }
    @media (max-width: 1100px) {
        .chat-input-form{
            width: 1000px !important;
        }
    }
    @media (max-width: 1050px) {
        .chat-input-form{
            width: 950px !important;
        }
    }
    @media (max-width: 1000px) {
        .chat-input-form{
            width: 900px !important;
        }
    }
    @media (max-width: 950px) {
        .chat-input-form{
            width: 850px !important;
        }
    }
    @media (max-width: 900px) {
        .chat-input-form{
            width: 800px !important;
        }
    }
    @media (max-width: 850px) {
        .chat-input-form{
            width: 400px !important;
        }
    }
    @media (max-width: 450px) {
        .chat-input-form{
            width: 300px !important;
        }
    }
    .file-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .file-input {
        display: none;
    }

    .file-input-label {
        background: #1f2937;
        border: 2px solid #e5e7eb;
        border-radius: 50%;
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .file-input-label:hover {
        border-color: #ffffff60;
    }

    .chat-image-container {
        margin-top: 0.5rem;
        max-width: 100%;
    }

    .chat-image {
        max-width: 100%;
        max-height: 300px;
        border-radius: 12px;
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .chat-image:hover {
        transform: scale(1.02);
    }

    .image-remove-btn {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #ef4444;
        color: white;
        border: none;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        font-size: 12px;
        cursor: pointer;
        display: none;
    }

    .preview-container {
        display: inline-block;
    }

    .message-with-image {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    .admin-chat-container {
        background: #f8fafc;
    }

    .chat-wrapper {
        max-width: 80rem;
        margin: 0 auto;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        height: 94vh;
        display: flex;
        flex-direction: column;
    }

    .chat-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: white;
        padding: 1rem;
        text-align: center;
    }

    .chat-header h1 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 700;
    }

    .chat-header .online-users {
        margin-top: 0.5rem;
        font-size: 0.875rem;
        opacity: 0.9;
    }

    .messages-container {
        flex: 1;
        overflow-y: auto;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .message {
        display: flex;
        gap: 0.75rem;
        max-width: 80%;
    }

    .message.own {
        align-self: flex-end;
        flex-direction: row-reverse;
    }

    .message.other {
        align-self: flex-start;
    }

    .message-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: #374151;
        flex-shrink: 0;
    }

    .message-avatar img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }

    .message-content {
        background: #f3f4f6;
        padding: 0.75rem 1rem;
        border-radius: 16px;
        position: relative;
    }

    .message.own .message-content {
        max-width: 1180px;
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
    }

    .message-info {
        display: flex;
        flex-direction: row-reverse;
        align-items: center;
        gap: 20px;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.50rem;
    }

    .message-sender {
        font-weight: 600;
        font-size: 0.875rem;
        line-height: 16px;
    }

    .message-time {
        font-size: 0.75rem;
        opacity: 0.7;
    }

    .message-text {
        word-wrap: break-word;
        line-height: 1.4;
    }

    .system-message {
        align-self: center;
        text-align: center;
        background: #fef3c7;
        color: #92400e;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        max-width: 60%;
    }

    .chat-input-container {
        padding: 1rem;
        position: relative;
        /* border-top: 1px solid #e5e7eb; */
    }

    .chat-input-form {
        display: flex;
        gap: 0.75rem;
        flex-direction: row;
        align-items: center;
    }

    .message-input {
        flex: 1;
        padding: 0.75rem 1rem;
        border-radius: 24px;
        resize: none;
        font-size: 1rem;
        line-height: 1.4;
        max-height: 120px;
        width: 100%;
        background-color: #ffffff02 !important;
        transition: border-color 0.3s ease;
        position: relative;
        overflow: hidden;
        color: white !important;
        height: 50px;
        top: 3px;
    }
    .message-input::placeholder {
        color: #001930ff !important;
    }
    .message-input-div{
        flex: 1;
        resize: none;
        max-height: 120px;
        position: relative;
        overflow: hidden;
    }
    .message-input-div:before{
        position: absolute;
        inset: 0;
        content: "";
        z-index: -1;
        width: 100%;
        border-radius: 24px;
        backdrop-filter: blur(5px);
        box-shadow: 0px 0px 0px 0px inset black;
        background-color: #ffffff63 !important;
    }

    .message-input:focus {
        outline: none;
        border-color: #3b82f6;
    }
    textarea{
        border: 0px solid #cccccc07 !important;
    }
    .send-button {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
        border: none;
        border-radius: 50%;
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        flex-shrink: 0;
        transition: 0.5s ease-in;

    }
    .send-button svg{
        transition: 1s ease-in;
    }
    .send-button:hover svg{
        animation: services 3s cubic-bezier(0, 1.83, 0.79, 1.61) infinite;
        transition: 1s ease-in;
    }
    @keyframes services{
        0%{
            transform: rotate3d(0, 0, 0, 0deg) translate3d(0px, 0px, 0px);
        }
        30%{
            transform: rotate3d(0, 0, 0, 0deg) translate3d(0px, 0px, 0px);
        }
        80%{
            transform: rotate3d(50, 0, 0, 40deg) translate3d(10px, 0px, 20px);
        }

        61%{transform: rotate3d(0, 0, 0, 0deg) translate3d(-20px, 10px, 0px);}
        100%{
            transform: rotate3d(0, 0, 0, 0deg) translate3d(0px, 0px, 0px);
        }
    }





    .send-button:hover {
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .send-button:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
    }

    .typing-indicator {
        padding: 0.5rem 1rem;
        font-style: italic;
        color: #6b7280;
        font-size: 0.875rem;
    }

    .empty-chat {
        text-align: center;
        color: #6b7280;
        padding: 2rem;
    }

    /* Темная тема */
    .dark-theme .admin-chat-container {
        background: #111827;
    }

    .dark-theme .chat-wrapper {
        background: #1f2937;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .dark-theme .message-content {
        background: #374151;
        color: #f9fafb;
    }

    .dark-theme .message-avatar {
        background: #4b5563;
        color: #e5e7eb;
    }

    .dark-theme .chat-input-container {
        /* border-top-color: #374151; */
    }

    .dark-theme .message-input {
        background: #374151;
        color: #f9fafb;
    }

    .dark-theme .message-input:focus {
        border-color: #3b82f6;
    }

    .dark-theme .system-message {
        background: #78350f;
        color: #fbbf24;
    }

    .message {
        animation: messageSlideIn 0.3s ease;
    }

    .messages-container::-webkit-scrollbar {
        width: 6px;
    }

    .messages-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .messages-container::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }

    .messages-container::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }

    .dark-theme .messages-container::-webkit-scrollbar-track {
        background: #374151;
    }

    .dark-theme .messages-container::-webkit-scrollbar-thumb {
        background: #6b7280;
    }

    .dark-theme .messages-container::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
</style>

<div class="admin-chat-container">
    <div class="chat-wrapper">
        <div class="chat-header">
            <h1>Админ Чат</h1>
            <div class="online-users" id="onlineUsers">
            </div>
        </div>

        <div class="messages-container" id="messagesContainer">
            <style>
                .messages-container{
                    position: relative;
                }
                .chat-input-container {
                    position: fixed;
                    bottom: 0;
                    width: 1280px;
                    margin-left: -1rem;
                }
            </style>


                <style>
                    .messages-container > div:last-of-type {
                        margin-bottom: 100px !important;
                    }
                </style>
            <style>
                .message-delete-btn {
                    background: none;
                    border: none;
                    color: #6b7280;
                    cursor: pointer;
                    padding: 4px;
                    border-radius: 4px;
                    transition: all 0.3s ease;
                    opacity: 0;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    width: 24px;
                    height: 24px;
                }

                .message:hover .message-delete-btn {
                    opacity: 1;
                }

                .message-delete-btn:hover {
                    color: #ef4444;
                    background: rgba(239, 68, 68, 0.1);
                }

                .message.own .message-delete-btn {
                    color: rgba(255, 255, 255, 0.7);
                }

                .message.own .message-delete-btn:hover {
                    color: white;
                    background: rgba(255, 255, 255, 0.1);
                }
            </style>

            @foreach($messages as $message)
                @if($message->is_system)
                    <div class="system-message">
                        {{ $message->message }}
                    </div>
                @else
                    <div class="message {{ $message->user_id === auth()->id() ? 'own' : 'other' }} chat-message" data-message-id="{{ $message->id }}">
                        <div class="message-avatar">
                            @if($message->user->avatar)
                                <img src="{{ asset('storage/' . $message->user->avatar) }}" alt="{{ $message->user->name }}">
                            @else
                                {{ substr($message->user->name, 0, 1) }}
                            @endif
                        </div>
                        <div style="max-width: 1180px; !important" class="message-content">
                            <div class="message-info">
                                <span class="message-sender">{{ $message->user->name }}</span>
                                <span class="message-time">{{ $message->created_at->format('H:i') }}</span>
                            </div>
                            
                            @if($message->image_path)
                                <div class="message-with-image">
                                    @if($message->message)
                                        <div class="message-text">{{ $message->message }}</div>
                                    @endif
                                    <div class="chat-image-container">
                                        <img src="{{ asset('storage/' . $message->image_path) }}" 
                                            alt="Изображение" 
                                            class="chat-image" 
                                            onclick="openImageModal('{{ asset('storage/' . $message->image_path) }}')">
                                    </div>
                                </div>
                            @else
                                <div class="message-text">{{ $message->message }}</div>
                            @endif
                        </div>
                                @if($message->canDelete(auth()->user()))
                                <button class="message-delete-btn" onclick="deleteMessage({{ $message->id }})" title="Удалить сообщение">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 6h18M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2M10 11v6M14 11v6"/>
                                    </svg>
                                </button>
                                @endif
                    </div>
                @endif
            @endforeach

            <span class="chat-input-container">
                <form class="chat-input-form" id="chatForm" enctype="multipart/form-data">
                    @csrf
                    <div class="file-input-wrapper">
                        <input type="file" id="imageInput" class="file-input" accept="image/*">
                        <label for="imageInput" class="file-input-label" title="Добавить изображение">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </label>
                    </div>
                    <div class="message-input-div">
                        <textarea style="color: #001930ff !important;" 
                            class="message-input" 
                            id="messageInput" 
                            placeholder="Введите сообщение или добавьте изображение..." 
                            rows="1"
                            maxlength="1000"
                        ></textarea>
                    </div>
                    <button type="submit" class="send-button" id="sendButton">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M22 2L11 13M22 2L15 22L11 13M22 2L2 9L11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </form>
                

                <div class="preview-container" id="imagePreviewContainer" style="display: none;">
                    <img id="imagePreview" class="chat-image-preview" style="box-shadow: 0px 0px 20px 3px black;">
                    <button type="button" class="image-remove-btn" id="removeImageBtn">×</button>
                </div>
                </span>


        </div>


    </div>
</div>
<script>
    // Функция для удаления сообщения
window.deleteMessage = async function(messageId) {
    if (!confirm('Вы уверены, что хотите удалить это сообщение?')) {
        return;
    }

    try {
        const response = await fetch('{{ route("admin.chat.delete") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                message_id: messageId
            })
        });

        const data = await response.json();
        
        if (data.success) {
            // Находим и удаляем элемент сообщения
            const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
            if (messageElement) {
                messageElement.style.opacity = '0';
                messageElement.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    messageElement.remove();
                }, 300);
            }
            
            // Показываем уведомление об успешном удалении
            showNotification('Сообщение удалено', 'success');
        } else {
            alert('Ошибка при удалении сообщения: ' + data.message);
        }
    } catch (error) {
        console.error('Error deleting message:', error);
        alert('Ошибка при удалении сообщения');
    }
}

// Функция для показа уведомлений
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 12px 20px;
        border-radius: 8px;
        color: white;
        z-index: 10000;
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        animation: slideIn 0.3s ease;
    `;
    
    if (type === 'success') {
        notification.style.background = '#10b981';
    } else if (type === 'error') {
        notification.style.background = '#ef4444';
    } else {
        notification.style.background = '#3b82f6';
    }
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);
</script>
<script>
    
    document.addEventListener('DOMContentLoaded', function() {
        const messagesContainer = document.getElementById('messagesContainer');
        const chatForm = document.getElementById('chatForm');
        const messageInput = document.getElementById('messageInput');
        const sendButton = document.getElementById('sendButton');
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        const removeImageBtn = document.getElementById('removeImageBtn');
        const onlineUsers = document.getElementById('onlineUsers');

        let selectedImage = null;

        function scrollToBottom() {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        scrollToBottom();


        messageInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 120) + 'px';
        });

        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (file.size > 5 * 1024 * 1024) {
                    alert('Размер изображения не должен превышать 5MB');
                    imageInput.value = '';
                    return;
                }

                if (!file.type.startsWith('image/')) {
                    alert('Пожалуйста, выберите файл изображения');
                    imageInput.value = '';
                    return;
                }

                selectedImage = file;
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.alt = 'Предпросмотр изображения';
                    imagePreviewContainer.style.display = 'block';
                    imagePreviewContainer.classList.add('show'); 
                    removeImageBtn.style.display = 'flex'; 
                }
                
                reader.onerror = function() {
                    alert('Ошибка при чтении файла');
                    imageInput.value = '';
                }
                
                reader.readAsDataURL(file);
            }
        });


        removeImageBtn.addEventListener('click', function() {
            selectedImage = null;
            imageInput.value = '';
            imagePreviewContainer.style.display = 'none';
            imagePreviewContainer.classList.remove('show');
            removeImageBtn.style.display = 'none';
            imagePreview.src = '';
        });


        removeImageBtn.addEventListener('click', function() {
            selectedImage = null;
            imageInput.value = '';
            imagePreviewContainer.style.display = 'none';
            removeImageBtn.style.display = 'none';
        });


        chatForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const message = messageInput.value.trim();
            

            if (!message && !selectedImage) {
                alert('Введите сообщение или добавьте изображение');
                return;
            }


            sendButton.disabled = true;
            
            try {
                const formData = new FormData();
                formData.append('message', message);
                
                if (selectedImage) {
                    formData.append('image', selectedImage);
                }

                const response = await fetch('{{ route("admin.chat.send") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                });

                const data = await response.json();
                
                if (data.success) {
                    messageInput.value = '';
                    messageInput.style.height = 'auto';
                    

                    selectedImage = null;
                    imageInput.value = '';
                    imagePreviewContainer.style.display = 'none';
                    removeImageBtn.style.display = 'none';
                    

                    location.reload();
                    
                } else {
                    alert('Ошибка при отправке сообщения');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Ошибка при отправке сообщения');
            } finally {
                sendButton.disabled = false;
            }
        });

        messageInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                chatForm.dispatchEvent(new Event('submit'));
            }
        });

        function addMessageToChat(message) {
            const messageDiv = document.createElement('div');
            
            if (message.is_system) {
                messageDiv.className = 'system-message';
                messageDiv.textContent = message.message;
            } else {
                const isOwn = message.user_id === {{ auth()->id() }};
                messageDiv.className = `message ${isOwn ? 'own' : 'other'}`;
                
                const avatarContent = message.user.avatar ? 
                    `<img src="/storage/${message.user.avatar}" alt="${message.user.name}">` : 
                    message.user.name.charAt(0);
                
                let messageContent = '';
                
                if (message.image_path) {
                    messageContent = `
                        <div class="message-with-image">
                            ${message.message ? `<div class="message-text">${message.message}</div>` : ''}
                            <div class="chat-image-container">
                                <img src="/storage/${message.image_path}" alt="Изображение" class="chat-image" onclick="openImageModal('/storage/${message.image_path}')">
                            </div>
                        </div>
                    `;
                } else {
                    messageContent = `<div class="message-text">${message.message}</div>`;
                }
                
                messageDiv.innerHTML = `
                    <div class="message-avatar">
                        ${avatarContent}
                    </div>
                    <div class="message-content">
                        <div class="message-info">
                            <span class="message-sender">${message.user.name}</span>
                            <span class="message-time">${new Date(message.created_at).toLocaleTimeString('ru-RU', {hour: '2-digit', minute:'2-digit'})}</span>
                        </div>
                        ${messageContent}
                    </div>
                `;
            }
            
            messagesContainer.appendChild(messageDiv);
        }

        window.openImageModal = function(imageUrl) {
            const modal = document.createElement('div');
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.8);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 10000;
                cursor: pointer;
            `;
            
            const img = document.createElement('img');
            img.src = imageUrl;
            img.style.cssText = `
                max-width: 90%;
                max-height: 90%;
                border-radius: 8px;
                cursor: default;
            `;
            
            modal.appendChild(img);
            document.body.appendChild(modal);
            
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    document.body.removeChild(modal);
                }
            });
        };

        let lastMessageId = {{ $messages->last() ? $messages->last()->id : 0 }};
        
        async function pollMessages() {
            try {
                const response = await fetch('{{ route("admin.chat.messages") }}');
                const messages = await response.json();
                
                const newMessages = messages.filter(msg => msg.id > lastMessageId);
                
                if (newMessages.length > 0) {
                    newMessages.forEach(message => {
                        addMessageToChat(message);
                    });
                    lastMessageId = messages[messages.length - 1].id;
                    scrollToBottom();
                }
            } catch (error) {
                console.error('Error polling messages:', error);
            }
        }

        setInterval(pollMessages, 3000);

        async function updateOnlineUsers() {
            try {
                onlineUsers.textContent = 'Админы и модераторы';
            } catch (error) {
                console.error('Error updating online users:', error);
            }
        }

        setInterval(updateOnlineUsers, 30000);
        updateOnlineUsers();
    });
</script>
@endsection