<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('email', 'admin@admin.admin')->first() ?? User::first();
        $userId = $user ? $user->id : null;

        $items = [
            ['client_name' => 'Алексей К.', 'client_position' => 'Стример', 'review_text' => 'Отличное превью для стрима, быстро и качественно.', 'rating' => 5],
            ['client_name' => 'Мария В.', 'client_position' => 'SMM-менеджер', 'review_text' => 'Заказывала баннеры для соцсетей — всё в срок, учли правки.', 'rating' => 5],
            ['client_name' => 'Дмитрий П.', 'client_position' => 'Блогер', 'review_text' => 'Аватарка и превью сделали за два дня. Рекомендую.', 'rating' => 5],
            ['client_name' => 'Ольга С.', 'client_position' => 'Предприниматель', 'review_text' => 'Логотип для стартапа — несколько концепций, выбрали лучшую.', 'rating' => 5],
            ['client_name' => 'Игорь Н.', 'client_position' => 'Дизайнер', 'review_text' => 'Помогли с анимацией для портфолио. Профессионально.', 'rating' => 5],
            ['client_name' => 'Елена Т.', 'client_position' => 'Маркетолог', 'review_text' => 'Серия баннеров под рекламную кампанию — всё согласовано.', 'rating' => 5],
            ['client_name' => 'Павел М.', 'client_position' => 'Геймдев', 'review_text' => 'Превью для YouTube в едином стиле. Доволен результатом.', 'rating' => 5],
            ['client_name' => 'Анна Л.', 'client_position' => 'Фрилансер', 'review_text' => 'Заказывала аватарку и обложку — аккуратно и в срок.', 'rating' => 5],
            ['client_name' => 'Сергей К.', 'client_position' => 'Преподаватель', 'review_text' => 'Оформление для онлайн-курса. Всем коллегам рекомендую.', 'rating' => 5],
            ['client_name' => 'Наталья Р.', 'client_position' => 'Контент-мейкер', 'review_text' => 'Быстро сделали превью под новый формат. Спасибо!', 'rating' => 5],
        ];

        foreach ($items as $item) {
            Review::firstOrCreate(
                [
                    'client_name' => $item['client_name'],
                    'review_text' => $item['review_text'],
                ],
                [
                    'client_position' => $item['client_position'],
                    'rating' => $item['rating'],
                    'is_approved' => true,
                    'user_id' => $userId,
                ]
            );
        }
    }
}
