{{-- Модалка профиля пользователя (общая для сообщений и отзывов) --}}
<div id="admin2-msg-user-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-modal="true">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/50" id="admin2-msg-user-modal-backdrop"></div>
        <div class="relative admin2-card rounded-xl shadow-xl max-w-lg w-full p-6 max-h-[90vh] overflow-y-auto text-slate-900 dark:text-slate-100">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Профиль пользователя</h3>
                <button type="button" id="admin2-msg-user-modal-close" class="p-1 rounded hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-300">&times;</button>
            </div>
            <div id="admin2-msg-user-modal-body" class="space-y-4">
                <div class="flex gap-4 items-start">
                    <div class="flex-shrink-0">
                        <img id="admin2-msg-user-avatar" src="" alt="Аватар" class="w-20 h-20 rounded-full object-cover border-2 border-slate-200 dark:border-slate-600" style="display:none;">
                        <div id="admin2-msg-user-avatar-placeholder" class="w-20 h-20 rounded-full bg-slate-200 dark:bg-slate-600 flex items-center justify-center text-2xl font-semibold admin2-text-muted"></div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-lg" id="admin2-msg-user-name">—</p>
                        <p class="text-sm admin2-text-muted" id="admin2-msg-user-email">—</p>
                        <p class="text-sm mt-1">Роль: <span id="admin2-msg-user-role" class="font-medium">—</span></p>
                        <p class="text-sm">Заказов: <span id="admin2-msg-user-orders">0</span></p>
                        <p class="text-sm admin2-text-muted">Регистрация: <span id="admin2-msg-user-created">—</span></p>
                    </div>
                </div>
                <div class="border-t border-slate-200 dark:border-slate-600 pt-4 space-y-3">
                    <div class="flex items-center justify-between">
                        <h4 class="text-sm font-semibold">Заказы</h4>
                        <a href="#" id="admin2-msg-user-order-create" class="text-xs text-primary hover:underline">+ Создать заказ за пользователя</a>
                    </div>
                    <div id="admin2-msg-user-orders-list" class="max-h-40 overflow-y-auto space-y-2 text-sm"></div>
                </div>
                <div class="border-t border-slate-200 dark:border-slate-600 pt-4 space-y-3">
                    <h4 class="text-sm font-semibold">Отзывы</h4>
                    <form id="admin2-msg-user-review-form" class="space-y-2 p-2 bg-slate-50 dark:bg-slate-800/50 rounded-lg border border-slate-200 dark:border-slate-600">
                        <input type="text" name="client_name" placeholder="Имя автора" class="w-full rounded border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-2 py-1 text-sm text-slate-900 dark:text-slate-100 placeholder-slate-500 dark:placeholder-slate-400" required>
                        <input type="text" name="client_position" placeholder="Должность (необяз.)" class="w-full rounded border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-2 py-1 text-sm text-slate-900 dark:text-slate-100 placeholder-slate-500 dark:placeholder-slate-400">
                        <textarea name="review_text" placeholder="Текст отзыва" rows="2" class="w-full rounded border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-2 py-1 text-sm text-slate-900 dark:text-slate-100 placeholder-slate-500 dark:placeholder-slate-400" required></textarea>
                        <select name="rating" class="rounded border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-2 py-1 text-sm text-slate-900 dark:text-slate-100">
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                        <button type="submit" class="px-3 py-1.5 bg-primary text-white text-sm rounded">Добавить отзыв</button>
                    </form>
                    <div id="admin2-msg-user-reviews-list" class="max-h-40 overflow-y-auto space-y-2 text-sm"></div>
                </div>
                <form id="admin2-msg-user-form" action="{{ route('adminPanel2.user.update', ['id' => 0]) }}" method="post" enctype="multipart/form-data" class="space-y-3 border-t border-slate-200 dark:border-slate-600 pt-4">
                    @csrf
                    <div>
                        <label class="block text-xs admin2-text-muted mb-1">Имя</label>
                        <input type="text" name="name" id="admin2-msg-user-input-name" class="w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm text-slate-900 dark:text-slate-100">
                    </div>
                    <div>
                        <label class="block text-xs admin2-text-muted mb-1">Email</label>
                        <input type="email" name="email" id="admin2-msg-user-input-email" class="w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm text-slate-900 dark:text-slate-100">
                    </div>
                    <div>
                        <label class="block text-xs admin2-text-muted mb-1">Роль</label>
                        <select name="role" id="admin2-msg-user-input-role" class="w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm text-slate-900 dark:text-slate-100">
                            <option value="user">user</option>
                            <option value="moderator">moderator</option>
                            <option value="admin">admin</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs admin2-text-muted mb-1">Новый аватар</label>
                        <input type="file" name="avatar" accept="image/jpeg,image/png,image/gif" class="w-full text-sm text-slate-700 dark:text-slate-300 file:mr-2 file:py-1.5 file:px-3 file:rounded file:border-0 file:bg-slate-100 file:text-slate-700 dark:file:bg-slate-600 dark:file:text-slate-200">
                    </div>
                    <div class="flex flex-wrap gap-2 items-center">
                        <button type="submit" class="px-4 py-2 rounded-lg bg-primary text-white text-sm font-medium hover:opacity-90">Сохранить</button>
                        <button type="button" id="admin2-msg-user-modal-cancel" class="px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 text-sm">Закрыть</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
