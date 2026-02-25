@php
    $f = $filters ?? [];
    $reviewStatus = $f['review_status'] ?? 'pending';
    $baseQuery = array_merge(request()->query(), ['page' => 'reviews']);
@endphp
<form method="get" action="{{ route('adminPanel2', ['page' => 'reviews']) }}" class="admin2-card rounded-xl p-4 mb-4">
    <input type="hidden" name="page" value="reviews">
    <div class="flex flex-wrap items-end gap-3">
        <div>
            <label class="block text-xs admin2-text-muted mb-1">Статус</label>
            <select name="filter_review_status" class="rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm w-48">
                <option value="pending" {{ $reviewStatus === 'pending' ? 'selected' : '' }}>На модерации</option>
                <option value="approved" {{ $reviewStatus === 'approved' ? 'selected' : '' }}>Опубликованные</option>
                <option value="all" {{ $reviewStatus === 'all' ? 'selected' : '' }}>Все</option>
            </select>
        </div>
        <button type="submit" class="px-4 py-2 rounded-lg bg-primary text-white text-sm font-medium hover:opacity-90">Применить</button>
        <a href="{{ route('adminPanel2', ['page' => 'reviews']) }}" class="px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 text-sm">Сбросить</a>
    </div>
</form>
<div class="admin2-card rounded-xl shadow-sm overflow-hidden">
    <div class="px-5 py-4 border-b border-slate-200 dark:border-slate-600 flex flex-wrap items-center justify-between gap-2">
        <h2 class="text-lg font-semibold">Отзывы</h2>
        @if(isset($reviewsPendingCount) && $reviewsPendingCount > 0)
            <span class="text-sm admin2-text-muted">На модерации: <strong>{{ $reviewsPendingCount }}</strong></span>
        @endif
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="admin2-text-muted text-sm font-medium border-b border-slate-200 dark:border-slate-600">
                <tr>
                    <th class="px-5 py-3">#</th>
                    <th class="px-5 py-3">Автор</th>
                    <th class="px-5 py-3">Текст</th>
                    <th class="px-5 py-3">Рейтинг</th>
                    <th class="px-5 py-3">Дата</th>
                    <th class="px-5 py-3">Статус</th>
                    <th class="px-5 py-3">Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reviewsAll as $review)
                <tr class="border-b border-slate-100 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800/50 admin2-review-row" data-review-id="{{ $review->id }}" data-user-id="{{ $review->user_id ?? '' }}">
                    <td class="px-5 py-3">{{ $review->id }}</td>
                    <td class="px-5 py-3">
                        <span class="font-medium">{{ $review->client_name ?? '—' }}</span>
                        @if($review->client_position)
                            <span class="block text-xs admin2-text-muted">{{ $review->client_position }}</span>
                        @endif
                        @if($review->user)
                            <span class="block text-xs admin2-text-muted">user #{{ $review->user_id }}</span>
                        @endif
                    </td>
                    <td class="px-5 py-3 text-sm max-w-xs">
                        <span class="line-clamp-2">{{ Str::limit($review->review_text, 120) }}</span>
                    </td>
                    <td class="px-5 py-3">
                        <span class="inline-flex items-center gap-0.5" title="{{ $review->rating }} из 5">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="text-amber-500">{{ $i <= $review->rating ? '★' : '☆' }}</span>
                            @endfor
                        </span>
                    </td>
                    <td class="px-5 py-3 admin2-text-muted text-sm">{{ $review->created_at?->format('d.m.Y H:i') ?? '—' }}</td>
                    <td class="px-5 py-3">
                        @if($review->is_approved)
                            <span class="px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-200">Опубликован</span>
                        @else
                            <span class="px-2 py-0.5 rounded text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-200">На модерации</span>
                        @endif
                    </td>
                    <td class="px-5 py-3">
                        <div class="flex flex-wrap gap-1 items-center">
                            @if($review->user_id)
                                <button type="button" class="admin2-review-profile-btn px-2 py-1 rounded text-xs border border-slate-300 dark:border-slate-500 hover:bg-slate-100 dark:hover:bg-slate-700" data-user-id="{{ $review->user_id }}" title="Профиль пользователя">Профиль</button>
                            @endif
                            <button type="button" class="admin2-review-edit-btn px-2 py-1 rounded text-xs border border-primary text-primary hover:bg-primary hover:text-white" data-review-id="{{ $review->id }}" data-name="{{ e($review->client_name) }}" data-position="{{ e($review->client_position ?? '') }}" data-text="{{ e($review->review_text) }}" data-rating="{{ $review->rating }}" data-approved="{{ $review->is_approved ? '1' : '0' }}">Редактировать</button>
                            <button type="button" class="admin2-review-delete-btn px-2 py-1 rounded text-xs font-medium bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-200 hover:bg-red-200 dark:hover:bg-red-900/50" data-review-id="{{ $review->id }}" data-review-text="{{ Str::limit(e($review->review_text), 40) }}">Удалить</button>
                            @if(!$review->is_approved)
                                <button type="button" class="admin2-review-approve-btn px-2 py-1 rounded text-xs font-medium bg-green-600 text-white hover:bg-green-700" data-review-id="{{ $review->id }}">Одобрить</button>
                                <button type="button" class="admin2-review-reject-btn px-2 py-1 rounded text-xs font-medium bg-slate-500 text-white hover:bg-slate-600" data-review-id="{{ $review->id }}">Отклонить</button>
                            @else
                                <button type="button" class="admin2-review-reject-btn px-2 py-1 rounded text-xs border border-slate-400 dark:border-slate-500 admin2-text-muted hover:bg-slate-100 dark:hover:bg-slate-700" data-review-id="{{ $review->id }}" title="Снять с публикации">Снять</button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-5 py-8 admin2-text-muted text-center">Нет отзывов по выбранному фильтру</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(isset($reviewsAll) && $reviewsAll->hasPages())
        <div class="px-5 py-3 border-t border-slate-200 dark:border-slate-600">
            {{ $reviewsAll->links() }}
        </div>
    @endif
