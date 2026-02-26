@extends('mobile.layouts.mobile-app')

@section('title', 'Услуги — DesignCraft')

@section('content')
<section class="m-hero">
    <h1 class="m-hero__title">Наши услуги</h1>
    <p class="m-hero__subtitle">Широкий спектр услуг по дизайну в Photoshop. От превью до анимаций — мы создаём всё!</p>
</section>

<section class="m-section">
    @foreach($servicesList as $item)
    <div class="m-card">
        @if(!empty($item['badge']))
            <span class="m-text" style="font-size:0.75rem; color:var(--m-accent);">{{ $item['badge'] }}</span>
        @endif
        <p class="m-title">{{ $item['name'] }}</p>
        <p class="m-text">{{ $item['desc'] }}</p>
        <p class="m-price">{{ $item['price'] }} <span>₽</span></p>
        <ul class="m-text" style="margin:0.5rem 0 0; padding-left:1.25rem;">
            @foreach($item['features'] as $f)
                <li>{{ $f }}</li>
            @endforeach
        </ul>
        @auth
            <a href="{{ route('mobile.order.create') }}" class="m-btn m-btn--primary" style="margin-top:0.75rem;">Заказать</a>
        @else
            <a href="{{ route('login') }}" class="m-btn m-btn--primary" style="margin-top:0.75rem;">Войти для заказа</a>
        @endauth
    </div>
    @endforeach
</section>
@endsection
