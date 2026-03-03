<?php

namespace App\Providers;

use App\Data\DefaultContent;
use App\Models\News;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        // Хелпер определения устройства (мобильный/десктоп и принудительный выбор)
        $this->app->bind('mobile.detect', function ($app) {
            $request = $app['request'];
            return new class($request) {
                private $request;
                public function __construct($request) { $this->request = $request; }
                public function isMobile(): bool { return (bool) $this->request->attributes->get('is_mobile_device', false); }
                public function wantsDesktop(): bool { return (bool) $this->request->attributes->get('wants_desktop', false); }
                public function wantsMobile(): bool { return (bool) $this->request->attributes->get('wants_mobile', false); }
            };
        });

        if (config('app.env') === 'production') {
            $url->forceScheme('https');
        }

        // Ссылка в письме сброса пароля
        ResetPassword::createUrlUsing(function ($notifiable, $token) {
            return url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ]));
        });

        // Контент по умолчанию (отзывы, новости) — без сидеров, подставляется при первом запуске
        $this->ensureDefaultContent();

        // Письмо сброса пароля на русском
        ResetPassword::toMailUsing(function ($notifiable, $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ]));
            $expire = config('auth.passwords.'.config('auth.defaults.passwords').'.expire', 60);

            \Illuminate\Support\Facades\Log::info('Отправка письма сброса пароля', [
                'to' => $notifiable->getEmailForPasswordReset(),
                'url_domain' => parse_url($url, PHP_URL_HOST),
            ]);

            return (new MailMessage)
                ->subject('Сброс пароля — '.config('app.name'))
                ->line('Вы получили это письмо, потому что был запрошен сброс пароля для вашего аккаунта.')
                ->action('Сбросить пароль', $url)
                ->line('Ссылка действительна '.$expire.' минут.')
                ->line('Если вы не запрашивали сброс пароля, ничего делать не нужно.');
        });
    }

    /**
     * Подставить отзывы и новости из DefaultContent в БД, если таблицы пустые (без сидеров).
     */
    protected function ensureDefaultContent(): void
    {
        try {
            if (Review::count() === 0) {
                $user = User::first();
                $userId = $user?->id;
                foreach (DefaultContent::reviews() as $item) {
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

            if (News::count() === 0) {
                $author = User::first();
                if ($author) {
                    foreach (DefaultContent::news() as $i => $item) {
                        News::firstOrCreate(
                            ['slug' => $item['slug']],
                            [
                                'title' => $item['title'],
                                'excerpt' => $item['excerpt'],
                                'content' => $item['content'],
                                'image_path' => $item['image_path'] ?? null,
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
        } catch (\Throwable $e) {
            // Не ломать старт приложения (миграции ещё не выполнены и т.д.)
            report($e);
        }
    }
}