(function() {
    var profileUrl = '{{ route("adminPanel2.user.profile", ["id" => "__ID__"]) }}';
    var csrf = document.querySelector('meta[name="csrf-token"]');
    var csrfToken = csrf ? csrf.getAttribute('content') : '';
    var msgModal = document.getElementById('admin2-msg-user-modal');
    var msgModalBackdrop = document.getElementById('admin2-msg-user-modal-backdrop');
    var msgModalClose = document.getElementById('admin2-msg-user-modal-close');
    var msgModalCancel = document.getElementById('admin2-msg-user-modal-cancel');
    var msgUserForm = document.getElementById('admin2-msg-user-form');
    function openAdminUserModalByData(data) {
        var id = data.userId || data.id;
        window._adminUserModalUserId = id;
        var nameEl = document.getElementById('admin2-msg-user-name');
        var emailEl = document.getElementById('admin2-msg-user-email');
        var roleEl = document.getElementById('admin2-msg-user-role');
        var ordersEl = document.getElementById('admin2-msg-user-orders');
        var createdEl = document.getElementById('admin2-msg-user-created');
        var inputName = document.getElementById('admin2-msg-user-input-name');
        var inputEmail = document.getElementById('admin2-msg-user-input-email');
        var inputRole = document.getElementById('admin2-msg-user-input-role');
        if (nameEl) nameEl.textContent = data.name || '—';
        if (emailEl) emailEl.textContent = data.email || '—';
        if (roleEl) roleEl.textContent = data.role || '—';
        if (ordersEl) ordersEl.textContent = (data.ordersCount ?? (data.orders && data.orders.length) ?? 0);
        if (createdEl) createdEl.textContent = data.created || '—';
        if (inputName) inputName.value = data.name || '';
        if (inputEmail) inputEmail.value = data.email || '';
        if (inputRole) inputRole.value = data.role || 'user';
        var img = document.getElementById('admin2-msg-user-avatar');
        var placeholder = document.getElementById('admin2-msg-user-avatar-placeholder');
        if (img && placeholder) {
            if (data.avatar) { img.src = data.avatar; img.style.display = 'block'; placeholder.style.display = 'none'; }
            else { img.style.display = 'none'; placeholder.style.display = 'flex'; placeholder.textContent = (data.name || '?').charAt(0).toUpperCase(); }
        }
        if (msgUserForm) msgUserForm.action = ('{{ route("adminPanel2.user.update", ["id" => 0]) }}').replace(/\/0\//, '/' + id + '/');
        var orderCreateLink = document.getElementById('admin2-msg-user-order-create');
        if (orderCreateLink) orderCreateLink.href = '{{ route("order.create") }}?for_user=' + id;
        var reviewForm = document.getElementById('admin2-msg-user-review-form');
        if (reviewForm) reviewForm.dataset.userId = id;
        var ordersList = document.getElementById('admin2-msg-user-orders-list');
        if (ordersList) {
            var orders = data.orders || [];
            if (orders.length === 0) ordersList.innerHTML = '<p class="admin2-text-muted text-xs">Нет заказов</p>';
            else ordersList.innerHTML = orders.map(function(o) {
                var ordersUrl = '{{ route("adminPanel2", ["page" => "orders"]) }}';
                var editUrl = ordersUrl + (ordersUrl.indexOf('?') >= 0 ? '&' : '?') + 'open_order=' + o.id;
                return '<div class="flex justify-between items-start gap-2 p-2 rounded bg-slate-100 dark:bg-slate-700/50 border border-slate-200 dark:border-slate-600">' +
                    '<div><span class="font-medium">#' + o.id + '</span> ' + (o.yslyga || '') + ' — ' + (o.status || '') + '<br><span class="text-xs admin2-text-muted">' + (o.created_at || '') + '</span></div>' +
                    '<div class="flex gap-2 flex-shrink-0"><a href="' + editUrl + '" class="text-xs text-primary hover:underline">Изменить</a><a href="' + ordersUrl + '" class="text-xs admin2-text-muted hover:underline">Открыть</a></div></div>';
            }).join('');
        }
        var reviewsList = document.getElementById('admin2-msg-user-reviews-list');
        if (reviewsList) {
            var reviews = data.reviews || [];
            if (reviews.length === 0) reviewsList.innerHTML = '<p class="admin2-text-muted text-xs">Нет отзывов</p>';
            else reviewsList.innerHTML = reviews.map(function(r) {
                return '<div class="p-2 rounded bg-slate-100 dark:bg-slate-700/50 review-item" data-review-id="' + r.id + '">' +
                    '<p class="font-medium text-xs">' + (r.client_name || '') + ' ★' + (r.rating || '') + '</p>' +
                    '<p class="text-xs mt-0.5">' + (r.review_text || '').substring(0, 80) + (r.review_text && r.review_text.length > 80 ? '…' : '') + '</p>' +
                    '<p class="text-xs admin2-text-muted">' + (r.created_at || '') + (r.is_approved ? ' · Опубликован' : '') + '</p>' +
                    '<button type="button" class="edit-review-btn mt-1 text-xs text-primary hover:underline" data-id="' + r.id + '" data-name="' + (r.client_name || '').replace(/"/g, '&quot;') + '" data-position="' + (r.client_position || '').replace(/"/g, '&quot;') + '" data-text="' + (r.review_text || '').replace(/"/g, '&quot;').replace(/</g, '&lt;') + '" data-rating="' + (r.rating || 5) + '" data-approved="' + (r.is_approved ? '1' : '0') + '">Изменить</button></div>';
            }).join('');
        }
        if (msgModal) msgModal.classList.remove('hidden');
    }
    function closeMsgUserModal() { if (msgModal) msgModal.classList.add('hidden'); }
    function refreshAdminUserModal() {
        var uid = window._adminUserModalUserId;
        if (!uid) return;
        fetch(profileUrl.replace('__ID__', uid)).then(function(r) { return r.json(); }).then(function(data) {
            if (!data || data.error) return;
            openAdminUserModalByData({ userId: data.id, name: data.name, email: data.email, role: data.role, avatar: data.avatar, created: data.created_at, ordersCount: data.orders_count, orders: data.orders || [], reviews: data.reviews || [] });
        });
    }
    if (msgModalBackdrop) msgModalBackdrop.addEventListener('click', closeMsgUserModal);
    if (msgModalClose) msgModalClose.addEventListener('click', closeMsgUserModal);
    if (msgModalCancel) msgModalCancel.addEventListener('click', closeMsgUserModal);
    if (msgUserForm) msgUserForm.addEventListener('submit', function() {});
    document.getElementById('admin2-msg-user-review-form') && document.getElementById('admin2-msg-user-review-form').addEventListener('submit', function(e) {
        e.preventDefault();
        var form = this;
        var userId = form.dataset.userId;
        if (!userId) return;
        var fd = new FormData(form);
        fd.append('_token', csrfToken);
        fetch(('{{ route("adminPanel2.user.review.store", ["id" => "USER_ID"]) }}').replace('USER_ID', userId), {
            method: 'POST', body: fd,
            headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
        }).then(function(r) { return r.json(); }).then(function(res) {
            if (res.success) { form.reset(); refreshAdminUserModal(); }
        });
    });
    document.getElementById('admin2-msg-user-reviews-list') && document.getElementById('admin2-msg-user-reviews-list').addEventListener('click', function(e) {
        var btn = e.target.closest('.edit-review-btn');
        if (!btn) return;
        e.preventDefault();
        var id = btn.dataset.id;
        var name = btn.dataset.name || '';
        var position = btn.dataset.position || '';
        var text = btn.dataset.text || '';
        var rating = btn.dataset.rating || '5';
        var approved = btn.dataset.approved !== '0';
        var reviewEl = btn.closest('.review-item');
        var editHtml = '<form class="review-edit-form mt-2 p-2 bg-slate-200 dark:bg-slate-600 rounded space-y-2" data-review-id="' + id + '">' +
            '<input type="text" name="client_name" value="' + name.replace(/"/g, '&quot;') + '" placeholder="Имя" class="w-full rounded px-2 py-1 text-sm">' +
            '<input type="text" name="client_position" value="' + (position || '').replace(/"/g, '&quot;') + '" placeholder="Должность" class="w-full rounded px-2 py-1 text-sm">' +
            '<textarea name="review_text" rows="2" class="w-full rounded px-2 py-1 text-sm">' + (text || '').replace(/</g, '&lt;') + '</textarea>' +
            '<select name="rating" class="rounded px-2 py-1 text-sm"><option value="5"' + (rating==5?' selected':'') + '>5</option><option value="4"' + (rating==4?' selected':'') + '>4</option><option value="3"' + (rating==3?' selected':'') + '>3</option><option value="2"' + (rating==2?' selected':'') + '>2</option><option value="1"' + (rating==1?' selected':'') + '>1</option></select>' +
            '<label class="flex items-center gap-1 text-xs"><input type="checkbox" name="is_approved" ' + (approved ? 'checked' : '') + '> Опубликован</label>' +
            '<div class="flex gap-2"><button type="submit" class="px-2 py-1 bg-primary text-white text-xs rounded">Сохранить</button><button type="button" class="review-edit-cancel px-2 py-1 border rounded text-xs">Отмена</button></div></form>';
        var wrap = document.createElement('div');
        wrap.innerHTML = editHtml;
        var editForm = wrap.firstChild;
        reviewEl.appendChild(editForm);
        editForm.querySelector('.review-edit-cancel').addEventListener('click', function() { editForm.remove(); });
        editForm.addEventListener('submit', function(ev) {
            ev.preventDefault();
            var fd = new FormData(editForm);
            fd.append('_token', csrfToken);
            fd.append('_method', 'PUT');
            fd.set('is_approved', editForm.querySelector('[name=is_approved]').checked ? '1' : '0');
            fetch(('{{ route("adminPanel2.reviews.update", ["id" => "REVIEW_ID"]) }}').replace('REVIEW_ID', id), {
                method: 'POST', body: fd,
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
            }).then(function(r) { return r.json(); }).then(function(res) {
                if (res.success) { editForm.remove(); refreshAdminUserModal(); }
            });
        });
    });
    window.openAdminUserModalByData = openAdminUserModalByData;
})();
</script>
