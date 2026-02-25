@php
    $f = $filters ?? [];
    $sortUsers = request()->get('sort_users', 'name');
    $dirUsers = request()->get('sort_dir_users', 'asc');
    $dirUsersOpp = $dirUsers === 'asc' ? 'desc' : 'asc';
    $baseUsers = array_merge(request()->query(), ['page' => 'users']);
@endphp
<form method="get" action="{{ route('adminPanel2', ['page' => 'users']) }}" class="admin2-card rounded-xl p-4 mb-4">
    <input type="hidden" name="page" value="users">
    <div class="flex flex-wrap items-end gap-3">
        <div>
            <label class="block text-xs admin2-text-muted mb-1">Роль</label>
            <select name="filter_user_role" class="rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm w-40">
                <option value="">Все</option>
                <option value="user" {{ ($f['user_role'] ?? '') === 'user' ? 'selected' : '' }}>user</option>
                <option value="moderator" {{ ($f['user_role'] ?? '') === 'moderator' ? 'selected' : '' }}>moderator</option>
                <option value="admin" {{ ($f['user_role'] ?? '') === 'admin' ? 'selected' : '' }}>admin</option>
            </select>
        </div>
        <div>
            <label class="block text-xs admin2-text-muted mb-1">Поиск</label>
            <input type="text" name="filter_user_search" value="{{ $f['user_search'] ?? '' }}" placeholder="Имя или email" class="rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm w-48">
        </div>
        <button type="submit" class="px-4 py-2 rounded-lg bg-primary text-white text-sm font-medium hover:opacity-90">Применить</button>
        <a href="{{ route('adminPanel2', ['page' => 'users']) }}" class="px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 text-sm">Сбросить</a>
    </div>
