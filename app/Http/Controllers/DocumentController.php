<?php

namespace App\Http\Controllers;

use App\Http\Requests\Document\DestroyRequest;
use App\Http\Requests\Document\DownloadRequest;
use App\Http\Requests\Document\EditRequest;
use App\Http\Requests\Document\ListRequest;
use App\Http\Requests\Document\ShowRequest;
use App\Http\Requests\Document\StoreRequest;
use App\Http\Requests\Document\UpdateRequest;
use App\Services\DocumentFieldService;
use App\Services\DocumentService;
use App\Services\DocumentTypeService;

class DocumentController extends Controller
{
    protected $documentService;
    protected $documentTypeService;
    protected $documentFieldService;
    public function __construct()
    {
        $this->documentFieldService = app(DocumentFieldService::class);
        $this->documentTypeService = app(DocumentTypeService::class);
        $this->documentService = app(DocumentService::class);
    }

    public function index()
    {
        return $this->catchWeb(function () {
            $fields = $this->documentFieldService->list(['paginate' => 0]);
            return view("pages.document.index", [
                'fields' => $fields,
            ]);
        });
    }

    public function list(ListRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            $data = $this->documentService->list($request->validated());
            return response()->json([
                'data' => $data,
            ], 200);
        });
    }

    public function create()
    {
        return $this->catchAPI(function () {
            $types = $this->documentTypeService->list(['paginate' => 0]);
            return view('pages.document.create', [
                'types' => $types,
            ]);
        });
    }

    public function store(StoreRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            $data = $this->documentService->store($request->validated());
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
            $types = $this->documentTypeService->list(['paginate' => 0]);
            $data = $this->documentService->findById($request->validated()['id']);
            return view('pages.document.edit', [
                'data' => $data,
                'types' => $types,
            ]);
        });
    }

    public function update(UpdateRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            $data = $this->documentService->update($request->validated());
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
            $this->documentService->destroy($request->validated());
            return response()->json(
                [
                    'message' => 'Xóa thành công!'
                ],
                200
            );
        });
    }

    public function show(ShowRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            $res = $this->documentService->show($request->validated());
            return response()->json(
                $res,
                200
            );
        });
    }

    public function download(DownloadRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            $res = $this->documentService->download($request->validated());
            return response()->json(
                $res,
                200
            );
        });
    }
}
