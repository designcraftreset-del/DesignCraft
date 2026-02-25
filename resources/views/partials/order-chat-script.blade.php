<script>
(function() {
    var csrf = document.querySelector('meta[name="csrf-token"]');
    var csrfToken = csrf ? csrf.getAttribute('content') : '';
    var currentUserId = {{ Auth::id() ?? 0 }};
    var initialOrderId = {{ isset($moderOrder) && $moderOrder ? (int)$moderOrder->id : 'null' }};
    var ordersListUrl = '{{ route("orders.chats.list") }}';
    var baseOrdersUrl = '{{ url("/orders") }}';
    var defaultAvatar = 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22 fill=%22%2394a3b8%22%3E%3Cpath d=%22M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z%22/%3E%3C/svg%3E';

    function storageUrl(path) {
        return path ? '{{ asset("storage") }}/' + (path + '').replace(/^\/+/, '') : '';
    }

    function sortOrdersOpenFirst(orders) {
        if (!orders || !orders.length) return orders || [];
        return orders.slice().sort(function(a, b) {
            var aClosed = !!(a.chat_closed_at);
            var bClosed = !!(b.chat_closed_at);
            if (aClosed !== bClosed) return aClosed ? 1 : -1;
            return (b.id || 0) - (a.id || 0);
        });
    }

    function getOrdersToShow() {
        var raw = window._orderChatOrdersList || [];
        var sorted = sortOrdersOpenFirst(raw);
        var hideClosedEl = document.getElementById('order-chat-hide-closed');
        var hideClosed = !!(hideClosedEl && hideClosedEl.getAttribute('aria-checked') === 'true');
        if (hideClosed) sorted = sorted.filter(function(o) { return !o.chat_closed_at; });
        var q = (document.getElementById('order-chat-search') && document.getElementById('order-chat-search').value || '').trim().toLowerCase();
        if (q) {
            sorted = sorted.filter(function(o) {
                var idStr = String(o.id || '');
                var yslyga = (o.yslyga || '').toLowerCase();
                return idStr.indexOf(q) !== -1 || yslyga.indexOf(q) !== -1;
            });
        }
        return sorted;
    }

    function renderThreadsList(orders) {
        var list = document.getElementById('order-chat-threads-list');
        var empty = document.getElementById('order-chat-threads-empty');
        if (!list) return;
        list.innerHTML = '';
        if (!orders || orders.length === 0) {
            if (empty) empty.style.display = 'block';
            return;
        }
        if (empty) empty.style.display = 'none';
        orders.forEach(function(o) {
            var btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'order-chat-thread' + (window._orderChatCurrentId === o.id ? ' active' : '');
            btn.dataset.orderId = o.id;
            btn.dataset.yslyga = o.yslyga || '';
            btn.dataset.closed = o.chat_closed_at ? '1' : '0';
            var lastMsg = (o.last_message || '').replace(/</g, '&lt;').substring(0, 35);
            btn.innerHTML = '<span class="order-chat-thread-icon">#' + o.id + '</span>' +
                '<div style="flex:1;min-width:0;"><span class="order-chat-thread-title">Заказ #' + o.id + '</span>' +
                (o.yslyga ? '<div class="order-chat-thread-preview">' + (o.yslyga + '').replace(/</g, '&lt;').substring(0, 30) + '</div>' : '') +
                (lastMsg ? '<div class="order-chat-thread-preview">' + lastMsg + '</div>' : '') +
                (o.chat_closed_at ? '<div class="order-chat-thread-closed">Закрыт</div>' : '') + '</div>';
            list.appendChild(btn);
        });
    }

    function loadOrderChatThreads() {
        fetch(ordersListUrl, { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                var orders = (data && data.orders) ? data.orders : [];
                if (initialOrderId && orders.length === 0) {
                    orders = [{ id: initialOrderId, yslyga: '{{ isset($moderOrder) ? addslashes($moderOrder->yslyga ?? "") : "" }}', chat_closed_at: null, last_message: null }];
                }
                window._orderChatOrdersList = sortOrdersOpenFirst(orders);
                renderThreadsList(getOrdersToShow());
                var threadsCol = document.getElementById('order-chat-threads-col');
                if (threadsCol) threadsCol.classList.toggle('order-chat-threads-col--scroll', (window._orderChatOrdersList || []).length > 6);
                if (initialOrderId) {
                    var found = orders.find(function(o) { return o.id === initialOrderId; });
                    if (found) selectOrderThread(found);
                }
            });
    }

    function selectOrderThread(order) {
        window._orderChatCurrentId = order.id;
        var header = document.getElementById('order-chat-header');
        var formWrap = document.getElementById('order-chat-form-wrap');
        var placeholder = document.getElementById('order-chat-placeholder');
        var titleEl = document.getElementById('order-chat-title');
        var closedBadge = document.getElementById('order-chat-closed-badge');
        var replyOrderId = document.getElementById('order-chat-reply-order-id');
        if (header) header.style.display = 'block';
        if (placeholder) placeholder.style.display = 'none';
        if (titleEl) titleEl.textContent = 'Заказ #' + order.id + (order.yslyga ? ' — ' + order.yslyga : '');
        if (closedBadge) closedBadge.style.display = order.chat_closed_at ? 'block' : 'none';
        if (replyOrderId) replyOrderId.value = order.id;
        if (formWrap) {
            formWrap.style.display = 'block';
            formWrap.style.pointerEvents = order.chat_closed_at ? 'none' : '';
            formWrap.style.opacity = order.chat_closed_at ? '0.6' : '1';
        }
        renderThreadsList(getOrdersToShow());
        loadOrderChatMessages(order.id);
    }

    function renderMessage(m, orderId) {
        var isOwn = m.user_id === currentUserId || (m.user && m.user.id === currentUserId);
        var isModer = m.user && (m.user.role === 'admin' || m.user.role === 'moderator');
        var name = (m.user && m.user.name) ? m.user.name : 'Гость';
        if (isModer) name += ' (дизайнер)';
        var time = m.created_at ? new Date(m.created_at).toLocaleString('ru-RU', { day: '2-digit', month: '2-digit', hour: '2-digit', minute: '2-digit' }) : '';
        var msg = (m.message || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        var avatarSrc = (m.user && m.user.avatar) ? storageUrl(m.user.avatar) : defaultAvatar;
        var imgUrl = m.image_url || (m.image_path ? storageUrl(m.image_path) : '');
        var fileUrl = m.file_url || (m.file_path ? storageUrl(m.file_path) : '');
        var fileName = (m.file_name || 'Файл').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        var imgBlock = imgUrl ? '<div class="order-chat-msg-img" role="button" tabindex="0" data-full="' + imgUrl + '" title="Открыть в полном размере"><img src="' + imgUrl + '" alt=""></div>' : '';
        var fileBlock = fileUrl ? '<a href="' + fileUrl + '" target="_blank" rel="noopener" class="order-chat-msg-file">' +
            '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg>' + fileName + '</a>' : '';
        var div = document.createElement('div');
        div.className = 'order-chat-msg-item' + (isOwn ? ' own' : '');
        div.innerHTML = '<img src="' + avatarSrc + '" alt="" style="width:32px;height:32px;border-radius:50%;object-fit:cover;flex-shrink:0" onerror="this.src=\'' + defaultAvatar + '\'">' +
            '<div class="order-chat-msg-bubble ' + (isOwn ? 'own' : 'other') + '">' +
            '<div class="name">' + (name || '').replace(/</g, '&lt;') + '</div>' +
            '<div class="time">' + time + '</div>' +
            (msg ? '<div class="text">' + msg + '</div>' : '') + imgBlock + fileBlock + '</div>';
        return div;
    }

    function loadOrderChatMessages(orderId) {
        var wrap = document.getElementById('order-chat-messages');
        if (!wrap) return;
        wrap.innerHTML = '';
        fetch(baseOrdersUrl + '/' + orderId + '/chat/messages', { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                var closed = data.order && data.order.chat_closed_at;
                var formWrap = document.getElementById('order-chat-form-wrap');
                var closedBadge = document.getElementById('order-chat-closed-badge');
                if (formWrap) { formWrap.style.pointerEvents = closed ? 'none' : ''; formWrap.style.opacity = closed ? '0.6' : '1'; }
                if (closedBadge) closedBadge.style.display = closed ? 'block' : 'none';
                (data.messages || []).forEach(function(m) {
                    wrap.appendChild(renderMessage(m, orderId));
                });
                wrap.scrollTop = wrap.scrollHeight;
            });
    }

    var searchEl = document.getElementById('order-chat-search');
    var hideClosedEl = document.getElementById('order-chat-hide-closed');
    function applyOrderChatFilters() {
        renderThreadsList(getOrdersToShow());
    }
    if (searchEl) searchEl.addEventListener('input', applyOrderChatFilters);
    if (searchEl) searchEl.addEventListener('keyup', applyOrderChatFilters);
    if (hideClosedEl) hideClosedEl.addEventListener('click', function() {
        var on = this.getAttribute('aria-checked') === 'true';
        this.setAttribute('aria-checked', on ? 'false' : 'true');
        applyOrderChatFilters();
    });

    document.getElementById('order-chat-threads-list') && document.getElementById('order-chat-threads-list').addEventListener('click', function(e) {
        var btn = e.target.closest('.order-chat-thread');
        if (!btn || !btn.dataset.orderId) return;
        var orderId = parseInt(btn.dataset.orderId, 10);
        var orders = window._orderChatOrdersList || [];
        var order = orders.find(function(o) { return o.id === orderId; }) || { id: orderId, yslyga: btn.dataset.yslyga || '', chat_closed_at: btn.dataset.closed === '1' };
        selectOrderThread(order);
    });

    function updateAttachPreview() {
        var previewEl = document.getElementById('order-chat-attach-preview');
        var imageInput = document.getElementById('order-chat-input-image');
        var fileInput = document.getElementById('order-chat-input-file');
        if (!previewEl) return;
        var html = [];
        if (imageInput && imageInput.files && imageInput.files[0]) {
            var file = imageInput.files[0];
            var url = URL.createObjectURL(file);
            html.push('<span class="order-chat-attach-preview-item">' +
                '<img src="' + url + '" alt="">' +
                '<button type="button" class="order-chat-attach-preview-remove" data-clear="image" title="Убрать">×</button></span>');
        }
        if (fileInput && fileInput.files && fileInput.files[0]) {
            var f = fileInput.files[0];
            html.push('<span class="order-chat-attach-preview-file">' +
                '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg>' +
                '<span>' + (f.name || 'Файл') + '</span>' +
                '<button type="button" class="order-chat-attach-preview-remove" data-clear="file" title="Убрать">×</button></span>');
        }
        previewEl.innerHTML = html.join('');
        previewEl.style.display = html.length ? 'flex' : 'none';
    }

    var form = document.getElementById('order-chat-reply-form');
    if (form) {
        var imageInput = form.querySelector('input[name="image"]');
        var fileInput = form.querySelector('input[name="file"]');
        if (imageInput) imageInput.addEventListener('change', updateAttachPreview);
        if (fileInput) fileInput.addEventListener('change', updateAttachPreview);
        document.getElementById('order-chat-attach-preview') && document.getElementById('order-chat-attach-preview').addEventListener('click', function(e) {
            var btn = e.target.closest('.order-chat-attach-preview-remove');
            if (!btn || !btn.dataset.clear) return;
            if (btn.dataset.clear === 'image' && imageInput) { imageInput.value = ''; }
            if (btn.dataset.clear === 'file' && fileInput) { fileInput.value = ''; }
            updateAttachPreview();
        });
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            var orderId = document.getElementById('order-chat-reply-order-id').value;
            if (!orderId) return;
            var text = (document.getElementById('order-chat-reply-text').value || '').trim();
            var hasImage = imageInput && imageInput.files && imageInput.files.length;
            var hasFile = fileInput && fileInput.files && fileInput.files.length;
            if (!text && !hasImage && !hasFile) return;
            var fd = new FormData(form);
            fd.append('_token', csrfToken);
            if (!hasImage) fd.delete('image');
            if (!hasFile) fd.delete('file');
            fetch(baseOrdersUrl + '/' + orderId + '/chat/send', {
                method: 'POST',
                body: fd,
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
            }).then(function(r) { return r.json(); }).then(function(data) {
                if (data.success && data.message) {
                    var wrap = document.getElementById('order-chat-messages');
                    if (wrap) wrap.appendChild(renderMessage(data.message, orderId));
                    if (wrap) wrap.scrollTop = wrap.scrollHeight;
                    form.reset();
                    document.getElementById('order-chat-reply-order-id').value = orderId;
                    document.getElementById('order-chat-reply-text').value = '';
                    if (imageInput) imageInput.value = '';
                    if (fileInput) fileInput.value = '';
                    updateAttachPreview();
                    loadOrderChatThreads();
                }
            });
        });
    }

    (function initLightbox() {
        var lb = document.getElementById('order-chat-lightbox');
        if (lb && document.body && lb.parentNode !== document.body) {
            document.body.appendChild(lb);
        }
    })();

    function openLightboxForEl(el) {
        if (!el || !el.classList || !el.classList.contains('order-chat-msg-img')) return;
        var src = el.dataset.full || (el.querySelector('img') && el.querySelector('img').src);
        var lb = document.getElementById('order-chat-lightbox');
        var lbImg = document.getElementById('order-chat-lightbox-img');
        var lbDownload = document.getElementById('order-chat-lightbox-download');
        if (lb && lbImg && src) {
            lbImg.src = src;
            if (lbDownload) { lbDownload.href = src; lbDownload.download = 'image'; }
            lb.classList.add('is-open');
            lb.setAttribute('aria-hidden', 'false');
        }
    }
    document.addEventListener('click', function(e) {
        var a = e.target.closest('.order-chat-msg-img');
        if (!a) return;
        e.preventDefault();
        e.stopPropagation();
        openLightboxForEl(a);
    }, true);
    document.addEventListener('keydown', function(e) {
        if (e.key !== 'Enter' && e.key !== ' ') return;
        var a = e.target.closest('.order-chat-msg-img');
        if (!a) return;
        e.preventDefault();
        openLightboxForEl(a);
    });

    document.getElementById('order-chat-lightbox-close') && document.getElementById('order-chat-lightbox-close').addEventListener('click', function() {
        var lb = document.getElementById('order-chat-lightbox');
        if (lb) { lb.classList.remove('is-open'); lb.setAttribute('aria-hidden', 'true'); }
    });
    document.getElementById('order-chat-lightbox') && document.getElementById('order-chat-lightbox').addEventListener('click', function(e) {
        if (e.target === this) { this.classList.remove('is-open'); this.setAttribute('aria-hidden', 'true'); }
    });

    window.openOrderChat = function(orderId) {
        var list = window._orderChatOrdersList || [];
        var order = list.find(function(o) { return o.id === orderId; });
        if (order) { selectOrderThread(order); return; }
        loadOrderChatThreads();
        setTimeout(function() {
            var list2 = window._orderChatOrdersList || [];
            var o = list2.find(function(x) { return x.id === orderId; });
            if (o) selectOrderThread(o);
        }, 600);
    };

    if (initialOrderId) {
        window._orderChatOrdersList = sortOrdersOpenFirst([{ id: initialOrderId, yslyga: '{{ isset($moderOrder) ? addslashes($moderOrder->yslyga ?? "") : "" }}', chat_closed_at: {{ isset($moderOrder) && $moderOrder->chat_closed_at ? 'true' : 'false' }}, last_message: null }]);
        renderThreadsList(getOrdersToShow());
        selectOrderThread(window._orderChatOrdersList[0]);
    } else {
        loadOrderChatThreads();
    }
})();
</script>
