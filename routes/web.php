<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\BannerControllerTwo;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AuthV2Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\OrderChatController;
use App\Http\Controllers\ServicesController;

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Главная (публичная)
Route::get("/index",  [ApplicationController::class, 'indexFunc'])->name('index')->middleware('auth');
Route::get("/adminPanel",  [ApplicationController::class, 'apminPanelFunc'])->name('adminPanel')->middleware('auth');
Route::get("/adminPanel2", [ApplicationController::class, 'adminPanel2Func'])->name('adminPanel2')->middleware('auth');
Route::get("/adminPanel2/export/orders", [ApplicationController::class, 'exportOrders'])->name('adminPanel2.export.orders')->middleware('auth');
Route::get("/adminPanel2/export/users", [ApplicationController::class, 'exportUsers'])->name('adminPanel2.export.users')->middleware('auth');
Route::get("/adminPanel2/export/table", [ApplicationController::class, 'exportTable'])->name('adminPanel2.export.table')->middleware('auth');
Route::get("/adminPanel2/export/services", [ApplicationController::class, 'exportServices'])->name('adminPanel2.export.services')->middleware('auth');
Route::get("/adminPanel2/export/messages", [ApplicationController::class, 'exportMessages'])->name('adminPanel2.export.messages')->middleware('auth');
Route::get("/userPanel",  [ApplicationController::class, 'userPanel'])->name('userPanel')->middleware('auth');
// Главная

Route::get("/adminPanel",  [ApplicationController::class, 'apminPanelFunc'])->name('adminPanel')->middleware('auth');
Route::get("/userPanel",  [ApplicationController::class, 'userPanel'])->name('userPanel')->middleware('auth');

// Страницы все
Route::get("/aboutus",  [ApplicationController::class, 'aboutusFunc'])->name('aboutus');
Route::get("/services",  [ApplicationController::class, 'servicesFunc'])->name('services');
Route::get("/servicesBlock/create",  [ApplicationController::class, 'servicesCreateFunc'])->name('services.create');
Route::post("/servicesBlockPost",  [ServicesController::class, 'servicesBlockPostFunc'])->name('servicesBlockPost')->middleware('auth');
Route::put('/services/{id}', [ServicesController::class, 'update'])->name('services.update')->middleware('auth');
Route::get("/portfolio", [BannerControllerTwo::class, 'index'])->name('portfolio');
Route::get("/whyus",  [ApplicationController::class, 'whyusFunc'])->name('whyus');
Route::get("/contacts",  [ApplicationController::class, 'contactsFunc'])->name('contacts');
Route::get("/",  [ApplicationController::class, 'hellowFunc'])->name('hellow');
Route::get('websiteNews', [ApplicationController::class,'websiteNewsFunc'])->name('websiteNews');

// Страница оформления заказа (отдельная страница)
Route::get("/order", [ApplicationController::class, 'orderCreate'])->name('order.create')->middleware('auth');
// Не помню
Route::post("/new",  [ApplicationController::class, 'infer'])->name('new')->middleware('auth');
Route::put('/orders/{id}/confirm', [ApplicationController::class, 'confirm'])->name('orders.confirm')->middleware('auth');
Route::put('/orders/{id}/cancel', [ApplicationController::class, 'cancel'])->name('orders.cancel')->middleware('auth');

// Тест отправки почты (только при APP_DEBUG) — откройте /test-mail чтобы увидеть ошибку SMTP
Route::get('/test-mail', function () {
    if (!config('app.debug')) {
        abort(404);
    }
    try {
        \Illuminate\Support\Facades\Mail::raw('Тест DesignCraft.', function ($m) {
            $m->to(config('mail.from.address'))->subject('Тест почты');
        });
        return response('Письмо отправлено. Проверьте ящик ' . config('mail.from.address'), 200);
    } catch (\Throwable $e) {
        return response('Ошибка: ' . $e->getMessage(), 500);
    }
})->name('test-mail');

