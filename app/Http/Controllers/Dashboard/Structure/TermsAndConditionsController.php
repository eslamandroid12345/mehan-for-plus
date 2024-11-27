<?php

namespace App\Http\Controllers\Dashboard\Structure;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Structure\AboutUsRequest;
use App\Http\Requests\Dashboard\Structure\TermsAndConditionsRequest;
use App\Http\Services\Mutual\FileManagerService;
use App\Repository\StructureRepositoryInterface;
use Illuminate\Http\Request;

class TermsAndConditionsController extends StructureController
{
    protected string $structureKey = 'terms-and-conditions';

    public function store(TermsAndConditionsRequest $request) {
        return parent::_store($request);
    }

    protected function copy($request)
    {
        //
    }
}
