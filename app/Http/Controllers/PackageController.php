<?php

namespace App\Http\Controllers;

use App\Http\Requests\Package\DestroyRequest;
use App\Http\Requests\Package\EditRequest;
use App\Http\Requests\Package\ListRequest;
use App\Http\Requests\Package\StoreRequest;
use App\Http\Requests\Package\UpdateRequest;
use App\Services\PackageService;

class PackageController extends Controller
{
    protected $packageService;
    public function __construct()
    {
        $this->packageService = app(PackageService::class);
    }

    public function index()
    {
        return $this->catchWeb(function () {
            return view('pages.package.index');
        });
    }

    public function list(ListRequest $request)
    {
        return $this->catchWeb(function () use ($request) {
            $data = $this->packageService->list($request->validated());
            return response()->json(
                ['data' => $data],
                200
            );
        });
    }

    public function create()
    {
        return $this->catchWeb(function () {
            return view('pages.package.create');
        });
    }

    public function store(StoreRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            $data = $this->packageService->store($request->validated());
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
            $data = $this->packageService->findById($request->validated()['id']);
            return view('pages.package.edit', [
                'data' => $data,
            ]);
        });
    }

    public function update(UpdateRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            $data = $this->packageService->update($request->validated());
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
            $data = $this->packageService->destroy($request->validated());
            return response()->json(
                [
                    'message' => 'Xóa thành công!'
                ],
                200
            );
        });
    }
}