// Политика и условия (страницы без хедера/футера)
Route::get('/privacy', function () {
    return view('legal.privacy');
})->name('privacy');
Route::get('/terms', function () {
    return view('legal.terms');
})->name('terms');

// Аутентификация
Auth::routes();

// Тестовый дизайн форм (auth-v2) — отдельные страницы для проверки нового оформления
Route::middleware('guest')->prefix('auth-v2')->group(function () {
    Route::get('/login', [AuthV2Controller::class, 'showLoginForm'])->name('auth-v2.login');
    Route::get('/register', [AuthV2Controller::class, 'showRegisterForm'])->name('auth-v2.register');
    Route::get('/password/reset', [AuthV2Controller::class, 'showLinkRequestForm'])->name('auth-v2.password.request');
    Route::get('/password/reset/{token}', [AuthV2Controller::class, 'showResetForm'])->name('auth-v2.password.reset');
});
// Кастомный logout — редирект на главную (лендинг), не на /index
Route::post('/logout', function (Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->to(url('/'));
})->name('logout');

// Управление заказами (Наверно я не помню)
Route::prefix('orders')->middleware('auth')->group(function () {
    Route::put('/{id}/status', [ApplicationController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::put('/{id}', [ApplicationController::class, 'updateOrder'])->name('orders.update');
    Route::delete('/{id}', [ApplicationController::class, 'destroy'])->name('orders.destroy');
    Route::get('/', [ApplicationController::class, 'index'])->name('orders.index');
});

// Отзывы
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])
    ->name('reviews.destroy')
    ->middleware('auth');

// Аватарки
Route::post('/avatar/upload', [AvatarController::class, 'upload'])->name('avatar.upload')->middleware('auth');
Route::delete('/avatar/remove', [AvatarController::class, 'remove'])->name('avatar.remove')->middleware('auth');
Route::post('/profile', [UserController::class, 'updateOwnProfile'])->name('profile.update')->middleware('auth');
Route::post('/profile/password', [UserController::class, 'changePassword'])->name('profile.password')->middleware('auth');
Route::post('/profile/password/send-link', [UserController::class, 'sendPasswordResetLink'])->name('profile.password.send-link')->middleware('auth');

