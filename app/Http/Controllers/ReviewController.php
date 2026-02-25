<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_position' => 'nullable|string|max:255',
            'review_text' => 'required|string|min:10',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        Review::create([
            'client_name' => $request->client_name,
            'client_position' => $request->client_position,
            'review_text' => $request->review_text,
            'rating' => $request->rating,
            'user_id' => auth()->id(),
            'is_approved' => false,
        ]);

        return redirect()->back()->with('success', 'Спасибо за ваш отзыв! Он будет опубликован после проверки модератором.');
    }

    /** Создать отзыв от имени пользователя (админ/модератор) */
    public function storeForUser(Request $request, $userId)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'moderator'])) {
            return response()->json(['error' => 'Forbidden'], 403);
        }
        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_position' => 'nullable|string|max:255',
            'review_text' => 'required|string|min:10',
            'rating' => 'required|integer|min:1|max:5',
        ]);
        Review::create([
            'client_name' => $request->client_name,
            'client_position' => $request->client_position,
            'review_text' => $request->review_text,
            'rating' => (int) $request->rating,
            'user_id' => (int) $userId,
            'is_approved' => true,
        ]);
        return response()->json(['success' => true]);
    }

    /** Обновить отзыв (админ/модератор) */
    public function update(Request $request, $id)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'moderator'])) {
            return response()->json(['error' => 'Forbidden'], 403);
        }
        $review = Review::findOrFail($id);
        $request->validate([
            'client_name' => 'sometimes|string|max:255',
            'client_position' => 'nullable|string|max:255',
            'review_text' => 'sometimes|string|min:10',
            'rating' => 'sometimes|integer|min:1|max:5',
            'is_approved' => 'sometimes|boolean',
        ]);
        if ($request->has('client_name')) $review->client_name = $request->client_name;
        if ($request->has('client_position')) $review->client_position = $request->client_position;
        if ($request->has('review_text')) $review->review_text = $request->review_text;
        if ($request->has('rating')) $review->rating = (int) $request->rating;
        if ($request->has('is_approved')) $review->is_approved = (bool) $request->is_approved;
        $review->save();
        return response()->json(['success' => true, 'review' => [
            'id' => $review->id,
            'client_name' => $review->client_name,
            'client_position' => $review->client_position,
            'review_text' => $review->review_text,
            'rating' => $review->rating,
            'is_approved' => $review->is_approved,
            'created_at' => $review->created_at?->format('d.m.Y H:i'),
        ]]);
    }

    public function index()
    {
        $reviews = Review::approved()->orderBy('created_at', 'desc')->get();
        return $reviews;
    }
    

    public function destroy(Review $review)
    {
        if (!Auth::check()) {
            abort(403, 'Необходима авторизация');
        }

        $user = Auth::user();

        if ($user->role === 'admin' || $user->role === 'moderator') {

        } elseif ($user->role === 'user' && $review->user_id === $user->id) {

        } else {
            abort(403, 'У вас нет прав для удаления этого отзыва');
        }

        $review->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true]);
        }
        return redirect()->back()->with('success', 'Отзыв успешно удален');
    }
}