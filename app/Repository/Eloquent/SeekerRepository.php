<?php

namespace App\Repository\Eloquent;

use App\Models\Seeker;
use App\Repository\SeekerRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class SeekerRepository extends Repository implements SeekerRepositoryInterface
{
    protected Model $model;

    public function __construct(Seeker $model)
    {
        parent::__construct($model);
    }

    public function count(bool $isResident) {
        return $this->model::query()->where('is_resident', $isResident)->count();
    }

    public function getPaginatedResidentSeekers()
    {
        return $this->model::query()->resident()->with('user')->paginate(10);
    }

    public function getPaginatedNonResidentSeekers()
    {
        return $this->model::query()->nonResident()->with('user')->paginate(10);
    }
}
