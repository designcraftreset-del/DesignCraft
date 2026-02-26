@extends('layouts.error')

@section('title', '404 — Страница не найдена')

@push('styles')
<style>
* { box-sizing: border-box; }
body { margin: 0; font-family: Nunito, ui-sans-serif, system-ui, sans-serif; min-height: 100vh; }
.error-404-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    padding: 2rem 1rem;
    overflow: hidden;
}
.error-404-bg {
    position: absolute;
    inset: 0;
    background: linear-gradient(160deg, #f0f9ff 0%, #e0f2fe 40%, #faf5ff 100%);
    opacity: 0.95;
}
.error-404-bg::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle at 20% 30%, rgba(59, 130, 246, 0.08) 0%, transparent 50%),
                      radial-gradient(circle at 80% 70%, rgba(139, 92, 246, 0.06) 0%, transparent 50%);
}
.error-404-bg::after {
    content: '';
    position: absolute;
    width: 600px;
    height: 600px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.06) 0%, transparent 70%);
    top: -200px;
    right: -100px;
}
.error-404-content {
    position: relative;
    z-index: 1;
    text-align: center;
    max-width: 420px;
}
.error-404-code {
    font-size: clamp(6rem, 20vw, 10rem);
    font-weight: 800;
    line-height: 1;
    letter-spacing: -0.04em;
    background: linear-gradient(135deg, #1d4ed8 0%, #3b82f6 50%, #6366f1 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
}
.error-404-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 0.75rem;
    letter-spacing: -0.02em;
}
.error-404-desc {
    font-size: 1rem;
    color: #64748b;
    line-height: 1.5;
    margin: 0 0 2.5rem;
}
.error-404-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    justify-content: center;
}
.error-404-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    transition: transform 0.2s, box-shadow 0.2s;
}
.error-404-btn:hover { transform: translateY(-1px); }
.error-404-btn--primary {
    background: linear-gradient(135deg, #1d4ed8 0%, #3b82f6 100%);
    color: #fff;
    border: none;
    box-shadow: 0 4px 14px rgba(29, 78, 216, 0.4);
}
.error-404-btn--primary:hover { box-shadow: 0 6px 20px rgba(29, 78, 216, 0.5); }
.error-404-btn--ghost {
    background: transparent;
    color: #475569;
    border: 2px solid #e2e8f0;
}
.error-404-btn--ghost:hover { border-color: #3b82f6; color: #3b82f6; }

body.dark-theme .error-404-bg {
    background: linear-gradient(160deg, #0f172a 0%, #1e293b 40%, #1c1917 100%);
}
body.dark-theme .error-404-bg::before {
    background-image: radial-gradient(circle at 20% 30%, rgba(59, 130, 246, 0.12) 0%, transparent 50%),
                      radial-gradient(circle at 80% 70%, rgba(139, 92, 246, 0.08) 0%, transparent 50%);
}
body.dark-theme .error-404-bg::after {
    background: radial-gradient(circle, rgba(59, 130, 246, 0.08) 0%, transparent 70%);
}
body.dark-theme .error-404-code {
    background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 50%, #818cf8 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
body.dark-theme .error-404-title { color: #f1f5f9; }
body.dark-theme .error-404-desc { color: #94a3b8; }
body.dark-theme .error-404-btn--ghost { color: #cbd5e1; border-color: #475569; }
body.dark-theme .error-404-btn--ghost:hover { border-color: #60a5fa; color: #60a5fa; }
</style>
@endpush

@section('content')
<div class="error-404-page">
    <div class="error-404-bg" aria-hidden="true"></div>
    <div class="error-404-content">
        <div class="error-404-code" aria-hidden="true">404</div>
        <h1 class="error-404-title">Страница не найдена</h1>
        <p class="error-404-desc">Возможно, ссылка устарела или вы перешли по неверному адресу.</p>
        <div class="error-404-actions">
            <a href="{{ url('/') }}" class="error-404-btn error-404-btn--primary">На главную</a>
            <a href="javascript:history.back()" class="error-404-btn error-404-btn--ghost">Назад</a>
        </div>
    </div>
</div>
@endsection