</div>

@push('scripts')
<script>
(function() {
    var csrf = document.querySelector('meta[name="csrf-token"]');
    var csrfToken = csrf ? csrf.getAttribute('content') : '';
    var baseUrl = '{{ url("/adminPanel2/reviews") }}';

    function updateReview(id, isApproved, btn) {
        var row = document.querySelector('.admin2-review-row[data-review-id="' + id + '"]');
        fetch(baseUrl + '/' + id, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ is_approved: isApproved ? 1 : 0 })
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data.success && row) {
                if (isApproved) {
                    var statusCell = row.querySelector('td:nth-child(6)');
                    var actionsCell = row.querySelector('td:nth-child(7)');
                    if (statusCell) statusCell.innerHTML = '<span class="px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-200">Опубликован</span>';
                    if (actionsCell) actionsCell.innerHTML = '<button type="button" class="admin2-review-reject-btn px-2 py-1 rounded text-xs border border-slate-400 dark:border-slate-500 admin2-text-muted hover:bg-slate-100 dark:hover:bg-slate-700" data-review-id="' + id + '" title="Снять с публикации">Снять</button>';
                } else {
                    var statusCell = row.querySelector('td:nth-child(6)');
                    var actionsCell = row.querySelector('td:nth-child(7)');
                    if (statusCell) statusCell.innerHTML = '<span class="px-2 py-0.5 rounded text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-200">На модерации</span>';
                    if (actionsCell) actionsCell.innerHTML = '<button type="button" class="admin2-review-approve-btn px-2 py-1 rounded text-xs font-medium bg-green-600 text-white hover:bg-green-700 mr-1" data-review-id="' + id + '">Одобрить</button><button type="button" class="admin2-review-reject-btn px-2 py-1 rounded text-xs font-medium bg-slate-500 text-white hover:bg-slate-600" data-review-id="' + id + '">Отклонить</button>';
                }
                bindReviewButtons();
            }
        })
        .catch(function(err) { console.error(err); });
    }

    function bindReviewButtons() {
        document.querySelectorAll('.admin2-review-approve-btn').forEach(function(btn) {
            btn.removeEventListener('click', approveHandler);
            btn.addEventListener('click', approveHandler);
        });
        document.querySelectorAll('.admin2-review-reject-btn').forEach(function(btn) {
            btn.removeEventListener('click', rejectHandler);
            btn.addEventListener('click', rejectHandler);
        });
        document.querySelectorAll('.admin2-review-profile-btn').forEach(function(btn) {
            btn.onclick = function() {
                var uid = this.getAttribute('data-user-id');
                if (!uid || typeof window.openAdminUserModalByData !== 'function') return;
                fetch(('{{ url("/adminPanel2/api/user") }}' + '/' + uid), { headers: { 'Accept': 'application/json' } })
                    .then(function(r) { return r.json(); })
                    .then(function(data) {
                        if (!data || data.error) return;
                        window.openAdminUserModalByData({ userId: data.id, name: data.name, email: data.email, role: data.role, avatar: data.avatar, created: data.created_at, ordersCount: data.orders_count, orders: data.orders || [], reviews: data.reviews || [] });
                    });
            };
        });
        document.querySelectorAll('.admin2-review-edit-btn').forEach(function(btn) {
            btn.onclick = function() {
                var id = this.getAttribute('data-review-id');
                var row = document.querySelector('.admin2-review-row[data-review-id="' + id + '"]');
                if (!row || row.querySelector('.review-edit-form')) return;
                var name = this.getAttribute('data-name') || '';
                var position = this.getAttribute('data-position') || '';
                var text = this.getAttribute('data-text') || '';
                var rating = this.getAttribute('data-rating') || '5';
                var approved = this.getAttribute('data-approved') !== '0';
                var tr = document.createElement('tr');
                tr.className = 'review-edit-form border-b border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50';
                tr.innerHTML = '<td colspan="7" class="px-5 py-3"><form class="admin2-review-edit-form-inner space-y-2 p-3 rounded-lg border border-slate-200 dark:border-slate-600" data-review-id="' + id + '">' +
                    '<input type="text" name="client_name" value="' + name.replace(/"/g, '&quot;').replace(/</g, '&lt;') + '" placeholder="Имя" class="w-full rounded border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-2 py-1 text-sm">' +
                    '<input type="text" name="client_position" value="' + (position || '').replace(/"/g, '&quot;').replace(/</g, '&lt;') + '" placeholder="Должность" class="w-full rounded border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-2 py-1 text-sm">' +
                    '<textarea name="review_text" rows="3" class="w-full rounded border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-2 py-1 text-sm">' + (text || '').replace(/</g, '&lt;') + '</textarea>' +
                    '<select name="rating" class="rounded border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-2 py-1 text-sm">' + [5,4,3,2,1].map(function(r) { return '<option value="' + r + '"' + (String(r) === String(rating) ? ' selected' : '') + '>' + r + '</option>'; }).join('') + '</select>' +
                    '<label class="flex items-center gap-1 text-xs"><input type="checkbox" name="is_approved" ' + (approved ? 'checked' : '') + '> Опубликован</label>' +
                    '<div class="flex gap-2"><button type="submit" class="px-3 py-1.5 bg-primary text-white text-sm rounded">Сохранить</button><button type="button" class="review-edit-cancel px-3 py-1.5 border rounded text-sm">Отмена</button></div></form></td>';
                row.after(tr);
                var form = tr.querySelector('form');
                tr.querySelector('.review-edit-cancel').addEventListener('click', function() { tr.remove(); });
                form.addEventListener('submit', function(ev) {
                    ev.preventDefault();
                    var fd = new FormData(form);
                    fd.append('_token', csrfToken);
                    fd.append('_method', 'PUT');
                    fd.set('is_approved', form.querySelector('[name=is_approved]').checked ? '1' : '0');
                    fetch(baseUrl + '/' + id, { method: 'PUT', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }, body: JSON.stringify({ client_name: fd.get('client_name'), client_position: fd.get('client_position'), review_text: fd.get('review_text'), rating: parseInt(fd.get('rating'), 10), is_approved: fd.get('is_approved') === '1' }) })
                        .then(function(r) { return r.json(); })
                        .then(function(data) {
                            if (data.success && data.review) {
                                tr.remove();
                                var statusCell = row.querySelector('td:nth-child(6)');
                                var actionsCell = row.querySelector('td:nth-child(7)');
                                var textCell = row.querySelector('td:nth-child(3)');
                                if (textCell) textCell.innerHTML = '<span class="line-clamp-2">' + (data.review.review_text || '').substring(0, 120) + (data.review.review_text && data.review.review_text.length > 120 ? '…' : '') + '</span>';
                                if (statusCell) statusCell.innerHTML = data.review.is_approved ? '<span class="px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-200">Опубликован</span>' : '<span class="px-2 py-0.5 rounded text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-200">На модерации</span>';
                                if (actionsCell) {
                                    var approved = data.review.is_approved;
                                    var uid = row.getAttribute('data-user-id') || '';
                                    var profileBtn = uid ? '<button type="button" class="admin2-review-profile-btn px-2 py-1 rounded text-xs border border-slate-300 dark:border-slate-500 hover:bg-slate-100 dark:hover:bg-slate-700" data-user-id="' + uid + '" title="Профиль пользователя">Профиль</button>' : '';
                                    actionsCell.innerHTML = profileBtn +
                                        '<button type="button" class="admin2-review-edit-btn px-2 py-1 rounded text-xs border border-primary text-primary hover:bg-primary hover:text-white" data-review-id="' + id + '" data-name="' + (data.review.client_name || '').replace(/"/g, '&quot;') + '" data-position="' + (data.review.client_position || '').replace(/"/g, '&quot;') + '" data-text="' + (data.review.review_text || '').replace(/"/g, '&quot;').replace(/</g, '&lt;') + '" data-rating="' + (data.review.rating || 5) + '" data-approved="' + (approved ? '1' : '0') + '">Редактировать</button>' +
                                        '<button type="button" class="admin2-review-delete-btn px-2 py-1 rounded text-xs font-medium bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-200 hover:bg-red-200 dark:hover:bg-red-900/50" data-review-id="' + id + '" data-review-text="' + (data.review.review_text || '').substring(0, 40).replace(/"/g, '&quot;') + '">Удалить</button>' +
                                        (approved ? '<button type="button" class="admin2-review-reject-btn px-2 py-1 rounded text-xs border border-slate-400 dark:border-slate-500 admin2-text-muted hover:bg-slate-100 dark:hover:bg-slate-700" data-review-id="' + id + '" title="Снять с публикации">Снять</button>' : '<button type="button" class="admin2-review-approve-btn px-2 py-1 rounded text-xs font-medium bg-green-600 text-white hover:bg-green-700" data-review-id="' + id + '">Одобрить</button><button type="button" class="admin2-review-reject-btn px-2 py-1 rounded text-xs font-medium bg-slate-500 text-white hover:bg-slate-600" data-review-id="' + id + '">Отклонить</button>');
                                    bindReviewButtons();
                                }
                            }
                        });
                });
            };
        });
        document.querySelectorAll('.admin2-review-delete-btn').forEach(function(btn) {
            btn.onclick = function() {
                var id = this.getAttribute('data-review-id');
                var text = this.getAttribute('data-review-text') || '';
                if (!confirm('Удалить отзыв?' + (text ? '\n«' + text + '»' : ''))) return;
                var row = document.querySelector('.admin2-review-row[data-review-id="' + id + '"]');
                fetch('{{ url("/reviews") }}/' + id, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                }).then(function(r) { return r.json(); }).then(function(data) {
                    if (data.success && row) row.remove();
                }).catch(function() { if (row) row.remove(); });
            };
        });
    }
    function approveHandler() { var id = this.getAttribute('data-review-id'); if (id) updateReview(id, true, this); }
    function rejectHandler() { var id = this.getAttribute('data-review-id'); if (id) updateReview(id, false, this); }

    bindReviewButtons();
})();
</script>
@endpush
