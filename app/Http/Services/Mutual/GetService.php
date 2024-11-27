<?php

namespace App\Http\Services\Mutual;

use App\Http\Traits\Responser;
use App\Repository\RepositoryInterface;
use Exception;

class GetService
{
    use Responser;

    public function handle($resource, RepositoryInterface $repository, $method = 'getAll', $parameters = [], $is_instance = false)
    {
        try {
            $records = $is_instance ? new $resource($repository->$method(...$parameters)) : $resource::collection($repository->$method(...$parameters));
            return $this->responseSuccess(data: $records);
        } catch (Exception $e) {
//            return $e;
            return $this->responseFail(message: __('messages.No data found'));
        }
    }
}