</form>
<div class="admin2-card rounded-xl shadow-sm overflow-hidden">
    <div class="px-5 py-4 border-b border-slate-200 dark:border-slate-600 flex flex-wrap items-center justify-between gap-2">
        <h2 class="text-lg font-semibold">Пользователи</h2>
        <div class="flex flex-wrap items-center gap-2">
            <button type="button" id="admin2-user-add-btn" class="px-3 py-2 rounded-lg bg-primary text-white text-sm font-medium hover:opacity-90">+ Добавить пользователя</button>
            <a href="{{ route('adminPanel2.export.users', request()->query()) }}" class="text-sm text-green-600 dark:text-green-400 hover:underline">Скачать в Excel</a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="admin2-text-muted text-sm font-medium border-b border-slate-200 dark:border-slate-600">
                <tr>
                    <th class="px-5 py-3"><a href="{{ route('adminPanel2', array_merge($baseUsers, ['sort_users' => 'id', 'sort_dir_users' => $sortUsers === 'id' ? $dirUsersOpp : 'asc'])) }}" class="hover:text-primary">ID</a></th>
                    <th class="px-5 py-3"><a href="{{ route('adminPanel2', array_merge($baseUsers, ['sort_users' => 'name', 'sort_dir_users' => $sortUsers === 'name' ? $dirUsersOpp : 'asc'])) }}" class="hover:text-primary">Имя</a></th>
                    <th class="px-5 py-3"><a href="{{ route('adminPanel2', array_merge($baseUsers, ['sort_users' => 'email', 'sort_dir_users' => $sortUsers === 'email' ? $dirUsersOpp : 'asc'])) }}" class="hover:text-primary">Email</a></th>
                    <th class="px-5 py-3"><a href="{{ route('adminPanel2', array_merge($baseUsers, ['sort_users' => 'role', 'sort_dir_users' => $sortUsers === 'role' ? $dirUsersOpp : 'asc'])) }}" class="hover:text-primary">Роль</a></th>
                    <th class="px-5 py-3">Заказов</th>
                    <th class="px-5 py-3"><a href="{{ route('adminPanel2', array_merge($baseUsers, ['sort_users' => 'created_at', 'sort_dir_users' => $sortUsers === 'created_at' ? $dirUsersOpp : 'desc'])) }}" class="hover:text-primary">Регистрация</a></th>
                    <th class="px-5 py-3">Изменить роль</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                <tr class="border-b border-slate-100 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800/50 cursor-pointer admin2-user-row"
                    data-user-id="{{ $u->id }}"
                    data-name="{{ e($u->name) }}"
                    data-email="{{ e($u->email) }}"
                    data-role="{{ $u->role ?? 'user' }}"
                    data-avatar="{{ $u->avatar ? asset('storage/' . $u->avatar) : '' }}"
                    data-created="{{ $u->created_at?->format('d.m.Y H:i') ?? '' }}"
                    data-orders-count="{{ $u->orders_count ?? 0 }}">
                    <td class="px-5 py-3">{{ $u->id }}</td>
                    <td class="px-5 py-3 font-medium">{{ $u->name }}</td>
                    <td class="px-5 py-3 text-sm">{{ $u->email }}</td>
                    <td class="px-5 py-3">
                        @if($u->role === 'admin')<span class="px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-200">admin</span>
                        @elseif($u->role === 'moderator')<span class="px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-200">moderator</span>
                        @else<span class="px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-200">user</span>@endif
                    </td>
                    <td class="px-5 py-3">{{ $u->orders_count ?? 0 }}</td>
                    <td class="px-5 py-3 admin2-text-muted text-sm">{{ $u->created_at?->format('d.m.Y') ?? '—' }}</td>
                    <td class="px-5 py-3">
                        @if($u->id !== Auth::id())
                        <form action="{{ route('users.updateRole', $u->id) }}" method="post" class="inline">
                            @csrf
                            @method('PUT')
                            <select name="role" onchange="this.form.submit()" class="text-xs rounded border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-2 py-1">
                                <option value="user" {{ ($u->role ?? '') === 'user' ? 'selected' : '' }}>user</option>
                                <option value="moderator" {{ ($u->role ?? '') === 'moderator' ? 'selected' : '' }}>moderator</option>
                                <option value="admin" {{ ($u->role ?? '') === 'admin' ? 'selected' : '' }}>admin</option>
                            </select>
                        </form>
                        @else
                        <span class="text-xs admin2-text-muted">—</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="px-5 py-8 admin2-text-muted text-center">Нет пользователей</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div class="px-5 py-3 border-t border-slate-200 dark:border-slate-600 flex justify-center gap-2">
        @if($users->onFirstPage())<span class="px-3 py-1 rounded bg-slate-100 dark:bg-slate-700 text-sm admin2-text-muted">Назад</span>
        @else<a href="{{ $users->withQueryString()->previousPageUrl() }}" class="px-3 py-1 rounded bg-primary/10 text-primary text-sm hover:bg-primary/20">Назад</a>@endif
        <span class="px-3 py-1 text-sm admin2-text-muted">{{ $users->currentPage() }} / {{ $users->lastPage() }}</span>
        @if($users->hasMorePages())<a href="{{ $users->withQueryString()->nextPageUrl() }}" class="px-3 py-1 rounded bg-primary/10 text-primary text-sm hover:bg-primary/20">Вперёд</a>
        @else<span class="px-3 py-1 rounded bg-slate-100 dark:bg-slate-700 text-sm admin2-text-muted">Вперёд</span>@endif
    </div>
    @endif
</div>

