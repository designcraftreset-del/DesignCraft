<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('auth-v2.email');
    }

    /**
     * Отправка ссылки сброса пароля. При ошибке (например, нет SMTP на Render) — не 500, а понятное сообщение.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        try {
            $response = $this->broker()->sendResetLink(
                $this->credentials($request)
            );

            return $response == Password::RESET_LINK_SENT
                ? $this->sendResetLinkResponse($request, $response)
                : $this->sendResetLinkFailedResponse($request, $response);
        } catch (\Throwable $e) {
            Log::warning('Password reset link send failed: ' . $e->getMessage());
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Не удалось отправить письмо. Проверьте email или напишите в поддержку.']);
        }
    }
}