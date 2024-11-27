<?php

namespace App\Http\Services\Api;

use App\Http\Resources\FeedResource;
use App\Http\Resources\StructureResource;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\AdRepositoryInterface;
use App\Repository\StructureRepositoryInterface;

class StructureService
{
    use Responser;

    private StructureRepositoryInterface $structureRepository;
    private AdRepositoryInterface $adRepository;
    protected GetService $get;

    public function __construct(
        StructureRepositoryInterface $structureRepository,
        AdRepositoryInterface $adRepository,
        GetService $getService,
    )
    {
        $this->structureRepository = $structureRepository;
        $this->adRepository = $adRepository;
        $this->get = $getService;
    }

    public function get($key) {
        $structure = $this->structureRepository->structure($key);
        if ($structure->exists()) {
            return $this->responseSuccess(data: new StructureResource($structure->first()));
        } else {
            return $this->responseFail();
        }
    }

    public function bestFive() {
        return $this->get->handle(resource: FeedResource::class, repository: $this->adRepository, method: 'bestFive');
    }

}
