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
