<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\SupportThread;
use App\Models\SupportThreadRead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    /** Отдельная страница: чат с пользователями (только админ/модератор) */
    public function supportChatPage()
    {
        if (!in_array(Auth::user()->role, ['admin', 'moderator'])) {
            abort(403, 'Доступ запрещен');
        }
        return view('adminPanel2.support-chat');
    }

    public function adminChat()
    {
        if (!in_array(Auth::user()->role, ['admin', 'moderator'])) {
            abort(403, 'Доступ запрещен');
        }

        $messages = ChatMessage::with('user')
            ->adminChat()
            ->orderBy('created_at', 'asc')
            ->get();

        // Помечаем сообщения как прочитанные
        ChatMessage::adminChat()->where('user_id', '!=', Auth::id())
            ->unread()
            ->update(['read_at' => now()]);

        return view('AdminChat', compact('messages'));
    }

    /** Отправка сообщения в админ-чат (только admin/moderator) */
    public function sendMessage(Request $request)
    {
        if (!in_array(Auth::user()->role, ['admin', 'moderator'])) {
            return response()->json(['error' => 'Доступ запрещен'], 403);
        }

        $request->validate([
            'message' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120' // 5MB max
        ]);

        $imagePath = null;
        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->store('chat_images', 'public');
        }

        if (empty($request->message) && !$request->hasFile('image')) {
            return response()->json(['error' => 'Сообщение или изображение обязательно'], 422);
        }

        $message = ChatMessage::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'image_path' => $imagePath,
            'image_name' => $imageName,
            'chat_type' => 'admin',
        ]);

        // Явно загружаем пользователя с нужными полями
        $message->load(['user' => function($query) {
            $query->select('id', 'name', 'avatar', 'role');
        }]);

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    /** Сообщения админ-чата (только admin/moderator) */
    public function getMessages()
    {
        if (!in_array(Auth::user()->role, ['admin', 'moderator'])) {
            return response()->json(['error' => 'Доступ запрещен'], 403);
        }

        $messages = ChatMessage::with(['user' => function($query) {
            $query->select('id', 'name', 'avatar', 'role');
        }])
        ->adminChat()
        ->orderBy('created_at', 'asc')
        ->get();

        return response()->json($messages);
    }

    /** Сообщения чата поддержки: для пользователя — свой тред, для админа — по thread_id */
    public function getSupportMessages(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Доступ запрещен'], 403);
        }

        $isAdmin = in_array(Auth::user()->role, ['admin', 'moderator']);
        $threadId = $request->integer('thread_id', 0);

        $query = ChatMessage::with(['user' => function ($q) {
            $q->select('id', 'name', 'avatar', 'role');
        }])->supportChat()->orderBy('created_at', 'asc');

        $uid = Auth::id();
        if ($isAdmin && $threadId > 0) {
            $query->where('thread_id', $threadId);
        } else {
            // Свой тред: для пользователя и для админа при открытии чата из хедера (без thread_id)
            $query->where(function ($q) use ($uid) {
                $q->where('thread_id', $uid)
                  ->orWhere(function ($q2) use ($uid) {
                      $q2->whereNull('thread_id')->where('user_id', $uid);
                  });
            });
        }

        $messages = $query->get();
        $storageBase = $request->getSchemeAndHttpHost() . rtrim($request->getBasePath(), '/') . '/storage';
        $user = Auth::user();
        $isAdmin = $user && in_array($user->role, ['admin', 'moderator']);
        $list = $messages->map(function ($m) use ($storageBase, $user, $isAdmin) {
            $arr = $m->toArray();
            $arr['image_url'] = $m->image_path ? $storageBase . '/' . str_replace('\\', '/', ltrim($m->image_path, '/')) : null;
            $arr['file_url'] = $m->file_path ? $storageBase . '/' . str_replace('\\', '/', ltrim($m->file_path, '/')) : null;
            $canDelete = $isAdmin || ($user && $m->user_id === $user->id && $m->created_at->diffInDays(now()) <= 3);
            $canEdit = !$m->is_system && ($isAdmin || ($user && $m->user_id === $user->id && $m->created_at->diffInDays(now()) <= 3));
            $arr['can_delete'] = $canDelete;
            $arr['can_edit'] = $canEdit;
            return $arr;
        });
        return response()->json($list);
    }

    /** Список тредов поддержки для админа (сортировка по времени, непрочитанные, закреплённые) */
    public function getSupportThreads()
    {
        if (!in_array(Auth::user()->role, ['admin', 'moderator'])) {
            return response()->json(['error' => 'Доступ запрещен'], 403);
        }

        $adminId = Auth::id();
        $threadIds = ChatMessage::supportChat()->whereNotNull('thread_id')->distinct()->pluck('thread_id');
        $users = User::whereIn('id', $threadIds)->select('id', 'name', 'email', 'avatar', 'role', 'last_seen_at')->get()->keyBy('id');
        $threads = SupportThread::whereIn('user_id', $threadIds)->get()->keyBy('user_id');
        $reads = SupportThreadRead::where('admin_id', $adminId)->whereIn('thread_id', $threadIds)->get()->keyBy('thread_id');
        $now = now();
        $onlineThreshold = $now->copy()->subMinutes(3);

        $list = [];
        foreach ($threadIds as $tid) {
            $u = $users->get($tid);
            if (!$u) continue;
            $last = ChatMessage::supportChat()->where('thread_id', $u->id)->latest()->first();
            $thread = $threads->get($u->id);
            $read = $reads->get($u->id);
            $readAt = $read ? $read->read_at : null;
            $pinned = $read ? $read->pinned : false;
            // Непрочитанные = сообщения от клиента (user_id = thread_id) после read_at
            $unreadCount = ChatMessage::supportChat()
                ->where('thread_id', $u->id)
                ->where('user_id', $u->id)
                ->when($readAt, fn ($q) => $q->where('created_at', '>', $readAt))
                ->count();
            $lastSeen = $u->last_seen_at ? $u->last_seen_at->toIso8601String() : null;
            $isOnline = $u->last_seen_at && $u->last_seen_at->gte($onlineThreshold);
            $list[] = [
                'id' => $u->id,
                'name' => $u->name,
                'email' => $u->email,
                'avatar' => $u->avatar,
                'role' => $u->role,
                'last_seen_at' => $lastSeen,
                'is_online' => $isOnline,
                'last_message' => $last ? [
                    'id' => $last->id,
                    'message' => $last->message,
                    'created_at' => $last->created_at->toIso8601String(),
                ] : null,
                'needs_human' => $thread ? $thread->needs_human : false,
                'unread_count' => $unreadCount,
                'pinned' => $pinned,
            ];
        }

        // Сортировка: сначала закреплённые, потом по времени последнего сообщения (сверху кто только что написал)
        usort($list, function ($a, $b) {
            if ($a['pinned'] !== $b['pinned']) return $a['pinned'] ? -1 : 1;
            $at = $a['last_message']['created_at'] ?? null;
            $bt = $b['last_message']['created_at'] ?? null;
            if (!$at && !$bt) return 0;
            if (!$at) return 1;
            if (!$bt) return -1;
            return strcmp($bt, $at);
        });

        $unreadChatsCount = collect($list)->where('unread_count', '>', 0)->count();
        return response()->json(['threads' => $list, 'unread_chats_count' => $unreadChatsCount]);
    }

    /** Поиск пользователей для чата (админ/модератор): по email, имени */
    public function searchUsersForChat(Request $request)
    {
        if (!in_array(Auth::user()->role, ['admin', 'moderator'])) {
            return response()->json(['error' => 'Доступ запрещен'], 403);
        }
        $q = $request->string('q')->trim();
        if ($q->length() < 2) {
            return response()->json([]);
        }
        $users = User::where('role', 'user')
            ->where(function ($qb) use ($q) {
                $qb->where('name', 'like', '%' . $q . '%')
                    ->orWhere('email', 'like', '%' . $q . '%');
            })
            ->select('id', 'name', 'email', 'avatar', 'last_seen_at')
            ->orderBy('name')
            ->limit(20)
            ->get();
        $onlineThreshold = now()->subMinutes(3);
        $list = $users->map(function ($u) use ($onlineThreshold) {
            return [
                'id' => $u->id,
                'name' => $u->name,
                'email' => $u->email,
                'avatar' => $u->avatar,
                'last_seen_at' => $u->last_seen_at ? $u->last_seen_at->toIso8601String() : null,
                'is_online' => $u->last_seen_at && $u->last_seen_at->gte($onlineThreshold),
            ];
        });
        return response()->json($list);
    }

    /** Отправка в чат поддержки (любой авторизованный). Поддержка images[] и files[] (до 8 шт каждого; при обоих типах — по 4). */
    public function sendSupportMessage(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Доступ запрещен'], 403);
        }

        $images = $request->hasFile('images') ? $request->file('images') : [];
        $files = $request->hasFile('files') ? $request->file('files') : [];
        if (!is_array($images)) {
            $images = $request->hasFile('image') ? [$request->file('image')] : [];
        }
        if (!is_array($files)) {
            $files = $request->hasFile('file') ? [$request->file('file')] : [];
        }

        $maxImages = count($files) > 0 ? 4 : 8;
        $maxFiles = count($images) > 0 ? 4 : 8;
        $rules = [
            'message' => 'nullable|string|max:1000',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'files' => 'nullable|array',
            'files.*' => 'file|max:20480',
        ];
        $request->validate($rules);
        if (count($images) > $maxImages || count($files) > $maxFiles) {
            return response()->json(['error' => 'Максимум фото: ' . $maxImages . ', файлов: ' . $maxFiles], 422);
        }

        $text = trim((string) $request->message ?? '');
        if ($text === '' && count($images) === 0 && count($files) === 0) {
            return response()->json(['error' => 'Сообщение, фото или файл обязательно'], 422);
        }

        $userId = Auth::id();
        SupportThread::updateOrCreate(
            ['user_id' => $userId],
            ['last_message_at' => now()]
        );

        $needsHuman = $this->detectNeedsHuman($text);
        if ($needsHuman) {
            SupportThread::where('user_id', $userId)->update(['needs_human' => true]);
        }

        $created = [];

        if ($text !== '') {
            $message = ChatMessage::create([
                'user_id' => $userId,
                'message' => $text,
                'image_path' => null,
                'image_name' => null,
                'file_path' => null,
                'file_name' => null,
                'chat_type' => 'support',
                'thread_id' => $userId,
            ]);
            $message->load(['user' => function ($q) {
                $q->select('id', 'name', 'avatar', 'role');
            }]);
            $payload = $message->toArray();
            $payload['image_url'] = null;
            $payload['file_url'] = null;
            $payload['can_delete'] = true;
            $payload['can_edit'] = true;
            $created[] = $payload;
        }

        foreach ($images as $image) {
            $imageName = time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
            $imagePath = $image->store('chat_images', 'public');
            $message = ChatMessage::create([
                'user_id' => $userId,
                'message' => '',
                'image_path' => $imagePath,
                'image_name' => $imageName,
                'file_path' => null,
                'file_name' => null,
                'chat_type' => 'support',
                'thread_id' => $userId,
            ]);
            $message->load(['user' => function ($q) {
                $q->select('id', 'name', 'avatar', 'role');
            }]);
            $payload = $message->toArray();
            $payload['image_url'] = $this->storageUrlForRequest($request, $message->image_path);
            $payload['file_url'] = null;
            $payload['can_delete'] = true;
            $payload['can_edit'] = false;
            $created[] = $payload;
        }

        foreach ($files as $file) {
            $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
            $filePath = $file->store('chat_files', 'public');
            $message = ChatMessage::create([
                'user_id' => $userId,
                'message' => '',
                'image_path' => null,
                'image_name' => null,
                'file_path' => $filePath,
                'file_name' => $fileName,
                'chat_type' => 'support',
                'thread_id' => $userId,
            ]);
            $message->load(['user' => function ($q) {
                $q->select('id', 'name', 'avatar', 'role');
            }]);
            $payload = $message->toArray();
            $payload['image_url'] = null;
            $payload['file_url'] = $this->storageUrlForRequest($request, $message->file_path);
            $payload['can_delete'] = true;
            $payload['can_edit'] = false;
            $created[] = $payload;
        }

        $thread = SupportThread::where('user_id', $userId)->first();
        $botDisabled = $thread && $thread->needs_human;
        $botReply = !$botDisabled ? $this->getBotReply($text, $userId) : null;
        if ($botReply !== null) {
            $botUser = $this->getBotUser();
            $messageBody = $botReply['text'];
            if (!empty($botReply['buttons'])) {
                $messageBody .= self::BOT_BTN_DELIMITER . json_encode($botReply['buttons'], JSON_UNESCAPED_UNICODE);
            }
            ChatMessage::create([
                'user_id' => $botUser->id,
                'message' => $messageBody,
                'chat_type' => 'support',
                'thread_id' => $userId,
                'is_system' => true,
            ]);
        }

        return response()->json(['success' => true, 'messages' => $created]);
    }

    /** Ответ админа в тред поддержки (пользователю) */
    public function sendSupportReply(Request $request)
    {
        if (!in_array(Auth::user()->role, ['admin', 'moderator'])) {
            return response()->json(['error' => 'Доступ запрещен'], 403);
        }

        $request->validate([
            'thread_id' => 'required|integer|exists:users,id',
            'message' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'file' => 'nullable|file|max:20480',
        ]);

        $imagePath = null;
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->store('chat_images', 'public');
        }
        $filePath = null;
        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->store('chat_files', 'public');
        }
        if (empty(trim((string) $request->message)) && !$request->hasFile('image') && !$request->hasFile('file')) {
            return response()->json(['error' => 'Сообщение, фото или файл обязательно'], 422);
        }

        $message = ChatMessage::create([
            'user_id' => Auth::id(),
            'message' => trim((string) ($request->message ?? '')),
            'image_path' => $imagePath,
            'image_name' => $imageName,
            'file_path' => $filePath,
            'file_name' => $fileName,
            'chat_type' => 'support',
            'thread_id' => (int) $request->thread_id,
        ]);
        $message->load(['user' => function ($q) {
            $q->select('id', 'name', 'avatar', 'role');
        }]);
        $msgArr = $message->toArray();
        $msgArr['image_url'] = $this->storageUrlForRequest($request, $message->image_path);
        $msgArr['file_url'] = $this->storageUrlForRequest($request, $message->file_path);
        $msgArr['can_delete'] = true;
        $msgArr['can_edit'] = !$message->is_system;

        SupportThread::updateOrCreate(
            ['user_id' => (int) $request->thread_id],
            ['last_message_at' => now()]
        );

        return response()->json(['success' => true, 'message' => $msgArr]);
    }

    /** Включить бота снова для треда (админ/модератор) */
    public function enableBot(Request $request)
    {
        if (!in_array(Auth::user()->role, ['admin', 'moderator'])) {
            return response()->json(['error' => 'Доступ запрещен'], 403);
        }
        $request->validate(['thread_id' => 'required|integer|exists:users,id']);
        SupportThread::where('user_id', (int) $request->thread_id)->update(['needs_human' => false]);
        return response()->json(['success' => true]);
    }

    /** Выключить бота для треда (админ/модератор) */
    public function disableBot(Request $request)
    {
        if (!in_array(Auth::user()->role, ['admin', 'moderator'])) {
            return response()->json(['error' => 'Доступ запрещен'], 403);
        }
        $request->validate(['thread_id' => 'required|integer|exists:users,id']);
        SupportThread::where('user_id', (int) $request->thread_id)->update(['needs_human' => true]);
        return response()->json(['success' => true]);
    }

    /** Отметить тред как прочитанный (админ открыл чат) */
    public function markSupportThreadRead(Request $request)
    {
        if (!in_array(Auth::user()->role, ['admin', 'moderator'])) {
            return response()->json(['error' => 'Доступ запрещен'], 403);
        }
        $request->validate(['thread_id' => 'required|integer|exists:users,id']);
        $threadId = (int) $request->thread_id;
        SupportThreadRead::updateOrCreate(
            ['admin_id' => Auth::id(), 'thread_id' => $threadId],
            ['read_at' => now()]
        );
        return response()->json(['success' => true]);
    }

    /** Закрепить / открепить тред */
    public function pinSupportThread(Request $request)
    {
        if (!in_array(Auth::user()->role, ['admin', 'moderator'])) {
            return response()->json(['error' => 'Доступ запрещен'], 403);
        }
        $request->validate([
            'thread_id' => 'required|integer|exists:users,id',
            'pinned' => 'required|boolean',
        ]);
        $threadId = (int) $request->thread_id;
        SupportThreadRead::updateOrCreate(
            ['admin_id' => Auth::id(), 'thread_id' => $threadId],
            ['pinned' => $request->boolean('pinned')]
        );
        return response()->json(['success' => true]);
    }

    /** Удалить чат (все сообщения треда поддержки) */
    public function deleteSupportThread(Request $request)
    {
        if (!in_array(Auth::user()->role, ['admin', 'moderator'])) {
            return response()->json(['error' => 'Доступ запрещен'], 403);
        }
        $request->validate(['thread_id' => 'required|integer|exists:users,id']);
        $threadId = (int) $request->thread_id;
        ChatMessage::supportChat()->where('thread_id', $threadId)->delete();
        SupportThread::where('user_id', $threadId)->delete();
        SupportThreadRead::where('thread_id', $threadId)->delete();
        return response()->json(['success' => true]);
    }

    private function storageUrlForRequest(Request $request, ?string $path): ?string
    {
        if (!$path) {
            return null;
        }
        $path = ltrim(str_replace('\\', '/', $path), '/');
        $base = $request->getSchemeAndHttpHost() . rtrim($request->getBasePath(), '/') . '/storage';
        return $base . '/' . $path;
    }

    private function detectNeedsHuman(string $text): bool
    {
        $lower = mb_strtolower($text);
        $keywords = ['оператор', 'человек', 'менеджер', 'свяжитесь', 'связаться', 'позвоните', 'позвонить', 'живой', 'реальный', 'консультант', 'подключите оператора'];
        foreach ($keywords as $kw) {
            if (mb_strpos($lower, $kw) !== false) {
                return true;
            }
        }
        return false;
    }

    private const BOT_BTN_DELIMITER = "\n__BTN__\n";

    /** Кнопки по умолчанию под сообщением бота */
    private function defaultBotButtons(): array
    {
        return [
            ['label' => 'Сроки превью', 'text' => 'Сколько времени делается превью?'],
            ['label' => 'Сроки аватар', 'text' => 'Сколько делается аватар?'],
            ['label' => 'Оплата', 'text' => 'Как оплатить?'],
            ['label' => 'Связать с оператором', 'text' => 'Свяжите с оператором'],
        ];
    }

    /** Ответ бота с текстом и кнопками под сообщением. Возвращает null или ['text' => string, 'buttons' => array]. */
    private function getBotReply(string $text, ?int $userId = null): ?array
    {
        $lower = mb_strtolower(trim($text));
        if ($lower === '') {
            return null;
        }
        $defaultButtons = $this->defaultBotButtons();
        // Более длинные фразы проверяем первыми. Для каждого ответа — свой набор кнопок.
        $replies = [
            'сколько времени делается превью' => [
                'text' => 'Превью делаем в течение 2–4 часов в зависимости от сложности. Оформите заказ, и мы приступим.',
                'buttons' => [
                    ['label' => 'Сроки аватар', 'text' => 'Сколько делается аватар?'],
                    ['label' => 'Оплата', 'text' => 'Как оплатить?'],
                    ['label' => 'Связать с оператором', 'text' => 'Свяжите с оператором'],
                ],
            ],
            'сколько аватар' => [
                'text' => 'Аватарки выполняем в течение 1–2 часов. Можете оформить заказ на сайте.',
                'buttons' => [
                    ['label' => 'Сроки превью', 'text' => 'Сколько времени делается превью?'],
                    ['label' => 'Оплата', 'text' => 'Как оплатить?'],
                    ['label' => 'Связать с оператором', 'text' => 'Свяжите с оператором'],
                ],
            ],
            'сколько делается превью' => [
                'text' => 'Превью — 2–4 часа. Оформите заказ на сайте.',
                'buttons' => [
                    ['label' => 'Сроки аватар', 'text' => 'Сколько делается аватар?'],
                    ['label' => 'Оплата', 'text' => 'Как оплатить?'],
                    ['label' => 'Связать с оператором', 'text' => 'Свяжите с оператором'],
                ],
            ],
            'сколько делается аватар' => [
                'text' => 'Аватарки — 1–2 часа. Оформите заказ на сайте.',
                'buttons' => [
                    ['label' => 'Сроки превью', 'text' => 'Сколько времени делается превью?'],
                    ['label' => 'Оплата', 'text' => 'Как оплатить?'],
                    ['label' => 'Связать с оператором', 'text' => 'Свяжите с оператором'],
                ],
            ],
            'срок превью' => [
                'text' => 'Превью делаем за 2–4 часа. Оформите заказ на сайте.',
                'buttons' => [
                    ['label' => 'Сроки аватар', 'text' => 'Сколько делается аватар?'],
                    ['label' => 'Оплата', 'text' => 'Как оплатить?'],
                    ['label' => 'Связать с оператором', 'text' => 'Свяжите с оператором'],
                ],
            ],
            'срок аватар' => [
                'text' => 'Аватарки — 1–2 часа. Оформите заказ на сайте.',
                'buttons' => [
                    ['label' => 'Сроки превью', 'text' => 'Сколько времени делается превью?'],
                    ['label' => 'Оплата', 'text' => 'Как оплатить?'],
                    ['label' => 'Связать с оператором', 'text' => 'Свяжите с оператором'],
                ],
            ],
            'оплата' => [
                'text' => 'Оплата возможна банковской картой на сайте в разделе заказа. После оформления заказа мы пришлём ссылку на оплату.',
                'buttons' => [
                    ['label' => 'Сроки превью', 'text' => 'Сколько времени делается превью?'],
                    ['label' => 'Сроки аватар', 'text' => 'Сколько делается аватар?'],
                    ['label' => 'Связать с оператором', 'text' => 'Свяжите с оператором'],
                ],
            ],
            'оплатить' => [
                'text' => 'Оплата возможна банковской картой на сайте в разделе заказа. После оформления заказа мы пришлём ссылку на оплату.',
                'buttons' => [
                    ['label' => 'Сроки превью', 'text' => 'Сколько времени делается превью?'],
                    ['label' => 'Сроки аватар', 'text' => 'Сколько делается аватар?'],
                    ['label' => 'Связать с оператором', 'text' => 'Свяжите с оператором'],
                ],
            ],
            'карт' => [
                'text' => 'Оплата по карте доступна на нашем сайте при оформлении заказа. Вы получите безопасную ссылку на оплату.',
                'buttons' => $defaultButtons,
            ],
            'баннер' => [
                'text' => 'Баннер делаем в течение 2 часов после подтверждения заказа и оплаты.',
                'buttons' => $defaultButtons,
            ],
            'превью' => [
                'text' => 'Превью делаем в течение 2–4 часов в зависимости от сложности. Оформите заказ, и мы приступим.',
                'buttons' => [
                    ['label' => 'Сроки аватар', 'text' => 'Сколько делается аватар?'],
                    ['label' => 'Оплата', 'text' => 'Как оплатить?'],
                    ['label' => 'Связать с оператором', 'text' => 'Свяжите с оператором'],
                ],
            ],
            'аватар' => [
                'text' => 'Аватарки выполняем в течение 1–2 часов. Можете оформить заказ на сайте.',
                'buttons' => [
                    ['label' => 'Сроки превью', 'text' => 'Сколько времени делается превью?'],
                    ['label' => 'Оплата', 'text' => 'Как оплатить?'],
                    ['label' => 'Связать с оператором', 'text' => 'Свяжите с оператором'],
                ],
            ],
            'аватарк' => [
                'text' => 'Аватарки выполняем в течение 1–2 часов. Можете оформить заказ на сайте.',
                'buttons' => [
                    ['label' => 'Сроки превью', 'text' => 'Сколько времени делается превью?'],
                    ['label' => 'Оплата', 'text' => 'Как оплатить?'],
                    ['label' => 'Связать с оператором', 'text' => 'Свяжите с оператором'],
                ],
            ],
            'логотип' => [
                'text' => 'Срок изготовления логотипа — от 1 до 3 дней. Точный срок уточним после обсуждения ТЗ.',
                'buttons' => [
                    ['label' => 'Сроки превью', 'text' => 'Сколько времени делается превью?'],
                    ['label' => 'Сроки аватар', 'text' => 'Сколько делается аватар?'],
                    ['label' => 'Оплата', 'text' => 'Как оплатить?'],
                    ['label' => 'Связать с оператором', 'text' => 'Свяжите с оператором'],
                ],
            ],
            'анимация' => [
                'text' => 'Анимации выполняем в срок от 1 до 5 дней в зависимости от сложности.',
                'buttons' => $defaultButtons,
            ],
            'срок' => [
                'text' => 'Срок выполнения зависит от типа заказа: баннеры и аватарки — 1–2 часа, превью — 2–4 часа, логотипы и анимации — от 1 дня.',
                'buttons' => $defaultButtons,
            ],
            'время' => [
                'text' => 'Баннеры и аватарки — в течение 1–2 часов. Превью — 2–4 часа. Остальное — уточним после заказа.',
                'buttons' => $defaultButtons,
            ],
            'сколько времени' => [
                'text' => 'Баннер и аватарка — 1–2 часа. Превью — 2–4 часа. Логотип и анимация — от 1 дня. Нужна консультация? Напишите «свяжите с оператором».',
                'buttons' => $defaultButtons,
            ],
            'сколько делается' => [
                'text' => 'Баннер и аватарка — 1–2 часа. Превью — 2–4 часа. Логотип и анимация — от 1 дня.',
                'buttons' => $defaultButtons,
            ],
            'делается' => [
                'text' => 'Сроки: баннер/аватарка — 1–2 ч, превью — 2–4 ч, логотип и анимация — от 1 дня. Хотите поговорить с менеджером? Напишите «свяжите с оператором».',
                'buttons' => $defaultButtons,
            ],
            'привет' => [
                'text' => 'Здравствуйте! Чем могу помочь? Можете спросить про сроки, оплату или нажать кнопку ниже.',
                'buttons' => [
                    ['label' => 'Сроки превью', 'text' => 'Сколько времени делается превью?'],
                    ['label' => 'Сроки аватар', 'text' => 'Сколько делается аватар?'],
                    ['label' => 'Оплата', 'text' => 'Как оплатить?'],
                    ['label' => 'Связать с оператором', 'text' => 'Свяжите с оператором'],
                ],
            ],
            'здравствуйте' => [
                'text' => 'Здравствуйте! Задайте вопрос или нажмите кнопку ниже — поговорим с менеджером.',
                'buttons' => $defaultButtons,
            ],
            'здравствуй' => [
                'text' => 'Здравствуйте! Чем могу помочь?',
                'buttons' => $defaultButtons,
            ],
            'помощь' => [
                'text' => 'Могу подсказать по срокам и оплате. Или нажмите кнопку для связи с менеджером.',
                'buttons' => $defaultButtons,
            ],
        ];
        foreach ($replies as $keyword => $data) {
            if (mb_strpos($lower, $keyword) !== false) {
                return $data;
            }
        }
        return [
            'text' => 'По этому вопросу лучше поговорить с менеджером. Нажмите кнопку ниже — мы быстро ответим.',
            'buttons' => [
                ['label' => 'Связать с оператором', 'text' => 'Свяжите с оператором'],
                ['label' => 'Сроки превью', 'text' => 'Сколько времени делается превью?'],
                ['label' => 'Сроки аватар', 'text' => 'Сколько делается аватар?'],
                ['label' => 'Оплата', 'text' => 'Как оплатить?'],
            ],
        ];
    }

    private function getBotUser(): User
    {
        $bot = User::where('email', 'support-bot@designcraft.local')->first();
        if ($bot) {
            return $bot;
        }
        return User::create([
            'name' => 'Поддержка (бот)',
            'email' => 'support-bot@designcraft.local',
            'password' => bcrypt(str()->random(32)),
            'role' => 'user',
        ]);
    }

    public function getUnreadCount()
    {
        if (!in_array(Auth::user()->role, ['admin', 'moderator'])) {
            return response()->json(['error' => 'Доступ запрещен'], 403);
        }

        $count = ChatMessage::adminChat()->where('user_id', '!=', Auth::id())
            ->unread()
            ->count();

        return response()->json(['count' => $count]);
    }
    public function deleteMessage(Request $request)
        {
            if (!in_array(Auth::user()->role, ['admin', 'moderator'])) {
                return response()->json(['error' => 'Доступ запрещен'], 403);
            }

            try {
                $request->validate([
                    'message_id' => 'required|integer|exists:admin_chat_messages,id'
                ]);

                $message = ChatMessage::findOrFail($request->message_id);
                
                if (!$message->canDelete(Auth::user())) {
                    return response()->json([
                        'success' => false,
                        'message' => 'У вас нет прав для удаления этого сообщения'
                    ], 403);
                }

                if ($message->image_path) {
                    if (Storage::disk('public')->exists($message->image_path)) {
                        Storage::disk('public')->delete($message->image_path);
                    }
                }
                
                $message->delete();
                
                return response()->json([
                    'success' => true,
                    'message' => 'Сообщение удалено',
                ]);

            } catch (\Exception $e) {
                \Log::error('Error deleting message: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Ошибка при удалении сообщения: ' . $e->getMessage()
                ], 500);
            }
        }

    /** Удалить сообщение в чате поддержки: админ — любое, пользователь — только своё и не старше 3 дней */
    public function deleteSupportMessage(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Доступ запрещен'], 403);
        }
        $request->validate(['message_id' => 'required|integer|exists:admin_chat_messages,id']);
        $message = ChatMessage::findOrFail($request->message_id);
        if ($message->chat_type !== 'support') {
            return response()->json(['error' => 'Неверный тип сообщения'], 400);
        }
        $user = Auth::user();
        $isAdmin = in_array($user->role, ['admin', 'moderator']);
        if (!$isAdmin) {
            if ($message->user_id !== $user->id) {
                return response()->json(['error' => 'Можно удалять только свои сообщения'], 403);
            }
            if ($message->created_at->diffInDays(now()) > 3) {
                return response()->json(['error' => 'Удаление возможно только в течение 3 дней'], 403);
            }
        }
        if ($message->image_path) {
            Storage::disk('public')->delete($message->image_path);
        }
        if ($message->file_path) {
            Storage::disk('public')->delete($message->file_path);
        }
        $message->delete();
        return response()->json(['success' => true]);
    }

    /** Редактировать сообщение в чате поддержки: админ — любое, пользователь — только своё и не старше 3 дней */
    public function updateSupportMessage(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Доступ запрещен'], 403);
        }
        $request->validate([
            'message_id' => 'required|integer|exists:admin_chat_messages,id',
            'message' => 'required|string|max:1000',
        ]);
        $message = ChatMessage::findOrFail($request->message_id);
        if ($message->chat_type !== 'support') {
            return response()->json(['error' => 'Неверный тип сообщения'], 400);
        }
        $user = Auth::user();
        $isAdmin = in_array($user->role, ['admin', 'moderator']);
        if (!$isAdmin) {
            if ($message->user_id !== $user->id) {
                return response()->json(['error' => 'Можно редактировать только свои сообщения'], 403);
            }
            if ($message->created_at->diffInDays(now()) > 3) {
                return response()->json(['error' => 'Редактирование возможно только в течение 3 дней'], 403);
            }
        }
        $message->message = trim($request->message);
        $message->save();
        $msgArr = $message->toArray();
        $msgArr['image_url'] = $this->storageUrlForRequest($request, $message->image_path);
        $msgArr['file_url'] = $this->storageUrlForRequest($request, $message->file_path);
        return response()->json(['success' => true, 'message' => $msgArr]);
    }
}