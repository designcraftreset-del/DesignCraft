<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupportThreadRead extends Model
{
    protected $table = 'support_thread_reads';

    protected $fillable = ['admin_id', 'thread_id', 'read_at', 'pinned'];

    protected $casts = [
        'read_at' => 'datetime',
        'pinned' => 'boolean',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function threadUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'thread_id');
    }
}
