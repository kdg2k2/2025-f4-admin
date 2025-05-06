<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentField\DestroyRequest;
use App\Http\Requests\DocumentField\EditRequest;
use App\Http\Requests\DocumentField\ListRequest;
use App\Http\Requests\DocumentField\StoreRequest;
use App\Http\Requests\DocumentField\UpdateRequest;
use App\Services\DocumentFieldService;

class DocumentFieldController extends Controller
{
    protected $documentFieldService;
    public function __construct()
    {
        $this->documentFieldService = app(DocumentFieldService::class);
    }

    public function index()
    {
        return $this->catchWeb(function () {
            return view('pages.document-field.index');
        });
    }

    public function list(ListRequest $request)
    {
        return $this->catchWeb(function () use ($request) {
            $data = $this->documentFieldService->list($request->validated());
            return response()->json(
                ['data' => $data],
                200
            );
        });
    }

    public function create()
    {
        return $this->catchWeb(function () {
            return view('pages.document-field.create');
        });
    }

    public function store(StoreRequest $request)
    {
        return $this->catchWeb(function () use ($request) {
            $data = $this->documentFieldService->store($request->validated());
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
            $data = $this->documentFieldService->findById($request->validated()['id']);
            return view('pages.document-field.edit', [
                'data' => $data,
            ]);
        });
    }

    public function update(UpdateRequest $request)
    {
        return $this->catchWeb(function () use ($request) {
            $data = $this->documentFieldService->update($request->validated());
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
        return $this->catchWeb(function () use ($request) {
            $data = $this->documentFieldService->destroy($request->validated());
            return response()->json(
                [
                    'message' => 'Xóa thành công!'
                ],
                200
            );
        });
    }
}
