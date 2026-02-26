<section class="dc-section dc-section--content inner_reviews">
    <div class="container">
        <div class="block_reviews">
            <p class="block_working_text_h1">Отзывы</p>
            <div class="svg_reviews_block" aria-hidden="true"></div>
            <h1>Что говорят наши клиенты</h1>
            <h2>Нас выбирают за качество, скорость и профессионализм. Вот что говорят те, кто уже воспользовался нашими услугами.</h2>

            @if($reviews->count() > 0)
                <div class="reviews-grid">
                    @foreach($reviews as $review)
                        @include('partials.review-card', ['review' => $review])
                    @endforeach
                </div>
            @else
                <div class="reviews-empty">
                    <p>Пока нет отзывов. Будьте первым!</p>
                </div>
            @endif

            @auth
                <div class="review-form-container">
                    <h3 class="review-form-title">Оставьте свой отзыв</h3>
                    <p class="review-form-subtitle">Поделитесь вашим опытом работы с нами</p>
                    <form class="review-form" action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="client_name">Ваше имя *</label>
                            <input type="text" id="client_name" name="client_name" required placeholder="Введите ваше имя" value="{{ Auth::user()->name ?? '' }}">
                            @error('client_name')<span class="error-message">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="client_position">Должность / род деятельности</label>
                            <input type="text" id="client_position" name="client_position" placeholder="Например: Блогер, Предприниматель">
                            @error('client_position')<span class="error-message">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label>Оценка *</label>
                            <div class="rating-select">
                                <div class="rating-stars" id="ratingStars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="rating-star" data-rating="{{ $i }}">★</span>
                                    @endfor
                                </div>
                                <input type="hidden" name="rating" id="ratingInput" value="5" required>
                            </div>
                            @error('rating')<span class="error-message">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="review_text">Текст отзыва *</label>
                            <textarea class="textarea" id="review_text" name="review_text" rows="5" required placeholder="Расскажите о вашем опыте работы с нами..."></textarea>
                            @error('review_text')<span class="error-message">{{ $message }}</span>@enderror
                        </div>
                        <div class="submit-review-btn_two">
                            Отправить отзыв
                            <button type="submit" class="submit-review-btn">Спасибо за отзыв!</button>
                        </div>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</section>
