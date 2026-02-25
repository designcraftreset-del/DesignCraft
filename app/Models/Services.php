<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "category",
        "titleTwo",
        "subtitle",
        "money",
        "concept",
        "edits",
        "formatTwo",
        "term",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }


    public function scopeCurrentUser($query)
    {
        return $query->where('userid', auth()->id());
    }
}
