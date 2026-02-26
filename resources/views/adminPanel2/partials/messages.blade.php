<style>
    .admin2-support-chat-layout { height: calc(100vh - 12rem); min-height: 420px; }
    .admin2-support-chat-right { display: flex; flex-direction: column; min-height: 0; }
    #support-chat-messages { overflow-y: auto; overflow-x: hidden; -webkit-overflow-scrolling: touch; }
    #support-chat-messages:not(:empty) { display: flex; flex-direction: column; align-items: flex-start; }
    #support-chat-messages .support-msg-item { width: 100%; max-width: 100%; }

    /* Красивый скролл — чат и списки */
    #support-chat-messages,
    #support-threads-list,
    #support-chat-search-results,
    .admin2-chat-scroll {
        scrollbar-width: thin;
        scrollbar-color: #94a3b8 #e2e8f0;
    }
    #support-chat-messages::-webkit-scrollbar,
    #support-threads-list::-webkit-scrollbar,
    #support-chat-search-results::-webkit-scrollbar,
    .admin2-chat-scroll::-webkit-scrollbar {
        width: 8px;
    }
    #support-chat-messages::-webkit-scrollbar-track,
    #support-threads-list::-webkit-scrollbar-track,
    #support-chat-search-results::-webkit-scrollbar-track,
    .admin2-chat-scroll::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    #support-chat-messages::-webkit-scrollbar-thumb,
    #support-threads-list::-webkit-scrollbar-thumb,
    #support-chat-search-results::-webkit-scrollbar-thumb,
    .admin2-chat-scroll::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #94a3b8, #64748b);
        border-radius: 4px;
    }
    #support-chat-messages::-webkit-scrollbar-thumb:hover,
    #support-threads-list::-webkit-scrollbar-thumb:hover,
    #support-chat-search-results::-webkit-scrollbar-thumb:hover,
    .admin2-chat-scroll::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, #64748b, #475569);
    }
    [data-theme="dark"] #support-chat-messages,
    [data-theme="dark"] #support-threads-list,
    [data-theme="dark"] #support-chat-search-results {
        scrollbar-color: #475569 #334155;
    }
    [data-theme="dark"] #support-chat-messages::-webkit-scrollbar-track,
    [data-theme="dark"] #support-threads-list::-webkit-scrollbar-track,
    [data-theme="dark"] #support-chat-search-results::-webkit-scrollbar-track {
        background: #334155;
    }
    [data-theme="dark"] #support-chat-messages::-webkit-scrollbar-thumb,
    [data-theme="dark"] #support-threads-list::-webkit-scrollbar-thumb,
    [data-theme="dark"] #support-chat-search-results::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #64748b, #475569);
    }
    [data-theme="dark"] #support-chat-messages::-webkit-scrollbar-thumb:hover,
    [data-theme="dark"] #support-threads-list::-webkit-scrollbar-thumb:hover,
    [data-theme="dark"] #support-chat-search-results::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, #475569, #374151);
    }
