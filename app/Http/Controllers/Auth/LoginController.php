<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Редирект после входа: на мобильную главную, если запрос с мобильной формы.
     */
    public function redirectPath()
    {
        if (request()->has('redirect_mobile')) {
            return route('mobile.home');
        }
        return $this->redirectTo;
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Переопределяем метод показа формы входа
     */
    public function showLoginForm()
    {
        return view('auth-v2.login');
    }
}