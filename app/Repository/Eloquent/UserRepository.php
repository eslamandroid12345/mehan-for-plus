<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends Repository implements UserRepositoryInterface
{
    protected Model $model;
    private const COMPANIES = 0;
    private const RESIDENT_SEEKERS = 1;
    private const NON_RESIDENT_SEEKERS = 2;

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getDeviceTokens(array $userTypes) {
        return $this->model::query()
            ->where(function ($query) use ($userTypes) {
                if(in_array(self::COMPANIES, $userTypes)) {
                    $query->orWhere('user_type', self::COMPANIES);
                }
                if(in_array(self::RESIDENT_SEEKERS, $userTypes)) {
                    $query->orWhere(function ($query) {
                        $query->whereHas('seeker', function ($query) {
                            $query->where('is_resident', 1);
                        });
                    });
                }
                if(in_array(self::NON_RESIDENT_SEEKERS, $userTypes)) {
                    $query->orWhere(function ($query) {
                        $query->whereHas('seeker', function ($query) {
                            $query->where('is_resident', 0);
                        });
                    });
                }
            })
//            ->whereNotNull('device_token')
            ->pluck('device_token', 'id')
            ->toArray();
    }


}
