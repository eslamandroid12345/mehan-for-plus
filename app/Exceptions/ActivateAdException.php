<?php

namespace App\Exceptions;

use App\Http\Traits\Responser;
use Exception;

class ActivateAdException extends Exception
{
    use Responser;

    public function render($request)
    {
        return $this->responseFail(message: __('messages.Cannot activate an ad was already activated'));
    }
}
