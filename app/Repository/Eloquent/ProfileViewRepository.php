<?php

namespace App\Repository\Eloquent;

use App\Models\ProfileView;
use App\Repository\ProfileViewRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ProfileViewRepository extends Repository implements ProfileViewRepositoryInterface
{
    protected Model $model;

    public function __construct(ProfileView $model)
    {
        parent::__construct($model);
    }

    public function isViewedBefore($ad_id)
    {
        return $this->model::query()
            ->where('company_id', auth('api')->user()->company->id)
            ->where(function ($query) use ($ad_id) {
                $query->whereHas('ad', function ($query) use ($ad_id) {
                    $query->where('id', $ad_id);
                });
            })
            ->exists();
    }
}
