<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public function comments()
    {
        return $this->belongsTo(Comment::class, 'comment_id', 'id');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
