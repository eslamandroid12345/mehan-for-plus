<?php

namespace App\Http\Services\Api\Ads;

use App\Http\Requests\Api\Ads\PublishAdsRequest;
use App\Http\Resources\UserResource;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Traits\FileManager;
use App\Http\Traits\Responser;
use App\Repository\AdRepositoryInterface;
use App\Repository\SeekerRepositoryInterface;
use App\Repository\TransactionRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class AdsService
{
    use Responser;

    private UserRepositoryInterface $userRepository;
    private SeekerRepositoryInterface $seekerRepository;
    private AdRepositoryInterface $adRepository;
    private TransactionRepositoryInterface $transactionRepository;

    protected FileManagerService $fileManager;

    public function __construct(
        UserRepositoryInterface         $userRepository,
        SeekerRepositoryInterface       $seekerRepository,
        AdRepositoryInterface           $adRepository,
        TransactionRepositoryInterface  $transactionRepository,
        FileManagerService              $fileManagerService,
    )
    {
        $this->userRepository = $userRepository;
        $this->seekerRepository = $seekerRepository;
        $this->adRepository = $adRepository;
        $this->transactionRepository = $transactionRepository;
        $this->fileManager = $fileManagerService;
    }

    public function publish(PublishAdsRequest $request) {
        $user = auth('api')->user();
        DB::beginTransaction();
        try {
            $this->updateUser($request, $user);
            $this->updateSeeker($request, $user);
            $this->updateOrCreateAd($request, $user);
            DB::commit();
            $user = $this->userRepository->getById($user->id);
            return $this->responseSuccess(message: __('messages.Ad was published successfully'), data: new UserResource($user));
        } catch (\Exception $e) {
            DB::rollback();
            return $this->responseFail(message: __('messages.An error occurred while publishing ad'));
        }

    }

    private function updateUser($request, $user) {
        $values = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'is_phone_public' => $request->is_phone_public
        ];
        if(!is_null($request->image)) {
            $values['image'] = $this->fileManager->handle('image', 'profiles', $user->image);
        }
        return $this->userRepository->update(modelId: $user->id, payload: $values);
    }

    private function updateSeeker($request, $user) {
        $values = [
            'seekers' => [
                'religion' => $request->religion,
                'nationality_id' => $request->nationality_id,
                'city_id' => $request->city_id,
                'gender' => $request->gender,
            ],
            'resident' => [
                'residency_number' => $request->residency_number,
                'is_residency_number_public' => $request->is_residency_number_public,
                'residency_expiration' => $request->residency_expiration,
                'is_residency_expiration_public' => $request->is_residency_expiration_public,
            ],
            'nonresident' => [
                'is_worked_before_in_ksa' => $request->is_worked_before_in_ksa,
            ],
        ];
        $this->seekerRepository->update($user->seeker->id, array_merge($values['seekers'], ($user->seeker->is_resident ? $values['resident'] : $values['nonresident'])));
        if(!is_null($request->cv)) {
            $path = $this->fileManager->handle('cv', 'CVs', $request->cv);
            $this->seekerRepository->update($user->seeker->id, array_merge($values['seekers'], ['cv' => $path]));
        }
    }

    private function updateOrCreateAd($request, $user) {
        $values = [
            'linkedin_account' => $request->linkedin_account,
            'qualification_id' => $request->qualification_id,
            'work_hours_type' => $request->work_hours_type,
            'years_of_experience' => $request->years_of_experience,
            'marital_status' => $request->marital_status,
            'biography' => $request->biography,
            'is_hired' => 0
        ];
        return $this->adRepository->publish(seeker_id: $user->seeker->id, values: $values);
    }

    public function activate() {
        DB::beginTransaction();
        try {
            $user = auth('api')->user();
            $adValues = [
                'expiration_date' => Carbon::now()->addDays(30),
                'is_active' => 1,
                'is_past' => 1,
            ];
            if($user->seeker->ad->is_past) {
                $transactionValues = [
                    'seeker_id' => $user->seeker->id,
                    'amount' => 10,
                    'is_paid' => true,
                ];
                $transaction = $this->transactionRepository->create($transactionValues);
                $adValues['latest_transaction_id'] = $transaction->id;
            }
            $this->adRepository->update($user->seeker->ad->id, $adValues);
            DB::commit();
            return $this->responseSuccess(message: __('messages.Ad was activated successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;

            return $this->responseFail(message: __('messages.A payment error occurred'));
        }
    }

    public function hired() {
        DB::beginTransaction();
        try {
            $user = auth('api')->user();
            $this->adRepository->hired($user->seeker->ad->id);
            DB::commit();
            return $this->responseSuccess(message: __('messages.Seeker hired successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->responseFail(message: __('message.Something went wrong'));
        }
    }

}
