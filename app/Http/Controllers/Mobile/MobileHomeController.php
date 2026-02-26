<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\News;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class MobileHomeController extends Controller
{
    /**
     * Главная мобильная (лендинг) — те же данные, что hellow/index.
     */
    public function index()
    {
        $reviews = Review::approved()->orderBy('created_at', 'desc')->get();
        $news = News::published()->orderBy('published_at', 'desc')->orderBy('created_at', 'desc')->take(6)->get();
        $PublicFunc = Application::all();

        $servicesList = [
            ['badge' => 'Лучший рейтинг', 'name' => 'Базовый дизайн превью', 'desc' => 'Простой и эффективный дизайн превью для видео, статей или продуктов', 'price' => '2000', 'features' => ['1 концепция', '2 правки', 'Исходник в JPG', 'Срок: 2 дня'], 'select_value' => 'design', 'package' => 'Базовый'],
            ['badge' => 'Популярный выбор', 'name' => 'Превью Про', 'desc' => 'Профессиональный дизайн превью с уникальными элементами и эффектами', 'price' => '3500', 'features' => ['2 концепции на выбор', 'Неограниченные правки', 'Исходник в PSD', 'Срок: 3 дня'], 'select_value' => 'design', 'package' => 'Про'],
            ['badge' => 'Самый выгодный', 'name' => 'Базовая аватарка', 'desc' => 'Стильная аватарка для социальных сетей или игровых профилей', 'price' => '1500', 'features' => ['1 дизайн', '2 правки', 'Исходник в JPG/PNG', 'Срок: 1-2 дня'], 'select_value' => 'ava', 'package' => 'Базовый'],
        ];

        $portfolioHomeImages = [];
        $imageDir = public_path('image/1');
        if (is_dir($imageDir)) {
            for ($i = 1; $i <= 4; $i++) {
                foreach (['.jpg', '.jpeg', '.png', '.webp'] as $ext) {
                    $name = $i . $ext;
                    if (file_exists($imageDir . DIRECTORY_SEPARATOR . $name)) {
                        $portfolioHomeImages[] = 'image/1/' . $name;
                        break;
                    }
                }
            }
        }

        $ordersCount = 0;
        $canReview = false;
        if (Auth::check()) {
            $ordersCount = Application::where('userid', Auth::id())->count();
            $canReview = $ordersCount >= 1;
        }

        return view('mobile.pages.home', compact('PublicFunc', 'reviews', 'news', 'servicesList', 'portfolioHomeImages', 'ordersCount', 'canReview'));
    }
}
