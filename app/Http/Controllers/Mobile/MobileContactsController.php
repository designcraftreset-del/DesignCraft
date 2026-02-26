<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Application;

class MobileContactsController extends Controller
{
    public function index()
    {
        $PublicFunc = Application::all();

        return view('mobile.pages.contacts', compact('PublicFunc'));
    }
}
