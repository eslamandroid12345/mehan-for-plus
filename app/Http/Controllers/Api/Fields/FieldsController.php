<?php

namespace App\Http\Controllers\Api\Fields;

use App\Http\Controllers\Controller;
use App\Http\Resources\FieldResource;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\FieldRepositoryInterface;

class FieldsController extends Controller
{
    protected FieldRepositoryInterface $fieldRepository;

    private GetService $get;

    public function __construct(
        FieldRepositoryInterface $fieldRepository,
        GetService $getService,
    )
    {
        $this->fieldRepository = $fieldRepository;
        $this->get = $getService;
    }

    public function getAll() {
        return $this->get->handle(resource: FieldResource::class, repository: $this->fieldRepository);
    }
}
