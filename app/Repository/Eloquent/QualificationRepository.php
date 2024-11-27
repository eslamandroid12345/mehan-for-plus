<?php

namespace App\Repository\Eloquent;

use App\Models\Qualification;
use App\Repository\QualificationRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class QualificationRepository extends Repository implements QualificationRepositoryInterface
{
    protected Model $model;

    public function __construct(Qualification $model)
    {
        parent::__construct($model);
    }
}
