<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MobileAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except([]);
    }

    public function showLoginForm()
    {
        return view('mobile.auth.login');
    }

    public function showRegisterForm()
    {
        return view('mobile.auth.register');
    }

    public function showLinkRequestForm()
    {
        return view('mobile.auth.email');
    }

    public function showResetForm(Request $request, $token)
    {
        return view('mobile.auth.reset', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }
}
