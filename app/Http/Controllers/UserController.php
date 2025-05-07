<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\DestroyRequest;
use App\Http\Requests\User\EditRequest;
use App\Http\Requests\User\ListRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    public function __construct()
    {
        $this->userService = app(UserService::class);
    }

    public function index()
    {
        return $this->catchWeb(function () {
            return view('pages.user.index');
        });
    }

    public function list(ListRequest $request)
    {
        return $this->catchWeb(function () use ($request) {
            $data = $this->userService->list($request->validated());
            return response()->json(
                ['data' => $data],
                200
            );
        });
    }

    public function create()
    {
        return $this->catchWeb(function () {
            return view('pages.user.create');
        });
    }

    public function store(StoreRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            $data = $this->userService->store($request->validated());
            return response()->json(
                [
                    'data' => $data,
                    'message' => 'Thêm mới thành công!'
                ],
                200
            );
        });
    }

    public function edit(EditRequest $request)
    {
        return $this->catchWeb(function () use ($request) {
            $data = $this->userService->findById($request->validated()['id']);
            return view('pages.user.edit', [
                'data' => $data,
            ]);
        });
    }

    public function update(UpdateRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            $data = $this->userService->update($request->validated());
            return response()->json(
                [
                    'data' => $data,
                    'message' => 'Cập nhật thành công!'
                ],
                200
            );
        });
    }

    public function destroy(DestroyRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            $data = $this->userService->destroy($request->validated());
            return response()->json(
                [
                    'message' => 'Xóa thành công!'
                ],
                200
            );
        });
    }
}
