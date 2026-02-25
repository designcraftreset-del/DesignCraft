@php
    $chartYear = $chartYear ?? now()->year;
    $chartMonth = $chartMonth ?? now()->month;
    $availableYears = $availableYears ?? [$chartYear];
    $monthNamesRu = ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'];
@endphp
<form method="get" action="{{ route('adminPanel2', ['page' => 'analytics']) }}" class="admin2-card rounded-xl p-4 mb-4">
    <input type="hidden" name="page" value="analytics">
    <div class="flex flex-wrap items-end gap-3">
        <div>
            <label class="block text-xs admin2-text-muted mb-1">Год (заказы по месяцам)</label>
            <select name="chart_year" class="rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm w-32">
                @foreach($availableYears as $y)
                    <option value="{{ $y }}" {{ (int)$chartYear === (int)$y ? 'selected' : '' }}>{{ $y }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-xs admin2-text-muted mb-1">Месяц (заказы по дням)</label>
            <select name="chart_month" class="rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-3 py-2 text-sm w-40">
                @for($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ (int)$chartMonth === $m ? 'selected' : '' }}>{{ $monthNamesRu[$m-1] }}</option>
                @endfor
            </select>
        </div>
        <button type="submit" class="px-4 py-2 rounded-lg bg-primary text-white text-sm font-medium hover:opacity-90">Применить</button>
    </div>
</form>
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="admin2-card rounded-xl p-5 shadow-sm">
        <h2 class="text-lg font-semibold mb-4">Заказы по месяцам ({{ $chartYear }})</h2>
        <div class="h-64">
            <canvas id="admin2-analytics-bar"></canvas>
        </div>
    </div>
    <div class="admin2-card rounded-xl p-5 shadow-sm">
        <h2 class="text-lg font-semibold mb-4">Распределение по статусам</h2>
        <div class="h-64 flex items-center justify-center">
            <canvas id="admin2-analytics-pie"></canvas>
        </div>
    </div>
</div>
<div class="admin2-card rounded-xl p-5 shadow-sm mb-6">
    <h2 class="text-lg font-semibold mb-4">Заказы по дням ({{ $monthNamesRu[$chartMonth - 1] }} {{ $chartYear }})</h2>
    <div class="h-64">
        <canvas id="admin2-analytics-days"></canvas>
    </div>
</div>
<div class="admin2-card rounded-xl p-5 shadow-sm">
    <h2 class="text-lg font-semibold mb-4">Сводка</h2>
    <ul class="space-y-2 admin2-text-muted">
        <li>Всего заказов: <span class="font-semibold text-primary">{{ $totalOrders }}</span></li>
        <li>Завершённых: <span class="font-semibold text-primary">{{ $completedOrders }}</span></li>
        <li>В работе: <span class="font-semibold text-primary">{{ $inProgress }}</span></li>
        <li>За текущий месяц: <span class="font-semibold text-primary">{{ $ordersThisMonth }}</span></li>
        <li>Пользователей: <span class="font-semibold text-primary">{{ $totalUsers }}</span></li>
    </ul>
</div>
@push('scripts')
<script>
(function() {
    var barData = @json(array_values($chartBar ?? array_fill(0, 12, 0)));
    var monthNames = ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'];
    var barCtx = document.getElementById('admin2-analytics-bar');
    if (barCtx && typeof Chart !== 'undefined') {
        new Chart(barCtx, {
            type: 'bar',
            data: { labels: monthNames, datasets: [{ label: 'Заказы', data: barData, backgroundColor: 'rgba(29, 78, 216, 0.6)', borderColor: '#1d4ed8', borderWidth: 1 }] },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true }, x: { grid: { display: false } } } }
        });
    }
    var pieData = @json($chartPie ?? []);
    var pieCtx = document.getElementById('admin2-analytics-pie');
    if (pieCtx && typeof Chart !== 'undefined') {
        new Chart(pieCtx, {
            type: 'doughnut',
            data: { labels: Object.keys(pieData), datasets: [{ data: Object.values(pieData), backgroundColor: ['#1d4ed8', '#16a34a', '#94a3b8'], borderWidth: 0 }] },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
        });
    }
    var dayData = @json(array_values($chartByDay ?? []));
    var dayLabels = @json(range(1, $daysInMonth ?? 31));
    var dayCtx = document.getElementById('admin2-analytics-days');
    if (dayCtx && typeof Chart !== 'undefined') {
        new Chart(dayCtx, {
            type: 'bar',
            data: { labels: dayLabels, datasets: [{ label: 'Заказы', data: dayData, backgroundColor: 'rgba(29, 78, 216, 0.5)', borderColor: '#1d4ed8', borderWidth: 1 }] },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true }, x: { grid: { display: false } } } }
        });
    }
})();
</script>
@endpush
