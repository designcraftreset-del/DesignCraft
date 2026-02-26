@extends('mobile.layouts.mobile-app')

@section('title', 'Оставить отзыв — DesignCraft')

@section('content')
<section class="m-hero">
    <h1 class="m-hero__title">Оставить отзыв</h1>
    <p class="m-hero__subtitle">Ваш отзыв будет опубликован после проверки модератором.</p>
</section>

@if(session('success'))
<div class="m-card" style="background: rgba(34, 197, 94, 0.15); border-color: #22c55e;">{{ session('success') }}</div>
@endif
@if($errors->any())
<div class="m-card" style="background: rgba(239, 68, 68, 0.15); border-color: #ef4444;">
    @foreach($errors->all() as $e) <p class="m-text" style="margin:0;">{{ $e }}</p> @endforeach
</div>
@endif

<section class="m-section">
    <form action="{{ route('reviews.store') }}" method="post" class="m-card">
        @csrf
        <input type="hidden" name="redirect_mobile" value="1">
        <div class="m-order-field">
            <label for="review_name">Ваше имя</label>
            <input type="text" id="review_name" name="client_name" value="{{ old('client_name', auth()->user()->name) }}" required class="m-order-input">
        </div>
        <div class="m-order-field">
            <label for="review_position">Должность / проект (необязательно)</label>
            <input type="text" id="review_position" name="client_position" value="{{ old('client_position') }}" class="m-order-input">
        </div>
        <div class="m-order-field">
            <label for="review_text">Текст отзыва</label>
            <textarea id="review_text" name="review_text" required minlength="10" rows="4" class="m-order-input">{{ old('review_text') }}</textarea>
        </div>
        <div class="m-order-field">
            <label>Оценка</label>
            <div style="display:flex; gap:8px; flex-wrap:wrap;">
                @for($i = 1; $i <= 5; $i++)
                <label style="display:flex; align-items:center; gap:4px; cursor:pointer;">
                    <input type="radio" name="rating" value="{{ $i }}" {{ old('rating', 5) == $i ? 'checked' : '' }} required>
                    <span>{{ $i }} ★</span>
                </label>
                @endfor
            </div>
        </div>
        <button type="submit" class="m-btn m-btn--primary m-btn--block">Отправить на модерацию</button>
    </form>
</section>

<section class="m-section">
    <a href="{{ route('mobile.home') }}" class="m-btn m-btn--secondary m-btn--block">На главную</a>
</section>
@endsection
