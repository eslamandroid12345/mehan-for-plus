<?php

namespace App\Http\Services\Mutual;

use App\Http\Traits\NotificationManager;
use App\Http\Traits\Responser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use PHPUnit\Exception;

class NotificationService
{
    use Responser, NotificationManager;

    public function push($request) {
        DB::beginTransaction();
        try {
            $notification = $this->preparePush($request);

            $headers = [
                'Authorization: key=' . static::$serverApiKey,
                'Content-Type: application/json',
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $notification);
            curl_exec($ch);

            DB::commit();
            return redirect()->route('notifications.index')->with(['success' => __('messages.Notification pushed successfully')]);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('notifications.index')->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function read() {
        $this->notificationRepository->read();
        return $this->responseSuccess();
    }

    public function unreadCount() {
        return $this->responseSuccess(data: [
            'unread_count' => $this->notificationRepository->unreadCount(),
        ]);
    }

    public function delete($request) {
        if(Gate::allows('delete-notification', $request->notification_id)) {
            $this->notificationRepository->delete($request->notification_id);
            return $this->responseSuccess(message: __('messages.Notification deleted successfully'));
        } else {
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function deleteAll() {
        DB::beginTransaction();
        try {
            $this->notificationRepository->deleteAll();
            DB::commit();
            return $this->responseSuccess(message: __('messages.Notifications deleted successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

}
