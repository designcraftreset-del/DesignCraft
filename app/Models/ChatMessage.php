<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatMessage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'admin_chat_messages';

    protected $fillable = [
        'user_id',
        'message',
        'image_path',
        'image_name',
        'file_path',
        'file_name',
        'is_system',
        'read_at',
        'deleted_by_user_id',
        'chat_type',
        'thread_id',
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'is_system' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    public function scopeAdminChat($query)
    {
        return $query->where(function ($q) {
            $q->where('chat_type', 'admin')->orWhereNull('chat_type');
        });
    }

    public function scopeSupportChat($query)
    {
        return $query->where('chat_type', 'support');
    }

    public function scopeOrderChat($query)
    {
        return $query->where('chat_type', 'order');
    }

    public function markAsRead()
    {
        $this->update(['read_at' => now()]);
    }

    // Проверяет, может ли пользователь удалить сообщение
    public function canDelete($user)
    {
        return $user->role === 'admin' || 
               $user->role === 'moderator' || 
               $this->user_id === $user->id;
    }

    // Проверяет, удалено ли сообщение для текущего пользователя
    public function isDeletedForUser($userId = null)
    {
        if (!$userId) {
            $userId = auth()->id();
        }
        
        return $this->deleted_by_user_id === $userId;
    }
}