    {{-- Чат поддержки: панель справа, загрузка фото, ответы модераторов/админов --}}
    <div id="support-chat-panel" class="support-chat-panel">
        <div class="support-chat-inner">
            <div class="support-chat-header">
                <h3>Чат поддержки</h3>
                <div class="support-chat-header-actions">
                    <button type="button" class="support-chat-fullscreen-btn" id="support-chat-fullscreen-btn" title="На весь экран" aria-label="На весь экран">
                        <svg class="support-chat-icon-expand" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/></svg>
                        <svg class="support-chat-icon-exit-fullscreen hidden" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3v3a2 2 0 0 0-2 2H3m18 0h-3a2 2 0 0 0-2-2v-3m0 18v-3a2 2 0 0 0 2-2h3M3 16h3a2 2 0 0 0 2 2v3"/></svg>
                    </button>
                    <button type="button" class="support-chat-close" onclick="document.getElementById('support-chat-panel').classList.remove('support-chat-open')">&times;</button>
                </div>
            </div>
            <div class="support-chat-messages" id="support-chat-messages"></div>
            <div id="support-chat-attachments" class="support-chat-attachments"></div>
            <form class="support-chat-form" id="support-chat-form">
                <div class="support-chat-input-row">
                    <input type="text" name="message" id="support-chat-input" placeholder="Сообщение или прикрепите фото..." autocomplete="off" class="support-chat-text">
                    <label class="support-chat-file-label" title="Прикрепить фото (до 8)">
                        <input type="file" name="image" accept="image/*" id="support-chat-file" class="support-chat-file" multiple>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                    </label>
                    <label class="support-chat-file-label" title="Прикрепить файл (до 8)">
                        <input type="file" name="file" accept="video/*,.pdf,application/*,.doc,.docx,.xls,.xlsx,.zip" id="support-chat-attach-file" class="support-chat-file" multiple>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg>
                    </label>
                    <button type="submit" class="support-chat-send">Отправить</button>
                </div>
            </form>
        </div>
        <div id="support-chat-ctx-menu" class="support-chat-ctx-menu" style="display:none;position:fixed;left:0;top:0;min-width:140px;padding:4px 0;background:#fff;border:1px solid #e2e8f0;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,0.15);z-index:10001;">
            <button type="button" id="support-chat-ctx-edit" class="support-chat-ctx-btn">Редактировать</button>
            <button type="button" id="support-chat-ctx-delete" class="support-chat-ctx-btn support-chat-ctx-delete">Удалить</button>
        </div>
    </div>
    <style>
        .support-chat-ctx-btn { display: block; width: 100%; text-align: left; padding: 8px 12px; border: none; background: none; font-size: 14px; color: #0f172a; cursor: pointer; }
        .support-chat-ctx-btn:hover { background: #f1f5f9; }
        .support-chat-ctx-delete { color: #dc2626; }
        body.dark-theme .support-chat-ctx-menu { background: #1e293b; border-color: #334155; }
        body.dark-theme .support-chat-ctx-btn { color: #f1f5f9; }
        body.dark-theme .support-chat-ctx-btn:hover { background: #334155; }
        .support-chat-panel { position: fixed; top: 0; right: 0; width: 380px; min-width: 320px; max-width: 480px; height: 100%; background: #fff; box-shadow: -4px 0 20px rgba(0,0,0,0.15); z-index: 9999; transform: translateX(100%); transition: transform 0.3s ease, width 0.25s ease; }
        .support-chat-panel.support-chat-open { transform: translateX(0); }
        .support-chat-panel.support-chat-fullscreen { width: 100%; min-width: 100%; max-width: 100%; }
        .support-chat-inner { display: flex; flex-direction: column; height: 100%; }
        .support-chat-header { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: #fff; padding: 12px 16px; display: flex; justify-content: space-between; align-items: center; }
        .support-chat-header h3 { margin: 0; font-size: 1.1rem; font-weight: 600; color: #fff; }
        .support-chat-header-actions { display: flex; align-items: center; gap: 4px; }
        .support-chat-icon-expand { stroke: #fff; color: #fff; }
        .support-chat-msg.own .support-chat-msg-text { color: #fff; }
        .support-chat-fullscreen-btn { background: none; border: none; color: #fff; padding: 6px; cursor: pointer; line-height: 1; display: flex; align-items: center; justify-content: center; opacity: 0.9; }
        .support-chat-fullscreen-btn:hover { opacity: 1; }
        .support-chat-fullscreen-btn .hidden { display: none !important; }
        .support-chat-close { background: none; border: none; color: #fff; font-size: 24px; cursor: pointer; line-height: 1; padding: 0 4px; }
        .support-chat-messages { flex: 1; overflow-y: auto; padding: 12px; display: flex; flex-direction: column; gap: 10px; background: #f8fafc; scrollbar-width: thin; scrollbar-color: #94a3b8 #e2e8f0; }
        .support-chat-messages::-webkit-scrollbar { width: 8px; }
        .support-chat-messages::-webkit-scrollbar-track { background: #e2e8f0; border-radius: 4px; }
        .support-chat-messages::-webkit-scrollbar-thumb { background: linear-gradient(180deg, #94a3b8, #64748b); border-radius: 4px; }
        .support-chat-messages::-webkit-scrollbar-thumb:hover { background: linear-gradient(180deg, #64748b, #475569); }
        .support-chat-msg { max-width: 85%; padding: 8px 12px; border-radius: 12px; font-size: 14px; }
        .support-chat-msg.own { align-self: flex-end; background: #1d4ed8; color: #fff; }
        .support-chat-msg.own .support-chat-msg-name { color: rgba(255,255,255,0.95); }
        .support-chat-msg.other { align-self: flex-start; background: #fff; border: 1px solid #e2e8f0; color: #0f172a; }
        .support-chat-msg-name { font-size: 11px; color: #64748b; margin-bottom: 2px; }
        .support-chat-msg img.thumb { max-width: 120px; max-height: 100px; border-radius: 8px; cursor: pointer; margin-top: 4px; }
        .support-chat-form { padding: 10px; border-top: 1px solid #e2e8f0; background: #fff; }
        .support-chat-input-row { display: flex; gap: 8px; align-items: center; }
        .support-chat-text { flex: 1; padding: 10px 12px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; background: #fff; color: #0f172a; }
        .support-chat-file-label { width: 40px; height: 40px; border: 1px solid #e2e8f0; border-radius: 10px; display: flex; align-items: center; justify-content: center; cursor: pointer; background: #fff; color: #64748b; }
        .support-chat-file { display: none; }
        .support-chat-send { padding: 10px 16px; background: #1d4ed8; color: #fff; border: none; border-radius: 10px; font-size: 14px; cursor: pointer; }
        .support-chat-attachments { padding: 8px 10px; border-top: 1px solid #e2e8f0; background: #f1f5f9; display: flex; flex-direction: column; gap: 6px; max-height: 160px; overflow-y: auto; scrollbar-width: thin; scrollbar-color: #94a3b8 #e2e8f0; }
        .support-chat-attachments::-webkit-scrollbar { width: 6px; }
        .support-chat-attachments::-webkit-scrollbar-track { background: #e2e8f0; border-radius: 3px; }
        .support-chat-attachments::-webkit-scrollbar-thumb { background: linear-gradient(180deg, #94a3b8, #64748b); border-radius: 3px; }
        .support-chat-attachments::-webkit-scrollbar-thumb:hover { background: #64748b; }
        .support-chat-attachments:empty { display: none; }
        .support-chat-att-item { display: flex; align-items: center; gap: 8px; padding: 6px 10px; background: #fff; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 13px; }
        .support-chat-att-item.is-photo { border-left: 3px solid #3b82f6; }
        .support-chat-att-item.is-file { border-left: 3px solid #64748b; }
        .support-chat-att-name { flex: 1; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #334155; }
        .support-chat-att-ext { color: #64748b; flex-shrink: 0; }
        .support-chat-att-remove { width: 24px; height: 24px; min-width: 24px; border: none; background: #64748b; color: #fff; border-radius: 50%; font-size: 16px; line-height: 1; cursor: pointer; padding: 0; display: flex; align-items: center; justify-content: center; }
        .support-chat-att-remove:hover { background: #dc2626; }
        body.dark-theme .support-chat-attachments { background: #334155; border-top-color: #475569; }
        body.dark-theme .support-chat-att-item { background: #1e293b; border-color: #475569; }
        body.dark-theme .support-chat-att-name { color: #e2e8f0; }
        body.dark-theme .support-chat-att-ext { color: #94a3b8; }
        .support-chat-msg-buttons { margin-top: 8px; display: flex; flex-wrap: wrap; gap: 6px; }
        .support-chat-msg-btn { padding: 6px 12px; border: 1px solid #94a3b8; border-radius: 8px; background: #f1f5f9; color: #475569; font-size: 12px; cursor: pointer; }
        .support-chat-msg-btn:hover { background: #e2e8f0; color: #1e293b; }
        body.dark-theme .support-chat-msg-btn { background: #334155; border-color: #64748b; color: #e2e8f0; }
        body.dark-theme .support-chat-msg-btn:hover { background: #475569; color: #fff; }
        body.dark-theme .support-chat-preview { background: #334155; border-top-color: #475569; }
        /* Тёмная тема чата поддержки */
        body.dark-theme .support-chat-panel { background: #1e293b; }
        body.dark-theme .support-chat-messages { background: #0f172a; scrollbar-color: #475569 #334155; }
        body.dark-theme .support-chat-messages::-webkit-scrollbar-track { background: #334155; }
        body.dark-theme .support-chat-messages::-webkit-scrollbar-thumb { background: linear-gradient(180deg, #64748b, #475569); }
        body.dark-theme .support-chat-messages::-webkit-scrollbar-thumb:hover { background: #475569; }
        body.dark-theme .support-chat-attachments { scrollbar-color: #475569 #334155; }
        body.dark-theme .support-chat-attachments::-webkit-scrollbar-track { background: #334155; }
        body.dark-theme .support-chat-attachments::-webkit-scrollbar-thumb { background: #475569; }
        body.dark-theme .support-chat-attachments::-webkit-scrollbar-thumb:hover { background: #4b5563; }
        body.dark-theme .support-chat-msg.other { background: #334155; border-color: #475569; color: #f1f5f9; }
        body.dark-theme .support-chat-msg-name { color: #94a3b8; }
        body.dark-theme .support-chat-form { background: #1e293b; border-top-color: #334155; }
        body.dark-theme .support-chat-text { background: #334155; border-color: #475569; color: #f1f5f9; }
        body.dark-theme .support-chat-text::placeholder { color: #94a3b8; }
        body.dark-theme .support-chat-file-label { background: #334155; border-color: #475569; color: #94a3b8; }
        body.dark-theme .container { color: #e2e8f0; }
        /* Синий фон — всегда белый текст (контраст) */
        .btn-modern[style*="1e40af"], .btn-modern[style*="1D4ED8"], button[style*="background: #1e40af"], button[style*="background:#1e40af"], button[style*="background: #1D4ED8"], .moder-order-form-submit { color: #fff !important; }
    </style>
    <script>
    (function() {
        function initSupportChat() {
        var panel = document.getElementById('support-chat-panel');
        var messagesEl = document.getElementById('support-chat-messages');
        var form = document.getElementById('support-chat-form');
        if (!form) return;
        var input = form.querySelector('input[name="message"]');
        var fileInput = document.getElementById('support-chat-file');
        var attachFileInput = document.getElementById('support-chat-attach-file');
        var csrf = document.querySelector('meta[name="csrf-token"]');
        var currentUserId = {{ Auth::id() ?? 'null' }};
        var pollTimer;
        var attachmentsEl = document.getElementById('support-chat-attachments');
        var selectedImages = [];
        var selectedFiles = [];
        var MAX_ONE_TYPE = 8;
        var MAX_WHEN_BOTH = 4;
        function getExt(name) {
            if (!name) return '';
            var i = name.lastIndexOf('.');
            return i >= 0 ? name.slice(i) : '';
        }
        function renderAttachments() {
            if (!attachmentsEl) return;
            var html = '';
            selectedImages.forEach(function(file, idx) {
                var name = file.name || 'Фото';
                var ext = getExt(name);
                var baseName = ext ? name.slice(0, -ext.length) : name;
                html += '<div class="support-chat-att-item is-photo" data-type="image" data-index="' + idx + '">' +
                    '<span class="support-chat-att-name" title="' + (name.replace(/"/g, '&quot;')) + '">' + (baseName.replace(/</g, '&lt;')) + '</span>' +
                    '<span class="support-chat-att-ext">' + (ext.replace(/</g, '&lt;')) + '</span>' +
                    '<button type="button" class="support-chat-att-remove" title="Удалить">&times;</button></div>';
            });
            selectedFiles.forEach(function(file, idx) {
                var name = file.name || 'Файл';
                var ext = getExt(name);
                var baseName = ext ? name.slice(0, -ext.length) : name;
                html += '<div class="support-chat-att-item is-file" data-type="file" data-index="' + idx + '">' +
                    '<span class="support-chat-att-name" title="' + (name.replace(/"/g, '&quot;')) + '">' + (baseName.replace(/</g, '&lt;')) + '</span>' +
                    '<span class="support-chat-att-ext">' + (ext.replace(/</g, '&lt;')) + '</span>' +
                    '<button type="button" class="support-chat-att-remove" title="Удалить">&times;</button></div>';
            });
            attachmentsEl.innerHTML = html;
            attachmentsEl.querySelectorAll('.support-chat-att-remove').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var row = btn.closest('.support-chat-att-item');
                    if (!row) return;
                    var type = row.getAttribute('data-type');
                    var idx = parseInt(row.getAttribute('data-index'), 10);
                    if (type === 'image' && idx >= 0 && idx < selectedImages.length) {
                        selectedImages.splice(idx, 1);
                    } else if (type === 'file' && idx >= 0 && idx < selectedFiles.length) {
                        selectedFiles.splice(idx, 1);
                    }
                    renderAttachments();
                });
            });
        }
        function addImages(files) {
            var max = selectedFiles.length > 0 ? MAX_WHEN_BOTH : MAX_ONE_TYPE;
            for (var i = 0; i < files.length && selectedImages.length < max; i++) {
                if (files[i].type && files[i].type.indexOf('image') !== -1) selectedImages.push(files[i]);
            }
            renderAttachments();
        }
        function addFiles(files) {
            var max = selectedImages.length > 0 ? MAX_WHEN_BOTH : MAX_ONE_TYPE;
            for (var i = 0; i < files.length && selectedFiles.length < max; i++) {
                selectedFiles.push(files[i]);
            }
            renderAttachments();
        }
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                var list = this.files;
                if (list && list.length) {
                    addImages(Array.prototype.slice.call(list));
                    this.value = '';
                }
            });
        }
        if (attachFileInput) {
            attachFileInput.addEventListener('change', function() {
                var list = this.files;
                if (list && list.length) {
                    addFiles(Array.prototype.slice.call(list));
                    this.value = '';
                }
            });
        }
        function buildStorageUrl(path) {
            if (!path) return '';
            var pathStr = (path + '').replace(/\\/g, '/').replace(/^\//, '');
            var base = window.location.origin + (window.location.pathname.indexOf('/public') === 0 ? '/public/storage' : '/storage');
            return base + '/' + pathStr;
        }
        var BOT_BTN_DELIMITER = '\n__BTN__\n';
        function parseBotButtons(msgRaw) {
            var displayText = msgRaw;
            var buttons = [];
            if (msgRaw.indexOf(BOT_BTN_DELIMITER) !== -1) {
                var parts = msgRaw.split(BOT_BTN_DELIMITER);
                displayText = (parts[0] || '').trim();
                try {
                    if (parts[1]) buttons = JSON.parse((parts[1] || '').trim());
                } catch (e) { }
                return { displayText: displayText, buttons: buttons };
            }
            if (msgRaw.indexOf('__BTN__') !== -1) {
                var idx = msgRaw.indexOf('__BTN__');
                displayText = msgRaw.slice(0, idx).replace(/\n+$/, '').trim();
                if (displayText.slice(-1) === 'n' && msgRaw.charAt(idx - 1) === 'n') displayText = displayText.slice(0, -1).trim();
                var after = msgRaw.slice(idx + 7).replace(/^[\n\r]+/, '').trim();
                if (after.charAt(0) === 'n') after = after.slice(1).trim();
                var jsonStart = after.indexOf('[');
                if (jsonStart !== -1) {
                    try {
                        buttons = JSON.parse(after.slice(jsonStart));
                    } catch (e) { }
                }
                return { displayText: displayText, buttons: buttons };
            }
            return { displayText: displayText, buttons: buttons };
        }
        function renderOneMessage(m, currentUserId) {
            var isOwn = m.user_id === currentUserId;
            var name = (m.user && m.user.name) ? m.user.name : 'Гость';
            if ((m.user && m.user.role) === 'admin' || (m.user && m.user.role) === 'moderator') name += ' (поддержка)';
            if (m.is_system) name = 'Бот';
            var timeStr = m.created_at ? (function(d) { try { var x = new Date(d); return x.toLocaleDateString('ru-RU', { day: '2-digit', month: '2-digit' }) + ' ' + x.toLocaleTimeString('ru-RU', { hour: '2-digit', minute: '2-digit' }); } catch(e) { return d; } })(m.created_at) : '';
            var img = '';
            var imgUrl = m.image_url || (m.image_path ? buildStorageUrl(m.image_path) : '');
            if (imgUrl) {
                img = '<a href="' + imgUrl + '" class="support-chat-msg-img support-chat-zoom-img" data-full="' + imgUrl + '"><img src="' + imgUrl + '" alt="Фото" class="thumb" onerror="this.onerror=null;this.parentElement.innerHTML=\'<span class=\\\'text-sm opacity-80\\\'>Фото</span>\';"></a>';
            }
            var fileUrl = m.file_url || (m.file_path ? buildStorageUrl(m.file_path) : '');
            var fileBlock = fileUrl ? '<a href="' + fileUrl + '" target="_blank" rel="noopener" class="block mt-2 text-sm opacity-90">📎 ' + (m.file_name || 'Файл').replace(/</g, '&lt;') + '</a>' : '';
            var msgRaw = m.message ? (m.message + '') : '';
            var displayText = msgRaw;
            var buttons = [];
            if (m.is_system) {
                var parsed = parseBotButtons(msgRaw);
                displayText = parsed.displayText;
                buttons = parsed.buttons || [];
            }
            var textBlock = displayText ? ('<div class="support-chat-msg-text">' + displayText.replace(/</g, '&lt;').replace(/>/g, '&gt;') + '</div>') : (imgUrl ? '<div class="text-sm opacity-80">Фото</div>' : '');
            var buttonsHtml = '';
            if (Array.isArray(buttons) && buttons.length > 0) {
                buttonsHtml = '<div class="support-chat-msg-buttons">' + buttons.map(function(b) {
                    var label = (b && b.label) ? (b.label + '').replace(/</g, '&lt;').replace(/>/g, '&gt;') : '';
                    var sendText = (b && b.text) ? (b.text + '').replace(/"/g, '&quot;') : '';
                    return '<button type="button" class="support-chat-msg-btn" data-text="' + sendText + '">' + label + '</button>';
                }).join('') + '</div>';
            }
            var canDel = m.can_delete ? '1' : '0';
            var canEd = m.can_edit ? '1' : '0';
            var msgTextForCopy = (displayText || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
            return '<div class="support-chat-msg ' + (isOwn ? 'own' : 'other') + '" data-message-id="' + (m.id || '') + '" data-can-delete="' + canDel + '" data-can-edit="' + canEd + '" data-copy-text="' + msgTextForCopy.replace(/"/g, '&quot;') + '" title="Нажмите, чтобы скопировать">' +
                '<div class="support-chat-msg-name">' + name + (timeStr ? ' · ' + timeStr : '') + '</div>' +
                textBlock + img + fileBlock + buttonsHtml + '</div>';
        }
        function scrollChatToBottom() {
            if (messagesEl) { messagesEl.scrollTop = messagesEl.scrollHeight; }
        }
        function loadMessages() {
            if (!messagesEl) return;
            fetch('{{ route("support.chat.messages") }}', {
                credentials: 'same-origin',
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            })
                .then(function(r) {
                    if (!r.ok) return Promise.reject(r);
                    return r.json();
                })
                .then(function(data) {
                    var list = Array.isArray(data) ? data : (data && data.data && Array.isArray(data.data) ? data.data : []);
                    if (data && data.error) {
                        messagesEl.innerHTML = '<div class="support-chat-msg other"><div class="support-chat-msg-name">Ошибка загрузки</div></div>';
                        return;
                    }
                    if (list.length === 0) {
                        messagesEl.innerHTML = '<div class="support-chat-msg other"><div class="support-chat-msg-name">Пока нет сообщений. Напишите первым.</div></div>';
                        messagesEl.scrollTop = messagesEl.scrollHeight;
                        return;
                    }
                    messagesEl.innerHTML = list.map(function(m) { return renderOneMessage(m, currentUserId); }).join('');
                    scrollChatToBottom();
                    setTimeout(scrollChatToBottom, 80);
                    messagesEl.querySelectorAll('.support-chat-zoom-img').forEach(function(a) {
                        a.addEventListener('click', function(e) { e.preventDefault(); if (window.supportChatLightbox) window.supportChatLightbox.show(this.dataset.full || this.href); });
                    });
                    messagesEl.querySelectorAll('.support-chat-msg').forEach(function(msgEl) {
                        var copyText = msgEl.getAttribute('data-copy-text');
                        if (!copyText) {
                            var textEl = msgEl.querySelector('.support-chat-msg-text');
                            copyText = textEl ? (textEl.textContent || '').trim() : '';
                        }
                        if (copyText) {
                            msgEl.style.cursor = 'pointer';
                            msgEl.addEventListener('click', function(e) {
                                if (e.target.closest('.support-chat-msg-btn') || e.target.closest('a') || e.target.closest('button')) return;
                                try {
                                    var raw = msgEl.getAttribute('data-copy-text') || msgEl.querySelector('.support-chat-msg-text').textContent || '';
                                    if (raw && navigator.clipboard && navigator.clipboard.writeText) {
                                        navigator.clipboard.writeText(raw.trim());
                                    } else if (raw) {
                                        var ta = document.createElement('textarea'); ta.value = raw.trim(); ta.style.position = 'fixed'; ta.style.left = '-9999px'; document.body.appendChild(ta); ta.select(); document.execCommand('copy'); document.body.removeChild(ta);
                                    }
                                } catch (err) {}
                            });
                        }
                    });
                }).catch(function() {
                    messagesEl.innerHTML = '<div class="support-chat-msg other"><div class="support-chat-msg-name">Не удалось загрузить сообщения</div></div>';
                });
        }
        window.supportChatLightbox = {
            overlay: null,
            img: null,
            downloadBtn: null,
            init: function() {
                if (this.overlay) return;
                var div = document.createElement('div');
                div.id = 'support-chat-lightbox';
                div.className = 'support-chat-lightbox';
                div.innerHTML = '<button type="button" class="support-chat-lb-close" title="Закрыть">&times;</button><a href="#" class="support-chat-lb-download" download title="Скачать"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg></a><img src="data:image/gif;base64,R0lGOODlhAQABAAAAACwAAAAAAQABAAACAkQBADs=" alt="">';
                div.style.cssText = 'display:none;position:fixed;inset:0;z-index:10000;background:rgba(0,0,0,0.85);align-items:center;justify-content:center;padding:20px;';
                div.querySelector('img').style.maxWidth = '95vw'; div.querySelector('img').style.maxHeight = '95vh'; div.querySelector('img').style.objectFit = 'contain';
                div.querySelector('.support-chat-lb-close').style.cssText = 'position:absolute;top:15px;right:15px;width:44px;height:44px;border:none;background:rgba(255,255,255,0.15);color:#fff;font-size:28px;cursor:pointer;border-radius:50%;display:flex;align-items:center;justify-content:center;';
                div.querySelector('.support-chat-lb-download').style.cssText = 'position:absolute;top:15px;right:68px;width:44px;height:44px;border:none;background:rgba(255,255,255,0.15);color:#fff;cursor:pointer;border-radius:50%;display:flex;align-items:center;justify-content:center;';
                div.querySelector('.support-chat-lb-close').addEventListener('click', function(e) { e.stopPropagation(); window.supportChatLightbox.hide(); });
                div.querySelector('.support-chat-lb-download').addEventListener('click', function(e) { e.stopPropagation(); });
                div.addEventListener('click', function(e) { if (e.target === div) window.supportChatLightbox.hide(); });
                document.body.appendChild(div);
                this.overlay = div; this.img = div.querySelector('img'); this.downloadBtn = div.querySelector('.support-chat-lb-download');
            },
            show: function(url) {
                this.init();
                this.img.src = url;
                if (this.downloadBtn) { this.downloadBtn.href = url; this.downloadBtn.download = (url.split('/').pop() || 'image').split('?')[0] || 'image'; }
                this.overlay.style.display = 'flex';
            },
            hide: function() { if (this.overlay) { this.overlay.style.display = 'none'; this.img.src = 'data:image/gif;base64,R0lGOODlhAQABAAAAACwAAAAAAQABAAACAkQBADs='; } }
        };
        function startPoll() {
            if (pollTimer) clearInterval(pollTimer);
            pollTimer = setInterval(loadMessages, 5000);
        }
        function stopPoll() {
            if (pollTimer) { clearInterval(pollTimer); pollTimer = null; }
        }
        panel && panel.addEventListener('transitionend', function() {
            if (panel.classList.contains('support-chat-open')) { loadMessages(); startPoll(); } else stopPoll();
        });
        var toggleEl = document.getElementById('support-chat-toggle');
        if (toggleEl) {
            toggleEl.addEventListener('click', function(e) {
                e.preventDefault();
                if (panel) {
                    panel.classList.add('support-chat-open');
                    loadMessages();
                    startPoll();
                }
                var mNav = document.getElementById('mNav');
                if (mNav) mNav.classList.remove('is-open');
            });
        }
        messagesEl && messagesEl.addEventListener('click', function(e) {
            var btn = e.target.closest('.support-chat-msg-btn');
            if (!btn || !btn.dataset.text) return;
            var input = document.getElementById('support-chat-input');
            if (input) { input.value = btn.dataset.text; input.focus(); }
            var f = document.getElementById('support-chat-form');
            if (f) f.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }));
        });
        var supportChatInput = document.getElementById('support-chat-input');
        if (supportChatInput) supportChatInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') { e.preventDefault(); if (form) form.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true })); }
        });
        form && form.addEventListener('submit', function(e) {
            e.preventDefault();
            var msgInput = form.querySelector('input[name="message"]');
            var textVal = (msgInput && msgInput.value || '').toString().trim();
            var hasText = textVal !== '';
            var hasImages = selectedImages && selectedImages.length > 0;
            var hasFiles = selectedFiles && selectedFiles.length > 0;
            if (!hasText && !hasImages && !hasFiles) return;
            var fd = new FormData();
            fd.append('message', textVal);
            if (hasImages) {
                for (var i = 0; i < selectedImages.length; i++) {
                    fd.append('images[]', selectedImages[i]);
                }
            }
            if (hasFiles) {
                for (var j = 0; j < selectedFiles.length; j++) {
                    fd.append('files[]', selectedFiles[j]);
                }
            }
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route("support.chat.send") }}');
            if (csrf) xhr.setRequestHeader('X-CSRF-TOKEN', csrf.getAttribute('content'));
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.setRequestHeader('Accept', 'application/json');
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    try {
                        var res = JSON.parse(xhr.responseText);
                        if (res.success && res.messages && Array.isArray(res.messages)) {
                            res.messages.forEach(function(m) {
                                var html = renderOneMessage(m, currentUserId);
                                var wrap = document.createElement('div');
                                wrap.innerHTML = html;
                                if (wrap.firstChild && messagesEl) {
                                    messagesEl.appendChild(wrap.firstChild);
                                    wrap.firstChild.querySelectorAll('.support-chat-zoom-img').forEach(function(a) {
                                        a.addEventListener('click', function(ev) { ev.preventDefault(); if (window.supportChatLightbox) window.supportChatLightbox.show(this.dataset.full || this.href); });
                                    });
                                }
                            });
                            scrollChatToBottom();
                        } else if (res.success && res.message) {
                            var html = renderOneMessage(res.message, currentUserId);
                            var wrap = document.createElement('div');
                            wrap.innerHTML = html;
                            if (wrap.firstChild && messagesEl) {
                                messagesEl.appendChild(wrap.firstChild);
                                wrap.firstChild.querySelectorAll('.support-chat-zoom-img').forEach(function(a) {
                                    a.addEventListener('click', function(ev) { ev.preventDefault(); if (window.supportChatLightbox) window.supportChatLightbox.show(this.dataset.full || this.href); });
                                });
                            }
                            scrollChatToBottom();
                        }
                    } catch (err) {}
                    form.reset();
                    if (fileInput) fileInput.value = '';
                    if (attachFileInput) attachFileInput.value = '';
                    selectedImages.length = 0;
                    selectedFiles.length = 0;
                    renderAttachments();
                    loadMessages();
                }
            };
            xhr.send(fd);
        });
        var ctxMenu = document.getElementById('support-chat-ctx-menu');
        var ctxEdit = document.getElementById('support-chat-ctx-edit');
        var ctxDelete = document.getElementById('support-chat-ctx-delete');
        var ctxMsgId = null;
        var ctxMsgEl = null;
        var csrfToken = csrf ? csrf.getAttribute('content') : '';
        function hideCtx() { if (ctxMenu) { ctxMenu.style.display = 'none'; ctxMsgId = null; ctxMsgEl = null; } }
        messagesEl && messagesEl.addEventListener('contextmenu', function(e) {
            var msg = e.target.closest('.support-chat-msg');
            if (!msg) return;
            e.preventDefault();
            var mid = msg.getAttribute('data-message-id');
            var canDel = msg.getAttribute('data-can-delete') === '1';
            var canEd = msg.getAttribute('data-can-edit') === '1';
            if (!mid || (!canDel && !canEd)) return;
            ctxMsgId = mid;
            ctxMsgEl = msg;
            if (ctxMenu) {
                ctxEdit.style.display = canEd ? 'block' : 'none';
                ctxDelete.style.display = canDel ? 'block' : 'none';
                ctxMenu.style.left = e.clientX + 'px';
                ctxMenu.style.top = e.clientY + 'px';
                ctxMenu.style.display = 'block';
            }
        });
        document.addEventListener('click', function(e) { if (ctxMenu && !ctxMenu.contains(e.target)) hideCtx(); });
        if (ctxDelete) ctxDelete.addEventListener('click', function() {
            if (!ctxMsgId || !ctxMsgEl) return;
            var id = ctxMsgId;
            var el = ctxMsgEl;
            hideCtx();
            fetch('{{ route("support.chat.delete-message") }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json', 'Accept': 'application/json' }, body: JSON.stringify({ message_id: parseInt(id, 10), _token: csrfToken }) })
                .then(function(r) { return r.json(); })
                .then(function(data) { if (data.success && el && el.parentNode) el.remove(); });
        });
        if (ctxEdit) ctxEdit.addEventListener('click', function() {
            if (!ctxMsgId || !ctxMsgEl) return;
            var id = ctxMsgId;
            var el = ctxMsgEl;
            var textEl = el.querySelector('.support-chat-msg-text');
            hideCtx();
            if (!textEl) return;
            var current = textEl.textContent || '';
            var wrap = document.createElement('div');
            wrap.innerHTML = '<textarea class="support-chat-edit-ta" rows="3" style="width:100%;padding:6px;border-radius:8px;border:1px solid #e2e8f0;font-size:14px;"></textarea><div style="margin-top:8px;"><button type="button" class="support-chat-edit-save" style="padding:6px 12px;background:#1d4ed8;color:#fff;border:none;border-radius:8px;margin-right:8px;">Сохранить</button><button type="button" class="support-chat-edit-cancel" style="padding:6px 12px;border:1px solid #e2e8f0;border-radius:8px;">Отмена</button></div>';
            wrap.querySelector('textarea').value = current;
            textEl.replaceWith(wrap);
            var ta = wrap.querySelector('textarea');
            wrap.querySelector('.support-chat-edit-cancel').addEventListener('click', function() { wrap.replaceWith(textEl); });
            wrap.querySelector('.support-chat-edit-save').addEventListener('click', function() {
                var newText = (ta && ta.value || '').trim();
                fetch('{{ route("support.chat.update-message") }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json', 'Accept': 'application/json' }, body: JSON.stringify({ message_id: parseInt(id, 10), message: newText, _token: csrfToken }) })
                    .then(function(r) { return r.json(); })
                    .then(function(data) {
                        if (data.success && data.message) {
                            var d = document.createElement('div');
                            d.className = 'support-chat-msg-text';
                            d.textContent = (data.message.message || '');
                            wrap.replaceWith(d);
                        } else { wrap.replaceWith(textEl); }
                    });
            });
        });

        document.getElementById('support-chat-fullscreen-btn') && document.getElementById('support-chat-fullscreen-btn').addEventListener('click', function() {
            if (!panel) return;
            panel.classList.toggle('support-chat-fullscreen');
            var expand = panel.querySelector('.support-chat-icon-expand');
            var exit = panel.querySelector('.support-chat-icon-exit-fullscreen');
            if (expand && exit) {
                expand.classList.toggle('hidden', panel.classList.contains('support-chat-fullscreen'));
                exit.classList.toggle('hidden', !panel.classList.contains('support-chat-fullscreen'));
            }
        });
        if (panel && panel.classList.contains('support-chat-open')) { loadMessages(); startPoll(); }
        }
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initSupportChat);
        } else {
            initSupportChat();
        }
    })();
    </script>