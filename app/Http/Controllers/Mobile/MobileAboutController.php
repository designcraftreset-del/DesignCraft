<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class MobileAboutController extends Controller
{
    public function index()
    {
        $PublicFunc = Application::all();

        return view('mobile.pages.about', compact('PublicFunc'));
    }
}
