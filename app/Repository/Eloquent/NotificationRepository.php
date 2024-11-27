<?php

namespace App\Repository\Eloquent;

use App\Models\Notification;
use App\Repository\NotificationRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class NotificationRepository extends Repository implements NotificationRepositoryInterface
{
    protected Model $model;

    public function __construct(Notification $model)
    {
        parent::__construct($model);
    }

    public function fetch() {
        return $this->model::query()
            ->whereHas('users', function ($query) {
                $query->where('user_id', auth('api')->id());
            })
            ->get();
    }

    public function read() {
        $notifications = $this->get();
        foreach ($notifications as $notification) {
            $notification->users()->updateExistingPivot(auth('api')->id(), ['is_read' => true]);
        }
    }

    public function unreadCount() {
        return $this->model::query()
            ->whereHas('users', function ($query) {
                $query->where('user_id', auth('api')->id());
                $query->where('is_read', false);
            })
            ->count();
    }

    public function delete(int $notificationId): bool
    {
        $notification = $this->model::query()->where('id', $notificationId)->first();
        return $notification->users()->detach(auth('api')->id());
    }

    public function deleteAll() {
        $user = auth('api')->user();
        return $user->notifications()->detach();
    }
}
