<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\LoginRequest;
use App\Http\Services\Dashboard\Auth\AuthService;

class AuthController extends Controller
{

    private AuthService $auth;

    public function __construct(AuthService $authService)
    {
        $this->auth = $authService;
    }

    public function _login()
    {
        return view('dashboard.site.auth.login');
    }

    public function login(LoginRequest $request)
    {
        return $this->auth->login($request);
    }

    public function logout()
    {
        return $this->auth->logout();
    }
}
