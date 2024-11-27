<?php

namespace App\Repository\Eloquent;

use App\Models\ChatRoom;
use App\Repository\ChatRoomRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ChatRoomRepository extends Repository implements ChatRoomRepositoryInterface
{
    protected Model $model;

    public function __construct(
        ChatRoom $model,
    )
    {
        parent::__construct($model);
    }

    public function rooms() {
        return $this->model::query()
            ->whereHas('users', function ($query) {
                $query->where('user_id', auth('api')->id());
            })
            ->whereHas('messages')
            ->orderByDesc('updated_at')
            ->get();
    }

    public function create($user_id): ?Model
    {
        $room = new $this->model();
        $room->save();
        $room->users()->insert([
            [
                'chat_room_id' => $room->id,
                'user_id' => $user_id,
            ],
            [
                'chat_room_id' => $room->id,
                'user_id' => auth('api')->id(),
            ]
        ]);
        $room->push();
        return $room;
    }

    public function search($user1, $user2 = null) {
        return $this->model::query()
            ->where(function ($query) use ($user1) {
                $query->whereHas('users', function ($query) use ($user1) {
                    $query->where('user_id', $user1);
                });
            })
            ->where(function ($query) use ($user2) {
                $query->whereHas('users', function ($query) use ($user2) {
                    $query->where('user_id', $user2 ?? auth('api')->id());
                });
            });
    }

    public function provide($user_id) {
        $room = $this->search($user_id);
        if($room->exists()) {
            return $room->first();
        } else {
            return $this->create($user_id);
        }
    }



}