</style>
<div class="admin2-card rounded-xl shadow-sm overflow-hidden">
    <div class="px-5 py-4 border-b border-slate-200 dark:border-slate-600 flex flex-wrap items-center justify-between gap-2">
        <div class="flex items-center gap-2">
            <button type="button" id="msg-tab-admin" class="msg-tab px-4 py-2 rounded-lg font-medium transition bg-slate-200 dark:bg-slate-600 text-slate-700 dark:text-slate-300 hover:bg-slate-300 dark:hover:bg-slate-500">
                Чат с админами
            </button>
            <button type="button" id="msg-tab-users" class="msg-tab px-4 py-2 rounded-lg font-medium transition msg-tab-active bg-primary text-white">
                Чат с пользователями
            </button>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('switch.to.mobile') }}" class="text-sm text-sky-600 dark:text-sky-400 hover:underline">Мобильная версия</a>
            <a href="{{ route('adminPanel2.export.messages') }}" class="text-sm text-green-600 dark:text-green-400 hover:underline">Скачать в Excel</a>
        </div>
    </div>

    {{-- Вкладка: Чат с админами --}}
    <div id="msg-panel-admin" class="msg-panel hidden">
        <div class="admin2-chat-scroll divide-y divide-slate-200 dark:divide-slate-600 max-h-[70vh] overflow-y-auto">
            @forelse($messagesList as $msg)
            <div class="px-5 py-4 hover:bg-slate-50 dark:hover:bg-slate-800/30">
                <div class="flex items-start justify-between gap-2">
                    <div class="flex-1 min-w-0">
                        <p class="font-medium">{{ $msg->user->name ?? 'Система' }}</p>
                        <p class="admin2-text-muted text-sm mt-0.5">{{ $msg->created_at?->format('d.m.Y H:i') ?? '' }}</p>
                        <p class="mt-2 text-sm whitespace-pre-wrap">{{ $msg->message ?? '—' }}</p>
                        @if($msg->image_path ?? null)
                            <a href="{{ asset('storage/' . $msg->image_path) }}" target="_blank" rel="noopener" class="admin2-msg-img-thumb inline-block mt-2 rounded border border-slate-200 dark:border-slate-600 overflow-hidden" data-full="{{ asset('storage/' . $msg->image_path) }}">
                                <img src="{{ asset('storage/' . $msg->image_path) }}" alt="Фото" class="h-20 w-auto max-w-[120px] object-cover">
                            </a>
                        @endif
                    </div>
                    @if($msg->is_system ?? false)
                        <span class="px-2 py-0.5 rounded text-xs bg-slate-200 dark:bg-slate-600 admin2-text-muted">Системное</span>
                    @endif
                </div>
            </div>
            @empty
            <div class="px-5 py-12 admin2-text-muted text-center">Нет сообщений</div>
            @endforelse
        </div>
    </div>

    {{-- Вкладка: Чат с пользователями --}}
    <div id="msg-panel-users" class="msg-panel">
        <div class="flex flex-col md:flex-row admin2-support-chat-layout">
            <div class="w-full md:w-80 border-r border-slate-200 dark:border-slate-600 flex flex-col flex-shrink-0">
                <div class="p-2 border-b border-slate-200 dark:border-slate-600">
                    <div class="relative">
                        <input type="text" id="support-chat-search-unified" placeholder="Поиск по чатам или напишите пользователю (имя, email)" class="w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 px-3 py-2 text-sm placeholder-slate-500 dark:placeholder-slate-400" autocomplete="off">
                        <div id="support-chat-search-results" class="hidden absolute top-full left-0 right-0 mt-1 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-600 rounded-lg shadow-lg z-50 max-h-60 overflow-y-auto"></div>
                    </div>
                </div>
                <div id="support-threads-list" class="flex-1 overflow-y-auto divide-y divide-slate-200 dark:divide-slate-600 min-h-0">
                    @foreach($supportThreads ?? [] as $u)
                    <div class="support-thread-row flex items-center w-full border-b border-slate-200 dark:border-slate-600 last:border-0">
                        <button type="button" class="support-thread flex-1 min-w-0 text-left px-4 py-3 hover:bg-slate-100 dark:hover:bg-slate-800/50 flex items-center gap-3 {{ $u->needs_human ? ' bg-amber-50 dark:bg-amber-900/20 border-l-4 border-amber-500' : '' }}" data-thread-id="{{ $u->id }}" data-name="{{ e($u->name) }}" data-email="{{ e($u->email ?? '') }}" data-avatar="{{ $u->avatar ?? '' }}" data-needs-human="{{ $u->needs_human ? '1' : '0' }}" data-last-seen-at="" data-is-online="0">
                            <img src="{{ $u->avatar ? asset('storage/' . $u->avatar) : 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22 fill=%22%2394a3b8%22%3E%3Cpath d=%22M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z%22/%3E%3C/svg%3E' }}" alt="" class="w-10 h-10 rounded-full object-cover bg-slate-200 dark:bg-slate-600 flex-shrink-0">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2">
                                    <p class="font-medium truncate">{{ $u->name }}</p>
                                    @if($u->last_support_message ?? null)
                                    <span class="text-xs admin2-text-muted flex-shrink-0">{{ $u->last_support_message->created_at?->format('d.m H:i') }}</span>
                                    @endif
                                </div>
                                @if($u->last_support_message ?? null)
                                <p class="text-xs admin2-text-muted truncate">{{ Str::limit($u->last_support_message->message, 35) }}</p>
                                @endif
                                @if($u->needs_human ?? false)
                                <span class="inline-block mt-1 text-xs text-amber-600 dark:text-amber-400">Нужен оператор</span>
                                @endif
                            </div>
                        </button>
                        <button type="button" class="support-thread-menu p-2 rounded hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-500 dark:text-slate-400 flex-shrink-0" title="Меню" data-thread-id="{{ $u->id }}">&#8942;</button>
                    </div>
                    @endforeach
                    <div id="support-threads-empty" class="px-4 py-8 admin2-text-muted text-center text-sm {{ ($supportThreads ?? collect())->isNotEmpty() ? 'hidden' : '' }}">Нет диалогов поддержки</div>
                </div>
            </div>
            <div class="flex-1 flex flex-col min-h-0 admin2-support-chat-right">
                <div id="support-chat-header" class="p-3 border-b border-slate-200 dark:border-slate-600 hidden flex-shrink-0">
                    <div class="flex items-center gap-3">
                        <button type="button" id="support-chat-avatar-btn" class="flex-shrink-0 rounded-full overflow-hidden focus:ring-2 focus:ring-primary focus:ring-offset-2" title="Открыть профиль">
                            <img id="support-chat-avatar" src="" alt="" class="w-10 h-10 rounded-full object-cover bg-slate-200 block">
                        </button>
                        <div>
                            <p id="support-chat-name" class="font-medium"></p>
                            <p id="support-chat-email" class="text-xs admin2-text-muted"></p>
                            <p id="support-chat-status" class="text-xs admin2-text-muted mt-0.5"></p>
                        </div>
                        <button type="button" id="support-chat-profile-btn" class="ml-auto text-sm text-primary hover:underline">Профиль</button>
                    </div>
                    <div id="support-chat-enable-bot-wrap" style="display:none;" class="mt-2 pt-2 border-t border-slate-200 dark:border-slate-600">
                        <button type="button" id="support-chat-enable-bot-btn" class="px-3 py-1.5 rounded-lg bg-amber-500/20 text-amber-700 dark:text-amber-400 text-sm font-medium hover:bg-amber-500/30">Включить бота</button>
                    </div>
                    <div id="support-chat-disable-bot-wrap" style="display:none;" class="mt-2 pt-2 border-t border-slate-200 dark:border-slate-600">
                        <button type="button" id="support-chat-disable-bot-btn" class="px-3 py-1.5 rounded-lg bg-slate-200 dark:bg-slate-600 text-slate-700 dark:text-slate-300 text-sm font-medium hover:bg-slate-300 dark:hover:bg-slate-500">Выключить бота</button>
                    </div>
                </div>
                <div id="support-chat-messages" class="flex-1 overflow-y-auto p-4 space-y-3 min-h-0">
                    <div id="support-chat-placeholder" class="admin2-text-muted text-center py-12">Выберите пользователя слева</div>
                </div>
                <div id="support-chat-form-wrap" class="p-3 border-t border-slate-200 dark:border-slate-600 hidden flex-shrink-0 admin2-support-chat-form">
                    <form id="support-reply-form" class="flex flex-col gap-2" enctype="multipart/form-data">
                        <input type="hidden" name="thread_id" id="support-reply-thread-id" value="">
                        <div class="flex gap-2 items-end flex-wrap">
                            <div class="flex-1 min-w-0">
                                <textarea name="message" id="support-reply-text" rows="2" class="support-reply-textarea w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-transparent text-slate-900 dark:text-slate-100 placeholder-slate-500 dark:placeholder-slate-400 resize-none overflow-hidden" style="min-height: 2.5rem; max-height: 12rem;" placeholder="Сообщение..."></textarea>
                            </div>
                            <label class="admin2-support-reply-file-label flex-shrink-0 w-10 h-10 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 flex items-center justify-center cursor-pointer text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-600 transition-colors" title="Прикрепить фото">
                                <input type="file" name="image" id="support-reply-image" accept="image/jpeg,image/png,image/gif,image/jpg,image/webp" class="hidden">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                            </label>
                            <label class="admin2-support-reply-file-label flex-shrink-0 w-10 h-10 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 flex items-center justify-center cursor-pointer text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-600 transition-colors" title="Прикрепить файл">
                                <input type="file" name="file" id="support-reply-file" accept="video/*,.pdf,application/*" class="hidden">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg>
                            </label>
                            <button type="submit" class="px-4 py-2 rounded-lg bg-primary text-white font-medium hover:bg-blue-700 flex-shrink-0">Отправить</button>
                        </div>
                        <div id="support-reply-preview-wrap" class="hidden relative inline-block">
                            <img id="support-reply-preview-img" src="" alt="" class="rounded-lg max-h-20 object-cover border border-slate-200 dark:border-slate-600">
                            <button type="button" id="support-reply-preview-remove" class="absolute -top-1 -right-1 w-6 h-6 rounded-full bg-slate-500 hover:bg-slate-600 text-white text-sm flex items-center justify-center leading-none shadow" title="Убрать фото">&times;</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Контекстное меню сообщения (удалить / редактировать) --}}
<div id="support-msg-context-menu" class="fixed z-[60] hidden min-w-[140px] py-1 rounded-lg shadow-lg border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800" style="left:0;top:0;">
    <button type="button" id="support-msg-ctx-edit" class="block w-full text-left px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700">Редактировать</button>
    <button type="button" id="support-msg-ctx-delete" class="block w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-slate-100 dark:hover:bg-slate-700">Удалить</button>
