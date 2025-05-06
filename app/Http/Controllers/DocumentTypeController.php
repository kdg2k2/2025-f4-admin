<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentType\DestroyRequest;
use App\Http\Requests\DocumentType\EditRequest;
use App\Http\Requests\DocumentType\ListRequest;
use App\Http\Requests\DocumentType\StoreRequest;
use App\Http\Requests\DocumentType\UpdateRequest;
use App\Services\DocumentFieldService;
use App\Services\DocumentTypeService;

class DocumentTypeController extends Controller
{
    protected $documentTypeService;
    protected $documentFieldService;
    public function __construct()
    {
        $this->documentFieldService = app(DocumentFieldService::class);
        $this->documentTypeService = app(DocumentTypeService::class);
    }

    public function index()
    {
        return $this->catchWeb(function () {
            return view('pages.document-Type.index');
        });
    }

    public function list(ListRequest $request)
    {
        return $this->catchWeb(function () use ($request) {
            $data = $this->documentTypeService->list($request->validated());
            return response()->json(
                ['data' => $data],
                200
            );
        });
    }

    public function create()
    {
        return $this->catchWeb(function () {
            $fields = $this->documentFieldService->list(['paginate' => 0]);
            return view('pages.document-Type.create', [
                'fields' => $fields,
            ]);
        });
    }

    public function store(StoreRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            $data = $this->documentTypeService->store($request->validated());
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
            $fields = $this->documentFieldService->list(['paginate' => 0]);
            $data = $this->documentTypeService->findById($request->validated()['id']);
            return view('pages.document-Type.edit', [
                'data' => $data,
                'fields' => $fields,
            ]);
        });
    }

    public function update(UpdateRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            $data = $this->documentTypeService->update($request->validated());
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
            $data = $this->documentTypeService->destroy($request->validated());
            return response()->json(
                [
                    'message' => 'Xóa thành công!'
                ],
                200
            );
        });
    }
}
