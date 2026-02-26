<script>
(function() {
    var csrf = document.querySelector('meta[name="csrf-token"]');
    var csrfToken = csrf ? csrf.getAttribute('content') : '';
    var isStandalone = !!window._supportChatStandalone;
    var adminMessagesUrl = '{{ route("adminPanel2", ["page" => "messages"]) }}';

    function formatLastSeen(lastSeenAt, isOnline) {
        if (isOnline) return 'онлайн';
        if (!lastSeenAt) return '';
        try {
            var d = new Date(lastSeenAt);
            return 'был(а) в сети ' + d.toLocaleDateString('ru-RU', { day: '2-digit', month: '2-digit' }) + ', ' + d.toLocaleTimeString('ru-RU', { hour: '2-digit', minute: '2-digit' });
        } catch (e) { return ''; }
    }
    function storageUrl(path) {
        if (!path) return '';
        var pathStr = (path + '').replace(/\\/g, '/').replace(/^\//, '');
        var origin = typeof window !== 'undefined' ? window.location.origin : '';
        var pathname = typeof window !== 'undefined' ? (window.location.pathname || '') : '';
        var base = origin + (pathname.indexOf('/public') === 0 ? '/public/storage' : '/storage');
        return base + '/' + pathStr;
    }
    function renderThreadsList(threads) {
        var list = document.getElementById('support-threads-list');
        var empty = document.getElementById('support-threads-empty');
        if (!list) return;
        var existing = list.querySelectorAll('.support-thread[data-thread-id]');
        existing.forEach(function(el) { el.remove(); });
        if (threads.length === 0) {
            empty.classList.remove('hidden');
            return;
        }
        empty.classList.add('hidden');
        var defaultAvatar = 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22 fill=%22%2394a3b8%22%3E%3Cpath d=%22M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z%22/%3E%3C/svg%3E';
        threads.forEach(function(t) {
            var btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'support-thread w-full text-left px-4 py-3 hover:bg-slate-100 dark:hover:bg-slate-800/50 flex items-center gap-3' + (t.needs_human ? ' bg-amber-50 dark:bg-amber-900/20 border-l-4 border-amber-500' : '');
            btn.dataset.threadId = t.id;
            btn.dataset.name = t.name || '';
            btn.dataset.email = t.email || '';
            btn.dataset.avatar = t.avatar || '';
            btn.dataset.needsHuman = t.needs_human ? '1' : '0';
            btn.dataset.lastSeenAt = t.last_seen_at || '';
            btn.dataset.isOnline = t.is_online ? '1' : '0';
            var avatarUrl = t.avatar ? '{{ asset("storage") }}/' + t.avatar : defaultAvatar;
            var statusText = t.is_online ? '<span class="text-green-600 dark:text-green-400">онлайн</span>' : (t.last_seen_at ? '<span class="text-xs admin2-text-muted">' + formatLastSeen(t.last_seen_at, false) + '</span>' : '');
            var lastMsgRaw = (t.last_message && t.last_message.message) ? (t.last_message.message + '') : '';
            if (lastMsgRaw.indexOf('\n__BTN__\n') !== -1) lastMsgRaw = lastMsgRaw.split('\n__BTN__\n')[0];
            var lastMsg = lastMsgRaw.substring(0, 40);
            btn.innerHTML = '<img src="' + avatarUrl + '" alt="" class="w-10 h-10 rounded-full object-cover bg-slate-200 dark:bg-slate-600" onerror="this.src=\'' + defaultAvatar + '\'">' +
                '<div class="flex-1 min-w-0"><p class="font-medium truncate">' + (t.name || '') + '</p>' +
                (lastMsg ? '<p class="text-xs admin2-text-muted truncate">' + lastMsg.replace(/</g, '&lt;') + '</p>' : '') +
                (statusText ? '<p class="mt-0.5">' + statusText + '</p>' : '') +
                (t.needs_human ? '<span class="inline-block mt-1 text-xs text-amber-600 dark:text-amber-400">Нужен оператор</span>' : '') + '</div>';
            list.insertBefore(btn, empty);
        });
    }
    function loadSupportThreads() {
        return fetch('{{ route("support.chat.threads") }}', { headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' } })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.error) return;
                var threads = Array.isArray(data) ? data : [];
                window._supportThreadsList = threads;
                var unifiedInput = document.getElementById('support-chat-search-unified');
                var searchQ = (unifiedInput && unifiedInput.value || '').trim().toLowerCase();
                var toShow = searchQ ? threads.filter(function(t) {
                    return (t.name || '').toLowerCase().indexOf(searchQ) !== -1 || (t.email || '').toLowerCase().indexOf(searchQ) !== -1;
                }) : threads;
                renderThreadsList(toShow);
            });
    }
    var searchUserTimer;
    var unifiedSearchEl = document.getElementById('support-chat-search-unified');
    if (unifiedSearchEl) {
        unifiedSearchEl.addEventListener('input', function() {
            var q = this.value.trim();
            var qLower = q.toLowerCase();
            var threads = window._supportThreadsList || [];
            var toShow = q ? threads.filter(function(t) { return (t.name || '').toLowerCase().indexOf(qLower) !== -1 || (t.email || '').toLowerCase().indexOf(qLower) !== -1; }) : threads;
            renderThreadsList(toShow);
            var resultsEl = document.getElementById('support-chat-search-results');
            clearTimeout(searchUserTimer);
            if (q.length < 2) { resultsEl.classList.add('hidden'); resultsEl.innerHTML = ''; return; }
            searchUserTimer = setTimeout(function() {
                fetch('{{ route("support.chat.search-users") }}?q=' + encodeURIComponent(q), { headers: { 'Accept': 'application/json' } })
                    .then(function(r) { return r.json(); })
                    .then(function(users) {
                        if (!Array.isArray(users) || users.length === 0) {
                            resultsEl.innerHTML = '<p class="p-3 text-sm admin2-text-muted">Никого не найдено</p>';
                            resultsEl.classList.remove('hidden');
                            return;
                        }
                        resultsEl.innerHTML = users.map(function(u) {
                            var status = u.is_online ? 'онлайн' : (u.last_seen_at ? formatLastSeen(u.last_seen_at, false) : '');
                            return '<button type="button" class="support-search-user w-full text-left px-3 py-2 hover:bg-slate-100 dark:hover:bg-slate-700 flex items-center gap-2 border-b border-slate-100 dark:border-slate-700 last:border-0 text-slate-900 dark:text-slate-100" data-id="' + u.id + '" data-name="' + (u.name || '').replace(/"/g, '&quot;') + '" data-email="' + (u.email || '').replace(/"/g, '&quot;') + '" data-avatar="' + (u.avatar || '').replace(/"/g, '&quot;') + '" data-last-seen="' + (u.last_seen_at || '').replace(/"/g, '&quot;') + '" data-online="' + (u.is_online ? '1' : '0') + '">' +
                                '<img src="' + (u.avatar ? '{{ asset("storage") }}/' + u.avatar : 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22 fill=%22%2394a3b8%22%3E%3Cpath d=%22M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z%22/%3E%3C/svg%3E') + '" alt="" class="w-8 h-8 rounded-full object-cover">' +
                                '<div class="flex-1 min-w-0"><p class="font-medium text-sm truncate">' + (u.name || '').replace(/</g, '&lt;') + '</p><p class="text-xs admin2-text-muted truncate">' + (u.email || '').replace(/</g, '&lt;') + '</p>' + (status ? '<p class="text-xs text-green-600 dark:text-green-400">' + status.replace(/</g, '&lt;') + '</p>' : '') + '</div></button>';
                        }).join('');
                        resultsEl.classList.remove('hidden');
                    });
            }, 300);
        });
    }
    document.getElementById('support-chat-search-results') && document.getElementById('support-chat-search-results').addEventListener('click', function(e) {
        var btn = e.target.closest('.support-search-user');
        if (!btn || !btn.dataset.id) return;
        var thread = { id: btn.dataset.id, name: btn.dataset.name || '', email: btn.dataset.email || '', avatar: btn.dataset.avatar || '', needs_human: false, last_seen_at: btn.dataset.lastSeen || '', is_online: btn.dataset.online === '1' };
        var list = window._supportThreadsList || [];
        var found = list.find(function(t) { return String(t.id) === String(thread.id); });
        if (!found) {
            list.unshift({ id: thread.id, name: thread.name, email: thread.email, avatar: thread.avatar, needs_human: false, last_seen_at: thread.last_seen_at, is_online: thread.is_online, last_message: null });
            window._supportThreadsList = list;
            renderThreadsList(list);
        }
        var unif = document.getElementById('support-chat-search-unified');
        if (unif) unif.value = '';
        document.getElementById('support-chat-search-results').classList.add('hidden');
        document.getElementById('support-chat-search-results').innerHTML = '';
        selectSupportThread(thread);
    });
    document.addEventListener('click', function(e) {
        var res = document.getElementById('support-chat-search-results');
        if (!res || res.classList.contains('hidden')) return;
        if (e.target.closest('#support-chat-search-unified') || e.target.closest('#support-chat-search-results')) return;
        res.classList.add('hidden');
    });
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('#support-threads-list .support-thread[data-thread-id]');
        if (!btn) return;
        var thread = { id: btn.getAttribute('data-thread-id'), name: btn.getAttribute('data-name') || '', email: btn.getAttribute('data-email') || '', avatar: btn.getAttribute('data-avatar') || '', needs_human: btn.getAttribute('data-needs-human') === '1', last_seen_at: btn.getAttribute('data-last-seen-at') || '', is_online: btn.getAttribute('data-is-online') === '1' };
        selectSupportThread(thread);
    });
    function selectSupportThread(thread) {
        var header = document.getElementById('support-chat-header');
        var formWrap = document.getElementById('support-chat-form-wrap');
        if (!header || !formWrap) return;
        document.querySelectorAll('.support-thread').forEach(function(b) { b.classList.remove('bg-slate-100', 'dark:bg-slate-700'); });
        var el = document.querySelector('.support-thread[data-thread-id="' + String(thread.id) + '"]');
        if (el) el.classList.add('bg-slate-100', 'dark:bg-slate-700');
        var replyThreadInput = document.getElementById('support-reply-thread-id');
        if (replyThreadInput) replyThreadInput.value = thread.id;
        header.classList.remove('hidden');
        window._supportChatCurrentThreadId = thread.id;
        window._supportChatNeedsHuman = thread.needs_human || false;
        var enableBotWrap = document.getElementById('support-chat-enable-bot-wrap');
        if (enableBotWrap) { enableBotWrap.style.display = (thread.needs_human ? 'block' : 'none'); }
        var disableBotWrap = document.getElementById('support-chat-disable-bot-wrap');
        if (disableBotWrap) { disableBotWrap.style.display = (!thread.needs_human ? 'block' : 'none'); }
        var nameEl = document.getElementById('support-chat-name');
        var emailEl = document.getElementById('support-chat-email');
        var statusEl = document.getElementById('support-chat-status');
        if (nameEl) nameEl.textContent = thread.name || '';
        if (emailEl) emailEl.textContent = thread.email || '';
        if (statusEl) statusEl.textContent = thread.is_online ? 'онлайн' : (thread.last_seen_at ? formatLastSeen(thread.last_seen_at, false) : '');
        var av = document.getElementById('support-chat-avatar');
        if (av) av.src = thread.avatar ? '{{ asset("storage") }}/' + thread.avatar : 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22 fill=%22%2394a3b8%22%3E%3Cpath d=%22M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z%22/%3E%3C/svg%3E';
        var placeholder = document.getElementById('support-chat-placeholder');
        if (placeholder) placeholder.classList.add('hidden');
        formWrap.classList.remove('hidden');
        loadSupportMessages(thread.id);
        startSupportMessagesPoll();
    }
    var supportThreadsPollTimer;
    var supportMessagesPollTimer;
    function startSupportThreadsPoll() {
        if (supportThreadsPollTimer) return;
        supportThreadsPollTimer = setInterval(function() {
            loadSupportThreads().then(function() {
                var tid = window._supportChatCurrentThreadId;
                if (tid) {
                    var list = window._supportThreadsList || [];
                    var t = list.find(function(x) { return String(x.id) === String(tid); });
                    var sel = document.getElementById('support-chat-status');
                    if (t && sel) sel.textContent = t.is_online ? 'онлайн' : (t.last_seen_at ? formatLastSeen(t.last_seen_at, false) : '');
                }
            });
        }, 20000);
    }
    function startSupportMessagesPoll() {
        if (supportMessagesPollTimer) clearInterval(supportMessagesPollTimer);
        supportMessagesPollTimer = setInterval(function() {
            var tid = window._supportChatCurrentThreadId;
            if (tid) loadSupportMessages(tid);
        }, 4000);
    }
    function stopSupportMessagesPoll() {
        if (supportMessagesPollTimer) { clearInterval(supportMessagesPollTimer); supportMessagesPollTimer = null; }
    }
    if (isStandalone) {
        document.getElementById('support-chat-avatar-btn') && document.getElementById('support-chat-avatar-btn').addEventListener('click', function() { window.location.href = adminMessagesUrl; });
    }
    document.getElementById('support-chat-enable-bot-btn') && document.getElementById('support-chat-enable-bot-btn').addEventListener('click', function() {
        var threadId = window._supportChatCurrentThreadId;
        if (!threadId) return;
        fetch('{{ route("support.chat.enable-bot") }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json', 'Accept': 'application/json' }, body: JSON.stringify({ thread_id: parseInt(threadId, 10), _token: csrfToken }) })
            .then(function(r) { return r.json(); }).then(function(res) {
                if (res.success) { window._supportChatNeedsHuman = false; document.getElementById('support-chat-enable-bot-wrap').style.display = 'none'; document.getElementById('support-chat-disable-bot-wrap').style.display = 'block'; loadSupportThreads(); }
            });
    });
    document.getElementById('support-chat-disable-bot-btn') && document.getElementById('support-chat-disable-bot-btn').addEventListener('click', function() {
        var threadId = window._supportChatCurrentThreadId;
        if (!threadId) return;
        fetch('{{ route("support.chat.disable-bot") }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json', 'Accept': 'application/json' }, body: JSON.stringify({ thread_id: parseInt(threadId, 10), _token: csrfToken }) })
            .then(function(r) { return r.json(); }).then(function(res) {
                if (res.success) { window._supportChatNeedsHuman = true; document.getElementById('support-chat-disable-bot-wrap').style.display = 'none'; document.getElementById('support-chat-enable-bot-wrap').style.display = 'block'; loadSupportThreads(); }
            });
    });
    function loadSupportMessages(threadId) {
        var wrap = document.getElementById('support-chat-messages');
        var placeholder = document.getElementById('support-chat-placeholder');
        if (!wrap) return;
        wrap.querySelectorAll('.support-msg-item').forEach(function(n) { n.remove(); });
        fetch('{{ route("support.chat.messages") }}?thread_id=' + encodeURIComponent(threadId), { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
            .then(function(r) { return r.json(); })
            .then(function(messages) {
                if (!Array.isArray(messages)) return;
                placeholder.classList.add('hidden');
                var BTN_DELIM = '\n__BTN__\n';
                messages.forEach(function(m) {
                    var div = document.createElement('div');
                    div.className = 'support-msg-item flex gap-2 ' + (m.user && (m.user.role === 'admin' || m.user.role === 'moderator') ? 'flex-row-reverse' : '');
                    var avatarSrc = (m.user && m.user.avatar) ? storageUrl(m.user.avatar) : '';
                    var imgUrl = (m.image_url || '') || (m.image_path ? storageUrl(m.image_path) : '');
                    var name = (m.user && m.user.name) ? m.user.name : (m.is_system ? 'Поддержка (бот)' : 'Пользователь');
                    var time = m.created_at ? new Date(m.created_at).toLocaleString('ru-RU', { day: '2-digit', month: '2-digit', hour: '2-digit', minute: '2-digit' }) : '';
                    var msgRaw = (m.message && m.message.toString()) || '';
                    var displayText = msgRaw;
                    var buttons = [];
                    if (msgRaw.indexOf(BTN_DELIM) !== -1) { var parts = msgRaw.split(BTN_DELIM); displayText = parts[0] || ''; try { if (parts[1]) buttons = JSON.parse(parts[1]); } catch (e) {} }
                    var msgContent = displayText ? ('<p class="mt-1 whitespace-pre-wrap">' + displayText.replace(/</g, '&lt;').replace(/>/g, '&gt;') + '</p>') : '';
                    if (Array.isArray(buttons) && buttons.length > 0) {
                        msgContent += '<div class="mt-2 flex flex-wrap gap-1.5">' + buttons.map(function(b) {
                            var lbl = (b && b.label) ? (b.label + '').replace(/</g, '&lt;').replace(/>/g, '&gt;') : '';
                            return '<span class="inline-block px-2 py-1 rounded text-xs bg-white/20 dark:bg-black/20">' + lbl + '</span>';
                        }).join('') + '</div>';
                    }
                    var imgBlock = imgUrl ? '<a href="' + imgUrl + '" target="_blank" rel="noopener" class="admin2-msg-img-thumb block mt-2 rounded overflow-hidden border border-slate-200 dark:border-slate-600" data-full="' + imgUrl + '"><img src="' + imgUrl + '" alt="Фото" class="rounded max-h-32 w-auto object-cover cursor-pointer"></a>' : '';
                    var fileUrl = (m.file_url || '') || (m.file_path ? storageUrl(m.file_path) : '');
                    var fileBlock = fileUrl ? '<a href="' + fileUrl + '" target="_blank" rel="noopener" class="block mt-2 text-sm underline opacity-90">📎 ' + (m.file_name || 'Файл').replace(/</g, '&lt;') + '</a>' : '';
                    var msgHtml = '<div class="max-w-[80%] rounded-lg px-3 py-2 ' + (m.user && (m.user.role === 'admin' || m.user.role === 'moderator') ? 'bg-primary text-white' : 'bg-slate-200 dark:bg-slate-600 text-slate-900 dark:text-slate-100') + '">' +
                        '<p class="font-medium text-sm">' + (name || '').replace(/</g, '&lt;').replace(/>/g, '&gt;') + '</p>' +
                        '<p class="text-xs opacity-80">' + time + '</p>' + msgContent + imgBlock + fileBlock +
                        (m.is_system ? ' <span class="text-xs opacity-75">(автоответ)</span>' : '') + '</div>';
                    div.innerHTML = '<img src="' + (avatarSrc || 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22 fill=%22%2394a3b8%22%3E%3Cpath d=%22M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z%22/%3E%3C/svg%3E') + '" alt="" class="w-8 h-8 rounded-full object-cover flex-shrink-0" onerror="this.src=\'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22 fill=%22%2394a3b8%22%3E%3Cpath d=%22M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z%22/%3E%3C/svg%3E\'">' + msgHtml;
                    wrap.appendChild(div);
                });
                wrap.scrollTop = wrap.scrollHeight;
                setTimeout(function() { wrap.scrollTop = wrap.scrollHeight; }, 50);
            });
    }
    var replyImg = document.getElementById('support-reply-image');
    var replyPreviewWrap = document.getElementById('support-reply-preview-wrap');
    var replyPreviewImg = document.getElementById('support-reply-preview-img');
    var replyPreviewRemove = document.getElementById('support-reply-preview-remove');
    if (replyImg) replyImg.addEventListener('change', function() {
        var f = this.files && this.files[0];
        if (f && f.type.indexOf('image') !== -1) { var url = URL.createObjectURL(f); if (replyPreviewImg) replyPreviewImg.src = url; if (replyPreviewWrap) replyPreviewWrap.classList.remove('hidden'); }
        else if (replyPreviewWrap) replyPreviewWrap.classList.add('hidden');
    });
    if (replyPreviewRemove) replyPreviewRemove.addEventListener('click', function() { if (replyImg) replyImg.value = ''; if (replyPreviewImg) replyPreviewImg.src = ''; if (replyPreviewWrap) replyPreviewWrap.classList.add('hidden'); });
    var supportReplyText = document.getElementById('support-reply-text');
    if (supportReplyText) supportReplyText.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); var f = document.getElementById('support-reply-form'); if (f) f.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true })); }
    });
    document.addEventListener('submit', function(e) {
        if (e.target.id !== 'support-reply-form') return;
        e.preventDefault();
        var threadId = document.getElementById('support-reply-thread-id') && document.getElementById('support-reply-thread-id').value;
        if (!threadId) return;
        var fd = new FormData(e.target);
        fd.set('thread_id', threadId);
        fd.append('_token', csrfToken);
        fetch('{{ route("support.chat.reply") }}', { method: 'POST', body: fd, headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' } })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.success && data.message) {
                    var m = data.message;
                    var wrap = document.getElementById('support-chat-messages');
                    var div = document.createElement('div');
                    div.className = 'support-msg-item flex gap-2 flex-row-reverse';
                    var avatarSrc = (m.user && m.user.avatar) ? storageUrl(m.user.avatar) : '';
                    var imgSrc = (m.image_path ? storageUrl(m.image_path) : '') || (m.image_url || '');
                    var fileUrl = (m.file_path ? storageUrl(m.file_path) : '') || (m.file_url || '');
                    var fileBlock = fileUrl ? '<a href="' + fileUrl + '" target="_blank" rel="noopener" class="block mt-2 text-sm underline opacity-90">📎 ' + (m.file_name || 'Файл').replace(/</g, '&lt;') + '</a>' : '';
                    var time = m.created_at ? new Date(m.created_at).toLocaleString('ru-RU', { day: '2-digit', month: '2-digit', hour: '2-digit', minute: '2-digit' }) : '';
                    var imgBlock = imgSrc ? '<a href="' + imgSrc + '" target="_blank" rel="noopener" class="admin2-msg-img-thumb block mt-2 rounded overflow-hidden border border-white/20"><img src="' + imgSrc + '" alt="Фото" class="rounded max-h-32 w-auto object-cover"></a>' : '';
                    div.innerHTML = '<img src="' + (avatarSrc || '') + '" alt="" class="w-8 h-8 rounded-full object-cover flex-shrink-0" onerror="this.style.display=\'none\'">' +
                        '<div class="max-w-[80%] rounded-lg px-3 py-2 bg-primary text-white"><p class="font-medium text-sm">' + (m.user && m.user.name ? m.user.name.replace(/</g, '&lt;') : '') + '</p><p class="text-xs opacity-80">' + time + '</p>' + (m.message ? '<p class="mt-1">' + (m.message + '').replace(/</g, '&lt;') + '</p>' : '') + imgBlock + fileBlock + '</div>';
                    if (wrap) { wrap.appendChild(div); wrap.scrollTop = wrap.scrollHeight; }
                    var replyText = document.getElementById('support-reply-text');
                    var replyFile = document.getElementById('support-reply-file');
                    if (replyText) replyText.value = '';
                    if (replyImg) replyImg.value = '';
                    if (replyFile) replyFile.value = '';
                    if (replyPreviewWrap) replyPreviewWrap.classList.add('hidden');
                    if (replyPreviewImg) replyPreviewImg.src = '';
                }
            });
    });
    var lb = document.getElementById('admin2-msg-lightbox');
    var lbImg = document.getElementById('admin2-msg-lightbox-img');
    var lbClose = document.getElementById('admin2-msg-lightbox-close');
    document.addEventListener('click', function(e) {
        var a = e.target.closest && e.target.closest('.admin2-msg-img-thumb');
        if (!a) return;
        e.preventDefault(); e.stopPropagation();
        var src = (a.dataset && a.dataset.full) || a.getAttribute('href') || (a.querySelector('img') && a.querySelector('img').src);
        if (lbImg && src) { lbImg.src = src; }
        if (lb) { lb.classList.remove('hidden'); lb.style.display = 'flex'; }
    });
    if (lbClose) lbClose.addEventListener('click', function() { if (lb) { lb.classList.add('hidden'); lb.style.display = 'none'; } });
    if (lb) lb.addEventListener('click', function(e) { if (e.target === lb) { lb.classList.add('hidden'); lb.style.display = 'none'; } });

    if (isStandalone) {
        loadSupportThreads();
        startSupportThreadsPoll();
    }
})();
</script>
