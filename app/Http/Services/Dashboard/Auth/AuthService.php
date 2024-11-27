<?php

namespace App\Http\Services\Dashboard\Auth;

class AuthService
{

    public function login($request) {
        $credentials = $request->validated();
        $isRememberMe = $request->remember_me == 'on';
        if (auth('admin')->attempt($credentials, $isRememberMe)) {
            return redirect()->route('/');
        } else {
            return redirect()->route('auth.login')->with(['error' => __('messages.wrong credentials')]);
        }
    }

    public function logout() {
        auth('admin')->logout();
        return redirect()->route('auth.login');
    }

}
