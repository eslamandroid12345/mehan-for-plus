<?php

namespace App\Http\Services\Dashboard\Ads;

use App\Http\Services\Mutual\FileManagerService;
use App\Repository\AdRepositoryInterface;
use App\Repository\NationalityRepositoryInterface;
use App\Repository\SeekerRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdsService
{
    private UserRepositoryInterface $userRepository;
    private AdRepositoryInterface $adRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        AdRepositoryInterface $adRepository,
    )
    {
        $this->userRepository = $userRepository;
        $this->adRepository = $adRepository;
    }

    public function publish($request, $id) {
        $user = $this->userRepository->getById($id);
        DB::beginTransaction();
        try {
            $is_active = $request->is_active ?? 0;
            $ad = $this->adRepository->publish(
                $user->seeker->id,
                [
                    'linkedin_account'=> $request->linkedin_account,
                    'qualification_id'=> $request->qualification_id,
                    'work_hours_type'=> $request->work_hours_type,
                    'marital_status'=> $request->marital_status,
                    'years_of_experience'=> $request->years_of_experience,
                    'biography' => $request->biography,
                    'is_active' => $is_active,
                ],
                $request->sielently ?? 0
            );
            if($is_active) {
                $this->activate($ad, $request->renew ?? 0);
            }
            DB::commit();
            return redirect()->to($request->redirects_to)->with(['success' => __('messages.Ad published successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('ads.edit', $id)->with(['error' => __('messages.Something went wrong')]);
        }
    }

    private function activate($ad, bool $renew = false) {
        $values = [
            'is_active' => 1,
            'is_past' => 1,
        ];
        if($renew) {
            $values['expiration_date'] = Carbon::now()->addDays(30);
        }
        $this->adRepository->update($ad->id, $values);
    }

}
