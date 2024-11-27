<?php

namespace App\Repository\Eloquent;

use App\Models\Job;
use App\Repository\JobRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class JobRepository extends Repository implements JobRepositoryInterface
{
    protected Model $model;

    public function __construct(Job $model)
    {
        parent::__construct($model);
    }

    public function search($request)
    {
        return $this->model::query()
            ->where('name_en', 'LIKE', '%'.$request->keyword.'%')
            ->orWhere('name_ar', 'LIKE', '%'.$request->keyword.'%')
            ->get();
    }
}
