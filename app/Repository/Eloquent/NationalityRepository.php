<?php

namespace App\Repository\Eloquent;

use App\Models\Nationality;
use App\Repository\NationalityRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class NationalityRepository extends Repository implements NationalityRepositoryInterface
{
    protected Model $model;

    public function __construct(Nationality $model)
    {
        parent::__construct($model);
    }

    public function isSaudi($nationality_id) {
        return $this->model::query()
            ->where('id', $nationality_id)
            ->where(function ($query) {
                $query->where('name_en', 'LIKE', '%saudi%');
                $query->orWhere('name_ar', 'LIKE', '%سعودي%');
            })
            ->exists();
    }
}
