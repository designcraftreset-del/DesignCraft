<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\News;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Если пользователь не авторизован, показываем базовую страницу
        if (!$user) {
            return view('home', [
                'userStats' => [
                    'total_orders' => 0,
                    'orders_this_month' => 0,
                    'active_projects' => 0,
                    'completed_projects' => 0,
                    'account_balance' => 0,
                    'total_reviews' => 0,
                    'average_rating' => 0
                ],
                'recentNews' => News::orderBy('created_at', 'desc')->take(3)->get(),
                'recentOrders' => collect(),
                'recentReviews' => Review::orderBy('created_at', 'desc')->take(3)->get()
            ]);
        }

        // Статистика пользователя (только для авторизованных)
        $userStats = [
            'total_orders' => Application::where('userid', $user->id)->count(),
            'orders_this_month' => Application::where('userid', $user->id)
                ->whereMonth('created_at', now()->month)
                ->count(),
            'active_projects' => Application::where('userid', $user->id)
                ->whereIn('status', ['pending', 'confirmed'])
                ->count(),
            'completed_projects' => Application::where('userid', $user->id)
                ->where('status', 'completed')
                ->count(),
            'account_balance' => 0,
            'total_reviews' => Review::where('user_id', $user->id)->count(),
            'average_rating' => Review::where('user_id', $user->id)
                ->avg('rating') ?? 0
        ];

        // Последние новости
        $recentNews = News::orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Последние заказы пользователя (только для авторизованных)
        $recentOrders = Application::where('userid', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Последние отзывы
        $recentReviews = Review::orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('home', compact(
            'userStats',
            'recentNews',
            'recentOrders',
            'recentReviews'
        ));
    }
}