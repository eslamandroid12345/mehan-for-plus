<?php

namespace App\Http\Controllers\Api\Seekers;

use App\Http\Controllers\Controller;
use App\Http\Resources\SeekerDetailsResource;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;

class SeekersController extends Controller
{
    use Responser;

    protected UserRepositoryInterface $userRepository;

    private GetService $get;

    public function __construct(
        UserRepositoryInterface $userRepository,
        GetService $getService,
    )
    {
        $this->middleware('auth:api');
        $this->userRepository = $userRepository;
        $this->get = $getService;
    }

    public function details() {
        return $this->get->handle(resource: SeekerDetailsResource::class, repository: $this->userRepository, method: 'getById', parameters: [auth('api')->id()], is_instance: true);
    }
}
