<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\AssignJobAndSkillsRequest;
use App\Http\Requests\Api\Auth\DecideResidencyDataRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\ResetPassword;
use App\Http\Requests\Api\Auth\ResetPasswordCodeRequest;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use App\Http\Requests\Api\Auth\ResetPasswordSubmitRequest;
use App\Http\Requests\Api\Auth\UploadProfileImageRequest;
use App\Http\Services\Api\Auth\AuthService;
use App\Http\Traits\FileManager;
use App\Http\Traits\Responser;
use App\Models\JobsSeeker;
use JWTAuth;

class AuthController extends Controller
{
    use Responser, FileManager;

    protected AuthService $auth;

    public function __construct(AuthService $authService)
    {
        $this->middleware('auth:api')->except(['login', 'register', 'resetPasswordRequest', 'resetPasswordCode', 'resetPasswordSubmit']);
        $this->auth = $authService;
    }

    public function login(LoginRequest $request)
    {
        return $this->auth->login($request);
    }

    public function refresh() {
        return $this->auth->refresh();
    }

    public function register(RegisterRequest $request)
    {
        return $this->auth->register($request);
    }

    public function assignJobsAndSkills(AssignJobAndSkillsRequest $request)
    {
        return $this->auth->assignJobsAndSkills($request);
    }

    public function uploadProfileImage(UploadProfileImageRequest $request)
    {
        return $this->auth->uploadProfileImage();
    }

    public function decideResidencyFields(DecideResidencyDataRequest $request) {
        return $this->auth->decideResidencyFields($request);
    }

    public function resetPasswordRequest(ResetPasswordRequest $request) {
        return $this->auth->resetPasswordRequest($request);
    }

    public function resetPasswordCode(ResetPasswordCodeRequest $request)
    {
        return $this->auth->resetPasswordCode($request);
    }

    public function resetPasswordSubmit(ResetPasswordSubmitRequest $request)
    {
        return $this->auth->resetPasswordSubmit($request);
    }
}
