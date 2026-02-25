<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ChatMessage;
use App\Models\SupportThread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderChatController extends Controller
{
    /** Отправить в общий чат поддержки сообщение о проблеме с заказом (от имени пользователя) */
    public function reportOrderProblem(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Необходимо войти'], 403);
        }
        $request->validate(['order_id' => 'required|integer|exists:applications,id']);
        $order = Application::with('user')->findOrFail($request->order_id);
        if ($order->userid != Auth::id()) {
            return response()->json(['error' => 'Нет доступа к заказу'], 403);
        }
        $text = "Проблема с заказом #{$order->id}\nУслуга: {$order->yslyga}\nПакет: " . ($order->paket ?? '—') . "\nОписание: " . \Str::limit($order->info, 200) . "\nКлиент: {$order->name}, {$order->email}, {$order->nomer}";
        SupportThread::updateOrCreate(
            ['user_id' => Auth::id()],
            ['last_message_at' => now(), 'needs_human' => true]
        );
        ChatMessage::create([
            'user_id' => Auth::id(),
            'message' => $text,
            'chat_type' => 'support',
            'thread_id' => Auth::id(),
            'is_system' => false,
        ]);
        return response()->json(['success' => true]);
    }

    /** Сообщения чата по заказу (для пользователя — свой заказ; для админа/модера — любой) */
    public function getOrderMessages(Request $request, int $orderId)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Доступ запрещён'], 403);
        }
        $order = Application::findOrFail($orderId);
        $isModer = in_array(Auth::user()->role ?? null, ['admin', 'moderator']);
        if (!$isModer && $order->userid != Auth::id()) {
            return response()->json(['error' => 'Нет доступа'], 403);
        }
        $messages = ChatMessage::with(['user' => fn($q) => $q->select('id', 'name', 'avatar', 'role')])
            ->orderChat()
            ->where('thread_id', $orderId)
            ->orderBy('created_at', 'asc')
            ->get();
        if ($isModer) {
            ChatMessage::orderChat()
                ->where('thread_id', $orderId)
                ->where('user_id', $order->userid)
                ->whereNull('read_at')
                ->update(['read_at' => now()]);
        }
        $url = fn($path) => $path ? asset('storage/' . $path) : null;
        $list = $messages->map(function ($m) use ($url) {
            $arr = $m->toArray();
            $arr['image_url'] = $url($m->image_path);
            $arr['file_url'] = $url($m->file_path);
            return $arr;
        });
        $chatClosed = $order->chat_closed_at || ($order->status ?? '') === 'completed';
        return response()->json([
            'messages' => $list,
            'order' => ['id' => $order->id, 'yslyga' => $order->yslyga, 'chat_closed_at' => $chatClosed ? ($order->chat_closed_at ? $order->chat_closed_at->toIso8601String() : now()->toIso8601String()) : null],
        ]);
    }

    /** Отправить сообщение в чат заказа */
    public function sendOrderMessage(Request $request, int $orderId)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Доступ запрещён'], 403);
        }
        $order = Application::findOrFail($orderId);
        $isModer = in_array(Auth::user()->role ?? null, ['admin', 'moderator']);
        if (!$isModer && $order->userid != Auth::id()) {
            return response()->json(['error' => 'Нет доступа'], 403);
        }
        $chatClosed = $order->chat_closed_at || ($order->status ?? '') === 'completed';
        if ($chatClosed && !$isModer) {
            return response()->json(['error' => 'Чат по заказу закрыт'], 422);
        }
        $request->validate([
            'message' => 'nullable|string|max:2000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'file' => 'nullable|file|max:20480',
        ]);
        $text = trim((string) ($request->message ?? ''));
        $imagePath = null;
        $imageName = null;
        if ($request->hasFile('image')) {
            $f = $request->file('image');
            $imageName = $f->getClientOriginalName();
            $imagePath = $f->store('chat_images', 'public');
        }
        $filePath = null;
        $fileName = null;
        if ($request->hasFile('file')) {
            $f = $request->file('file');
            $fileName = $f->getClientOriginalName();
            $filePath = $f->store('chat_files', 'public');
        }
        if ($text === '' && !$imagePath && !$filePath) {
            return response()->json(['error' => 'Нужен текст, фото или файл'], 422);
        }
        $msg = ChatMessage::create([
            'user_id' => Auth::id(),
            'message' => $text,
            'image_path' => $imagePath,
            'image_name' => $imageName,
            'file_path' => $filePath,
            'file_name' => $fileName,
            'chat_type' => 'order',
            'thread_id' => $orderId,
        ]);
        $msg->load(['user' => fn($q) => $q->select('id', 'name', 'avatar', 'role')]);
        $arr = $msg->toArray();
        $arr['image_url'] = $imagePath ? asset('storage/' . $imagePath) : null;
        $arr['file_url'] = $filePath ? asset('storage/' . $filePath) : null;
        return response()->json(['success' => true, 'message' => $arr]);
    }

    /** Закрыть чат заказа (только админ/модератор) */
    public function closeOrderChat(int $orderId)
    {
        if (!in_array(Auth::user()->role ?? null, ['admin', 'moderator'])) {
            return response()->json(['error' => 'Доступ запрещён'], 403);
        }
        $order = Application::findOrFail($orderId);
        $order->chat_closed_at = now();
        $order->save();
        return response()->json(['success' => true]);
    }

    /** Открыть обратно чат заказа (только админ/модератор) */
    public function reopenOrderChat(int $orderId)
    {
        if (!in_array(Auth::user()->role ?? null, ['admin', 'moderator'])) {
            return response()->json(['error' => 'Доступ запрещён'], 403);
        }
        $order = Application::findOrFail($orderId);
        $order->chat_closed_at = null;
        $order->save();
        return response()->json(['success' => true]);
    }

    /** Загрузить превью заказа (отправить пользователю) — только админ/модератор */
    public function uploadOrderPreview(Request $request, int $orderId)
    {
        if (!in_array(Auth::user()->role ?? null, ['admin', 'moderator'])) {
            return response()->json(['error' => 'Доступ запрещён'], 403);
        }
        $request->validate(['preview' => 'required|file|mimes:jpeg,png,jpg,gif,webp,pdf|max:20480']);
        $order = Application::findOrFail($orderId);
        if ($order->preview_path && Storage::disk('public')->exists($order->preview_path)) {
            Storage::disk('public')->delete($order->preview_path);
        }
        $path = $request->file('preview')->store('order_previews', 'public');
        $order->preview_path = $path;
        $order->preview_sent_at = now();
        $order->save();
        return response()->json(['success' => true, 'preview_url' => asset('storage/' . $path)]);
    }

    /** Список заказов текущего пользователя с чатами (для раздела «Чаты с дизайнерами») */
    public function userOrderChats()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Доступ запрещён'], 403);
        }
        $orders = Application::where('userid', Auth::id())
            ->orderBy('updated_at', 'desc')
            ->get(['id', 'yslyga', 'status', 'chat_closed_at', 'preview_path', 'preview_sent_at', 'updated_at']);
        $orderIds = $orders->pluck('id')->toArray();
        $lastMessages = ChatMessage::orderChat()
            ->whereIn('thread_id', $orderIds)
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique('thread_id')
            ->keyBy('thread_id');
        $list = $orders->map(function ($o) use ($lastMessages) {
            $last = $lastMessages->get($o->id);
            $chatClosed = $o->chat_closed_at || ($o->status ?? '') === 'completed';
            return [
                'id' => $o->id,
                'yslyga' => $o->yslyga,
                'status' => $o->status,
                'chat_closed_at' => $chatClosed ? ($o->chat_closed_at ? $o->chat_closed_at->toIso8601String() : now()->toIso8601String()) : null,
                'preview_path' => $o->preview_path,
                'preview_url' => $o->preview_path ? asset('storage/' . $o->preview_path) : null,
                'preview_sent_at' => $o->preview_sent_at?->toIso8601String(),
                'last_message' => $last ? \Str::limit($last->message, 60) : null,
                'updated_at' => $o->updated_at?->toIso8601String(),
            ];
        });
        return response()->json(['orders' => $list]);
    }
}
