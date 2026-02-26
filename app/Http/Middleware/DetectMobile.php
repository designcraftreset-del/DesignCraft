<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class DetectMobile
{
    /** @var string ключ сессии для принудительного выбора версии */
    public const SESSION_FORCE_VIEW = 'force_mobile_view';

    /**
     * Проверка User-Agent на мобильное устройство.
     */
    public static function isMobile(Request $request): bool
    {
        $ua = $request->userAgent() ?? '';
        $mobileAgents = [
            'Mobile', 'Android', 'iPhone', 'iPad', 'iPod', 'webOS', 'BlackBerry',
            'IEMobile', 'Opera Mini', 'Opera Mobi', 'Windows Phone', 'Kindle', 'Silk',
        ];
        foreach ($mobileAgents as $agent) {
            if (stripos($ua, $agent) !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Пользователь явно выбрал десктоп (не редиректить на mobile).
     */
    public static function wantsDesktop(Request $request): bool
    {
        return $request->session()->get(self::SESSION_FORCE_VIEW) === 'desktop';
    }

    /**
     * Пользователь явно выбрал мобильную версию.
     */
    public static function wantsMobile(Request $request): bool
    {
        return $request->session()->get(self::SESSION_FORCE_VIEW) === 'mobile';
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, bool $redirectToMobile = false): Response
    {
        $isMobile = self::isMobile($request);
        $wantsDesktop = self::wantsDesktop($request);
        $wantsMobile = self::wantsMobile($request);

        $request->attributes->set('is_mobile_device', $isMobile);
        $request->attributes->set('wants_desktop', $wantsDesktop);
        $request->attributes->set('wants_mobile', $wantsMobile);

        View::share('is_mobile_device', $isMobile);
        View::share('wants_desktop', $wantsDesktop);
        View::share('wants_mobile', $wantsMobile);

        return $next($request);
    }
}
