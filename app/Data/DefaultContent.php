<?php

namespace App\Data;

/**
 * Контент по умолчанию (отзывы, новости с фотками).
 * Прописан здесь, чтобы не использовать сидеры — подставляется в БД при первом запуске.
 */
class DefaultContent
{
    /**
     * Отзывы для блока «Что говорят клиенты».
     *
     * @return array<int, array{client_name: string, client_position: string, review_text: string, rating: int}>
     */
    public static function reviews(): array
    {
        return [
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
    }

    /**
     * Новости с полями для фото (image_path можно подставить путь к картинке в storage).
     *
     * @return array<int, array{title: string, slug: string, excerpt: string, content: string, image_path: string|null, category: string, is_featured: bool}>
     */
    public static function news(): array
    {
        return [
            [
                'title' => 'Новые тенденции в веб-дизайне 2025',
                'slug' => 'new-trends-web-design-2025',
                'excerpt' => 'Обзор актуальных трендов в веб-дизайне.',
                'content' => 'Полное содержание новости о тенденциях в веб-дизайне. Минимализм, неоморфизм, тёмные темы и доступность — кратко о главном для дизайнеров в 2025 году.',
                'image_path' => null,
                'category' => 'Дизайн',
                'is_featured' => true,
            ],
            [
                'title' => 'Photoshop: обновление инструментов',
                'slug' => 'photoshop-update-tools',
                'excerpt' => 'Новые инструменты в последней версии Photoshop.',
                'content' => 'Содержание о новинках Photoshop: улучшенная нейросеть, маски и работа с цветом. Как быстрее доводить макеты до финала.',
                'image_path' => null,
                'category' => 'Дизайн',
                'is_featured' => false,
            ],
            [
                'title' => 'Figma для команд',
                'slug' => 'figma-for-teams',
                'excerpt' => 'Как эффективно работать в Figma в команде.',
                'content' => 'Советы по совместной работе в Figma: компоненты, библиотеки, комментарии и передача макетов разработчикам.',
                'image_path' => null,
                'category' => 'Разработка',
                'is_featured' => false,
            ],
            [
                'title' => 'Цветовые схемы в дизайне',
                'slug' => 'color-schemes-design',
                'excerpt' => 'Подбор цветовых палитр для проектов.',
                'content' => 'Как выбирать цвета для дизайна: контраст, доступность, настроение. Примеры палитр для лендингов и соцсетей.',
                'image_path' => null,
                'category' => 'Дизайн',
                'is_featured' => false,
            ],
            [
                'title' => 'Типографика в интерфейсах',
                'slug' => 'typography-interfaces',
                'excerpt' => 'Основы типографики в UI/UX.',
                'content' => 'Правила использования шрифтов в интерфейсах: читаемость, иерархия, парные шрифты.',
                'image_path' => null,
                'category' => 'Дизайн',
                'is_featured' => false,
            ],
            [
                'title' => 'Баннеры для соцсетей',
                'slug' => 'banners-social',
                'excerpt' => 'Создание баннеров для социальных сетей.',
                'content' => 'Размеры и советы по баннерам для ВКонтакте, Telegram, YouTube и рекламных сетей.',
                'image_path' => null,
                'category' => 'Маркетинг',
                'is_featured' => false,
            ],
            [
                'title' => 'Аватарки и брендинг',
                'slug' => 'avatars-branding',
                'excerpt' => 'Как аватарка влияет на узнаваемость бренда.',
                'content' => 'Роль аватарки в визуальном стиле: стримеры, блогеры, компании. Единый стиль для всех каналов.',
                'image_path' => null,
                'category' => 'Дизайн',
                'is_featured' => false,
            ],
            [
                'title' => 'Анимация в дизайне',
                'slug' => 'animation-design',
                'excerpt' => 'Микроанимации и их применение.',
                'content' => 'Когда и как использовать анимацию: превью, сторис, баннеры. Простые приёмы в After Effects и Figma.',
                'image_path' => null,
                'category' => 'Дизайн',
                'is_featured' => false,
            ],
            [
                'title' => 'Логотипы: от идеи до макета',
                'slug' => 'logos-from-idea',
                'excerpt' => 'Этапы создания логотипа.',
                'content' => 'От брифа до финального файла: концепции, правки, форматы для печати и веба.',
                'image_path' => null,
                'category' => 'Дизайн',
                'is_featured' => false,
            ],
            [
                'title' => 'Экспорт из Figma в код',
                'slug' => 'figma-export-code',
                'excerpt' => 'Передача макетов разработчикам.',
                'content' => 'Экспорт ресурсов и стилей из Figma. Dev Mode и плагины для быстрой вёрстки.',
                'image_path' => null,
                'category' => 'Разработка',
                'is_featured' => false,
            ],
        ];
    }
}
