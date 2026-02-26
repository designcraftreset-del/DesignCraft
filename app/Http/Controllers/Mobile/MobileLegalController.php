<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;

class MobileLegalController extends Controller
{
    public function privacy()
    {
        return view('mobile.pages.privacy');
    }

    public function terms()
    {
        return view('mobile.pages.terms');
    }
}
