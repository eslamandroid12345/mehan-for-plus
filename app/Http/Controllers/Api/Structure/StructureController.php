<?php

namespace App\Http\Controllers\Api\Structure;

use App\Http\Controllers\Controller;
use App\Http\Resources\StructureResource;
use App\Http\Services\Api\StructureService;
use App\Http\Traits\Responser;
use App\Repository\StructureRepositoryInterface;
use Illuminate\Http\Request;

class StructureController extends Controller
{
    use Responser;
    protected StructureService $structure;

    public function __construct(StructureService $structureService)
    {
        $this->structure = $structureService;
    }

    public function get($key) {
        return $this->structure->get($key);
    }

    public function bestFive() {
        return $this->structure->bestFive();
    }
}
