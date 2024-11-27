<?php

namespace App\Http\Services\Api\Company;

use App\Http\Resources\CompanyResource;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Traits\Responser;
use App\Repository\AdRepositoryInterface;
use App\Repository\ProfileViewRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class CompanyService
{
    use Responser;

    protected UserRepositoryInterface $userRepository;
    protected AdRepositoryInterface $adRepository;
    protected ProfileViewRepositoryInterface $profileViewRepository;

    private FileManagerService $fileManager;

    public function __construct(
        UserRepositoryInterface $userRepository,
        AdRepositoryInterface $adRepository,
        ProfileViewRepositoryInterface $profileViewRepository,
        FileManagerService $fileManagerService,
    )
    {
        $this->userRepository = $userRepository;
        $this->adRepository = $adRepository;
        $this->profileViewRepository = $profileViewRepository;
        $this->fileManager = $fileManagerService;
    }

    public function update($request) {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->getById(auth('api')->id());
            $user->update($request->except('field_id', 'image'));
            if(!is_null($request->image)) {
                $user->image = $this->fileManager->handle('image', 'profiles', $user->image);
            }
            $user->company()->update([
                'field_id' => $request->field_id,
            ]);
            $user->save();
            DB::commit();
            return $this->responseSuccess(data: new CompanyResource($user));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->responseFail();
        }
    }

    public function view($request) {
        if(!$this->profileViewRepository->isViewedBefore($request->ad_id)) {
            $this->profileViewRepository->create([
                'company_id' => auth('api')->user()->company->id,
                'ad_id' => $request->ad_id,
            ]);
            $this->adRepository->incrementView($request->ad_id);
            return $this->responseSuccess();
        } else {
            return $this->responseFail();
        }
    }

}
