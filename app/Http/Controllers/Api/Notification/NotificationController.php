<?php

namespace App\Http\Controllers\Api\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Notification\NotificationRequest;
use App\Http\Resources\NotificationResource;
use App\Http\Services\Mutual\GetService;
use App\Http\Services\Mutual\NotificationService;
use App\Repository\NotificationRepositoryInterface;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected GetService $get;
    protected NotificationService $notifications;
    private NotificationRepositoryInterface $notificationRepository;

    public function __construct(
        GetService $getService,
        NotificationService $notificationService,
        NotificationRepositoryInterface $notificationRepository,
    )
    {
        $this->middleware('auth:api');
        $this->get = $getService;
        $this->notifications = $notificationService;
        $this->notificationRepository = $notificationRepository;
    }

    public function get() {
        return $this->get->handle(resource: NotificationResource::class, repository: $this->notificationRepository, method: 'fetch');
    }

    public function read() {
        return $this->notifications->read();
    }

    public function unreadCount() {
        return $this->notifications->unreadCount();
    }

    public function delete(NotificationRequest $request) {
        return $this->notifications->delete($request);
    }

    public function deleteAll() {
        return $this->notifications->deleteAll();
    }

}