</div>
{{-- Лайтбокс для увеличения фото: закрыть, скачать --}}
<div id="admin2-msg-lightbox" class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4 hidden">
    <button type="button" id="admin2-msg-lightbox-close" class="absolute top-4 right-4 w-10 h-10 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white" title="Закрыть">&times;</button>
    <a id="admin2-msg-lightbox-download" href="#" download class="absolute top-4 right-16 w-10 h-10 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white" title="Скачать">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
    </a>
    <img id="admin2-msg-lightbox-img" src="" alt="" class="max-w-full max-h-[90vh] object-contain">
</div>

@push('scripts')
<script>
(function() {
    var csrf = document.querySelector('meta[name="csrf-token"]');
    var csrfToken = csrf ? csrf.getAttribute('content') : '';
    window._supportChatSelectUserId = @json(request()->get('user_id') ? (int)request()->get('user_id') : null);

    // Табы
    var msgTabAdmin = document.getElementById('msg-tab-admin');
    var msgTabUsers = document.getElementById('msg-tab-users');
    if (msgTabAdmin) msgTabAdmin.addEventListener('click', function() {
        document.querySelectorAll('.msg-tab').forEach(function(t) { t.classList.remove('msg-tab-active', 'bg-primary', 'text-white'); t.classList.add('bg-slate-200', 'dark:bg-slate-600'); });
        this.classList.add('msg-tab-active', 'bg-primary', 'text-white'); this.classList.remove('bg-slate-200', 'dark:bg-slate-600');
        var pAdmin = document.getElementById('msg-panel-admin'); var pUsers = document.getElementById('msg-panel-users');
        if (pAdmin) pAdmin.classList.remove('hidden'); if (pUsers) pUsers.classList.add('hidden');
    });
    if (msgTabUsers) msgTabUsers.addEventListener('click', function() {
        document.querySelectorAll('.msg-tab').forEach(function(t) { t.classList.remove('msg-tab-active', 'bg-primary', 'text-white'); t.classList.add('bg-slate-200', 'dark:bg-slate-600'); });
        this.classList.add('msg-tab-active', 'bg-primary', 'text-white'); this.classList.remove('bg-slate-200', 'dark:bg-slate-600');
        var pAdmin = document.getElementById('msg-panel-admin'); var pUsers = document.getElementById('msg-panel-users');
        if (pAdmin) pAdmin.classList.add('hidden'); if (pUsers) pUsers.classList.remove('hidden');
        loadSupportThreads();
    });
    var pUsersInit = document.getElementById('msg-panel-users');
    if (pUsersInit && !pUsersInit.classList.contains('hidden')) loadSupportThreads();

    function formatLastSeen(lastSeenAt, isOnline) {
        if (isOnline) return 'онлайн';
        if (!lastSeenAt) return '';
        try {
            var d = new Date(lastSeenAt);
            return 'был(а) в сети ' + d.toLocaleDateString('ru-RU', { day: '2-digit', month: '2-digit' }) + ', ' + d.toLocaleTimeString('ru-RU', { hour: '2-digit', minute: '2-digit' });
        } catch (e) { return ''; }
    }
    function formatThreadTime(createdAt) {
        if (!createdAt) return '';
        try {
            var d = new Date(createdAt);
            var now = new Date();
            var diff = now - d;
            if (diff < 60000) return 'сейчас';
            if (d.toDateString() === now.toDateString()) return d.toLocaleTimeString('ru-RU', { hour: '2-digit', minute: '2-digit' });
            if (diff < 86400000 * 2 && d.getDate() === now.getDate() - 1) return 'вчера ' + d.toLocaleTimeString('ru-RU', { hour: '2-digit', minute: '2-digit' });
            return d.toLocaleDateString('ru-RU', { day: '2-digit', month: '2-digit' }) + ' ' + d.toLocaleTimeString('ru-RU', { hour: '2-digit', minute: '2-digit' });
        } catch (e) { return ''; }
    }
    function renderThreadsList(threads) {
        var list = document.getElementById('support-threads-list');
        var empty = document.getElementById('support-threads-empty');
        if (!list) return;
        Array.from(list.children).forEach(function(el) { if (el.id !== 'support-threads-empty') el.remove(); });
        if (threads.length === 0) {
            empty.classList.remove('hidden');
            return;
        }
        empty.classList.add('hidden');
        var defaultAvatar = 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22 fill=%22%2394a3b8%22%3E%3Cpath d=%22M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z%22/%3E%3C/svg%3E';
        threads.forEach(function(t) {
            var row = document.createElement('div');
            row.className = 'support-thread-row flex items-center w-full border-b border-slate-200 dark:border-slate-600 last:border-0' + (t.pinned ? ' bg-slate-50 dark:bg-slate-800/30' : '');
            var btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'support-thread flex-1 min-w-0 text-left px-4 py-3 hover:bg-slate-100 dark:hover:bg-slate-800/50 flex items-center gap-3' + (t.needs_human ? ' bg-amber-50 dark:bg-amber-900/20 border-l-4 border-amber-500' : '');
            btn.dataset.threadId = t.id;
            btn.dataset.name = t.name || '';
            btn.dataset.email = t.email || '';
            btn.dataset.avatar = t.avatar || '';
            btn.dataset.needsHuman = t.needs_human ? '1' : '0';
            btn.dataset.lastSeenAt = t.last_seen_at || '';
            btn.dataset.isOnline = t.is_online ? '1' : '0';
            var avatarUrl = t.avatar ? '{{ asset("storage") }}/' + t.avatar : defaultAvatar;
            var timeStr = formatThreadTime(t.last_message && t.last_message.created_at ? t.last_message.created_at : null);
            var statusText = t.is_online ? '<span class="text-green-600 dark:text-green-400 text-xs">онлайн</span>' : (t.last_seen_at ? '<span class="text-xs admin2-text-muted">' + formatLastSeen(t.last_seen_at, false) + '</span>' : '');
            var lastMsgRaw = (t.last_message && t.last_message.message) ? (t.last_message.message + '') : '';
            if (lastMsgRaw.indexOf('\n__BTN__\n') !== -1) lastMsgRaw = lastMsgRaw.split('\n__BTN__\n')[0];
            var lastMsg = lastMsgRaw.substring(0, 35);
            var unreadBadge = (t.unread_count > 0) ? '<span class="support-thread-unread flex-shrink-0 w-5 h-5 rounded-full bg-red-500 text-white text-xs flex items-center justify-center font-medium">' + (t.unread_count > 99 ? '99+' : t.unread_count) + '</span>' : '';
            btn.innerHTML = '<img src="' + avatarUrl + '" alt="" class="w-10 h-10 rounded-full object-cover bg-slate-200 dark:bg-slate-600 flex-shrink-0" onerror="this.src=\'' + defaultAvatar + '\'">' +
                '<div class="flex-1 min-w-0"><div class="flex items-center justify-between gap-2"><p class="font-medium truncate">' + (t.name || '') + '</p>' + (timeStr ? '<span class="text-xs admin2-text-muted flex-shrink-0">' + timeStr + '</span>' : '') + '</div>' +
                (lastMsg ? '<p class="text-xs admin2-text-muted truncate">' + lastMsg.replace(/</g, '&lt;') + '</p>' : '') +
                (statusText ? '<p class="mt-0.5">' + statusText + '</p>' : '') +
                (t.needs_human ? '<span class="inline-block mt-1 text-xs text-amber-600 dark:text-amber-400">Нужен оператор</span>' : '') + '</div>' + unreadBadge;
            row.appendChild(btn);
            if (t.pinned) {
                var pinEl = document.createElement('span');
                pinEl.className = 'support-thread-pin flex-shrink-0 text-slate-500 dark:text-slate-400 px-1';
                pinEl.title = 'Закреплён';
                pinEl.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M16 12V4h1V2H7v2h1v8l-2 2v2h5.2v6h1.6v-6H18v-2l-2-2z"/></svg>';
                row.appendChild(pinEl);
            }
            var menuBtn = document.createElement('button');
            menuBtn.type = 'button';
            menuBtn.className = 'support-thread-menu p-2 rounded hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-500 dark:text-slate-400 flex-shrink-0';
            menuBtn.title = 'Меню';
            menuBtn.innerHTML = '&#8942;';
            menuBtn.dataset.threadId = t.id;
            row.appendChild(menuBtn);
            list.insertBefore(row, empty);
        });
    }
    function loadSupportThreads() {
        return fetch('{{ route("support.chat.threads") }}', { headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' } })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.error) return;
                var threads = (data.threads && Array.isArray(data.threads)) ? data.threads : (Array.isArray(data) ? data : []);
                window._supportThreadsList = threads;
                var badge = document.getElementById('support-unread-badge');
                if (badge) {
                    var count = data.unread_chats_count != null ? data.unread_chats_count : 0;
                    badge.textContent = count;
                    if (count > 0) badge.classList.remove('hidden'); else badge.classList.add('hidden');
                }
                var unifiedInput = document.getElementById('support-chat-search-unified');
                var searchQ = (unifiedInput && unifiedInput.value || '').trim().toLowerCase();
                if (threads.length === 0 && !searchQ) return;
                var toShow = searchQ ? threads.filter(function(t) {
                    return (t.name || '').toLowerCase().indexOf(searchQ) !== -1 || (t.email || '').toLowerCase().indexOf(searchQ) !== -1;
                }) : threads;
                renderThreadsList(toShow);
                if (window._supportChatSelectUserId) {
                    var uid = window._supportChatSelectUserId;
                    window._supportChatSelectUserId = null;
                    var t = threads.find(function(x) { return String(x.id) === String(uid); });
                    if (t) selectSupportThread(t);
                }
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
        if (e.target.closest('.support-thread-menu')) return;
        var btn = e.target.closest('#support-threads-list .support-thread[data-thread-id]');
        if (!btn) return;
        var thread = { id: btn.getAttribute('data-thread-id'), name: btn.getAttribute('data-name') || '', email: btn.getAttribute('data-email') || '', avatar: btn.getAttribute('data-avatar') || '', needs_human: btn.getAttribute('data-needs-human') === '1', last_seen_at: btn.getAttribute('data-last-seen-at') || '', is_online: btn.getAttribute('data-is-online') === '1' };
        selectSupportThread(thread);
    });

    var threadMenuDropdown = null;
    document.getElementById('support-threads-list') && document.getElementById('support-threads-list').addEventListener('click', function(e) {
        var menuBtn = e.target.closest('.support-thread-menu');
        if (!menuBtn || !menuBtn.dataset.threadId) return;
        e.preventDefault();
        e.stopPropagation();
        var threadId = menuBtn.dataset.threadId;
        var list = window._supportThreadsList || [];
        var t = list.find(function(x) { return String(x.id) === String(threadId); });
        if (!t) return;
        if (threadMenuDropdown && threadMenuDropdown.dataset.threadId === threadId) {
            threadMenuDropdown.remove();
            threadMenuDropdown = null;
            return;
        }
        if (threadMenuDropdown) threadMenuDropdown.remove();
        var row = menuBtn.closest('.support-thread-row');
        var drop = document.createElement('div');
        drop.className = 'support-thread-dropdown absolute right-0 top-full mt-0.5 py-1 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-600 rounded-lg shadow-lg z-50 min-w-[160px]';
        drop.dataset.threadId = threadId;
        drop.addEventListener('click', function(e) { e.stopPropagation(); });
        if (row) { row.style.position = 'relative'; row.appendChild(drop); }
        else { list.style.position = 'relative'; list.appendChild(drop); }
        var pinLabel = t.pinned ? 'Открепить' : 'Закрепить';
        drop.innerHTML = '<button type="button" class="support-thread-action w-full text-left px-3 py-2 text-sm hover:bg-slate-100 dark:hover:bg-slate-700" data-action="profile">Открыть профиль</button>' +
            '<button type="button" class="support-thread-action w-full text-left px-3 py-2 text-sm hover:bg-slate-100 dark:hover:bg-slate-700" data-action="pin">' + pinLabel + '</button>' +
            '<button type="button" class="support-thread-action w-full text-left px-3 py-2 text-sm hover:bg-slate-100 dark:hover:bg-slate-700 text-red-600 dark:text-red-400" data-action="delete">Удалить</button>';
        threadMenuDropdown = drop;
        drop.querySelectorAll('.support-thread-action').forEach(function(act) {
            act.addEventListener('click', function(ev) {
                ev.stopPropagation();
                var action = this.dataset.action;
                if (action === 'profile') {
                    selectSupportThread({ id: t.id, name: t.name, email: t.email, avatar: t.avatar, needs_human: t.needs_human, last_seen_at: t.last_seen_at, is_online: t.is_online });
                    openSupportUserModal();
                } else if (action === 'pin') {
                    fetch('{{ route("support.chat.pin") }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json', 'Accept': 'application/json' }, body: JSON.stringify({ thread_id: parseInt(threadId, 10), pinned: !t.pinned, _token: csrfToken }) })
                        .then(function(r) { return r.json(); }).then(function(res) { if (res.success) loadSupportThreads(); });
                } else if (action === 'delete') {
                    if (!confirm('Удалить этот чат? Все сообщения будут удалены.')) { drop.remove(); threadMenuDropdown = null; return; }
                    fetch('{{ route("support.chat.delete-thread") }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json', 'Accept': 'application/json' }, body: JSON.stringify({ thread_id: parseInt(threadId, 10), _token: csrfToken }) })
                        .then(function(r) { return r.json(); }).then(function(res) {
                            if (res.success) {
                                if (window._supportChatCurrentThreadId === threadId) closeSupportChat();
                                var list = window._supportThreadsList || [];
                                window._supportThreadsList = list.filter(function(x) { return String(x.id) !== String(threadId); });
                                renderThreadsList(window._supportThreadsList);
                            }
                        });
                }
                drop.remove();
                threadMenuDropdown = null;
            });
        });
    });
    document.addEventListener('click', function() { if (threadMenuDropdown) { threadMenuDropdown.remove(); threadMenuDropdown = null; } });

    function closeSupportChat() {
        var header = document.getElementById('support-chat-header');
        var formWrap = document.getElementById('support-chat-form-wrap');
        var placeholder = document.getElementById('support-chat-placeholder');
        var messagesWrap = document.getElementById('support-chat-messages');
        var replyThreadInput = document.getElementById('support-reply-thread-id');
        if (header) header.classList.add('hidden');
        if (formWrap) formWrap.classList.add('hidden');
        if (placeholder) placeholder.classList.remove('hidden');
        if (messagesWrap) {
            messagesWrap.querySelectorAll('.support-msg-item').forEach(function(el) { el.remove(); });
        }
        var replyText = document.getElementById('support-reply-text');
        if (replyThreadInput && replyThreadInput.value && replyText) saveDraft(replyThreadInput.value, replyText.value);
        if (replyThreadInput) replyThreadInput.value = '';
        window._supportChatCurrentThreadId = null;
        document.querySelectorAll('.support-thread').forEach(function(b) { b.classList.remove('bg-slate-100', 'dark:bg-slate-700'); });
    }
    function draftKey(threadId) { return 'support_draft_' + (threadId || ''); }
    function saveDraft(threadId, text) {
        try { if (threadId) localStorage.setItem(draftKey(threadId), (text || '')); } catch (err) {}
    }
    function loadDraft(threadId) {
        try { return (threadId && localStorage.getItem(draftKey(threadId))) || ''; } catch (err) { return ''; }
    }
    function selectSupportThread(thread) {
        var header = document.getElementById('support-chat-header');
        var formWrap = document.getElementById('support-chat-form-wrap');
        var replyText = document.getElementById('support-reply-text');
        var replyThreadInput = document.getElementById('support-reply-thread-id');
        var currentId = (replyThreadInput && replyThreadInput.value) ? replyThreadInput.value : window._supportChatCurrentThreadId;
        if (currentId && replyText) saveDraft(currentId, replyText.value);
        if (!header || !formWrap) return;
        document.querySelectorAll('.support-thread').forEach(function(b) { b.classList.remove('bg-slate-100', 'dark:bg-slate-700'); });
        var el = document.querySelector('.support-thread[data-thread-id="' + String(thread.id) + '"]');
        if (el) el.classList.add('bg-slate-100', 'dark:bg-slate-700');
        if (replyThreadInput) replyThreadInput.value = thread.id;
        if (replyText) replyText.value = loadDraft(thread.id);
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
        fetch('{{ route("support.chat.mark-read") }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json', 'Accept': 'application/json' }, body: JSON.stringify({ thread_id: parseInt(thread.id, 10), _token: csrfToken }) })
            .then(function(r) { return r.json(); }).then(function(res) {
                var list = window._supportThreadsList || [];
                var idx = list.findIndex(function(x) { return String(x.id) === String(thread.id); });
                if (idx >= 0) { list[idx].unread_count = 0; window._supportThreadsList = list; }
                loadSupportThreads().then(function() {
                    var el = document.querySelector('.support-thread[data-thread-id="' + String(thread.id) + '"]');
                    if (el) { document.querySelectorAll('.support-thread').forEach(function(b) { b.classList.remove('bg-slate-100', 'dark:bg-slate-700'); }); el.classList.add('bg-slate-100', 'dark:bg-slate-700'); }
                });
            });
        loadSupportMessages(thread.id);
        startSupportMessagesPoll();
    }
    var supportThreadsPollTimer;
    var supportMessagesPollTimer;
    function startSupportThreadsPoll() {
        if (supportThreadsPollTimer) return;
        supportThreadsPollTimer = setInterval(function() {
            if (document.getElementById('msg-panel-users') && !document.getElementById('msg-panel-users').classList.contains('hidden')) {
                loadSupportThreads().then(function() {
                    var tid = window._supportChatCurrentThreadId;
                    if (tid) {
                        var list = window._supportThreadsList || [];
                        var t = list.find(function(x) { return String(x.id) === String(tid); });
                        var sel = document.getElementById('support-chat-status');
                        if (t && sel) sel.textContent = t.is_online ? 'онлайн' : (t.last_seen_at ? formatLastSeen(t.last_seen_at, false) : '');
                    }
                });
            }
        }, 20000);
    }
    function stopSupportThreadsPoll() { if (supportThreadsPollTimer) { clearInterval(supportThreadsPollTimer); supportThreadsPollTimer = null; } stopSupportMessagesPoll(); }
    function startSupportMessagesPoll() {
        if (supportMessagesPollTimer) clearInterval(supportMessagesPollTimer);
        supportMessagesPollTimer = setInterval(function() {
            var tid = window._supportChatCurrentThreadId;
            if (tid) loadSupportMessages(tid);
        }, 4000);
    }
    function stopSupportMessagesPoll() { if (supportMessagesPollTimer) { clearInterval(supportMessagesPollTimer); supportMessagesPollTimer = null; } }
    document.getElementById('msg-tab-users') && document.getElementById('msg-tab-users').addEventListener('click', function() { startSupportThreadsPoll(); });
    document.getElementById('msg-tab-admin') && document.getElementById('msg-tab-admin').addEventListener('click', function() { stopSupportThreadsPoll(); });
    function openSupportUserModal() {
        var id = window._supportChatCurrentThreadId;
        if (!id) return;
        fetch('{{ route("adminPanel2.user.profile", ["id" => "THREAD_ID"]) }}'.replace('THREAD_ID', id), { headers: { 'Accept': 'application/json' } })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (!data || data.error) return;
                openAdminUserModalByData({ userId: data.id, name: data.name, email: data.email, role: data.role, avatar: data.avatar, created: data.created_at, ordersCount: data.orders_count, orders: data.orders || [], reviews: data.reviews || [] });
            });
    }
    document.getElementById('support-chat-avatar-btn') && document.getElementById('support-chat-avatar-btn').addEventListener('click', openSupportUserModal);
    document.getElementById('support-chat-profile-btn') && document.getElementById('support-chat-profile-btn').addEventListener('click', openSupportUserModal);

    document.getElementById('support-chat-enable-bot-btn') && document.getElementById('support-chat-enable-bot-btn').addEventListener('click', function() {
        var threadId = window._supportChatCurrentThreadId;
        if (!threadId) return;
        fetch('{{ route("support.chat.enable-bot") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify({ thread_id: threadId, _token: csrfToken })
        }).then(function(r) { return r.json(); }).then(function(res) {
            if (res.success) {
                window._supportChatNeedsHuman = false;
                var wrap = document.getElementById('support-chat-enable-bot-wrap');
                if (wrap) wrap.style.display = 'none';
                var disableWrap = document.getElementById('support-chat-disable-bot-wrap');
                if (disableWrap) disableWrap.style.display = 'block';
                loadSupportThreads().then(function() {
                    var btn = document.querySelector('.support-thread[data-thread-id="' + threadId + '"]');
                    if (btn) {
                        document.querySelectorAll('.support-thread').forEach(function(b) { b.classList.remove('bg-slate-100', 'dark:bg-slate-700'); });
                        btn.classList.add('bg-slate-100', 'dark:bg-slate-700');
                    }
                });
                if (threadId) loadSupportMessages(threadId);
            }
        });
    });

    document.getElementById('support-chat-disable-bot-btn') && document.getElementById('support-chat-disable-bot-btn').addEventListener('click', function() {
        var threadId = window._supportChatCurrentThreadId;
        if (!threadId) return;
        fetch('{{ route("support.chat.disable-bot") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify({ thread_id: threadId, _token: csrfToken })
        }).then(function(r) { return r.json(); }).then(function(res) {
            if (res.success) {
                window._supportChatNeedsHuman = true;
                var disableWrap = document.getElementById('support-chat-disable-bot-wrap');
                if (disableWrap) disableWrap.style.display = 'none';
                var enableWrap = document.getElementById('support-chat-enable-bot-wrap');
                if (enableWrap) enableWrap.style.display = 'block';
                loadSupportThreads().then(function() {
                    var btn = document.querySelector('.support-thread[data-thread-id="' + threadId + '"]');
                    if (btn) {
                        document.querySelectorAll('.support-thread').forEach(function(b) { b.classList.remove('bg-slate-100', 'dark:bg-slate-700'); });
                        btn.classList.add('bg-slate-100', 'dark:bg-slate-700');
                    }
                });
                if (threadId) loadSupportMessages(threadId);
            }
        });
    });

    function storageUrl(path) {
        if (!path) return '';
        var pathStr = (path + '').replace(/\\/g, '/').replace(/^\//, '');
        var origin = typeof window !== 'undefined' ? window.location.origin : '';
        var pathname = typeof window !== 'undefined' ? (window.location.pathname || '') : '';
        var base = origin + (pathname.indexOf('/public') === 0 ? '/public/storage' : '/storage');
        return base + '/' + pathStr;
    }
    function loadSupportMessages(threadId) {
        var wrap = document.getElementById('support-chat-messages');
        var placeholder = document.getElementById('support-chat-placeholder');
        wrap.querySelectorAll('.support-msg-item').forEach(function(n) { n.remove(); });
        fetch('{{ route("support.chat.messages") }}?thread_id=' + encodeURIComponent(threadId), { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
            .then(function(r) { return r.json(); })
            .then(function(messages) {
                if (!Array.isArray(messages)) return;
                placeholder.classList.add('hidden');
                function parseBotButtons(msgRaw) {
                    var displayText = msgRaw;
                    var buttons = [];
                    var delim = '\n__BTN__\n';
                    if (msgRaw.indexOf(delim) !== -1) {
                        var parts = msgRaw.split(delim);
                        displayText = (parts[0] || '').trim();
                        try { if (parts[1]) buttons = JSON.parse((parts[1] || '').trim()); } catch (e) {}
                        return { displayText: displayText, buttons: buttons };
                    }
                    if (msgRaw.indexOf('n__BTN__n') !== -1) {
                        var idx = msgRaw.indexOf('n__BTN__n');
                        displayText = (msgRaw.slice(0, idx) || '').replace(/\n+$/, '').trim();
                        if (displayText.slice(-1) === '.' && displayText.length > 1) displayText = displayText.slice(0, -1).trim();
                        var after = (msgRaw.slice(idx + 9) || '').replace(/^[\n\r\s]+/, '').trim();
                        var jsonStart = after.indexOf('[');
                        if (jsonStart !== -1) { try { buttons = JSON.parse(after.slice(jsonStart)); } catch (e) {} }
                        return { displayText: displayText, buttons: buttons };
                    }
                    if (msgRaw.indexOf('__BTN__') !== -1) {
                        var i = msgRaw.indexOf('__BTN__');
                        displayText = (msgRaw.slice(0, i) || '').replace(/\n+$/, '').trim();
                        var rest = (msgRaw.slice(i + 7) || '').replace(/^[n\n\r\s]+/, '').trim();
                        var js = rest.indexOf('[');
                        if (js !== -1) { try { buttons = JSON.parse(rest.slice(js)); } catch (e) {} }
                        return { displayText: displayText, buttons: buttons };
                    }
                    return { displayText: displayText, buttons: buttons };
                }
                messages.forEach(function(m) {
                    var div = document.createElement('div');
                    div.className = 'support-msg-item flex gap-2 ' + (m.user && m.user.role === 'admin' || m.user && m.user.role === 'moderator' ? 'flex-row-reverse' : '');
                    var avatarSrc = (m.user && m.user.avatar) ? storageUrl(m.user.avatar) : '';
                    var imgUrl = (m.image_url || '') || (m.image_path ? storageUrl(m.image_path) : '');
                    var name = (m.user && m.user.name) ? m.user.name : (m.is_system ? 'Поддержка (бот)' : 'Пользователь');
                    var time = m.created_at ? new Date(m.created_at).toLocaleString('ru-RU', { day: '2-digit', month: '2-digit', hour: '2-digit', minute: '2-digit' }) : '';
                    var msgRaw = (m.message && m.message.toString()) || '';
                    var parsed = parseBotButtons(msgRaw);
                    var displayText = parsed.displayText;
                    var buttons = parsed.buttons || [];
                    var msgContent = displayText ? ('<p class="mt-1 whitespace-pre-wrap support-msg-text">' + displayText.replace(/</g, '&lt;').replace(/>/g, '&gt;') + '</p>') : '';
                    if (Array.isArray(buttons) && buttons.length > 0) {
                        msgContent += '<div class="mt-2 flex flex-wrap gap-1.5">' + buttons.map(function(b) {
                            var lbl = (b && b.label) ? (b.label + '').replace(/</g, '&lt;').replace(/>/g, '&gt;') : '';
                            return '<span class="inline-block px-2 py-1 rounded text-xs bg-white/20 dark:bg-black/20">' + lbl + '</span>';
                        }).join('') + '</div>';
                    }
                    var imgBlock = imgUrl ? '<a href="' + imgUrl + '" target="_blank" rel="noopener" class="admin2-msg-img-thumb block mt-2 rounded overflow-hidden border border-slate-200 dark:border-slate-600" data-full="' + imgUrl + '"><img src="' + imgUrl + '" alt="Фото" class="rounded max-h-32 w-auto object-cover cursor-pointer" onerror="this.style.display=\'none\';var s=document.createElement(\'span\');s.className=\'text-sm opacity-90\';s.textContent=\'Фото\';this.parentNode.appendChild(s);"></a>' : '';
                    var fileUrl = (m.file_url || '') || (m.file_path ? storageUrl(m.file_path) : '');
                    var fileBlock = fileUrl ? '<a href="' + fileUrl + '" target="_blank" rel="noopener" class="block mt-2 text-sm underline opacity-90">📎 ' + (m.file_name || 'Файл').replace(/</g, '&lt;') + '</a>' : '';
                    var msgHtml = '<div class="max-w-[80%] rounded-lg px-3 py-2 support-msg-bubble ' + (m.user && (m.user.role === 'admin' || m.user.role === 'moderator') ? 'bg-primary text-white' : 'bg-slate-200 dark:bg-slate-600 text-slate-900 dark:text-slate-100') + '">' +
                        '<p class="font-medium text-sm">' + (name || '').replace(/</g, '&lt;').replace(/>/g, '&gt;') + '</p>' +
                        '<p class="text-xs opacity-80">' + time + '</p>' +
                        msgContent + imgBlock + fileBlock +
                        (m.is_system ? ' <span class="text-xs opacity-75">(автоответ)</span>' : '') + '</div>';
                    div.setAttribute('data-message-id', m.id);
                    div.setAttribute('data-can-delete', (m.can_delete ? '1' : '0'));
                    div.setAttribute('data-can-edit', (m.can_edit ? '1' : '0'));
                    div.innerHTML = '<img src="' + (avatarSrc || 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22 fill=%22%2394a3b8%22%3E%3Cpath d=%22M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z%22/%3E%3C/svg%3E') + '" alt="" class="w-8 h-8 rounded-full object-cover flex-shrink-0" onerror="this.src=\'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22 fill=%22%2394a3b8%22%3E%3Cpath d=%22M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z%22/%3E%3C/svg%3E\'">' + msgHtml;
                    wrap.appendChild(div);
                });
                wrap.scrollTop = wrap.scrollHeight;
                setTimeout(function() { wrap.scrollTop = wrap.scrollHeight; }, 50);
            });
    }

    (function() {
        var replyImg = document.getElementById('support-reply-image');
        var replyPreviewWrap = document.getElementById('support-reply-preview-wrap');
        var replyPreviewImg = document.getElementById('support-reply-preview-img');
        var replyPreviewRemove = document.getElementById('support-reply-preview-remove');
        if (replyImg) {
            replyImg.addEventListener('change', function() {
                var f = this.files && this.files[0];
                if (f && f.type.indexOf('image') !== -1) {
                    var url = URL.createObjectURL(f);
                    if (replyPreviewImg) replyPreviewImg.src = url;
                    if (replyPreviewWrap) replyPreviewWrap.classList.remove('hidden');
                } else if (replyPreviewWrap) replyPreviewWrap.classList.add('hidden');
            });
        }
        if (replyPreviewRemove) {
            replyPreviewRemove.addEventListener('click', function() {
                if (replyImg) replyImg.value = '';
                if (replyPreviewImg) replyPreviewImg.src = '';
                if (replyPreviewWrap) replyPreviewWrap.classList.add('hidden');
            });
        }
    })();
    var supportReplyText = document.getElementById('support-reply-text');
    if (supportReplyText) supportReplyText.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); var f = document.getElementById('support-reply-form'); if (f) f.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true })); }
    });
    document.addEventListener('submit', function(e) {
        if (e.target.id !== 'support-reply-form') return;
        e.preventDefault();
        var form = e.target;
        var threadIdEl = document.getElementById('support-reply-thread-id');
        var threadId = threadIdEl ? threadIdEl.value : '';
        if (!threadId) return;
        var replyImg = document.getElementById('support-reply-image');
        var replyFile = document.getElementById('support-reply-file');
        var replyText = document.getElementById('support-reply-text');
        var textVal = (replyText && replyText.value) ? String(replyText.value).trim() : '';
        var hasImage = replyImg && replyImg.files && replyImg.files.length > 0;
        var hasFile = replyFile && replyFile.files && replyFile.files.length > 0;
        if (!textVal && !hasImage && !hasFile) return;
        var fd = new FormData(form);
        fd.set('thread_id', threadId);
        fd.append('_token', csrfToken);
        if (!textVal) fd.set('message', '');
        if (!hasImage) fd.delete('image');
        if (!hasFile) fd.delete('file');
        var wrap = document.getElementById('support-chat-messages');
        var replyPreviewWrap = document.getElementById('support-reply-preview-wrap');
        var replyPreviewImg = document.getElementById('support-reply-preview-img');
        fetch('{{ route("support.chat.reply") }}', { method: 'POST', body: fd, headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' } })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.success && data.message) {
                    var m = data.message;
                    var div = document.createElement('div');
                    div.className = 'support-msg-item flex gap-2 flex-row-reverse';
                    div.setAttribute('data-message-id', m.id);
                    div.setAttribute('data-can-delete', (m.can_delete ? '1' : '0'));
                    div.setAttribute('data-can-edit', (m.can_edit ? '1' : '0'));
                    var avatarSrc = (m.user && m.user.avatar) ? storageUrl(m.user.avatar) : '';
                    var imgSrc = (m.image_path ? storageUrl(m.image_path) : '') || (m.image_url || '');
                    var fileUrl = (m.file_path ? storageUrl(m.file_path) : '') || (m.file_url || '');
                    var fileBlock = fileUrl ? '<a href="' + fileUrl + '" target="_blank" rel="noopener" class="block mt-2 text-sm underline opacity-90">📎 ' + (m.file_name || 'Файл').replace(/</g, '&lt;') + '</a>' : '';
                    var time = m.created_at ? new Date(m.created_at).toLocaleString('ru-RU', { day: '2-digit', month: '2-digit', hour: '2-digit', minute: '2-digit' }) : '';
                    var imgBlock = imgSrc ? '<a href="' + imgSrc + '" target="_blank" rel="noopener" class="admin2-msg-img-thumb block mt-2 rounded overflow-hidden border border-white/20" data-full="' + imgSrc + '"><img src="' + imgSrc + '" alt="Фото" class="rounded max-h-32 w-auto object-cover cursor-pointer"></a>' : '';
                    var msgTextBlock = m.message ? '<p class="mt-1 support-msg-text">' + (m.message + '').replace(/</g, '&lt;') + '</p>' : '';
                    div.innerHTML = '<img src="' + (avatarSrc || '') + '" alt="" class="w-8 h-8 rounded-full object-cover flex-shrink-0" onerror="this.style.display=\'none\'">' +
                        '<div class="max-w-[80%] rounded-lg px-3 py-2 bg-primary text-white support-msg-bubble"><p class="font-medium text-sm">' + (m.user && m.user.name ? m.user.name.replace(/</g, '&lt;') : '') + '</p><p class="text-xs opacity-80">' + time + '</p>' + msgTextBlock + imgBlock + fileBlock + '</div>';
                    if (wrap) wrap.appendChild(div);
                    if (wrap) { wrap.scrollTop = wrap.scrollHeight; }
                    var replyText = document.getElementById('support-reply-text');
                    if (replyText) replyText.value = '';
                    if (replyImg) replyImg.value = '';
                    if (replyFile) replyFile.value = '';
                    if (replyPreviewWrap) replyPreviewWrap.classList.add('hidden');
                    if (replyPreviewImg) replyPreviewImg.src = '';
                    saveDraft(threadId, '');
                    setTimeout(function() { if (wrap) wrap.scrollTop = wrap.scrollHeight; }, 50);
                }
            });
    });
    (function() {
        var ta = document.getElementById('support-reply-text');
        if (!ta) return;
        function resize() {
            ta.style.height = 'auto';
            var max = parseInt(getComputedStyle(ta).maxHeight, 10) || 192;
            var h = Math.min(ta.scrollHeight, max);
            ta.style.height = h + 'px';
        }
        ta.addEventListener('input', resize);
        ta.addEventListener('focus', resize);
        resize();
    })();
    var draftSaveTimer;
    (function() {
        var ta = document.getElementById('support-reply-text');
        if (!ta) return;
        ta.addEventListener('input', function() {
            clearTimeout(draftSaveTimer);
            var tid = document.getElementById('support-reply-thread-id');
            var id = tid ? tid.value : window._supportChatCurrentThreadId;
            if (!id) return;
            draftSaveTimer = setTimeout(function() { saveDraft(id, ta.value); }, 400);
        });
    })();

    // Лайтбокс: закрыть (крестик), скачать
    var lb = document.getElementById('admin2-msg-lightbox');
    var lbImg = document.getElementById('admin2-msg-lightbox-img');
    var lbClose = document.getElementById('admin2-msg-lightbox-close');
    var lbDownload = document.getElementById('admin2-msg-lightbox-download');
    document.addEventListener('click', function(e) {
        var a = e.target.closest && e.target.closest('.admin2-msg-img-thumb');
        if (!a) return;
        e.preventDefault();
        e.stopPropagation();
        var src = (a.dataset && a.dataset.full) || a.getAttribute('href') || (a.querySelector('img') && a.querySelector('img').src);
        if (lbImg && src) { lbImg.src = src; lbImg.alt = 'Фото'; }
        if (lbDownload) { lbDownload.href = src; lbDownload.download = (src.split('/').pop() || 'image').split('?')[0] || 'image'; }
        if (lb) { lb.classList.remove('hidden'); lb.style.setProperty('display', 'flex'); }
    });
    function closeLb() { if (lb) { lb.classList.add('hidden'); lb.style.display = 'none'; } }
    if (lbClose) lbClose.addEventListener('click', closeLb);
    if (lb) lb.addEventListener('click', function(e) { if (e.target === lb) closeLb(); });
    if (lbDownload) lbDownload.addEventListener('click', function(e) { e.stopPropagation(); });

    document.addEventListener('keydown', function(e) {
        if (e.key !== 'Escape') return;
        if (lb && !lb.classList.contains('hidden')) { closeLb(); e.preventDefault(); return; }
        if (window._supportChatCurrentThreadId) closeSupportChat();
    });

    var ctxMenu = document.getElementById('support-msg-context-menu');
    var ctxEdit = document.getElementById('support-msg-ctx-edit');
    var ctxDelete = document.getElementById('support-msg-ctx-delete');
    var ctxMessageId = null;
    var ctxMessageEl = null;
    function hideCtxMenu() { if (ctxMenu) { ctxMenu.classList.add('hidden'); ctxMessageId = null; ctxMessageEl = null; } }
    document.getElementById('support-chat-messages') && document.getElementById('support-chat-messages').addEventListener('contextmenu', function(e) {
        var item = e.target.closest('.support-msg-item');
        if (!item) return;
        e.preventDefault();
        var mid = item.getAttribute('data-message-id');
        var canDel = item.getAttribute('data-can-delete') === '1';
        var canEd = item.getAttribute('data-can-edit') === '1';
        if (!mid || (!canDel && !canEd)) return;
        ctxMessageId = mid;
        ctxMessageEl = item;
        if (ctxMenu) {
            ctxEdit.style.display = canEd ? 'block' : 'none';
            ctxDelete.style.display = canDel ? 'block' : 'none';
            ctxMenu.style.left = e.clientX + 'px';
            ctxMenu.style.top = e.clientY + 'px';
            ctxMenu.classList.remove('hidden');
        }
    });
    document.addEventListener('click', function(e) {
        if (ctxMenu && !ctxMenu.contains(e.target)) hideCtxMenu();
    });
    if (ctxDelete) ctxDelete.addEventListener('click', function() {
        if (!ctxMessageId || !ctxMessageEl) return;
        var id = ctxMessageId;
        var el = ctxMessageEl;
        hideCtxMenu();
        fetch('{{ route("support.chat.delete-message") }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json', 'Accept': 'application/json' }, body: JSON.stringify({ message_id: parseInt(id, 10), _token: csrfToken }) })
            .then(function(r) { return r.json(); })
            .then(function(data) { if (data.success && el && el.parentNode) el.remove(); });
    });
    if (ctxEdit) ctxEdit.addEventListener('click', function() {
        if (!ctxMessageId || !ctxMessageEl) return;
        var id = ctxMessageId;
        var el = ctxMessageEl;
        var bubble = el.querySelector('.support-msg-bubble');
        var textEl = bubble && bubble.querySelector('.support-msg-text');
        hideCtxMenu();
        if (!textEl) return;
        var currentText = textEl.textContent || '';
        var wrap = document.createElement('div');
        wrap.className = 'mt-1';
        wrap.innerHTML = '<textarea class="support-msg-edit-input w-full rounded border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-2 py-1 text-sm text-slate-900 dark:text-slate-100" rows="3">' + (currentText || '').replace(/</g, '&lt;') + '</textarea><div class="flex gap-2 mt-2"><button type="button" class="support-msg-edit-save px-2 py-1 bg-primary text-white text-sm rounded">Сохранить</button><button type="button" class="support-msg-edit-cancel px-2 py-1 border rounded text-sm">Отмена</button></div>';
        var editDiv = wrap;
        var ta = editDiv.querySelector('textarea');
        var saveBtn = editDiv.querySelector('.support-msg-edit-save');
        var cancelBtn = editDiv.querySelector('.support-msg-edit-cancel');
        textEl.replaceWith(editDiv);
        cancelBtn.addEventListener('click', function() { editDiv.replaceWith(textEl); });
        saveBtn.addEventListener('click', function() {
            var newText = (ta && ta.value || '').trim();
            fetch('{{ route("support.chat.update-message") }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json', 'Accept': 'application/json' }, body: JSON.stringify({ message_id: parseInt(id, 10), message: newText, _token: csrfToken }) })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    if (data.success && data.message) {
                        var p = document.createElement('p');
                        p.className = 'mt-1 whitespace-pre-wrap support-msg-text';
                        p.textContent = (data.message.message || '');
                        editDiv.replaceWith(p);
                    } else { editDiv.replaceWith(textEl); }
                });
        });
    });
})();
</script>
@endpush
