<?php

namespace App\Exceptions;

use App\Http\Traits\Responser;
use Exception;

class PublishAdException extends Exception
{
    use Responser;

    public function render($request)
    {
        return $this->responseFail(message: __('messages.Cannot override an ad details while it\'s active'));
    }
}
