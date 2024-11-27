<?php

namespace App\Repository\Eloquent;

use App\Models\Setting;
use App\Repository\SettingRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class SettingRepository extends Repository implements SettingRepositoryInterface
{
    protected Model $model;

    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }

    public function _getAll()
    {
        return parent::getAll()->pluck('value', 'key');
    }

    public function _update($key, $value): bool
    {
        return $this->model::query()->where('key', $key)->update(['value' => $value]);
    }

    public function getSetting($key) {
        return $this->model::query()->where('key', $key)->pluck('value')->first();
    }
}
