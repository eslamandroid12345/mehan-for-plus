<?php

namespace App\Repository\Eloquent;

use App\Models\Skill;
use App\Repository\SkillRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class SkillRepository extends Repository implements SkillRepositoryInterface
{
    protected Model $model;

    public function __construct(Skill $model)
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
