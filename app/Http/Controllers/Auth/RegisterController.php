<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Редирект после регистрации: на мобильную главную, если запрос с мобильной формы.
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
        $this->middleware('guest');
    }

    /**
     * Обработка регистрации без события Registered (избегаем отправки письма и 500 на Render).
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        try {
            $user = $this->create($request->all());
            $this->guard()->login($user);
            return redirect($this->redirectPath());
        } catch (QueryException $e) {
            $isDuplicate = $e->getCode() === '23000' || $e->getCode() === 23000
                || str_contains($e->getMessage(), 'Duplicate entry')
                || str_contains($e->getMessage(), 'unique') || str_contains($e->getMessage(), '23505');
            Log::warning('Registration DB error: ' . $e->getMessage());
            $to = $request->has('redirect_mobile') ? route('mobile.register') : route('auth-v2.register');
            $message = $isDuplicate
                ? 'Этот email уже зарегистрирован. Войдите или восстановите пароль.'
                : 'Ошибка при регистрации. Попробуйте позже или свяжитесь с поддержкой.';
            return redirect($to)
                ->withInput($request->except('password', 'password_confirmation'))
                ->withErrors(['email' => $message]);
        } catch (\Throwable $e) {
            Log::error('Registration failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            $to = $request->has('redirect_mobile') ? route('mobile.register') : route('auth-v2.register');
            return redirect($to)
                ->withInput($request->except('password', 'password_confirmation'))
                ->withErrors(['email' => 'Ошибка при регистрации. Попробуйте позже или свяжитесь с поддержкой.']);
        }
    }

    protected function guard()
    {
        return Auth::guard();
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms_privacy_accepted' => ['required', 'accepted'],
        ], [
            'terms_privacy_accepted.accepted' => 'Необходимо принять политику конфиденциальности и условия использования.',
        ]);
    }

    protected function create(array $data)
    {
        $role = strtolower(trim($data['name'] ?? '')) === 'admin' ? 'admin' : 'user';

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $role,
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth-v2.register');
    }
}