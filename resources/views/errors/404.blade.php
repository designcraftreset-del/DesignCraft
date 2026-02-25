@extends('layouts.app')

@section('content')
<div class="error-404-page">
    <div class="error-404-hero">
        <div class="container error-404-container">
            <h1 class="error-404-title">404</h1>
            <p class="error-404-subtitle">Страница не найдена</p>
            <p class="error-404-text">Запрашиваемая страница не существует или была перемещена.</p>
            <a href="{{ url('/') }}" class="error-404-btn">На главную</a>
        </div>
    </div>
</div>
<style>
.error-404-page {
    min-height: calc(100vh - 200px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
    box-sizing: border-box;
}
.error-404-hero {
    background: linear-gradient(135deg, #1d4ed8 0%, #3b82f6 50%, #60a5fa 100%);
    color: #fff;
    padding: 3rem 2rem;
    text-align: center;
    border-radius: 16px;
    max-width: 520px;
    width: 100%;
    box-shadow: 0 4px 20px rgba(29, 78, 216, 0.3);
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}
.error-404-container {
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.75rem;
}
.error-404-title { font-size: 4rem; font-weight: 700; margin: 0; letter-spacing: -0.02em; line-height: 1; }
.error-404-subtitle { font-size: 1.5rem; margin: 0; opacity: 0.95; }
.error-404-text { margin: 0; opacity: 0.9; font-size: 1rem; }
.error-404-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.75rem 1.5rem;
    margin-top: 0.5rem;
    background: rgba(255,255,255,0.2);
    color: #fff;
    border: 1px solid rgba(255,255,255,0.4);
    border-radius: 10px;
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    transition: background 0.2s, border-color 0.2s;
}
.error-404-btn:hover { background: rgba(255,255,255,0.3); border-color: rgba(255,255,255,0.6); color: #fff; }
body.dark-theme .error-404-hero { box-shadow: 0 4px 20px rgba(0,0,0,0.3); }
</style>
@endsection
