<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['index', 'show', 'profileForAdmin', 'updateProfileByAdmin', 'updateOwnProfile', 'changePassword']);
    }

    /** Создание пользователя (только admin) */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,moderator,admin',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        return redirect()->back()->with('success', 'Пользователь создан');
    }

    /** JSON профиля пользователя для модалки админки */
    public function profileForAdmin($id)
    {
        $me = Auth::user();
        if ($me->role !== 'admin' && $me->role !== 'moderator') {
            return response()->json(['error' => 'Forbidden'], 403);
        }
        $user = User::withCount('orders')->with(['orders' => function ($q) {
            $q->orderBy('created_at', 'desc')->limit(50);
        }, 'reviews' => function ($q) {
            $q->orderBy('created_at', 'desc')->limit(50);
        }])->find($id);
        if (!$user) {
            return response()->json(['error' => 'Not found'], 404);
        }
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'avatar' => $user->avatar ? asset('storage/' . $user->avatar) : null,
            'created_at' => $user->created_at?->format('d.m.Y H:i'),
            'orders_count' => $user->orders_count ?? 0,
            'orders' => $user->orders->map(fn ($o) => [
                'id' => $o->id,
                'name' => $o->name,
                'email' => $o->email,
                'nomer' => $o->nomer,
                'yslyga' => $o->yslyga,
                'info' => $o->info,
                'status' => $o->status,
                'created_at' => $o->created_at?->format('d.m.Y H:i'),
            ]),
            'reviews' => $user->reviews->map(fn ($r) => [
                'id' => $r->id,
                'client_name' => $r->client_name,
                'client_position' => $r->client_position,
                'review_text' => $r->review_text,
                'rating' => $r->rating,
                'is_approved' => $r->is_approved,
                'created_at' => $r->created_at?->format('d.m.Y H:i'),
            ]),
        ]);
    }

    /** Обновление профиля пользователя (имя, роль, аватар) из админки */
    public function updateProfileByAdmin(Request $request, $id)
    {
        $me = Auth::user();
        if ($me->role !== 'admin' && $me->role !== 'moderator') {
            return redirect()->back()->with('error', 'Нет доступа');
        }
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255|unique:users,email,' . $user->id,
            'role' => 'sometimes|in:user,moderator,admin',
            'avatar' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->filled('name')) $user->name = $request->name;
        if ($request->filled('email')) $user->email = $request->email;
        if ($request->filled('role')) {
            if ($user->id === $me->id && $request->role !== $me->role) {
                return redirect()->back()->with('error', 'Нельзя изменить свою роль');
            }
            $user->role = $request->role;
        }
        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }
        $user->save();
        return redirect()->back()->with('success', 'Профиль обновлён');
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        

        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Вы не можете изменить свою собственную роль!');
        }

        $request->validate([
            'role' => 'required|in:user,moderator,admin'
        ]);

        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'Роль пользователя успешно обновлена!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        

        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Вы не можете удалить свой собственный аккаунт!');
        }


        $user->orders()->delete();
        

        if ($user->banner_photo) {
            \Illuminate\Support\Facades\Storage::delete('public/banner-photos/' . $user->banner_photo);
        }

        $user->delete();

        return redirect()->back()->with('success', 'Пользователь успешно удален!');
    }

    /** Обновление своего профиля (имя, email) из личного кабинета */
    public function updateOwnProfile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:30',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone ? trim($request->phone) : null;
        $user->save();
        if ($request->filled('redirect_mobile')) {
            return redirect()->route('mobile.account')->with('success', 'Профиль обновлён.');
        }
        return redirect()->route('userPanel')->with('success', 'Профиль обновлён.');
    }

    /** Смена пароля из личного кабинета (только по ссылке из письма) */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Текущий пароль неверен.');
        }
        $user->password = Hash::make($request->password);
        $user->save();
        if ($request->filled('redirect_mobile')) {
            return redirect()->route('mobile.settings')->with('success', 'Пароль успешно изменён.');
        }
        return redirect()->route('userPanel')->with('success', 'Пароль успешно изменён.');
    }

    /** Отправить на почту пользователя ссылку для сброса пароля (из личного кабинета) */
    public function sendPasswordResetLink(Request $request)
    {
        $user = Auth::user();
        $status = Password::sendResetLink(['email' => $user->email]);

        if ($status === Password::RESET_LINK_SENT) {
            $redirect = $request->filled('redirect_mobile') ? route('mobile.settings') : route('userPanel');
            return redirect($redirect)->with('success', 'Ссылка для сброса пароля отправлена на ' . $user->email . '. Проверьте почту и перейдите по ссылке, чтобы задать новый пароль.');
        }

        $redirect = $request->filled('redirect_mobile') ? route('mobile.settings') : route('userPanel');
        return redirect($redirect)->with('error', 'Не удалось отправить письмо. Попробуйте позже или обратитесь в поддержку.');
    }
}