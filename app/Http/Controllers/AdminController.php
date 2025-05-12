<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\DestroyRequest;
use App\Http\Requests\Admin\EditRequest;
use App\Http\Requests\Admin\ListRequest;
use App\Http\Requests\Admin\StoreRequest;
use App\Http\Requests\Admin\UpdateRequest;
use App\Services\AdminService;

class AdminController extends Controller
{
    protected $adminService;
    public function __construct()
    {
        $this->adminService = app(AdminService::class);
    }

    public function index()
    {
        return $this->catchWeb(function () {
            $data = $this->adminService->list(['paginate' => 0]);
            return view('pages.admin.index', [
                'admins' => $data
            ]);
        });
    }

    public function list(ListRequest $request)
    {
        return $this->catchWeb(function () use ($request) {
            $data = $this->adminService->list($request->validated());
            return response()->json(
                ['data' => $data],
                200
            );
        });
    }

    public function create()
    {
        return $this->catchWeb(function () {
            return view('pages.admin.create');
        });
    }

    public function store(StoreRequest $request)
    {
        return $this->catchWeb(function () use ($request) {
            $data = $this->adminService->store($request->validated());
            return redirect()->route('admin.index')->with('success', 'Thêm mới thành công!');
        });
    }

    public function edit(EditRequest $request)
    {
        return $this->catchWeb(function () use ($request) {
            $data = $this->adminService->findById($request->validated()['id']);
            return view('pages.admin.edit', [
                'data' => $data,
            ]);
        });
    }

    public function update(UpdateRequest $request)
    {
        return $this->catchWeb(function () use ($request) {
            $data = $this->adminService->update($request->validated());
            return redirect()->route('admin.index')->with('success', 'Cập nhật thành công!');
        });
    }

    public function destroy(DestroyRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            $data = $this->adminService->destroy($request->validated());
            return response()->json(
                [
                    'message' => 'Xóa thành công!'
                ],
                200
            );
        });
    }
}
