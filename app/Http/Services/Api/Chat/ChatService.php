<?php

namespace App\Http\Services\Api\Chat;

use App\Events\ChangeChatRoomsStateEvent;
use App\Events\ChangeChatUnreadCountEvent;
use App\Events\PushChatMessageEvent;
use App\Http\Resources\ChatAttachmentResource;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Traits\Responser;
use App\Repository\ChatMessageRepositoryInterface;
use App\Repository\ChatRoomRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class ChatService
{
    use Responser;
    private ChatRoomRepositoryInterface $chatRoomRepository;
    private ChatMessageRepositoryInterface $chatMessageRepository;

    protected FileManagerService $fileManager;

    public function __construct(
        ChatRoomRepositoryInterface $chatRoomRepository,
        ChatMessageRepositoryInterface $chatMessageRepository,
        FileManagerService $fileManagerService,
    )
    {
        $this->chatRoomRepository = $chatRoomRepository;
        $this->chatMessageRepository = $chatMessageRepository;
        $this->fileManager = $fileManagerService;
    }

    public function send($request) {
        DB::beginTransaction();
        try {
            $data = [
                'chat_room_id' => $request->room_id,
                'user_id' => auth('api')->id(),
                'content' => $request->input('content'),
                'type' => $request->type,
            ];
            $message = $this->chatMessageRepository->create($data);
            broadcast(new PushChatMessageEvent($message));
            $message->chatRoom->updated_at = Carbon::now();
            $otherParties = $message->chatRoom->users()->where('user_id', '!=', auth('api')->id())->get();
            foreach ($otherParties as $user) {
                $message->chatRoom->users()->where('user_id', $user->user->id)->increment('unread');
                broadcast(new ChangeChatRoomsStateEvent($user->user->id, $message->chatRoom));
                broadcast(new ChangeChatUnreadCountEvent($user->user));
            }
            $message->push();
            DB::commit();
            return $this->responseSuccess(message: __('messages.Message sent successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseFail(message: __('messages.Something went wrong while sending message'));
        }
    }

    public function attach($request) {
        try {
            $data = [
                'type' => $request->type,
                'path' => $this->fileManager->handle('attachment', 'chats/' . strtolower($request->type) . 's')
            ];
            return $this->responseSuccess(message: __('messages.Attachment uploaded successfully'), data: new ChatAttachmentResource($data));
        } catch (Exception $e) {
            return $this->responseFail(message: __('messages.Something went wrong while uploading attachment'));
        }
    }

    public function unreadCount() {
        return $this->responseSuccess(data: [
            'unread_count' => auth('api')->user()->chatRooms()->sum('unread') ?? 0,
        ]);
    }

}
