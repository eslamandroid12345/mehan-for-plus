<?php

namespace App\Http\Services\Api\Auth;

use App\Http\Resources\UserResource;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Traits\Responser;
use App\Repository\CompanyRepositoryInterface;
use App\Repository\NationalityRepositoryInterface;
use App\Repository\PasswordResetRepositoryInterface;
use App\Repository\SeekerRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthService
{
    use Responser;

    private UserRepositoryInterface $userRepository;
    private CompanyRepositoryInterface $companyRepository;
    private SeekerRepositoryInterface $seekerRepository;
    private NationalityRepositoryInterface $nationalityRepository;
    private PasswordResetRepositoryInterface $passwordResetRepository;

    protected FileManagerService $fileManager;

    public function __construct(
        UserRepositoryInterface    $userRepository,
        CompanyRepositoryInterface $companyRepository,
        SeekerRepositoryInterface  $seekerRepository,
        NationalityRepositoryInterface  $nationalityRepository,
        PasswordResetRepositoryInterface $passwordResetRepository,
        FileManagerService         $fileManagerService,
    )
    {
        $this->userRepository = $userRepository;
        $this->companyRepository = $companyRepository;
        $this->seekerRepository = $seekerRepository;
        $this->nationalityRepository = $nationalityRepository;
        $this->passwordResetRepository = $passwordResetRepository;
        $this->fileManager = $fileManagerService;
    }

    public function login($request) {
        $credentials = $request->only('email', 'password');
        $token = Auth::guard('api')->attempt($credentials);
        if($token) {
            if($request->device_token != null) {
                auth('api')->user()->update(['device_token' => $request->device_token]);
            }
            return $this->responseSuccess(message: __('messages.Successfully authenticated'), data: new UserResource(auth('api')->user()));
        } else {
            return $this->responseFail(status: 401, message: __('messages.wrong credentials'));
        }
    }

    public function refresh() {
        $token = Auth::guard('api')->refresh();
        if($token) {
            return $this->responseSuccess(message: __('messages.Successfully refreshed'), data: new UserResource(auth('api')->user()));
        } else {
            return $this->responseFail(status: 401, message: __('messages.Something went wrong'));
        }
    }

    private function registerInitialUser($request) {
        $data = [
            'user_type' => $request->user_type,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'is_phone_public' => $request->is_phone_public
        ];
        if($request->device_token != null) {
            $data['device_token'] = $request->device_token;
        }
        return $this->userRepository->create($data);
    }

    private function registerCompany($request, $user) {
        return $this->companyRepository->create([
            'user_id' => $user->id,
            'field_id' => $request->company_field,
        ]);
    }

    private function registerSeeker($request, $user) {
        $data = $request->only(['is_resident', 'nationality_id', 'city_id', 'residency_number', 'is_residency_number_public', 'residency_expiration', 'is_residency_expiration_public', 'gender', 'religion', 'is_worked_before_in_ksa', 'biography']);
        $data['user_id'] = $user->id;
        $seeker = $this->seekerRepository->create($data);
        if(!is_null($request->cv)) {
            $path = $this->fileManager->handle('cv', 'CVs', $seeker->cv);
            $seeker->update(['cv' => $path]);
        }
    }

    public function register($request) {
        DB::beginTransaction();
        try {
            $user = $this->registerInitialUser($request);
            if ($request->user_type == 0) {
                $this->registerCompany($request, $user);
            } else {
                $this->registerSeeker($request, $user);
            }
            DB::commit();
            $user = new UserResource($user);
            return $this->responseSuccess(message: __('messages.Successfully registered'), data: $user);
        } catch (Exception $e) {
            DB::rollback();
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function assignJobsAndSkills($request) {
        $job = $request->job;
        $skills = $request->skills;
        DB::beginTransaction();
        try {
            $seeker = auth('api')->user()->seeker;
            $seeker->update(['job_id' => $job, 'more_skills' => $request->more_skills]);
            $seeker->skills()->sync($skills);
            DB::commit();
            return $this->responseSuccess(message: __('messages.Job and skills were assigned successfully'));
        } catch (Exception $e) {
            DB::rollback();
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function uploadProfileImage() {
        $user = auth('api')->user();
        try {
            $path = $this->fileManager->handle('image', 'profiles', $user->getRawOriginal('image'));
            $user->update(['image' => $path]);
            return $this->responseSuccess(message: __('messages.Image uploaded successfully'), data: ['url' => url($path)]);
        } catch (Exception $e) {
            return $this->responseFail(status: 409, message: __('messages.An error occurred while uploading image'));
        }
    }

    public function decideResidencyFields($request) {
        $decide = !$this->nationalityRepository->isSaudi($request->nationality_id);
        return $this->responseSuccess(data: ['show_residency_fields' => $decide]);
    }

    public function resetPasswordRequest($request) {
        DB::beginTransaction();
        try {
            $email = $request->email;
            do {
                $code = random_int(1000, 9999);
            } while ($this->passwordResetRepository->search($code, $email));
            $this->passwordResetRepository->createCode($email, $code);
            $user = $this->userRepository->get('email', $request->email);
            Mail::send('dashboard.core.mails.reset-password', ['code' => $code, 'user' => $user], function ($message) use ($email) {
                $message->to($email);
                $message->subject(__('dashboard.Reset your password!'));
                $message->from(env('MAIL_RESET_PASSWORD_FROM_ADDRESS'), __('website.MehanPlus'));
            });
            DB::commit();
            return $this->responseSuccess(message: __('messages.We have sent you an email to reset your password'));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function resetPasswordCode($request) {
        if($this->passwordResetRepository->search($request->code, $request->email) !== null) {
            return $this->responseSuccess(message: __('messages.The code is correct You can reset your password'));
        } else {
            return $this->responseFail(message: __('messages.The code is incorrect'));
        }
    }

    public function resetPasswordSubmit($request) {
        if($this->passwordResetRepository->search($request->code, $request->email) !== null) {
            $user = $this->userRepository->get('email', $request->email);
            $user->update(['password' => $request->password]);
            $this->passwordResetRepository->search($request->code, $request->email)->delete();
            return $this->responseSuccess(message: __('messages.Password updated successfully'));
        } else {
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

}
