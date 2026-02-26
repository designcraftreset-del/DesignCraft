<?php

namespace App\Providers;

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
}
