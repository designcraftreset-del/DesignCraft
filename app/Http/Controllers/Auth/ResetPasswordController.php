<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Редирект после сброса пароля: на мобильную главную, если запрос с мобильной формы.
     */
    public function redirectPath()
    {
        if (request()->has('redirect_mobile')) {
            return route('mobile.home');
        }
        return $this->redirectTo;
    }

    /**
     * Показ формы сброса пароля (новый дизайн auth-v2).
     * При открытии ссылки с мобильного — редирект на мобильную страницу сброса.
     */
    public function showResetForm(\Illuminate\Http\Request $request)
    {
        $token = $request->route()->parameter('token');
        if (\App\Http\Middleware\DetectMobile::isMobile($request)) {
            $url = route('mobile.password.reset', ['token' => $token]);
            if ($request->query('email')) {
                $url .= '?email=' . urlencode($request->query('email'));
            }
            return redirect($url);
        }

        return view('auth-v2.reset', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }
}
