<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\User;

class NewsSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();

        News::create([
            'title' => 'Новые тенденции в веб-дизайне 2024',
            'slug' => 'new-trends-web-design-2024',
            'excerpt' => 'Обзор самых актуальных трендов в веб-дизайне, которые будут доминировать в этом году.',
            'content' => 'Полное содержание новости о тенденциях в веб-дизайне...',
            'category' => 'Дизайн',
            'is_featured' => true,
            'author_id' => $user->id,
            'published_at' => now(),
        ]);

        // Добавьте больше тестовых новостей
    }
}