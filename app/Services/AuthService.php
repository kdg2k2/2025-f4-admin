<?php

namespace App\Services;

class AuthService extends BaseService
{
    protected $adminService;
    protected $customValidateService;
    public function __construct()
    {
        $this->adminService = app(AdminService::class);
        $this->customValidateService = app(CustomValidateRequestService::class);
    }

    public function getLogin()
    {
        if (auth()->check())
            return route('dashboard');
        return null;
    }

    public function postLogin(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $route = route('dashboard');
            if (auth()->attempt(['email' => $request['email'], 'password' => $request['password']], $request['remember'])) {
                $previousUrl = session('url.previous');
                session()->forget('url.previous');
                if ($previousUrl)
                    $route = $previousUrl;

                return [
                    'route' => $route,
                    'message' => 'Đăng nhập thành công',
                    'message_type' => 'success',
                ];
            } else {
                return [
                    'route' => route('auth.get.login'),
                    'message' => 'Sai tài khoản hoặc mật khẩu',
                    'message_type' => 'err',
                ];
            }
        });
    }

    public function logout()
    {
        auth()->logout();
    }
}
