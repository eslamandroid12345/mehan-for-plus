<?php

namespace App\Http\Controllers\Api\Qualifications;

use App\Http\Controllers\Controller;
use App\Http\Resources\QualificationResource;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\QualificationRepositoryInterface;

class QualificationsController extends Controller
{
    use Responser;

    protected QualificationRepositoryInterface $qualificationRepository;

    private GetService $get;

    public function __construct(
        QualificationRepositoryInterface $qualificationRepository,
        GetService $getService,
    )
    {
        $this->qualificationRepository = $qualificationRepository;
        $this->get = $getService;
    }

    public function getAll() {
        return $this->get->handle(resource: QualificationResource::class, repository: $this->qualificationRepository);
    }
}
