<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MobileOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Страница оформления заказа (мобильная).
     * Та же логика, что orderCreate: for_user для админа/модератора.
     */
    public function create(Request $request)
    {
        $forUser = null;
        if (in_array(Auth::user()->role, ['admin', 'moderator']) && $request->filled('for_user')) {
            $forUser = User::find($request->for_user);
        }

        return view('mobile.pages.order', compact('forUser'));
    }
}
