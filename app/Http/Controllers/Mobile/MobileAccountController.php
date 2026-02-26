<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class MobileAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $orders = Application::where('userid', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $userStats = [
            'total_orders' => $orders->count(),
            'active_orders' => $orders->whereIn('status', ['new', 'processing', 'pending', 'confirmed'])->count(),
            'completed_orders' => $orders->where('status', 'completed')->count(),
            'total_reviews' => Review::where('user_id', $user->id)->count(),
            'user_since' => $user->created_at->diffForHumans(),
        ];

        $userReviews = Review::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('mobile.pages.account', compact('user', 'orders', 'userStats', 'userReviews'));
    }
}
