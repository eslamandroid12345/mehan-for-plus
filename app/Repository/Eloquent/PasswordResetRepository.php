<?php

namespace App\Repository\Eloquent;

use App\Models\PasswordReset;
use App\Repository\PasswordResetRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PasswordResetRepository extends Repository implements PasswordResetRepositoryInterface
{
    protected Model $model;
    public function __construct(PasswordReset $model)
    {
        parent::__construct($model);
    }

    public function createCode($email, $code)
    {
        return $this->model::query()->updateOrCreate(['email' => $email], ['token' => $code, 'created_at' => Carbon::now()]);
    }

    public function search($code, $email = null) {
        return $this->model::query()
            ->where('token', $code)
            ->where(function ($query) use ($email) {
                if ($email !== null)
                    $query->where('email', $email);
            })
            ->first();
    }
}
