<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mobile\MobileHomeController;
use App\Http\Controllers\Mobile\MobileAboutController;
use App\Http\Controllers\Mobile\MobileServicesController;
use App\Http\Controllers\Mobile\MobilePortfolioController;
use App\Http\Controllers\Mobile\MobileWhyusController;
use App\Http\Controllers\Mobile\MobileContactsController;
use App\Http\Controllers\Mobile\MobileNewsController;
use App\Http\Controllers\Mobile\MobileLegalController;
use App\Http\Controllers\Mobile\MobileOrderController;
use App\Http\Controllers\Mobile\MobileAccountController;
use App\Http\Controllers\Mobile\MobileSettingsController;
use App\Http\Controllers\Mobile\MobileChatsController;
use App\Http\Controllers\Mobile\MobileAuthController;

/*
|--------------------------------------------------------------------------
| Мобильные маршруты (префикс /mobile)
|--------------------------------------------------------------------------
| Те же данные и логика, что и у десктопа; отдаются мобильные Blade-шаблоны.
*/

Route::middleware(['web', 'mobile.detect'])->group(function () {
    Route::get('/', [MobileHomeController::class, 'index'])->name('mobile.home');

    // Гости: отдельные страницы входа, регистрации и восстановления пароля
    Route::middleware('guest')->group(function () {
        Route::get('/login', [MobileAuthController::class, 'showLoginForm'])->name('mobile.login');
        Route::get('/register', [MobileAuthController::class, 'showRegisterForm'])->name('mobile.register');
        Route::get('/password/reset', [MobileAuthController::class, 'showLinkRequestForm'])->name('mobile.password.request');
        Route::get('/password/reset/{token}', [MobileAuthController::class, 'showResetForm'])->name('mobile.password.reset');
    });
    Route::get('/about', [MobileAboutController::class, 'index'])->name('mobile.about');
    Route::get('/services', [MobileServicesController::class, 'index'])->name('mobile.services');
    Route::get('/portfolio', [MobilePortfolioController::class, 'index'])->name('mobile.portfolio');
    Route::get('/whyus', [MobileWhyusController::class, 'index'])->name('mobile.whyus');
    Route::get('/contacts', [MobileContactsController::class, 'index'])->name('mobile.contacts');
    Route::get('/news', [MobileNewsController::class, 'index'])->name('mobile.news');
    Route::get('/news/{slug}', [MobileNewsController::class, 'show'])->name('mobile.news.show');
    Route::get('/privacy', [MobileLegalController::class, 'privacy'])->name('mobile.privacy');
    Route::get('/terms', [MobileLegalController::class, 'terms'])->name('mobile.terms');
    Route::get('/order', [MobileOrderController::class, 'create'])->name('mobile.order.create')->middleware('auth');
    Route::get('/account', [MobileAccountController::class, 'index'])->name('mobile.account')->middleware('auth');
    Route::get('/settings', [MobileSettingsController::class, 'index'])->name('mobile.settings')->middleware('auth');
    Route::get('/chats', [MobileChatsController::class, 'index'])->name('mobile.chats')->middleware('auth');
    Route::get('/review', function () {
        return view('mobile.pages.review-create');
    })->name('mobile.review.create')->middleware('auth');
});
