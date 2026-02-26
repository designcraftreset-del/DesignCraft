<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        $role = strtolower($data['name']) === 'admin' ? 'admin' : 'user';

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