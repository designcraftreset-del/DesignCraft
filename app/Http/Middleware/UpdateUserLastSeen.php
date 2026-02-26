<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class UpdateUserLastSeen
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (Auth::check() && Auth::user()->id) {
            try {
                if (Schema::hasColumn((new \App\Models\User)->getTable(), 'last_seen_at')) {
                    Auth::user()->update(['last_seen_at' => now()]);
                }
            } catch (\Throwable $e) {
                // не ломаем ответ при ошибке обновления last_seen_at
            }
        }

        return $response;
    }
}
