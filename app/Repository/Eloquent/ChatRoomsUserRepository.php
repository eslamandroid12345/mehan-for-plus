<?php

namespace App\Repository\Eloquent;

use App\Models\ChatRoomsUser;
use App\Repository\ChatRoomsUserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ChatRoomsUserRepository extends Repository implements ChatRoomsUserRepositoryInterface
{
    protected Model $model;

    public function __construct(ChatRoomsUser $model)
    {
        parent::__construct($model);
    }

    public function read($room_id) {
        return $this->model::query()->where('user_id', auth('api')->id())->where('chat_room_id', $room_id)->update(['unread' => 0]);
    }
}