// Управление пользователями
Route::prefix('users')->middleware(['auth', 'admin'])->group(function () {
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::put('/{id}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});
// Профиль пользователя для админки (просмотр + редактирование, аватар, заказы, отзывы)
Route::middleware(['auth'])->group(function () {
    Route::get('/adminPanel2/api/user/{id}', [UserController::class, 'profileForAdmin'])->name('adminPanel2.user.profile');
    Route::post('/adminPanel2/user/{id}/update', [UserController::class, 'updateProfileByAdmin'])->name('adminPanel2.user.update');
    Route::post('/adminPanel2/user/{id}/review', [ReviewController::class, 'storeForUser'])->name('adminPanel2.user.review.store');
});
Route::put('/adminPanel2/reviews/{id}', [ReviewController::class, 'update'])->name('adminPanel2.reviews.update')->middleware(['auth', 'admin']);

// Баннеры
Route::middleware(['auth'])->group(function () {
    Route::get('/banners/create', [BannerControllerTwo::class, 'create'])->name('banners.create');
    Route::post('/banners', [BannerControllerTwo::class, 'store'])->name('banners.store');
    Route::delete('/banners/{banner}', [BannerControllerTwo::class, 'destroy'])->name('banners.destroy');
    
    // Админские страницы для баннеров
    Route::middleware(['admin'])->group(function () {
        Route::post('/banners/{banner}/approve', [BannerControllerTwo::class, 'approve'])->name('banners.approve');
    });
});
// Страница новости и создать новость
Route::get('/websiteNews', [NewsController::class, 'websiteNewsFunc'])->name('websiteNews');
Route::get('/newsTwo/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/create', [NewsController::class, 'create'])->name('create');

// Страницы для управления новостями (только для админов/модераторов)
Route::middleware(['auth'])->prefix('news')->group(function () {
    Route::get('/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/', [NewsController::class, 'store'])->name('news.store');
    Route::get('/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
});






Route::get("/app",  [ApplicationController::class, 'appFunc'])->name('layouts.app');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/support-chat', [ChatController::class, 'supportChatPage'])->name('admin.support-chat');
    Route::get('/admin/chat', [ChatController::class, 'adminChat'])->name('admin.chat');
    Route::post('/admin/chat/send', [ChatController::class, 'sendMessage'])->name('admin.chat.send');
    Route::get('/admin/chat/messages', [ChatController::class, 'getMessages'])->name('admin.chat.messages');
    Route::get('/admin/chat/unread-count', [ChatController::class, 'getUnreadCount'])->name('admin.chat.unread');
    // Чат поддержки (отдельно от админ-чата): для всех авторизованных
    Route::get('/support/chat/messages', [ChatController::class, 'getSupportMessages'])->name('support.chat.messages');
    Route::post('/support/chat/send', [ChatController::class, 'sendSupportMessage'])->name('support.chat.send');
    // Треды поддержки для админа
    Route::get('/support/chat/threads', [ChatController::class, 'getSupportThreads'])->name('support.chat.threads');
    Route::get('/support/chat/search-users', [ChatController::class, 'searchUsersForChat'])->name('support.chat.search-users');
    Route::post('/support/chat/reply', [ChatController::class, 'sendSupportReply'])->name('support.chat.reply');
    Route::post('/support/chat/enable-bot', [ChatController::class, 'enableBot'])->name('support.chat.enable-bot');
    Route::post('/support/chat/disable-bot', [ChatController::class, 'disableBot'])->name('support.chat.disable-bot');
    Route::post('/support/chat/mark-read', [ChatController::class, 'markSupportThreadRead'])->name('support.chat.mark-read');
    Route::post('/support/chat/pin', [ChatController::class, 'pinSupportThread'])->name('support.chat.pin');
    Route::post('/support/chat/delete-thread', [ChatController::class, 'deleteSupportThread'])->name('support.chat.delete-thread');
    Route::post('/support/chat/delete-message', [ChatController::class, 'deleteSupportMessage'])->name('support.chat.delete-message');
    Route::post('/support/chat/update-message', [ChatController::class, 'updateSupportMessage'])->name('support.chat.update-message');
});

Route::post('/admin/chat/delete', [App\Http\Controllers\ChatController::class, 'deleteMessage'])->name('admin.chat.delete');

// Чат по заказу и панель модератора
Route::middleware(['auth'])->group(function () {
    Route::post('/support/order-problem', [OrderChatController::class, 'reportOrderProblem'])->name('support.order-problem');
    Route::get('/orders/{orderId}/chat/messages', [OrderChatController::class, 'getOrderMessages'])->name('orders.chat.messages');
    Route::post('/orders/{orderId}/chat/send', [OrderChatController::class, 'sendOrderMessage'])->name('orders.chat.send');
    Route::get('/orders/chats/list', [OrderChatController::class, 'userOrderChats'])->name('orders.chats.list');
});
Route::middleware(['auth'])->group(function () {
    Route::post('/orders/{orderId}/chat/close', [OrderChatController::class, 'closeOrderChat'])->name('orders.chat.close');
    Route::post('/orders/{orderId}/chat/reopen', [OrderChatController::class, 'reopenOrderChat'])->name('orders.chat.reopen');
    Route::post('/orders/{orderId}/preview', [OrderChatController::class, 'uploadOrderPreview'])->name('orders.preview.upload');
});
Route::get('/moder-panel', [ApplicationController::class, 'moderPanel'])->name('moder.panel')->middleware('auth');
Route::get('/moder-panel/order-unread', [ApplicationController::class, 'moderOrderUnreadApi'])->name('moder.order.unread')->middleware('auth');
Route::get('/moder-panel/order/{orderId}/chat', [ApplicationController::class, 'moderOrderChatPage'])->name('moder.order.chat')->middleware('auth');