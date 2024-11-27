<?php

namespace App\Repository\Eloquent;

use App\Models\Favorite;
use App\Repository\FavoriteRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class FavoriteRepository extends Repository implements FavoriteRepositoryInterface
{
    protected Model $model;

    public function __construct(Favorite $model)
    {
        parent::__construct($model);
    }

    public function toggle($seeker_id) {
        $favorite = $this->model::query()->where('company_id', auth('api')->user()->company->id)->where('seeker_id', $seeker_id);
        if($favorite->exists()) {
            return $favorite->delete();
        } else {
            return $this->create([
                'company_id' => auth('api')->user()->company->id,
                'seeker_id' => $seeker_id,
            ]);
        }
    }
}
