<?php

use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.room.{room_id}', function ($user, $room_id) {
    return $user->chatRooms()->where('chat_room_id', $room_id)->exists();
});

Broadcast::channel('chat.rooms.states.{user_id}', function ($user) {
    return true;
});

Broadcast::channel('chat.unread.messages.{user_id}', function ($user) {
    return $user->chatRooms()->where('unread', '>=', 0)->exists();
});
