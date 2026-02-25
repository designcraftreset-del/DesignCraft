<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\User;

class NewsSeeder extends Seeder
{
    public function run()
    {
        $author = User::where('email', 'admin@admin.admin')->first() ?? User::first();
        if (!$author) {
            return;
        }

        $items = [
            ['title' => 'Новые тенденции в веб-дизайне 2025', 'slug' => 'new-trends-web-design-2025', 'excerpt' => 'Обзор актуальных трендов в веб-дизайне.', 'content' => 'Полное содержание новости о тенденциях в веб-дизайне...', 'category' => 'Дизайн'],
            ['title' => 'Photoshop: обновление инструментов', 'slug' => 'photoshop-update-tools', 'excerpt' => 'Новые инструменты в последней версии Photoshop.', 'content' => 'Содержание о новинках Photoshop...', 'category' => 'Инструменты'],
            ['title' => 'Figma для команд', 'slug' => 'figma-for-teams', 'excerpt' => 'Как эффективно работать в Figma в команде.', 'content' => 'Советы по совместной работе в Figma...', 'category' => 'Разработка'],
            ['title' => 'Цветовые схемы в дизайне', 'slug' => 'color-schemes-design', 'excerpt' => 'Подбор цветовых палитр для проектов.', 'content' => 'Как выбирать цвета для дизайна...', 'category' => 'Дизайн'],
            ['title' => 'Типографика в интерфейсах', 'slug' => 'typography-interfaces', 'excerpt' => 'Основы типографики в UI/UX.', 'content' => 'Правила использования шрифтов...', 'category' => 'Дизайн'],
            ['title' => 'Баннеры для соцсетей', 'slug' => 'banners-social', 'excerpt' => 'Создание баннеров для социальных сетей.', 'content' => 'Размеры и советы по баннерам...', 'category' => 'Маркетинг'],
            ['title' => 'Аватарки и брендинг', 'slug' => 'avatars-branding', 'excerpt' => 'Как аватарка влияет на узнаваемость бренда.', 'content' => 'Роль аватарки в визуальном стиле...', 'category' => 'Брендинг'],
            ['title' => 'Анимация в дизайне', 'slug' => 'animation-design', 'excerpt' => 'Микроанимации и их применение.', 'content' => 'Когда и как использовать анимацию...', 'category' => 'Дизайн'],
            ['title' => 'Логотипы: от идеи до макета', 'slug' => 'logos-from-idea', 'excerpt' => 'Этапы создания логотипа.', 'content' => 'От брифа до финального файла...', 'category' => 'Брендинг'],
            ['title' => 'Экспорт из Figma в код', 'slug' => 'figma-export-code', 'excerpt' => 'Передача макетов разработчикам.', 'content' => 'Экспорт ресурсов и стилей...', 'category' => 'Разработка'],
        ];

        foreach ($items as $i => $item) {
            News::firstOrCreate(
                ['slug' => $item['slug']],
                [
                    'title' => $item['title'],
                    'excerpt' => $item['excerpt'],
                    'content' => $item['content'],
                    'category' => $item['category'],
                    'is_featured' => $i === 0,
                    'is_published' => true,
                    'author_id' => $author->id,
                    'views_count' => 0,
                    'published_at' => now(),
                ]
            );
        }
    }
}