{{-- Модальное окно профиля пользователя --}}
<div id="admin2-user-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-modal="true">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/50" id="admin2-user-modal-backdrop"></div>
        <div class="relative admin2-card rounded-xl shadow-xl max-w-lg w-full p-6 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-lg font-semibold">Профиль пользователя</h3>
                <button type="button" id="admin2-user-modal-close" class="p-1 rounded hover:bg-slate-200 dark:hover:bg-slate-600">&times;</button>
            </div>
            <div id="admin2-user-modal-body" class="space-y-4">
                <div class="flex gap-4 items-start">
                    <div class="flex-shrink-0">
                        <img id="admin2-user-avatar" src="" alt="Аватар" class="w-20 h-20 rounded-full object-cover border-2 border-slate-200 dark:border-slate-600" style="display:none;">
                        <div id="admin2-user-avatar-placeholder" class="w-20 h-20 rounded-full bg-slate-200 dark:bg-slate-600 flex items-center justify-center text-2xl font-semibold admin2-text-muted"></div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-lg" id="admin2-user-name">—</p>
                        <p class="text-sm admin2-text-muted" id="admin2-user-email">—</p>
                        <p class="text-sm mt-1">Роль: <span id="admin2-user-role" class="font-medium">—</span></p>
                        <p class="text-sm">Заказов: <span id="admin2-user-orders">0</span></p>
                        <p class="text-sm admin2-text-muted">Регистрация: <span id="admin2-user-created">—</span></p>
                    </div>
                </div>
                <form id="admin2-user-form" action="{{ route('adminPanel2.user.update', ['id' => 0]) }}" method="post" enctype="multipart/form-data" class="space-y-3 border-t border-slate-200 dark:border-slate-600 pt-4">
                    @csrf
                    <div>
                        <label class="block text-xs admin2-text-muted mb-1">Имя</label>
                        <input type="text" name="name" id="admin2-user-input-name" class="w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs admin2-text-muted mb-1">Email</label>
                        <input type="email" name="email" id="admin2-user-input-email" class="w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs admin2-text-muted mb-1">Роль</label>
                        <select name="role" id="admin2-user-input-role" class="w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm">
                            <option value="user">user</option>
                            <option value="moderator">moderator</option>
                            <option value="admin">admin</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs admin2-text-muted mb-1">Новый аватар</label>
                        <input type="file" name="avatar" accept="image/jpeg,image/png,image/gif" class="w-full text-sm">
                    </div>
                    <div class="flex flex-wrap gap-2 items-center">
                        <button type="submit" class="px-4 py-2 rounded-lg bg-primary text-white text-sm font-medium hover:opacity-90">Сохранить</button>
                        <button type="button" id="admin2-user-modal-cancel" class="px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 text-sm">Закрыть</button>
                        <span id="admin2-user-delete-wrap" class="ml-auto" style="display:none;">
                            <form action="" method="post" id="admin2-user-delete-form" class="inline" onsubmit="return confirm('Удалить этого пользователя? Заказы будут удалены.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 text-white text-sm font-medium hover:bg-red-700">Удалить</button>
                            </form>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Модальное окно: добавить пользователя --}}
<div id="admin2-user-add-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-modal="true">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/50" id="admin2-user-add-backdrop"></div>
        <div class="relative admin2-card rounded-xl shadow-xl max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Добавить пользователя</h3>
                <button type="button" id="admin2-user-add-close" class="p-1 rounded hover:bg-slate-200 dark:hover:bg-slate-600">&times;</button>
            </div>
            <form action="{{ route('users.store') }}" method="post" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-xs admin2-text-muted mb-1">Имя</label>
                    <input type="text" name="name" required class="w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-xs admin2-text-muted mb-1">Email</label>
                    <input type="email" name="email" required class="w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-xs admin2-text-muted mb-1">Пароль</label>
                    <input type="password" name="password" required minlength="8" class="w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-xs admin2-text-muted mb-1">Пароль ещё раз</label>
                    <input type="password" name="password_confirmation" required minlength="8" class="w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-xs admin2-text-muted mb-1">Роль</label>
                    <select name="role" class="w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm">
                        <option value="user">user</option>
                        <option value="moderator">moderator</option>
                        <option value="admin">admin</option>
                    </select>
                </div>
                <div class="flex gap-2 pt-2">
                    <button type="submit" class="px-4 py-2 rounded-lg bg-primary text-white text-sm font-medium hover:opacity-90">Создать</button>
                    <button type="button" id="admin2-user-add-cancel" class="px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 text-sm">Отмена</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script>
