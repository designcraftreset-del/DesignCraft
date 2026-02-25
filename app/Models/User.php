<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'banner_photo',
        'last_seen_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_seen_at' => 'datetime',
    ];

    // Отношение с заказами
    public function orders()
    {
        return $this->hasMany(Application::class, 'userid');
    }

    public function servicesBlockPost()
    {
        return $this->hasMany(Services::class, 'userid');
    }

    // Scope для администраторов
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    // Scope для модераторов
    public function scopeModerators($query)
    {
        return $query->where('role', 'moderator');
    }

    // Scope для обычных пользователей
    public function scopeRegularUsers($query)
    {
        return $query->where('role', 'user');
    }

    public function supportMessages()
    {
        return $this->hasMany(ChatMessage::class, 'thread_id');
    }

    public function supportThread()
    {
        return $this->hasOne(SupportThread::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}