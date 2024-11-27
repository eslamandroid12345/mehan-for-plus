<?php

namespace App\Http\Controllers\Dashboard\Structure;

use App\Http\Requests\Dashboard\Structure\PrivacyPolicyRequest;

class PrivacyPolicyController extends StructureController
{
    protected string $structureKey = 'privacy-policy';

    public function store(PrivacyPolicyRequest $request) {
        return parent::_store($request);
    }

    protected function copy($request)
    {
        //
    }
}
