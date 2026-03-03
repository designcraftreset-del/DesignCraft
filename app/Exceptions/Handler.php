<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Редирект при ошибке валидации формы регистрации: на мобильную или десктопную форму,
     * чтобы оба варианта сайта работали и данные падали в одну таблицу users.
     */
    protected function invalid($request, ValidationException $exception)
    {
        $redirectTo = $exception->redirectTo ?? null;
        if ($redirectTo === null && $request->isMethod('POST') && $request->is('register')) {
            $redirectTo = $request->has('redirect_mobile')
                ? route('mobile.register')
                : route('auth-v2.register');
        }
        if ($redirectTo === null) {
            $redirectTo = url()->previous();
        }
        return redirect($redirectTo)
            ->withInput(Arr::except($request->input(), $this->dontFlash))
            ->withErrors($exception->errors(), $request->input('_error_bag', $exception->errorBag));
    }
}
