<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthV2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth-v2.login');
    }

    public function showRegisterForm()
    {
        return view('auth-v2.register');
    }

    public function showLinkRequestForm()
    {
        return view('auth-v2.email');
    }

    public function showResetForm(Request $request, $token)
    {
        return view('auth-v2.reset', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }
}
