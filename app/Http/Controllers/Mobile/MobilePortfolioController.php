<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class MobilePortfolioController extends Controller
{
    /**
     * Фотки из БД (banners) и из public/image/4/ (как на десктопе).
     */
    public function index(Request $request)
    {
        $category = $request->get('category', 'all');
        $galleryItems = [];
        if (Schema::hasTable('banners')) {
            $banners = Banner::approved()->byCategory($category)->get();
            foreach ($banners as $b) {
                $galleryItems[] = [
                    'path' => 'storage/' . $b->image_path,
                    'title' => $b->title ?? 'Работа',
                    'subtitle' => $b->subtitle ?? '',
                    'description' => $b->description ?? '',
                ];
            }
        }

        $portfolioCaptions = [
            1 => ['title' => 'Игровой баннер \'ЖЕМ\'', 'subtitle' => 'Баннер для стрима', 'description' => 'Стримерский баннер с игровой тематикой. Использованы элементы популярных игр и персонажей для привлечения внимания зрителей.'],
            2 => ['title' => 'Dead Space', 'subtitle' => 'Игровой баннер', 'description' => 'Баннер для стримера по мотивам популярной игры Dead Space. Стильный дизайн с акцентом на атмосферу игры.'],
            3 => ['title' => 'Превью с Днём Рождения', 'subtitle' => 'Превью для стрима', 'description' => 'Именной праздничный баннер для поздравления с днем рождения. Персонализированный дизайн с фотографиями именинника.'],
            4 => ['title' => '1500 КМ Проект', 'subtitle' => 'Превью для блога', 'description' => 'Баннер для киберспортивного турнира. Дизайн с использованием контрастных цветов и узнаваемых игровых элементов.'],
            5 => ['title' => 'Reinwide League\'', 'subtitle' => 'Киберспорта', 'description' => 'Баннер для туристического агентства с актуальными ценами на туры в Египет. Яркий дизайн с узнаваемыми символами страны.'],
            6 => ['title' => 'Отдых в Египте', 'subtitle' => 'Туристическое превью', 'description' => 'Дизайн для системы донатов в Minecraft. Яркий, привлекающий внимание баннер в стиле игры.'],
            7 => ['title' => 'Донат кейс', 'subtitle' => 'Игровое превью', 'description' => 'Художественная композиция с использованием 3D-моделирования. Атмосферная сцена в лесу с фантастическими элементами.'],
            8 => ['title' => 'Мистический лес', 'subtitle' => 'Арт', 'description' => 'Рекламный баннер для кофейни. Привлекательный дизайн с изображением команды и продукции.'],
            9 => ['title' => 'Всем кофе я плачу', 'subtitle' => 'Коммерческий баннер', 'description' => 'Промо-баннер для киберспортивного турнира по Dota 2. Дизайн с использованием игрового персонажа и логотипа события.'],
            10 => ['title' => 'VSCL.RU Dota 2', 'subtitle' => 'Киберспорт', 'description' => 'Комплексное оформление для канала Twitch. Баннеры, аватарки и другие элементы в едином стиле.'],
            11 => ['title' => 'Оформление Twitch', 'subtitle' => 'Стрим', 'description' => 'Превью для видеоролика об автомобильном проекте. Современный дизайн с акцентом на основной объект.'],
            12 => ['title' => 'ВАЗ 2109 Проект', 'subtitle' => 'Автомобильный баннер', 'description' => 'Баннер для автомобильного канала. Динамичный дизайн с использованием круговой вставки для детализации.'],
            13 => ['title' => 'Двойной выхлоп на Приору', 'subtitle' => 'Автомобильный баннер', 'description' => 'Превью для видеоролика об автомобильном проекте. Современный дизайн с акцентом на основной объект.'],
            14 => ['title' => 'Жигули за 38к', 'subtitle' => 'Автомобильный баннер', 'description' => 'Превью для видеоролика об автомобильном проекте. Современный дизайн с акцентом на основной объект.'],
            15 => ['title' => 'Заработал 60к', 'subtitle' => 'Автомобильный баннер', 'description' => 'Превью для видеоролика об автомобильном проекте. Современный дизайн с акцентом на основной объект.'],
        ];

        $imageDir = public_path('image/4');
        if (is_dir($imageDir)) {
            for ($i = 1; $i <= 15; $i++) {
                foreach (['.jpg', '.jpeg', '.png', '.webp'] as $ext) {
                    $name = $i . $ext;
                    if (file_exists($imageDir . DIRECTORY_SEPARATOR . $name)) {
                        $cap = $portfolioCaptions[$i] ?? ['title' => 'Работа ' . $i, 'subtitle' => '', 'description' => ''];
                        $galleryItems[] = [
                            'path' => 'image/4/' . $name,
                            'title' => $cap['title'],
                            'subtitle' => $cap['subtitle'],
                            'description' => $cap['description'],
                        ];
                        break;
                    }
                }
            }
        }

        $PublicFunc = Application::all();

        return view('mobile.pages.portfolio', compact('galleryItems', 'category', 'PublicFunc'));
    }
}
