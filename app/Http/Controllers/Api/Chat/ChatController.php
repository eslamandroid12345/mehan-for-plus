<?php

namespace App\Http\Controllers\Api\Chat;

use App\Events\ChangeChatUnreadCountEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Chats\AttachRequest;
use App\Http\Requests\Api\Chats\ChatRequest;
use App\Http\Requests\Api\Chats\ReadChatRequest;
use App\Http\Requests\Api\Chats\RoomRequest;
use App\Http\Resources\ChatRoomMessagesResource;
use App\Http\Resources\ChatRoomsResource;
use App\Http\Services\Api\Chat\ChatService;
use App\Http\Traits\Responser;
use App\Repository\ChatMessageRepositoryInterface;
use App\Repository\ChatRoomRepositoryInterface;
use App\Repository\Eloquent\ChatRoomsUserRepository;
use App\Repository\UserRepositoryInterface;

class ChatController extends Controller
{
    use Responser;

    private ChatRoomRepositoryInterface $chatRoomRepository;
    private ChatRoomsUserRepository $chatRoomsUserRepository;
    private ChatMessageRepositoryInterface $chatMessageRepository;
    private UserRepositoryInterface $userRepository;
    protected ChatService $chat;

    public function __construct(
        ChatRoomRepositoryInterface $chatRoomRepository,
        ChatRoomsUserRepository $chatRoomsUserRepository,
        ChatMessageRepositoryInterface $chatMessageRepository,
        UserRepositoryInterface $userRepository,
        ChatService $chatService,
    )
    {
        $this->middleware('auth:api');
        $this->chatRoomRepository = $chatRoomRepository;
        $this->chatRoomsUserRepository = $chatRoomsUserRepository;
        $this->chatMessageRepository = $chatMessageRepository;
        $this->userRepository = $userRepository;
        $this->chat = $chatService;
    }

    public function rooms() {
        $rooms = $this->chatRoomRepository->rooms();
        return $this->responseSuccess(data: ChatRoomsResource::collection($rooms));
    }

    public function provide(RoomRequest $request) {
        $room = $this->chatRoomRepository->provide($request->user_id);
        $user = $this->userRepository->getById($request->user_id);
        return $this->responseSuccess(data: new ChatRoomMessagesResource($room, $user));
    }

    public function send(ChatRequest $request) {
        return $this->chat->send($request);
    }

    public function attach(AttachRequest $request) {
        return $this->chat->attach($request);
    }

    public function read(ReadChatRequest $request) {
        $this->chatRoomsUserRepository->read($request->room_id);
        broadcast(new ChangeChatUnreadCountEvent(auth('api')->user()));
        return $this->responseSuccess();
    }

    public function unreadCount() {
        return $this->chat->unreadCount();
    }
}
