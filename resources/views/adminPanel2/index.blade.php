@extends('layouts.admin2')

@section('title', $headings[$page] ?? 'Админ-панель')
@section('heading', $headings[$page] ?? 'Админ-панель')

@section('content')
    @include('adminPanel2.partials.' . $page)
@endsection

@if($page === 'dashboard')
    @push('scripts')
    <script>
        (function() {
            var barData = @json(array_values($chartBar));
            var monthNames = ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'];
            var barCtx = document.getElementById('admin2-bar-chart');
            if (barCtx && typeof Chart !== 'undefined') {
                var isDark = document.documentElement.getAttribute('data-theme') === 'dark';
                var gridColor = isDark ? 'rgba(148,163,184,0.2)' : 'rgba(0,0,0,0.08)';
                new Chart(barCtx, {
                    type: 'bar',
                    data: { labels: monthNames, datasets: [{ label: 'Заказы', data: barData, backgroundColor: 'rgba(29, 78, 216, 0.6)', borderColor: '#1d4ed8', borderWidth: 1 }] },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, grid: { color: gridColor } }, x: { grid: { display: false } } } }
                });
            }
            var pieData = @json($chartPie);
            var pieCtx = document.getElementById('admin2-pie-chart');
            if (pieCtx && typeof Chart !== 'undefined') {
                new Chart(pieCtx, {
                    type: 'doughnut',
                    data: { labels: Object.keys(pieData), datasets: [{ data: Object.values(pieData), backgroundColor: ['#1d4ed8', '#16a34a', '#94a3b8'], borderWidth: 0 }] },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
                });
            }
        })();
    </script>
    @endpush
@endif
