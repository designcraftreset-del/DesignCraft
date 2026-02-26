<div class="review-card">
    <div class="review-card__header">
        <div class="review-card__avatar">
            @if(isset($review->user) && $review->user && $review->user->avatar)
                <img src="{{ asset('storage/' . $review->user->avatar) }}" alt="" loading="lazy">
            @else
                <span class="review-card__initials">{{ mb_strtoupper(mb_substr($review->client_name ?? '?', 0, 1)) }}</span>
            @endif
        </div>
        <div class="review-card__meta">
            <h4 class="review-card__name">{{ $review->client_name }}</h4>
            @if(!empty($review->client_position))
                <p class="review-card__position">{{ $review->client_position }}</p>
            @endif
            @auth
                @if((Auth::user()->role ?? null) === 'admin' || $review->user_id === Auth::id())
                    <div class="review-card__actions">
                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="delete-review-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="review-card__delete" onclick="return confirm('Удалить этот отзыв?')" aria-label="Удалить отзыв">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6m3 0V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
    </div>
    <div class="review-card__rating">
        @for($i = 1; $i <= 5; $i++)
            <span class="review-card__star {{ $i <= ($review->rating ?? 0) ? 'is-filled' : '' }}" aria-hidden="true">★</span>
        @endfor
    </div>
    <p class="review-card__text">"{{ $review->review_text }}"</p>
    <time class="review-card__date" datetime="{{ $review->created_at->format('Y-m-d') }}">{{ $review->created_at->format('d.m.Y') }}</time>
</div>
