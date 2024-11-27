<?php

namespace App\Repository\Eloquent;

use App\Models\City;
use App\Repository\CityRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CityRepository extends Repository implements CityRepositoryInterface
{
    protected Model $model;

    public function __construct(City $model)
    {
        parent::__construct($model);
    }

    public function getCountryCities($country_id)
    {
        return $this->model::query()
            ->where('country_id', $country_id)
            ->whereDoesntHave('country', function ($query) {
                $query->where('name_en', 'LIKE', '%saudi%');
                $query->orWhere('name_ar', 'LIKE', '%سعودي%');
            })
            ->get();
    }

    public function getSaudiCities()
    {
        return $this->model::query()
            ->whereHas('country', function ($query) {
                $query->where('name_en', 'LIKE', '%saudi%');
                $query->orWhere('name_ar', 'LIKE', '%سعودي%');
            })
            ->get();
    }
}
