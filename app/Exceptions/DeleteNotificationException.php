<?php

namespace App\Exceptions;

use App\Http\Traits\Responser;
use Exception;

class DeleteNotificationException extends Exception
{
    use Responser;

    public function render($request)
    {
        return $this->responseFail(message: __('messages.You dont have permission to delete this notification'));
    }
}
