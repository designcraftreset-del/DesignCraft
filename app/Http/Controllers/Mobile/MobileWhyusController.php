<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Review;
use App\Models\User;

class MobileWhyusController extends Controller
{
    public function index()
    {
        $PublicFunc = Application::all();
        $reviews = Review::approved()->orderBy('created_at', 'desc')->get();
        $users = User::withCount('orders')->get();

        return view('mobile.pages.whyus', compact('PublicFunc', 'reviews', 'users'));
    }
}
