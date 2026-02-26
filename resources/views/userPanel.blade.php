@extends('layouts.app')

@section('content')
<style>
    
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
    margin-bottom: 40px;
}

.stat-card-modern {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    padding: 30px 25px;
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.5);
    text-align: center;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
}

.stat-card-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 10px;
    filter: blur(20px);
    background: linear-gradient(90deg, #3b82f6, #1e40af);
}

.stat-card-modern:hover {
    box-shadow: 0 20px 40px rgba(59, 130, 246, 0.15);
}

.stat-icon {
    width: 70px;
    height: 70px;
    margin: 0 auto 20px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #3b82f6, #1e40af);
    position: relative;
    transition: all 0.3s ease;
}

.stat-card-modern:hover .stat-icon {
    transform: scale(1.1) rotate(5deg);
}

.stat-icon.orders { 
    background: linear-gradient(135deg, #3b82f6, #1e40af); 
}
.stat-icon.active { 
    background: linear-gradient(135deg, #10b981, #059669); 
}
.stat-icon.completed { 
    background: linear-gradient(135deg, #f59e0b, #d97706); 
}
.stat-icon.reviews { 
    background: linear-gradient(135deg, #ec4899, #db2777); 
}

.stat-icon svg {
    width: 32px;
    height: 32px;
    stroke: white;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
}

.stat-value {
    font-size: 42px;
    font-weight: 900;
    color: #1e3a8a;
    margin-bottom: 8px;
    background: linear-gradient(135deg, #1e3a8a, #3b82f6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.stat-label {
    font-size: 15px;
    color: #6b7280;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

/* Темная тема для статистики */
.dark-theme .stat-card-modern {
    background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
    border-color: #374151;
}

.dark-theme .stat-value {
    background: linear-gradient(135deg, #24edfbffrgba(11, 34, 245, 1)0b);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
</style>
<style>
    /* Новые стили для дополнительных секций */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .stat-card-modern {
        background: white;
        padding: 25px;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
        text-align: center;
        transition: all 0.3s ease;
    }

    .stat-card-modern:hover {
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        margin: 0 auto 15px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .stat-icon.orders { background: #eff6ff; color: #3b82f6; }
    .stat-icon.active { background: #f0fdf4; color: #10b981; }
    .stat-icon.completed { background: #fef7ed; color: #f59e0b; }
    .stat-icon.reviews { background: #fdf2f8; color: #ec4899; }

    .stat-value {
        font-size: 32px;
        font-weight: 800;
        color: #1e3a8a;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 14px;
        color: #6b7280;
        font-weight: 600;
    }

    .reviews-section {
        margin-bottom: 40px;
    }

    /* Стили для статистики услуг */
    .services-stats {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 40px;
    }

    .service-stat-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #f3f4f6;
    }

    .service-stat-item:last-child {
        border-bottom: none;
    }

    .service-name {
        font-weight: 600;
        color: #374151;
    }

    .service-count {
        background: #3b82f6;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    /* Стили для прогресс-бара */
    .progress-bar {
        width: 100%;
        height: 6px;
        background: #e5e7eb;
        border-radius: 3px;
        overflow: hidden;
        margin-top: 5px;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #3b82f6, #1e40af);
        border-radius: 3px;
        transition: width 0.3s ease;
    }

    /* Анимации */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in-up {
        animation: fadeInUp 0.6s ease forwards;
    }

    /* Темная тема */
    .dark-theme .stat-card-modern,
    .dark-theme .services-stats {
        background: #1f2937;
        border-color: #374151;
        color: #f9fafb;
    }

    .dark-theme .stat-value {
        color: #fbbf24;
    }

    .dark-theme .service-name {
        color: #f9fafb;
    }

</style>
<style>
    .account-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 120px 20px 60px;
    }
    
    .account-header {
        display: flex;
        align-items: center;
        gap: 30px;
        margin-bottom: 40px;
        padding: 30px;
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        border-radius: 20px;
        color: white;
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
    }
    
    .account-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        font-weight: 700;
        border: 3px solid rgba(255, 255, 255, 0.3);
        overflow: hidden;
    }
    .account-avatar-initials { display: block; }
    .account-avatar-wrap {
        position: relative;
        width: 100px;
        height: 100px;
        flex-shrink: 0;
    }
    .account-avatar-overlay {
        position: absolute;
        inset: 0;
        border-radius: 50%;
        background: rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        opacity: 0;
        transition: opacity 0.2s;
    }
    .account-avatar-wrap:hover .account-avatar-overlay { opacity: 1; }
    .account-avatar-btn {
        width: 36px;
        height: 36px;
        border: none;
        border-radius: 50%;
        background: rgba(255,255,255,0.9);
        color: #1e3a8a;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        transition: transform 0.2s;
    }
    .account-avatar-btn:hover { transform: scale(1.1); }
    .account-avatar-btn--delete { background: rgba(220, 38, 38, 0.9); color: #fff; }
    .user-panel-form__hint { font-size: 0.8rem; color: #6b7280; margin-top: 4px; }
    .dark-theme .user-panel-form__hint { color: #9ca3af; }
    
    .account-info h1 {
        font-size: 32px;
        margin-bottom: 10px;
        color: white;
    }
    
    .account-info p {
        font-size: 16px;
        opacity: 0.9;
        color: white;
    }
    
    .orders-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 25px;
        margin-top: 30px;
    }
    .orders-grid-wrap--scroll {
        max-height: 75vh;
        overflow-y: auto;
        margin-top: 30px;
    }
    .orders-grid-wrap--scroll .orders-grid { margin-top: 0; }
    
    .order-card-modern {
        background: white;
        border-radius: 16px;
        padding: 0;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .order-card-modern:hover {
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }
    
    .order-header-modern {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: white;
        padding: 20px;
        position: relative;
    }
    
    .order-id-modern {
        color: white;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 5px;
    }
    
    .order-date-modern {
        color: #cacacaff;
        font-size: 14px;
        opacity: 0.9;
    }
    
    .order-status-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .status-new {
        background: rgba(255, 255, 255, 0.2);
        color: white;
    }
    
    .status-processing {
        background: #cf68ffff;
        color: #620e92ff;
    }
    
    .status-completed {
        background: #10b981;
        color: white;
    }
    
    .status-cancelled {
        background: #ef4444;
        color: white;
    }
    
    .order-content {
        padding: 20px;
    }
    
    .service-badge {
        display: inline-block;
        background: #eff6ff;
        color: #1e40af;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 15px;
    }
    
    .order-details-grid {
        display: grid;
        gap: 12px;
        margin-bottom: 20px;
    }
    
    .detail-item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #6b7280;
        font-size: 14px;
    }
    
    .detail-item strong {
        color: #374151;
        min-width: 80px;
    }
    
    .order-description {
        background: #0000000e;
        padding: 15px;
        border-radius: 10px;
        margin: 15px 0;
    }
    
    .order-description h4 {
        color: #1e3a8a;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 600;
    }
    
    .order-description p {
        color: #6b7280;
        font-size: 14px;
        line-height: 1.5;
        margin: 0;
    }
    
    .order-actions-modern {
        display: flex;
        gap: 10px;
        padding-top: 15px;
        border-top: 1px solid #e5e7eb;
    }
    
    .btn-modern {
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        flex: 1;
        text-align: center;
    }
    
    .btn-danger-modern {
        background: #ef4444;
        color: white;
    }
    
    .btn-danger-modern:hover {
        background: #dc2626;
    }
    
    .empty-state-modern {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }
    
    .empty-state-icon {
        font-size: 64px;
        margin-bottom: 20px;
        color: #cbd5e1;
    }
    
    .empty-state-modern h3 {
        color: #374151;
        margin-bottom: 10px;
        font-size: 24px;
    }
    
    .empty-state-modern p {
        color: #6b7280;
        margin-bottom: 25px;
        font-size: 16px;
    }
    
    .section-title-modern {
        width: 100%;
        font-size: 28px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 10px;
        text-align: center;
    }
    
    .section-subtitle {
        text-align: center;
        color: #6b7280;
        margin-bottom: 30px;
        font-size: 16px;
    }
    
    .logout-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 20px;
        background: #ef4444;
        color: white;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        margin-top: 40px;
        width: 100%;
        justify-content: center;
    }
    
    .logout-btn:hover {
        background: #dc2626;
    }
    
    @media (max-width: 768px) {
        .orders-grid { grid-template-columns: 1fr; }
        .order-actions-modern { flex-direction: column; }
        .account-header { flex-direction: column; text-align: center; }
    }

    /* Панель с разделами */
    .user-panel-alert {
        padding: 12px 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-weight: 500;
    }
    .user-panel-alert--success { background: #d1fae5; color: #065f46; }
    .user-panel-alert--error { background: #fee2e2; color: #991b1b; }
    .dark-theme .user-panel-alert--success { background: #064e3b; color: #a7f3d0; }
    .dark-theme .user-panel-alert--error { background: #7f1d1d; color: #fecaca; }

    .user-panel-layout {
        display: grid;
        grid-template-columns: 260px 1fr;
        gap: 30px;
        align-items: start;
    }
    @media (max-width: 900px) {
        .user-panel-layout { grid-template-columns: 1fr; }
    }

    .user-panel-sidebar {
        position: sticky;
        top: 80px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }
    .dark-theme .user-panel-sidebar {
        background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        border-color: #374151;
    }

    .user-panel-nav { padding: 1rem; }
    .user-panel-nav__item {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        padding: 14px 16px;
        border: none;
        background: transparent;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        color: #4b5563;
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: left;
    }
    .user-panel-nav__item:hover { background: #f3f4f6; color: #1e3a8a; }
    .user-panel-nav__item.active { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; }
    .dark-theme .user-panel-nav__item { color: #d1d5db; }
    .dark-theme .user-panel-nav__item:hover { background: #374151; color: #93c5fd; }
    .dark-theme .user-panel-nav__item.active { background: linear-gradient(135deg, #1e40af, #3b82f6); color: white; }
    .user-panel-nav__icon {
        width: 20px;
        height: 20px;
        border-radius: 6px;
        background: currentColor;
        opacity: 0.5;
    }
    body:not(.dark-theme) .user-panel-nav__icon {
        background: rgb(52 113 220);
        opacity: 0.5;
    }

    .user-panel-main { min-width: 0; }
    .user-panel-chat-card { max-width: 563px; width: 100%; }
    .user-panel-section { display: none; }
    .user-panel-section.active { display: block; }

    .user-panel-section-title {
        font-size: 28px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 8px;
    }
    .dark-theme .user-panel-section-title { color: #93c5fd; }
    .user-panel-section-desc {
        color: #6b7280;
        margin-bottom: 24px;
        font-size: 16px;
    }
    .dark-theme .user-panel-section-desc { color: #9ca3af; }

    .user-panel-card {
        width: 100%;
        max-width: 100%;
        background: white;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
    }
    .dark-theme .user-panel-card {
        background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        border-color: #374151;
    }
    .user-panel-form__row { margin-bottom: 20px; }
    .user-panel-form__label {
        display: block;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
        font-size: 14px;
    }
    .dark-theme .user-panel-form__label { color: #e5e7eb; }
    .user-panel-form__input {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        font-size: 15px;
        background: white;
        color: #111;
    }
    .dark-theme .user-panel-form__input {
        background: #374151;
        border-color: #4b5563;
        color: #f9fafb;
    }
    .user-panel-form__input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }
    .user-panel-form__avatar-actions { display: flex; gap: 10px; flex-wrap: wrap; }
    .user-panel-form__error { display: block; font-size: 13px; color: #dc2626; margin-top: 6px; }

    .user-panel-security-card {
        max-width: 420px;
        text-align: left;
        padding: 2rem 1.75rem;
    }
    .user-panel-security-icon {
        width: 56px;
        height: 56px;
        margin: 0 0 1.25rem;
        border-radius: 14px;
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        color: #1d4ed8;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .user-panel-security-lead {
        font-size: 15px;
        line-height: 1.55;
        color: #4b5563;
        margin: 0 0 1rem;
    }
    .user-panel-security-email {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: #f3f4f6;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        color: #1e3a8a;
        margin-bottom: 1.5rem;
        letter-spacing: 0.02em;
    }
    .user-panel-security-form { margin: 0; }
    .user-panel-security-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 12px 24px;
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        box-shadow: 0 4px 14px rgba(30, 64, 175, 0.35);
    }
    .user-panel-security-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(30, 64, 175, 0.4);
    }
    .user-panel-security-btn:active { transform: translateY(0); }
    .user-panel-security-btn svg { color: #fff; stroke: #fff; }

    .dark-theme .user-panel-security-icon {
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
        color: #93c5fd;
    }
    .dark-theme .user-panel-security-lead { color: #9ca3af; }
    .dark-theme .user-panel-security-email {
        background: #374151;
        color: #93c5fd;
    }
    .dark-theme .user-panel-security-btn {
        box-shadow: 0 4px 14px rgba(30, 64, 175, 0.5);
    }
</style>

<main>
    <div class="account-container">
        @auth
        @if(session('success'))
            <div class="user-panel-alert user-panel-alert--success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="user-panel-alert user-panel-alert--error">{{ session('error') }}</div>
        @endif

        <div class="user-panel-layout">
            <aside class="user-panel-sidebar">
                <nav class="user-panel-nav">
                    <button type="button" class="user-panel-nav__item active" data-section="overview" aria-current="true">
                        <span class="user-panel-nav__icon"></span>
                        Обзор
                    </button>
                    <button type="button" class="user-panel-nav__item" data-section="profile">
                        <span class="user-panel-nav__icon"></span>
                        Профиль
                    </button>
                    <button type="button" class="user-panel-nav__item" data-section="security">
                        <span class="user-panel-nav__icon"></span>
                        Безопасность
                    </button>
                    <button type="button" class="user-panel-nav__item" data-section="chats">
                        <span class="user-panel-nav__icon"></span>
                        Чаты с дизайнерами
                    </button>
                </nav>
            </aside>

            <div class="user-panel-main">
                <section class="user-panel-section active" id="section-overview" data-section="overview">
                    <div class="account-header">
                        <div class="account-avatar">
                            @if(Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Аватар" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                            @else
                                {{ mb_substr(Auth::user()->name, 0, 1) }}{{ Auth::user()->name && strpos(Auth::user()->name, ' ') !== false ? mb_substr(Auth::user()->name, strpos(Auth::user()->name, ' ') + 1, 1) : '' }}
                            @endif
                        </div>
                        <div class="account-info">
                            <h1>{{ Auth::user()->name }}</h1>
                            <p>{{ Auth::user()->email }} • Зарегистрирован с {{ Auth::user()->created_at->format('d.m.Y') }}</p>
                        </div>
                    </div>

        @if($orders->count() > 0)
        <div class="stats-grid">
            <div class="stat-card-modern fade-in-up">
                <div class="stat-value">{{ $userStats['total_orders'] ?? 0 }}</div>
                <div class="stat-label">Всего заказов</div>
            </div>
            <div class="stat-card-modern fade-in-up">
                <div class="stat-value">{{ $userStats['active_orders'] ?? 0 }}</div>
                <div class="stat-label">Активные заказы</div>
            </div>
            <div class="stat-card-modern fade-in-up">
                <div class="stat-value">{{ $userStats['completed_orders'] ?? 0 }}</div>
                <div class="stat-label">Завершено</div>
            </div>
            <div class="stat-card-modern fade-in-up">
                <div class="stat-value">{{ $userStats['total_reviews'] ?? 0 }}</div>
                <div class="stat-label">Ваши отзывы</div>
            </div>
        </div>

            <div class="orders-grid-wrap {{ $orders->count() > 6 ? 'orders-grid-wrap--scroll' : '' }}">
            <div class="orders-grid">
                @foreach($orders as $order)
                <div class="order-card-modern">
                    <div class="order-header-modern">
                        <div class="order-id-modern">Заказ #{{ $order->id }}</div>
                        <div class="order-date-modern">{{ $order->created_at->format('d.m.Y в H:i') }}</div>
                        <div class="order-status-badge status-{{ $order->status ?? 'new' }}">
                            @if($order->status == 'new')
                                Новый
                            @elseif($order->status == 'processing')
                                В работе
                            @elseif($order->status == 'completed')
                                Завершен
                            @elseif($order->status == 'cancelled')
                                Отменен
                            @else
                                Новый
                            @endif
                        </div>
                    </div>
                    
                    <div class="order-content">
                        <div class="service-badge">
                            {{ $order->yslyga }}
                        </div>
                        
                        <div class="order-details-grid">
                            <div class="detail-item">
                                <strong> Пакет:</strong>
                                <span>{{ $order->paket ?? '—' }}</span>
                            </div>
                            <div class="detail-item">
                                <strong> Email:</strong>
                                <span>{{ $order->email }}</span>
                            </div>
                            <div class="detail-item">
                                <strong> Телефон:</strong>
                                <span>{{ $order->nomer }}</span>
                            </div>
                            <div class="detail-item">
                                <strong> Клиент:</strong>
                                <span>{{ $order->name }}</span>
                            </div>
                        </div>
                        
                        <div class="order-description">
                            <h4>Описание проекта:</h4>
                            <p>{{ $order->info }}</p>
                        </div>
                        
                        <div class="order-actions-modern" style="display: flex; flex-direction: column; gap: 10px;">
                            <div style="display: flex; flex-wrap: wrap; gap: 8px; align-items: center;">
                                <button type="button" class="btn-modern order-problem-btn" data-order-id="{{ $order->id }}" data-order-yslyga="{{ e($order->yslyga) }}" style="background: #dc2626; color: white;">Проблема с заказом</button>
                                <a href="{{ route('userPanel') }}?order={{ $order->id }}#chats" class="btn-modern order-open-chat-btn" data-order-id="{{ $order->id }}" style="background: #1e40af; color: white; text-decoration: none;">Открыть чат</a>
                            </div>
                            @if(($order->status ?? 'new') == 'new')
                            <div style="width: 100%;">
                                <form action="{{ route('orders.cancel', $order->id) }}" method="POST" style="display: block; width: 100%;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn-modern btn-danger-modern" style="width: 100%;" onclick="return confirm('Вы уверены, что хотите отменить этот заказ?')">Отменить</button>
                                </form>
                            </div>
                            @endif
                        </div>
                        @if($order->preview_path)
                        <div class="order-preview-box" style="margin-top: 10px; padding: 10px; background: #f0f9ff; border-radius: 8px; border: 1px solid #bae6fd;">
                            <strong>Превью заказа:</strong>
                            <a href="{{ asset('storage/' . $order->preview_path) }}" target="_blank" rel="noopener" style="display: inline-block; margin-top: 4px; color: #0369a1;">Открыть / скачать</a>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            </div>
        @else
            <div class="empty-state-modern">
                <div class="empty-state-icon"></div>
                <h3>Заказы не найдены</h3>
                <p>У вас пока нет созданных заказов. Начните сотрудничество с нами!</p>
            </div>
        @endif

        @if(isset($serviceStats) && $serviceStats->count() > 0)
        <div class="services-stats fade-in-up" style="margin-top: 2rem;">
            <h3 style="color: #1e3a8a; margin-bottom: 20px; font-size: 20px; font-weight: 700;">Статистика по услугам</h3>
            @foreach($serviceStats as $service)
            <div class="service-stat-item">
                <span class="service-name">{{ $service->yslyga }}</span>
                <span class="service-count">{{ $service->count }}</span>
            </div>
            @endforeach
        </div>
        @endif

        @if(isset($userReviews) && $userReviews->count() > 0)
        <div class="reviews-section fade-in-up">
            <h3 class="reviews-section__title">Ваши последние отзывы</h3>
            <div class="reviews-grid">
                @foreach($userReviews as $review)
                    @include('partials.review-card', ['review' => $review])
                @endforeach
            </div>
        </div>
        @endif

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <button type="button" class="logout-btn" onclick="document.getElementById('logout-form').submit();">Выйти из аккаунта</button>
                </section>

                <section class="user-panel-section" id="section-profile" data-section="profile">
                    <div class="account-header account-header--with-avatar-actions">
                        <div class="account-avatar-wrap">
                            <div class="account-avatar" id="profile-section-avatar">
                                @if(Auth::user()->avatar)
                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Аватар" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                @else
                                    <span class="account-avatar-initials">{{ mb_substr(Auth::user()->name, 0, 1) }}{{ Auth::user()->name && strpos(Auth::user()->name, ' ') !== false ? mb_substr(Auth::user()->name, strpos(Auth::user()->name, ' ') + 1, 1) : '' }}</span>
                                @endif
                            </div>
                            <div class="account-avatar-overlay">
                                <button type="button" class="account-avatar-btn account-avatar-btn--upload" onclick="document.getElementById('avatar-input').click();" title="Загрузить фото" aria-label="Загрузить фото">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                                </button>
                                @if(Auth::user()->avatar)
                                <button type="button" class="account-avatar-btn account-avatar-btn--delete" id="avatar-delete-btn" title="Удалить аватар" aria-label="Удалить аватар">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                                @endif
                            </div>
                            <form action="{{ route('avatar.upload') }}" method="POST" enctype="multipart/form-data" id="avatar-upload-form" style="display: none;">
                                @csrf
                                <input type="file" name="avatar" accept="image/*" id="avatar-input">
                            </form>
                        </div>
                        <div class="account-info">
                            <h1>Аватар</h1>
                            <p>{{ Auth::user()->name }}</p>
                            <p>{{ Auth::user()->email }} • Зарегистрирован с {{ Auth::user()->created_at->format('d.m.Y') }}</p>
                        </div>
                    </div>
                    <div class="user-panel-card">
                        <form action="{{ route('profile.update') }}" method="POST" class="user-panel-form">
                            @csrf
                            <div class="user-panel-form__row">
                                <label class="user-panel-form__label" for="profile-name">Имя</label>
                                <input type="text" name="name" id="profile-name" class="user-panel-form__input" value="{{ old('name', Auth::user()->name) }}" required>
                                @error('name')<span class="user-panel-form__error">{{ $message }}</span>@enderror
                            </div>
                            <div class="user-panel-form__row">
                                <label class="user-panel-form__label" for="profile-email">Email</label>
                                <input type="email" name="email" id="profile-email" class="user-panel-form__input" value="{{ old('email', Auth::user()->email) }}" required>
                                @error('email')<span class="user-panel-form__error">{{ $message }}</span>@enderror
                            </div>
                            <div class="user-panel-form__row">
                                <label class="user-panel-form__label" for="profile-phone">Телефон</label>
                                <input type="tel" name="phone" id="profile-phone" class="user-panel-form__input" value="{{ old('phone', Auth::user()->phone) }}" placeholder="+7 (999) 123-45-67" maxlength="18">
                                @error('phone')<span class="user-panel-form__error">{{ $message }}</span>@enderror
                                <span class="user-panel-form__hint">Будет подставляться в формах заказа на сайте</span>
                            </div>
                            <button type="submit" class="btn-modern" style="background: linear-gradient(135deg, #1e3a8a, #3b82f6); color: white; width: auto;">Сохранить профиль</button>
                        </form>
                    </div>
                </section>

                <section class="user-panel-section" id="section-chats" data-section="chats">
                    <div class="account-header">
                        <div class="account-avatar">
                            @if(Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Аватар" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                            @else
                                {{ mb_substr(Auth::user()->name, 0, 1) }}{{ Auth::user()->name && strpos(Auth::user()->name, ' ') !== false ? mb_substr(Auth::user()->name, strpos(Auth::user()->name, ' ') + 1, 1) : '' }}
                            @endif
                        </div>
                        <div class="account-info">
                            <h1>Чаты с дизайнерами</h1>
                            <p>Переписка по заказам. Если заказ закрыт — написать нельзя.</p>
                        </div>
                    </div>
                    <div class="user-panel-card user-panel-chat-card" style="overflow: hidden; display: flex; flex-direction: column;">
                        @include('partials.order-chat-ui', ['moderOrder' => null, 'layoutHeight' => 'height: calc(100vh - 220px); min-height: 420px;'])
                        @include('partials.order-chat-script')
                    </div>
                </section>

                <section class="user-panel-section" id="section-security" data-section="security">
                    <div class="account-header">
                        <div class="account-avatar">
                            @if(Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Аватар" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                            @else
                                {{ mb_substr(Auth::user()->name, 0, 1) }}{{ Auth::user()->name && strpos(Auth::user()->name, ' ') !== false ? mb_substr(Auth::user()->name, strpos(Auth::user()->name, ' ') + 1, 1) : '' }}
                            @endif
                        </div>
                        <div class="account-info">
                            <h1>{{ Auth::user()->name }}</h1>
                            <p>{{ Auth::user()->email }} • Зарегистрирован с {{ Auth::user()->created_at->format('d.m.Y') }}</p>
                        </div>
                    </div>
                    <div class="user-panel-card user-panel-security-card">
                        <div class="user-panel-security-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        </div>
                        <p class="user-panel-security-lead">Мы отправим на вашу почту письмо со ссылкой. По ссылке вы зададите новый пароль. Ссылка действует ограниченное время.</p>
                        <div class="user-panel-security-email">{{ Auth::user()->email }}</div>
                        <form action="{{ route('profile.password.send-link') }}" method="POST" class="user-panel-security-form">
                            @csrf
                            <button type="submit" class="user-panel-security-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                Отправить ссылку на почту
                            </button>
                        </form>
                    </div>
                </section>
            </div>
        </div>

        @else
        <div class="empty-state-modern">
            <div class="empty-state-icon"></div>
            <h3>Доступ запрещен</h3>
            <p>Пожалуйста, войдите в систему чтобы просмотреть свой аккаунт.</p>
            <a href="/login" class="btn-modern btn-danger-modern" style="display: inline-block; width: auto; background: #3b82f6;">Войти в аккаунт</a>
        </div>
        @endauth















        {{-- Модальное окно обрезки аватарки --}}
        <div id="avatar-crop-modal" class="avatar-crop-modal" aria-hidden="true">
            <div class="avatar-crop-modal__backdrop"></div>
            <div class="avatar-crop-modal__box">
                <h3 class="avatar-crop-modal__title">Обрезка аватарки</h3>
                <p class="avatar-crop-modal__hint">Переместите и масштабируйте изображение. Круг показывает, как будет выглядеть аватар.</p>
                <div class="avatar-crop-modal__body">
                    <div class="avatar-crop-container">
                        <img id="avatar-crop-image" src="" alt="">
                    </div>
                    <div class="avatar-crop-preview-wrap">
                        <span class="avatar-crop-preview-label">Превью:</span>
                        <div class="avatar-crop-preview"></div>
                    </div>
                </div>
                <div class="avatar-crop-modal__actions">
                    <button type="button" class="btn-modern avatar-crop-cancel">Отмена</button>
                    <button type="button" class="btn-modern avatar-crop-apply">Применить</button>
                </div>
            </div>
        </div>

        {{-- Модальное окно удаления аватарки --}}
        <div id="avatar-delete-modal" class="avatar-crop-modal avatar-delete-modal" aria-hidden="true">
            <div class="avatar-crop-modal__backdrop avatar-delete-modal-backdrop"></div>
            <div class="avatar-crop-modal__box">
                <h3 class="avatar-crop-modal__title">Удалить аватар?</h3>
                <div class="avatar-delete-modal-preview">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="" style="max-width: 200px; max-height: 200px; border-radius: 50%; object-fit: cover;">
                    @endif
                </div>
                <div class="avatar-crop-modal__actions">
                    <button type="button" class="btn-modern avatar-delete-cancel">Отмена</button>
                    <form action="{{ route('avatar.remove') }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-modern" style="background: #dc2626; color: white;">Удалить аватар</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var cards = document.querySelectorAll('.order-card-modern');
        cards.forEach(function(card, index) {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(function() {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
        document.querySelectorAll('.btn-danger-modern').forEach(function(button) {
            button.addEventListener('click', function(e) {
                if (!confirm('Вы уверены, что хотите удалить этот заказ? Это действие нельзя отменить.')) {
                    e.preventDefault();
                }
            });
        });

        var navItems = document.querySelectorAll('.user-panel-nav__item');
        var sections = document.querySelectorAll('.user-panel-section');
        function showSection(sectionId) {
            navItems.forEach(function(b) { b.classList.remove('active'); b.removeAttribute('aria-current'); });
            var btn = document.querySelector('.user-panel-nav__item[data-section="' + sectionId + '"]');
            if (btn) { btn.classList.add('active'); btn.setAttribute('aria-current', 'true'); }
            sections.forEach(function(s) {
                s.classList.toggle('active', s.getAttribute('data-section') === sectionId);
            });
        }
        navItems.forEach(function(btn) {
            btn.addEventListener('click', function() { showSection(this.getAttribute('data-section')); });
        });
        @if($errors->has('name') || $errors->has('email'))
        showSection('profile');
        @endif

        // Маска телефона в профиле
        var profilePhone = document.getElementById('profile-phone');
        if (profilePhone) {
            function formatProfilePhone() {
                var v = profilePhone.value.replace(/\D/g, '');
                if (v.length > 0) {
                    if (v[0] === '8' || v[0] === '7') v = v.substring(1);
                    if (v[0] !== '7') v = '7' + v;
                }
                v = v.substring(0, 11);
                var s = '';
                if (v.length > 0) s = '+7';
                if (v.length > 1) s += ' (' + v.substring(1, 4);
                if (v.length >= 4) s += ') ';
                if (v.length > 4) s += v.substring(4, 7);
                if (v.length > 7) s += '-' + v.substring(7, 9);
                if (v.length > 9) s += '-' + v.substring(9, 11);
                profilePhone.value = s;
            }
            profilePhone.addEventListener('input', formatProfilePhone);
            profilePhone.addEventListener('paste', function() { setTimeout(formatProfilePhone, 0); });
            profilePhone.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && profilePhone.value.replace(/\D/g, '').length <= 1) {
                    profilePhone.value = '';
                    e.preventDefault();
                }
            });
            if (profilePhone.value) formatProfilePhone();
        }

        // Проблема с заказом: отправить инфо в чат поддержки и открыть чат
        document.querySelectorAll('.order-problem-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var orderId = this.getAttribute('data-order-id');
                if (!orderId) return;
                var csrf = document.querySelector('meta[name="csrf-token"]');
                fetch('{{ route("support.order-problem") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf ? csrf.getAttribute('content') : '', 'Accept': 'application/json' },
                    body: JSON.stringify({ order_id: parseInt(orderId, 10), _token: csrf ? csrf.getAttribute('content') : '' })
                }).then(function() {
                    var panel = document.getElementById('support-chat-panel');
                    if (panel) panel.classList.add('support-chat-open');
                });
            });
        });

        // Открыть чат: перейти в раздел Чаты и открыть чат по заказу
        document.querySelectorAll('.order-open-chat-btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                var orderId = this.getAttribute('data-order-id');
                if (orderId && typeof window.openOrderChat === 'function') {
                    e.preventDefault();
                    showSection('chats');
                    window.openOrderChat(parseInt(orderId, 10));
                }
            });
        });

        if (window.location.hash === '#chats') {
            showSection('chats');
            var m = window.location.search.match(/order=(\d+)/);
            if (m && typeof window.openOrderChat === 'function') setTimeout(function() { window.openOrderChat(parseInt(m[1], 10)); }, 500);
        }

        // Обрезка аватарки
        var avatarInput = document.getElementById('avatar-input');
        var avatarCropModal = document.getElementById('avatar-crop-modal');
        var avatarCropImage = document.getElementById('avatar-crop-image');
        var cropperInstance = null;
        var currentAvatarObjectUrl = null;

        function openAvatarCropModal(file) {
            if (currentAvatarObjectUrl) URL.revokeObjectURL(currentAvatarObjectUrl);
            currentAvatarObjectUrl = URL.createObjectURL(file);
            avatarCropImage.src = currentAvatarObjectUrl;
            avatarCropModal.classList.add('is-open');
            avatarCropModal.setAttribute('aria-hidden', 'false');
            if (cropperInstance) {
                cropperInstance.destroy();
                cropperInstance = null;
            }
            avatarCropImage.onload = function() {
                cropperInstance = new Cropper(avatarCropImage, {
                    aspectRatio: 1,
                    viewMode: 1,
                    dragMode: 'move',
                    autoCropArea: 0.8,
                    restore: false,
                    guides: true,
                    center: true,
                    highlight: false,
                    cropBoxMovable: false,
                    cropBoxResizable: false,
                    toggleDragModeOnDblclick: false,
                    preview: '.avatar-crop-preview'
                });
            };
        }

        function closeAvatarCropModal() {
            avatarCropModal.classList.remove('is-open');
            avatarCropModal.setAttribute('aria-hidden', 'true');
            if (cropperInstance) {
                cropperInstance.destroy();
                cropperInstance = null;
            }
            if (currentAvatarObjectUrl) {
                URL.revokeObjectURL(currentAvatarObjectUrl);
                currentAvatarObjectUrl = null;
            }
            if (avatarInput) avatarInput.value = '';
        }

        if (avatarInput && avatarCropModal) {
            avatarInput.addEventListener('change', function() {
                var file = this.files && this.files[0];
                if (!file || !file.type.match(/^image\/(jpeg|png|gif|webp)/)) {
                    if (file) alert('Выберите изображение (JPEG, PNG, GIF или WebP).');
                    return;
                }
                openAvatarCropModal(file);
            });

            avatarCropModal.querySelector('.avatar-crop-modal__backdrop').addEventListener('click', closeAvatarCropModal);
            avatarCropModal.querySelector('.avatar-crop-cancel').addEventListener('click', closeAvatarCropModal);

        var avatarDeleteModal = document.getElementById('avatar-delete-modal');
        var avatarDeleteBtn = document.getElementById('avatar-delete-btn');
        if (avatarDeleteBtn && avatarDeleteModal) {
            avatarDeleteBtn.addEventListener('click', function() {
                avatarDeleteModal.classList.add('is-open');
                avatarDeleteModal.setAttribute('aria-hidden', 'false');
            });
            avatarDeleteModal.querySelector('.avatar-delete-modal-backdrop').addEventListener('click', function() {
                avatarDeleteModal.classList.remove('is-open');
                avatarDeleteModal.setAttribute('aria-hidden', 'true');
            });
            avatarDeleteModal.querySelector('.avatar-delete-cancel').addEventListener('click', function() {
                avatarDeleteModal.classList.remove('is-open');
                avatarDeleteModal.setAttribute('aria-hidden', 'true');
            });
        }

            avatarCropModal.querySelector('.avatar-crop-apply').addEventListener('click', function() {
                if (!cropperInstance) return;
                var btn = this;
                btn.disabled = true;
                var canvas = cropperInstance.getCroppedCanvas({ width: 400, height: 400, imageSmoothingEnabled: true, imageSmoothingQuality: 'high' });
                canvas.toBlob(function(blob) {
                    var formData = new FormData();
                    formData.append('avatar', blob, 'avatar.jpg');
                    formData.append('_token', document.querySelector('input[name="_token"]').value);
                    fetch('{{ route("avatar.upload") }}', {
                        method: 'POST',
                        body: formData,
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                    .then(function(r) {
                        if (r.redirected) {
                            window.location.href = r.url;
                            return;
                        }
                        return r.json ? r.json() : r.text();
                    })
                    .then(function(data) {
                        if (data && (data.redirect || data.url)) {
                            window.location.href = data.redirect || data.url;
                        } else if (!document.location.href.match(/\?|#/)) {
                            document.location.reload();
                        }
                    })
                    .catch(function() {
                        document.getElementById('avatar-upload-form').submit();
                    })
                    .finally(function() {
                        btn.disabled = false;
                        closeAvatarCropModal();
                    });
                }, 'image/jpeg', 0.92);
            });
        }
    });
</script>
<style>
    /* Темная тема для order-card-modern */
.dark-theme .order-card-modern {
    background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
    border: 1px solid #374151;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.dark-theme .order-card-modern:hover {
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
    border-color: #4b5563;
}

.dark-theme .order-content {
    background: transparent;
}

.dark-theme .service-badge {
    background: linear-gradient(135deg, #1e40af, #3b82f6);
    color: white;
    border: 1px solid #3b82f6;
}

.dark-theme .detail-item {
    color: #d1d5db;
}

.dark-theme .detail-item strong {
    color: #f3f4f6;
}

.dark-theme .order-description {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid #374151;
}

.dark-theme .order-description h4 {
    color: #60a5fa;
}

.dark-theme .order-description p {
    color: #d1d5db;
}

.dark-theme .order-actions-modern {
    border-top-color: #374151;
}

.dark-theme .btn-modern {
    background: #374151;
    color: #f9fafb;
    border: 1px solid #4b5563;
}

.dark-theme .btn-modern:hover {
    background: #4b5563;
}

.dark-theme .btn-danger-modern {
    background: #dc2626;
    color: white;
    border: 1px solid #ef4444;
}

.dark-theme .btn-danger-modern:hover {
    background: #ef4444;
}

/* Темная тема для пустого состояния */
.dark-theme .empty-state-modern {
    background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
    border: 1px solid #374151;
}

.dark-theme .empty-state-modern h3 {
    color: #f3f4f6;
}

.dark-theme .empty-state-modern p {
    color: #d1d5db;
}

/* Темная тема для статистики услуг */
.dark-theme .services-stats {
    background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
    border: 1px solid #374151;
}

.dark-theme .service-stat-item {
    border-bottom-color: #374151;
}

.dark-theme .service-name {
    color: #f3f4f6;
}

.dark-theme .service-count {
    background: linear-gradient(135deg, #3b82f6, #1e40af);
    color: white;
}

/* Модальное окно обрезки аватарки */
.avatar-crop-modal {
    position: fixed;
    inset: 0;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.25s, visibility 0.25s;
}
.avatar-crop-modal.is-open {
    opacity: 1;
    visibility: visible;
}
.avatar-crop-modal__backdrop {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
    cursor: pointer;
}
.avatar-crop-modal__box {
    position: relative;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
    max-width: 520px;
    width: 100%;
    max-height: 90vh;
    overflow: auto;
}
.dark-theme .avatar-crop-modal__box {
    background: #1f2937;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
}
.avatar-crop-modal__title {
    margin: 0;
    padding: 20px 20px 8px;
    font-size: 1.25rem;
    color: #1e3a8a;
}
.dark-theme .avatar-crop-modal__title { color: #93c5fd; }
.avatar-crop-modal__hint {
    margin: 0;
    padding: 0 20px 16px;
    font-size: 0.9rem;
    color: #6b7280;
}
.dark-theme .avatar-crop-modal__hint { color: #9ca3af; }
.avatar-crop-modal__body {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    align-items: flex-start;
    justify-content: center;
    padding: 0 20px 20px;
}
.avatar-crop-container {
    width: 100%;
    max-width: 320px;
    height: 280px;
    margin: 0 auto;
    background: #f3f4f6;
}
.dark-theme .avatar-crop-container { background: #374151; }
.avatar-crop-container img {
    max-width: 100%;
    display: block;
}
.avatar-crop-preview-wrap {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
}
.avatar-crop-preview-label {
    font-size: 0.85rem;
    color: #6b7280;
    font-weight: 600;
}
.dark-theme .avatar-crop-preview-label { color: #9ca3af; }
.avatar-crop-preview {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    background: #e5e7eb;
    border: 3px solid #1e40af;
}
.dark-theme .avatar-crop-preview { background: #374151; border-color: #3b82f6; }
.avatar-crop-modal__actions {
    display: flex;
    gap: 12px;
    justify-content: flex-end;
    padding: 16px 20px 20px;
    border-top: 1px solid #e5e7eb;
}
.dark-theme .avatar-crop-modal__actions { border-top-color: #374151; }
.avatar-crop-apply {
    background: #1e40af !important;
    color: #fff !important;
}
.avatar-crop-apply:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}
</style>
@endsection