<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Review;
use App\Models\User;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\News;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    public function indexFunc(){
        $PublicFunc = Application::all();
        $reviews = Review::approved()->orderBy('created_at', 'desc')->get();
        return view("index", compact("PublicFunc", "reviews"));
    }

    public function confirm($id)
    {
        $order = Application::findOrFail($id);
        $order->status = 'confirmed';
        $order->save();
        
        return redirect()->back()->with('success', 'Заказ подтвержден!');
    }

    public function cancel($id)
    {
        $order = Application::findOrFail($id);
        $order->status = 'cancelled';
        $order->save();
        
        return redirect()->back()->with('success', 'Заказ отменен!');
    }

    /** Страница оформления заказа (для админа можно ?for_user=ID — заказ от имени пользователя) */
    public function orderCreate(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $forUser = null;
        if (in_array(Auth::user()->role, ['admin', 'moderator']) && $request->filled('for_user')) {
            $forUser = User::find($request->for_user);
        }
        return view('order.create', compact('forUser'));
    }

    public function infer(Request $request){
        $request->validate([
            "name" => "required|string",
            "email" => "required|string",
            "phone" => "required|string",
            "selectt" => "required|string",
            "text" => "required|string",
            "radioo" => "nullable|string|max:64",
            "sources" => "nullable|file|max:51200",
            "photos" => "nullable|array|max:10",
            "photos.*" => "nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048",
        ], [
            'name.required' => 'Укажите имя.',
            'email.required' => 'Укажите email.',
            'phone.required' => 'Укажите телефон.',
            'selectt.required' => 'Выберите услугу.',
            'text.required' => 'Опишите задачу.',
            'photos.max' => 'Можно загрузить не более 10 фото.',
            'photos.*.image' => 'Файлы должны быть изображениями (JPEG, PNG, GIF, WebP).',
            'photos.*.mimes' => 'Разрешены форматы: JPEG, PNG, GIF, WebP.',
            'photos.*.max' => 'Каждое фото — не более 2 МБ. Уменьшите размер файлов.',
            'sources.max' => 'Файл источников слишком большой (макс. 50 МБ).',
        ]);
        
        $userId = auth()->id();
        if (in_array(Auth::user()->role, ['admin', 'moderator']) && $request->filled('for_user')) {
            $userId = (int) $request->for_user;
        }
        $sourcesPath = null;
        if ($request->hasFile('sources')) {
            $sourcesPath = $request->file('sources')->store('order_sources', 'public');
        }
        $photosPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $f) {
                if ($f && $f->isValid()) {
                    $photosPaths[] = $f->store('order_photos', 'public');
                }
            }
        }
        $newrequest = new Application([
            "name" => $request->name,
            "email" => $request->email,
            "nomer" => $request->phone,
            "yslyga" => $request->selectt,
            "paket" => $request->radioo,
            "info" => $request->text,
            "userid" => $userId,
            "sources_path" => $sourcesPath,
            "photos_paths" => $photosPaths ?: null,
        ]);
        $newrequest->save();
        if ($request->filled('redirect_mobile')) {
            return redirect()->route('mobile.order.create')->with('success', true);
        }
        return redirect()->route('order.create')->with('success', true);
    }

    public function apminPanelFunc(){
        $user = Auth::user();
        
        if ($user->role !== 'admin' && $user->role !== 'moderator') {
            return redirect()->route('home')->with('error', 'У вас нет прав доступа к этой странице!');
        }

        $PublicFunc = Application::all();
        $users = User::withCount('orders')->get();
        
        return view("adminPanel", compact("PublicFunc", "users"));
    }

    public function adminPanel2Func(Request $request){
        $user = Auth::user();
        if (($user->role ?? null) !== 'admin' && ($user->role ?? null) !== 'moderator') {
            return redirect()->route('home')->with('error', 'У вас нет прав доступа к этой странице!');
        }
        $allowed = ['dashboard', 'orders', 'users', 'table', 'products', 'messages', 'analytics', 'reports', 'reviews', 'settings'];
        $page = $request->get('page', 'dashboard');
        if (!in_array($page, $allowed, true)) {
            $page = 'dashboard';
        }

        $filters = [
            'order_status' => $request->get('filter_order_status'),
            'order_search' => $request->get('filter_order_search'),
            'order_date_from' => $request->get('filter_order_date_from'),
            'order_date_to' => $request->get('filter_order_date_to'),
            'user_role' => $request->get('filter_user_role'),
            'user_search' => $request->get('filter_user_search'),
            'table_status' => $request->get('filter_table_status'),
            'table_search' => $request->get('filter_table_search'),
            'product_search' => $request->get('filter_product_search'),
        ];

        $orders = Application::with('user')->latest()->take(10)->get();
        $ordersQuery = Application::with('user');
        $sortOrder = $request->get('sort_order', 'created_at');
        $sortDir = strtolower($request->get('sort_dir', 'desc')) === 'asc' ? 'asc' : 'desc';
        $allowedSort = ['id', 'name', 'email', 'yslyga', 'status', 'created_at'];
        if (in_array($sortOrder, $allowedSort, true)) {
            $ordersQuery->orderBy($sortOrder, $sortDir);
        } else {
            $ordersQuery->latest();
        }
        if ($filters['order_status']) {
            $ordersQuery->where('status', $filters['order_status']);
        }
        if ($filters['order_search']) {
            $q = $filters['order_search'];
            $ordersQuery->where(function ($qb) use ($q) {
                $qb->where('name', 'like', "%{$q}%")->orWhere('email', 'like', "%{$q}%")->orWhere('yslyga', 'like', "%{$q}%");
            });
        }
        if ($filters['order_date_from']) {
            $ordersQuery->whereDate('created_at', '>=', $filters['order_date_from']);
        }
        if ($filters['order_date_to']) {
            $ordersQuery->whereDate('created_at', '<=', $filters['order_date_to']);
        }
        $ordersAll = $ordersQuery->paginate(20, ['*'], 'orders_page')->withQueryString();

        $totalOrders = Application::count();
        $totalUsers = User::count();
        $ordersThisMonth = Application::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
        $completedOrders = Application::where('status', 'completed')->count();
        $chartYear = (int) $request->get('chart_year', now()->year);
        $chartMonth = (int) $request->get('chart_month', now()->month);
        if ($chartYear < 2020 || $chartYear > 2100) $chartYear = now()->year;
        if ($chartMonth < 1 || $chartMonth > 12) $chartMonth = now()->month;
        $barRaw = Application::selectRaw('MONTH(created_at) as month, COUNT(*) as total')->whereYear('created_at', $chartYear)->groupBy('month')->orderBy('month')->pluck('total', 'month')->all();
        $chartBar = array_replace(array_fill(1, 12, 0), $barRaw);
        $daysInMonth = (int) date('t', mktime(0, 0, 0, $chartMonth, 1, $chartYear));
        $chartByDayRaw = Application::selectRaw('DAY(created_at) as day, COUNT(*) as total')
            ->whereMonth('created_at', $chartMonth)->whereYear('created_at', $chartYear)
            ->groupBy('day')->orderBy('day')->pluck('total', 'day')->all();
        $chartByDay = array_replace(array_fill(1, $daysInMonth, 0), $chartByDayRaw);
        $availableYears = Application::selectRaw('DISTINCT YEAR(created_at) as y')->orderBy('y', 'desc')->pluck('y')->take(10)->all();
        if (!in_array($chartYear, $availableYears, true)) $availableYears = array_merge([$chartYear], $availableYears);
        $inProgress = (int) Application::where('status', 'processing')->count();
        $chartPie = [
            'В работе' => $inProgress,
            'Завершённые' => (int) $completedOrders,
            'Новые' => max(0, $totalOrders - $completedOrders - $inProgress),
        ];

        $usersQuery = User::withCount('orders');
        $sortUsers = $request->get('sort_users', 'name');
        $dirUsers = strtolower($request->get('sort_dir_users', 'asc')) === 'desc' ? 'desc' : 'asc';
        $allowedUsersSort = ['id', 'name', 'email', 'role', 'created_at'];
        if (in_array($sortUsers, $allowedUsersSort, true)) {
            $usersQuery->orderBy($sortUsers, $dirUsers);
        } else {
            $usersQuery->orderBy('name');
        }
        if ($filters['user_role']) {
            $usersQuery->where('role', $filters['user_role']);
        }
        if ($filters['user_search']) {
            $q = $filters['user_search'];
            $usersQuery->where(function ($qb) use ($q) {
                $qb->where('name', 'like', "%{$q}%")->orWhere('email', 'like', "%{$q}%");
            });
        }
        $users = $usersQuery->paginate(20, ['*'], 'users_page')->withQueryString();

        $tableQuery = Application::with('user');
        $sortTable = $request->get('sort_table', 'created_at');
        $dirTable = strtolower($request->get('sort_dir_table', 'desc')) === 'asc' ? 'asc' : 'desc';
        $allowedTableSort = ['id', 'name', 'email', 'yslyga', 'status', 'created_at'];
        if (in_array($sortTable, $allowedTableSort, true)) {
            $tableQuery->orderBy($sortTable, $dirTable);
        } else {
            $tableQuery->latest();
        }
        if ($filters['table_status']) {
            $tableQuery->where('status', $filters['table_status']);
        }
        if ($filters['table_search']) {
            $q = $filters['table_search'];
            $tableQuery->where(function ($qb) use ($q) {
                $qb->where('name', 'like', "%{$q}%")->orWhere('email', 'like', "%{$q}%")->orWhere('nomer', 'like', "%{$q}%")->orWhere('yslyga', 'like', "%{$q}%");
            });
        }
        $applicationsAll = $tableQuery->paginate(25, ['*'], 'table_page')->withQueryString();

        $servicesQuery = Services::query();
        $sortProducts = $request->get('sort_products', 'created_at');
        $dirProducts = strtolower($request->get('sort_dir_products', 'desc')) === 'asc' ? 'asc' : 'desc';
        $allowedProductsSort = ['id', 'title', 'titleTwo', 'category', 'money', 'term', 'created_at'];
        if (in_array($sortProducts, $allowedProductsSort, true)) {
            $servicesQuery->orderBy($sortProducts, $dirProducts);
        } else {
            $servicesQuery->latest();
        }
        if ($filters['product_search']) {
            $q = $filters['product_search'];
            $servicesQuery->where(function ($qb) use ($q) {
                $qb->where('title', 'like', "%{$q}%")->orWhere('titleTwo', 'like', "%{$q}%")->orWhere('category', 'like', "%{$q}%");
            });
        }
        $services = $servicesQuery->paginate(20, ['*'], 'products_page')->withQueryString();

        $messagesList = \App\Models\ChatMessage::with('user')->adminChat()->latest()->take(50)->get();

        $supportThreads = collect();
        $reviewsAll = collect();
        $reviewsPendingCount = Review::where('is_approved', false)->count();
        $supportChatsCount = 0;
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'moderator'])) {
            $threadIds = \App\Models\ChatMessage::supportChat()->whereNotNull('thread_id')->distinct()->pluck('thread_id');
            $reads = \App\Models\SupportThreadRead::where('admin_id', Auth::id())->whereIn('thread_id', $threadIds)->get()->keyBy('thread_id');
            foreach ($threadIds as $tid) {
                $readAt = $reads->get($tid)->read_at ?? null;
                $unread = \App\Models\ChatMessage::supportChat()
                    ->where('thread_id', $tid)->where('user_id', $tid)
                    ->when($readAt, fn ($q) => $q->where('created_at', '>', $readAt))
                    ->count();
                if ($unread > 0) $supportChatsCount++;
            }
        }
        if ($page === 'reviews') {
            $reviewFilter = $request->get('filter_review_status', 'pending');
            $reviewsQuery = Review::with('user')->orderBy('created_at', 'desc');
            if ($reviewFilter === 'pending') {
                $reviewsQuery->where('is_approved', false);
            } elseif ($reviewFilter === 'approved') {
                $reviewsQuery->where('is_approved', true);
            }
            // 'all' — без фильтра по is_approved
            $reviewsAll = $reviewsQuery->paginate(20, ['*'], 'reviews_page')->withQueryString();
        }
        if ($page === 'messages') {
            $threadIds = \App\Models\ChatMessage::supportChat()->whereNotNull('thread_id')->distinct()->pluck('thread_id');
            $supportThreads = \App\Models\User::whereIn('id', $threadIds)->withCount(['supportMessages' => function ($q) {
                $q->where('chat_type', 'support');
            }])->orderBy('name')->get()->map(function ($u) {
                $last = \App\Models\ChatMessage::supportChat()->where('thread_id', $u->id)->latest()->first();
                $u->last_support_message = $last;
                $thread = \App\Models\SupportThread::where('user_id', $u->id)->first();
                $u->needs_human = $thread ? $thread->needs_human : false;
                return $u;
            });
        }

        $headings = [
            'dashboard' => 'Дашборд',
            'orders' => 'Заказы',
            'users' => 'Пользователи',
            'table' => 'Общая таблица',
            'products' => 'Товары / Услуги',
            'messages' => 'Сообщения',
            'analytics' => 'Аналитика',
            'reports' => 'Отчёты',
            'reviews' => 'Отзывы',
            'settings' => 'Настройки',
        ];
        $filters['review_status'] = $request->get('filter_review_status', 'pending');

        return view('adminPanel2.index', compact('page', 'headings', 'orders', 'ordersAll', 'totalOrders', 'totalUsers', 'ordersThisMonth', 'completedOrders', 'inProgress', 'chartBar', 'chartPie', 'chartYear', 'chartMonth', 'chartByDay', 'daysInMonth', 'availableYears', 'users', 'applicationsAll', 'services', 'messagesList', 'supportThreads', 'supportChatsCount', 'reviewsAll', 'reviewsPendingCount', 'filters'));
    }

    /*
    public function userPanelFunc(){
        if (Auth::check()) {
            $PublicFunc = Application::where('userid', Auth::id())->get();
            $reviews = Review::approved()->orderBy('created_at', 'desc')->get();
            $PublicFunc = Application::all();
            $users = User::withCount('orders')->get();
        } else {
            $PublicFunc = collect(); 
        }
        return view("userPanel", compact("PublicFunc","reviews","users"));
    }
    */

    public function aboutusFunc(){
        $PublicFunc = Application::where('userid', Auth::id())->get();
        $reviews = Review::approved()->orderBy('created_at', 'desc')->get();
        $PublicFunc = Application::all();
        $users = User::withCount('orders')->get();
        return view("aboutus", compact("PublicFunc"));
    }

    public function servicesFunc(){
        $PublicFunc = Application::where('userid', Auth::id())->get();
        $reviews = Review::approved()->orderBy('created_at', 'desc')->get();
        $PublicFunc = Application::all();
        $servicess = Services::all();
        $users = User::withCount('orders')->get();
        $servicesList = [
            ['badge' => 'Лучший рейтинг', 'name' => 'Базовый дизайн превью', 'desc' => 'Простой и эффективный дизайн превью для видео, статей или продуктов', 'price' => '2000', 'features' => ['1 концепция', '2 правки', 'Исходник в JPG', 'Срок: 2 дня'], 'select_value' => 'design', 'package' => 'Базовый'],
            ['badge' => 'Популярный выбор', 'name' => 'Превью Про', 'desc' => 'Профессиональный дизайн превью с уникальными элементами и эффектами', 'price' => '3500', 'features' => ['2 концепции на выбор', 'Неограниченные правки', 'Исходник в PSD', 'Срок: 3 дня'], 'select_value' => 'design', 'package' => 'Про'],
            ['badge' => 'Самый выгодный', 'name' => 'Базовая аватарка', 'desc' => 'Стильная аватарка для социальных сетей или игровых профилей', 'price' => '1500', 'features' => ['1 дизайн', '2 правки', 'Исходник в JPG/PNG', 'Срок: 1-2 дня'], 'select_value' => 'ava', 'package' => 'Базовый'],
            ['badge' => '', 'name' => 'Аватарка Про', 'desc' => 'Уникальная аватарка с индивидуальным стилем и эффектами', 'price' => '2500', 'features' => ['2 варианта дизайна', 'Неограниченные правки', 'Исходник в PSD', 'Срок: 2-3 дня'], 'select_value' => 'ava', 'package' => 'Про'],
            ['badge' => '', 'name' => 'Стандартный баннер', 'desc' => 'Баннер для социальных сетей, сайта или рекламы', 'price' => '3000', 'features' => ['1 размер', '2 правки', 'Исходник в JPG/PNG', 'Срок: 2-3 дня'], 'select_value' => 'banner', 'package' => 'Стандарт'],
            ['badge' => '', 'name' => 'Премиум баннер', 'desc' => 'Профессиональный баннер с адаптацией под различные платформы', 'price' => '5000', 'features' => ['3 разных размера', 'Неограниченные правки', 'Исходник в PSD', 'Срок: 3-5 дней'], 'select_value' => 'banner', 'package' => 'Продвинутая'],
            ['badge' => '', 'name' => 'Базовая анимация', 'desc' => 'Простая анимация логотипа или элементов дизайна', 'price' => '4000', 'features' => ['До 5 сек длительности', '2 правки', 'Формат GIF/MP4', 'Срок: 3-4 дня'], 'select_value' => 'animation', 'package' => 'Базовый'],
            ['badge' => '', 'name' => 'Продвинутая анимация', 'desc' => 'Сложная анимация с уникальными переходами и эффектами', 'price' => '7000', 'features' => ['До 15 сек длительности', 'Неограниченные правки', 'Формат по выбору', 'Срок: 5-7 дней'], 'select_value' => 'animation', 'package' => 'Продвинутая'],
            ['badge' => '', 'name' => 'Базовый логотип', 'desc' => 'Логотип для бренда или проекта с основными форматами', 'price' => '4500', 'features' => ['2 концепции', '3 правки', 'JPG, PNG, SVG', 'Срок: 5-7 дней'], 'select_value' => 'logo', 'package' => 'Базовый'],
            ['badge' => '', 'name' => 'Продвинутый логотип', 'desc' => 'Профессиональный логотип с брендбуком и различными форматами', 'price' => '8000', 'features' => ['3+ концепции', 'Неограниченные правки', 'Все форматы файлов', 'Срок: 7-10 дней'], 'select_value' => 'logo', 'package' => 'Продвинутая'],
        ];
        return view("services", compact("PublicFunc", "servicess", "servicesList"));
    }
    public function servicesCreateFunc(){
        $PublicFunc = Application::where('userid', Auth::id())->get();
        $servicess = Services::all();
        return view("servicesBlock.create", compact("PublicFunc",   "servicess"));
    }

    public function whyusFunc(){
        $PublicFunc = Application::where('userid', Auth::id())->get();
        $reviews = Review::approved()->orderBy('created_at', 'desc')->get();
        $PublicFunc = Application::all();
        $users = User::withCount('orders')->get();
        return view("whyus", compact("PublicFunc","reviews","users"));
    }

    public function contactsFunc(){
        $PublicFunc = Application::where('userid', Auth::id())->get();
        $reviews = Review::approved()->orderBy('created_at', 'desc')->get();
        $PublicFunc = Application::all();
        $users = User::withCount('orders')->get();
        return view("contacts", compact("PublicFunc"));
    }

    public function appFunc(){
        $PublicFunc = Application::where('userid', Auth::id())->get();
        $reviews = Review::approved()->orderBy('created_at', 'desc')->get();
        $PublicFunc = Application::all();
        $users = User::withCount('orders')->get();
        return view("app", compact("PublicFunc"));
    }

    public function hellowFunc(Request $request){
        // Страницу designcraft могут открывать только гость и админ; остальных — на /home
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('home');
        }
        // На мобильном устройстве без выбора «десктоп» — показываем мобильную главную
        if (\App\Http\Middleware\DetectMobile::isMobile($request) && !\App\Http\Middleware\DetectMobile::wantsDesktop($request)) {
            return redirect()->route('mobile.home');
        }
        $PublicFunc = Application::where('userid', Auth::id())->get();
        $reviews = Review::approved()->orderBy('created_at', 'desc')->get();
        $news = news::all();
        return view("hellow", ['hideHeader' => true], compact("PublicFunc", "reviews","news"));
    }

    public function websiteNewsFunc(){
        $PublicFunc = Application::where('userid', Auth::id())->get();
        $reviews = Review::approved()->orderBy('created_at', 'desc')->get();
        $users = User::all();
        return view("websiteNews", compact("PublicFunc", "reviews","users"));
    }

    public function index()
    {
        $orders = Application::where('userid', Auth::id())
                           ->orderBy('created_at', 'desc')
                           ->get();
        
        return view('your-view-name', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            \Log::info('Updating status for order:', [
                'id' => $id, 
                'status' => $request->status, 
                'user_id' => Auth::id()
            ]);
            
            $order = Application::find($id);
            
            if (!$order) {
                \Log::error('Order not found:', ['id' => $id]);
                return redirect()->back()->with('error', 'Заказ не найден!');
            }
            
            \Log::info('Order found:', [
                'order_id' => $order->id,
                'order_user_id' => $order->userid,
                'current_user_id' => Auth::id()
            ]);
            
            if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'moderator' && $order->userid != Auth::id()) {
                \Log::error('Access denied:', [
                    'user_id' => Auth::id(), 
                    'order_user_id' => $order->userid,
                    'user_role' => Auth::user()->role
                ]);
                return redirect()->back()->with('error', 'У вас нет прав для изменения этого заказа!');
            }
            
            $order->status = $request->status;
            $order->save();
            
            \Log::info('Status updated successfully', [
                'order_id' => $order->id,
                'new_status' => $order->status
            ]);
            
            return redirect()->back()->with('success', 'Статус заказа успешно обновлен!');
            
        } catch (\Exception $e) {
            \Log::error('Error updating order status:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Ошибка при обновлении статуса: ' . $e->getMessage());
        }
    }

    /** Редактирование заказа: имя, email, телефон, услуга, статус (админ/модератор) */
    public function updateOrder(Request $request, $id)
    {
        $order = Application::findOrFail($id);
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'moderator') {
            return redirect()->back()->with('error', 'Нет доступа');
        }
        $request->validate([
            'name' => 'sometimes|nullable|string|max:255',
            'email' => 'sometimes|nullable|email|max:255',
            'nomer' => 'sometimes|nullable|string|max:100',
            'yslyga' => 'sometimes|nullable|string|max:255',
            'paket' => 'sometimes|nullable|string|max:64',
            'status' => 'sometimes|in:new,processing,completed',
        ]);
        if ($request->has('name')) $order->name = $request->name;
        if ($request->has('email')) $order->email = $request->email;
        if ($request->has('nomer')) $order->nomer = $request->nomer;
        if ($request->has('yslyga')) $order->yslyga = $request->yslyga;
        if ($request->has('paket')) $order->paket = $request->paket;
        if ($request->has('status')) $order->status = $request->status;
        $order->save();
        return redirect()->back()->with('success', 'Заказ обновлён');
    }

    /** Панель модератора: таблица заказов, статусы, отправить превью, открыть чат. Слева — список аккаунтов (пользователей с заказами). */
    public function moderPanel(Request $request)
    {
        $user = Auth::user();
        if (($user->role ?? null) !== 'admin' && ($user->role ?? null) !== 'moderator') {
            return redirect()->route('home')->with('error', 'У вас нет прав доступа к этой странице!');
        }
        $selectedUserId = $request->get('user_id') ? (int) $request->get('user_id') : null;
        $accountUsers = User::whereHas('orders')->orderBy('name')->get(['id', 'name', 'email']);

        $ordersQuery = Application::with('user')->latest();
        if ($selectedUserId) {
            $ordersQuery->where('userid', $selectedUserId);
        }
        if ($status = $request->get('filter_status')) {
            $ordersQuery->where('status', $status);
        }
        if ($q = $request->get('search')) {
            $ordersQuery->where(function ($qb) use ($q) {
                $qb->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('yslyga', 'like', "%{$q}%")
                    ->orWhere('id', 'like', "%{$q}%");
            });
        }
        $orders = $ordersQuery->paginate(20)->withQueryString();
        $selectedUser = $selectedUserId ? $accountUsers->firstWhere('id', $selectedUserId) : null;
        return view('moderPanel', compact('orders', 'accountUsers', 'selectedUserId', 'selectedUser'));
    }

    /** Страница чата по заказу для модератора */
    public function moderOrderChatPage(int $orderId)
    {
        $user = Auth::user();
        if (($user->role ?? null) !== 'admin' && ($user->role ?? null) !== 'moderator') {
            return redirect()->route('home')->with('error', 'Доступ запрещён');
        }
        $order = Application::with('user')->findOrFail($orderId);
        return view('moderOrderChat', compact('order'));
    }

    public function destroy($id)
    {
        try {
            \Log::info('Deleting order:', ['id' => $id, 'user_id' => Auth::id()]);
            
            $order = Application::find($id);
            
            if (!$order) {
                return redirect()->back()->with('error', 'Заказ не найден!');
            }
            
            if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'moderator' && $order->userid != Auth::id()) {
                return redirect()->back()->with('error', 'У вас нет прав для удаления этого заказа!');
            }
            
            $order->delete();
            
            return redirect()->back()->with('success', 'Заказ успешно удален!');
            
        } catch (\Exception $e) {
            \Log::error('Error deleting order:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Ошибка при удалении заказа: ' . $e->getMessage());
        }
    }

    public function userPanel()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $orders = Application::where('userid', $user->id)
                               ->orderBy('created_at', 'desc')
                               ->get();
            $userStats = [
                'total_orders' => $orders->count(),
                'active_orders' => $orders->whereIn('status', ['new', 'processing', 'pending', 'confirmed'])->count(),
                'completed_orders' => $orders->where('status', 'completed')->count(),
                'total_reviews' => Review::where('user_id', $user->id)->count(),
                'user_since' => $user->created_at->diffForHumans()
            ];
            $userReviews = Review::where('user_id', $user->id)
                               ->orderBy('created_at', 'desc')
                               ->take(3)
                               ->get();
            $serviceStats = Application::where('userid', $user->id)
                                     ->select('yslyga', DB::raw('count(*) as count'))
                                     ->groupBy('yslyga')
                                     ->get();

            $PublicFunc = $orders;
            $reviews = Review::approved()->orderBy('created_at', 'desc')->get();
            $users = User::withCount('orders')->get();
            $news = News::all();

            return view("userPanel", compact(
                "user", 
                "orders", 
                "userStats",
                "userReviews", 
                "serviceStats",
                "PublicFunc",
                "reviews", 
                "users",
                "news"
            ));
        } else {
            return redirect()->route('login')->with('error', 'Пожалуйста, войдите в систему');
        }
    }

    /** Экспорт заказов в CSV (Excel) */
    public function exportOrders(Request $request)
    {
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'moderator') {
            return redirect()->route('home')->with('error', 'Нет доступа');
        }
        $query = Application::with('user')->latest();
        if ($request->get('filter_order_status')) $query->where('status', $request->filter_order_status);
        if ($q = $request->get('filter_order_search')) {
            $query->where(function ($qb) use ($q) {
                $qb->where('name', 'like', "%{$q}%")->orWhere('email', 'like', "%{$q}%")->orWhere('yslyga', 'like', "%{$q}%");
            });
        }
        if ($request->get('filter_order_date_from')) $query->whereDate('created_at', '>=', $request->filter_order_date_from);
        if ($request->get('filter_order_date_to')) $query->whereDate('created_at', '<=', $request->filter_order_date_to);
        $rows = $query->get();
        $csv = $this->buildCsv([
            ['ID', 'Имя', 'Email', 'Телефон', 'Услуга', 'Статус', 'Пользователь', 'Дата'],
            ...$rows->map(fn($o) => [$o->id, $o->name ?? '', $o->email ?? '', $o->nomer ?? '', $o->yslyga ?? '', $o->status ?? '', $o->user->name ?? '', $o->created_at?->format('d.m.Y H:i') ?? ''])->all()
        ]);
        return response($csv, 200, ['Content-Type' => 'text/csv; charset=UTF-8', 'Content-Disposition' => 'attachment; filename="orders.csv"']);
    }

    /** Экспорт пользователей в CSV */
    public function exportUsers(Request $request)
    {
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'moderator') {
            return redirect()->route('home')->with('error', 'Нет доступа');
        }
        $query = User::withCount('orders')->orderBy('name');
        if ($request->get('filter_user_role')) $query->where('role', $request->filter_user_role);
        if ($q = $request->get('filter_user_search')) {
            $query->where(function ($qb) use ($q) {
                $qb->where('name', 'like', "%{$q}%")->orWhere('email', 'like', "%{$q}%");
            });
        }
        $rows = $query->get();
        $csv = $this->buildCsv([
            ['ID', 'Имя', 'Email', 'Роль', 'Заказов', 'Дата регистрации'],
            ...$rows->map(fn($u) => [$u->id, $u->name ?? '', $u->email ?? '', $u->role ?? '', $u->orders_count ?? 0, $u->created_at?->format('d.m.Y H:i') ?? ''])->all()
        ]);
        return response($csv, 200, ['Content-Type' => 'text/csv; charset=UTF-8', 'Content-Disposition' => 'attachment; filename="users.csv"']);
    }

    /** Экспорт общей таблицы заявок в CSV */
    public function exportTable(Request $request)
    {
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'moderator') {
            return redirect()->route('home')->with('error', 'Нет доступа');
        }
        $query = Application::with('user')->latest();
        if ($request->get('filter_table_status')) $query->where('status', $request->filter_table_status);
        if ($q = $request->get('filter_table_search')) {
            $query->where(function ($qb) use ($q) {
                $qb->where('name', 'like', "%{$q}%")->orWhere('email', 'like', "%{$q}%")->orWhere('nomer', 'like', "%{$q}%")->orWhere('yslyga', 'like', "%{$q}%");
            });
        }
        $rows = $query->get();
        $csv = $this->buildCsv([
            ['ID', 'Имя', 'Email', 'Телефон', 'Услуга', 'Статус', 'Пользователь', 'Дата'],
            ...$rows->map(fn($o) => [$o->id, $o->name ?? '', $o->email ?? '', $o->nomer ?? '', $o->yslyga ?? '', $o->status ?? '', $o->user->name ?? '', $o->created_at?->format('d.m.Y H:i') ?? ''])->all()
        ]);
        return response($csv, 200, ['Content-Type' => 'text/csv; charset=UTF-8', 'Content-Disposition' => 'attachment; filename="applications.csv"']);
    }

    /** Экспорт услуг в CSV */
    public function exportServices(Request $request)
    {
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'moderator') {
            return redirect()->route('home')->with('error', 'Нет доступа');
        }
        $query = Services::latest();
        if ($q = $request->get('filter_product_search')) {
            $query->where(function ($qb) use ($q) {
                $qb->where('title', 'like', "%{$q}%")->orWhere('titleTwo', 'like', "%{$q}%")->orWhere('category', 'like', "%{$q}%");
            });
        }
        $rows = $query->get();
        $csv = $this->buildCsv([
            ['ID', 'Название', 'Категория', 'Цена', 'Срок', 'Дата'],
            ...$rows->map(fn($s) => [$s->id, $s->title ?? $s->titleTwo ?? '', $s->category ?? '', $s->money ?? '', $s->term ?? '', $s->created_at?->format('d.m.Y') ?? ''])->all()
        ]);
        return response($csv, 200, ['Content-Type' => 'text/csv; charset=UTF-8', 'Content-Disposition' => 'attachment; filename="services.csv"']);
    }

    /** Экспорт сообщений в CSV */
    public function exportMessages(Request $request)
    {
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'moderator') {
            return redirect()->route('home')->with('error', 'Нет доступа');
        }
        $rows = \App\Models\ChatMessage::with('user')->adminChat()->latest()->take(500)->get();
        $csv = $this->buildCsv([
            ['ID', 'Пользователь', 'Сообщение', 'Дата'],
            ...$rows->map(fn($m) => [$m->id, $m->user->name ?? 'Система', str_replace(["\r","\n"], ' ', $m->message ?? ''), $m->created_at?->format('d.m.Y H:i') ?? ''])->all()
        ]);
        return response($csv, 200, ['Content-Type' => 'text/csv; charset=UTF-8', 'Content-Disposition' => 'attachment; filename="messages.csv"']);
    }

    private function buildCsv(array $rows): string
    {
        $bom = "\xEF\xBB\xBF";
        $lines = array_map(function ($row) {
            return implode(';', array_map(function ($cell) {
                return '"' . str_replace('"', '""', (string) $cell) . '"';
            }, $row));
        }, $rows);
        return $bom . implode("\r\n", $lines);
    }
}