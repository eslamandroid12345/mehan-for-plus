<?php

namespace App\Repository\Eloquent;

use App\Models\Ad;
use App\Repository\AdRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class AdRepository extends Repository implements AdRepositoryInterface
{
    protected Model $model;

    public function __construct(Ad $model)
    {
        parent::__construct($model);
    }

    public function count() {
        return $this->model::query()->active()->where('is_active',1)->count();
    }

    public function publish($seeker_id, $values, $silently = false)
    {
        return $this->model::query()
            ->where('seeker_id', $seeker_id)
            ->where(function ($query) use ($silently) {
                if($silently) {
                    $query->withoutTimestamps();
                }
            })
            ->updateOrCreate(['seeker_id' => $seeker_id], $values);
    }

    public function feeds()
    {
        return $this->model::query()
            ->active()
            ->with('seeker', function ($query) {
                $query->with('user');
                $query->with('job');
                $query->with('city');
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(5);
    }

    public function filter($request)
    {
        return $this->model::query()
            ->active()
            ->where(function ($query) use ($request) {
                $query->whereHas('seeker', function ($query) use ($request) {
                    $query->where(function ($query) use ($request) {
                        if (!is_null($request->keyword)) {
                            $query->whereHas('user', function ($query) use ($request) {
                                $query->where('name', 'like', '%' . $request->keyword . '%');
                            });
                        }
                    });
                    $query->where(function ($query) use ($request) {
                        if (!is_null($request->nationality_id))  {
                            $query->where('nationality_id', $request->nationality_id);
                        }
                        if (!is_null($request->job_id)) {
                            $query->where('job_id', $request->job_id);
                        }
                        if (!is_null($request->is_resident)) {
                            $query->where('is_resident', $request->is_resident);
                        }
                        if (!is_null($request->city_id)) {
                            $query->where('city_id', $request->city_id);
                        }
                        if (!is_null($request->years_of_experience)) {
                            $years = match ($request->years_of_experience) {
                                '1-' => ['1-'],
                                '3-' => ['1-', '3-'],
                                '10-' => ['1-', '3-', '10-'],
                                '10+' => ['10+'],
                                default => ['1-', '3-', '10-', '10+'],
                            };
                            $query->whereIn('years_of_experience', $years);
                        }
                    });
                });
                if ($request->qualification_id !== null) {
                    $query->where('qualification_id', $request->qualification_id);
                }
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(5);
    }

    public function favorites()
    {
        return $this->model::query()
            ->active()
            ->whereHas('seeker', function ($query) {
                $query->whereHas('favorites', function ($query) {
                    $query->where('company_id', auth('api')->user()->company->id);
                });
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(5);
    }

    public function incrementView($id) {
        return $this->model::query()->withoutTimestamps()->where('id', $id)->increment('views');
    }

    public function endExpiredAds() {
        return $this->model::query()->expired()->update(['is_active' => 0]);
    }

    public function hired($id) {
        return $this->model::query()->withoutTimestamps()->where('id', $id)->update([
            'is_past' => 0,
            'is_hired' => 1,
        ]);
    }

    public function bestFive() {
        return $this->model::query()->active()->orderByDesc('views')->take(5)->get();
    }
}
