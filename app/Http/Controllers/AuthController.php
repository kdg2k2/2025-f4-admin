<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;
    public function __construct()
    {
        $this->authService = app(AuthService::class);
    }

    public function getLogin()
    {
        $res = $this->authService->getLogin();
        if ($res)
            return redirect($res);
        return view('pages.auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        return $this->catchWeb(function () use ($request) {
            $res = $this->authService->postLogin($request->validated());
            return redirect($res['route'])->with($res['message_type'], $res['message']);
        });
    }

    public function postLogout()
    {
        $this->authService->logout();
        return $this->getLogin();
    }
}
