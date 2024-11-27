<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users() {
        return $this->hasMany(ChatRoomsUser::class);
    }
    public function messages() {
        return $this->hasMany(ChatMessage::class)->orderBy('id', 'desc');
    }

    public function messagesByLatest()
    {
        return $this->messages()->orderByDesc('created_at');
    }
}
