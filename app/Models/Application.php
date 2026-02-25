<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "name",
        "email",
        "nomer",
        "yslyga",
        "paket",
        "info",
        "processing",
        "completed",
        "status",
        "userid",
        "chat_closed_at",
        "preview_path",
        "preview_sent_at",
        "sources_path",
        "photos_paths",
    ];

    protected $casts = [
        'chat_closed_at' => 'datetime',
        'preview_sent_at' => 'datetime',
        'photos_paths' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }


    public function scopeCurrentUser($query)
    {
        return $query->where('userid', auth()->id());
    }

    public function isChatClosed(): bool
    {
        return $this->chat_closed_at !== null;
    }
}