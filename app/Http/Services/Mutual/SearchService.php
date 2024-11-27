<?php

namespace App\Http\Services\Mutual;

use App\Http\Resources\JobResource;
use App\Http\Traits\Responser;
use App\Repository\RepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class SearchService
{
    use Responser;

    public function handle($resource, RepositoryInterface $repository, FormRequest $request, $method = 'search') {
        $search = $resource::collection($repository->$method($request));
        return $this->responseSuccess(data: $search);
    }
}
