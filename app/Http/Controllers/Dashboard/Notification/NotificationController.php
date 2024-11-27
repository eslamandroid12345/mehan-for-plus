<?php

namespace App\Http\Controllers\Dashboard\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Notification\NotificationRequest;
use App\Http\Services\Mutual\NotificationService;
use App\Repository\NotificationRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    protected NotificationService $notification;

    public function __construct(
        NotificationService $notificationService,
    )
    {
        $this->middleware('auth:admin');
        $this->notification = $notificationService;
    }

    public function index()
    {
        return view('dashboard.site.notifications.index');
    }

    public function store(NotificationRequest $request)
    {
        return $this->notification->push($request);
    }

}