(function() {
    var modal = document.getElementById('admin2-user-modal');
    var backdrop = document.getElementById('admin2-user-modal-backdrop');
    var closeBtn = document.getElementById('admin2-user-modal-close');
    var cancelBtn = document.getElementById('admin2-user-modal-cancel');
    var form = document.getElementById('admin2-user-form');
    var img = document.getElementById('admin2-user-avatar');
    var placeholder = document.getElementById('admin2-user-avatar-placeholder');
    var currentUserId = {{ Auth::id() }};
    function openModal(data) {
        var id = data.userId || data.getAttribute('data-user-id');
        var name = data.name || data.getAttribute('data-name');
        var email = data.email || data.getAttribute('data-email');
        var role = data.role || data.getAttribute('data-role');
        var avatar = data.avatar || data.getAttribute('data-avatar');
        var created = data.created || data.getAttribute('data-created');
        var orders = data.ordersCount ?? data.getAttribute('data-orders-count');
        document.getElementById('admin2-user-name').textContent = name || '—';
        document.getElementById('admin2-user-email').textContent = email || '—';
        document.getElementById('admin2-user-role').textContent = role || '—';
        document.getElementById('admin2-user-orders').textContent = orders ?? '0';
        document.getElementById('admin2-user-created').textContent = created || '—';
        document.getElementById('admin2-user-input-name').value = name || '';
        var emailEl = document.getElementById('admin2-user-input-email');
        if (emailEl) emailEl.value = email || '';
        document.getElementById('admin2-user-input-role').value = role || 'user';
        form.action = form.action.replace(/\/\d+\/update$/, '/' + id + '/update');
        form.querySelector('input[name="avatar"]').value = '';
        if (avatar) { img.src = avatar; img.style.display = ''; placeholder.style.display = 'none'; }
        else { img.style.display = 'none'; placeholder.style.display = 'flex'; placeholder.textContent = (name || '?').charAt(0).toUpperCase(); }
        var delWrap = document.getElementById('admin2-user-delete-wrap');
        var delForm = document.getElementById('admin2-user-delete-form');
        if (delWrap && delForm && String(id) !== String(currentUserId)) {
            delForm.action = '{{ route("users.destroy", ["id" => 0]) }}'.replace(/\/0$/, '/' + id);
            delWrap.style.display = '';
        } else if (delWrap) { delWrap.style.display = 'none'; }
        modal.classList.remove('hidden');
    }
    function closeModal() { modal.classList.add('hidden'); }
    document.querySelectorAll('.admin2-user-row').forEach(function(row) {
        row.addEventListener('click', function(e) {
            if (e.target.tagName === 'SELECT' || e.target.tagName === 'BUTTON' || e.target.closest('form')) return;
            openModal(this);
        });
    });
    if (backdrop) backdrop.addEventListener('click', closeModal);
    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
    var addModal = document.getElementById('admin2-user-add-modal');
    var addBtn = document.getElementById('admin2-user-add-btn');
    var addClose = document.getElementById('admin2-user-add-close');
    var addBackdrop = document.getElementById('admin2-user-add-backdrop');
    var addCancel = document.getElementById('admin2-user-add-cancel');
    function openAddModal() { if (addModal) addModal.classList.remove('hidden'); }
    function closeAddModal() { if (addModal) addModal.classList.add('hidden'); }
    if (addBtn) addBtn.addEventListener('click', openAddModal);
    if (addClose) addClose.addEventListener('click', closeAddModal);
    if (addBackdrop) addBackdrop.addEventListener('click', closeAddModal);
    if (addCancel) addCancel.addEventListener('click', closeAddModal);
})();
</script>
@endpush
