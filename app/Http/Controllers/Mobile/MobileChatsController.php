<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class MobileChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Application::where('userid', Auth::id())
            ->orderBy('updated_at', 'desc')
            ->get(['id', 'yslyga', 'status', 'chat_closed_at', 'info', 'created_at', 'updated_at']);
        return view('mobile.pages.chats', compact('orders'));
    }
}
