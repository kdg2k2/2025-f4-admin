<?php

namespace App\Http\Controllers;

use App\Http\Requests\Document\DestroyRequest;
use App\Http\Requests\Document\EditRequest;
use App\Http\Requests\Document\ListRequest;
use App\Http\Requests\Document\StoreRequest;
use App\Http\Requests\Document\UpdateRequest;
use App\Services\DocumentService;
use App\Services\DocumentTypeService;

class DocumentController extends Controller
{
    protected $documentService;
    protected $documentTypeService;
    public function __construct()
    {
        $this->documentTypeService = app(DocumentTypeService::class);
        $this->documentService = app(DocumentService::class);
    }

    public function index()
    {
        return $this->catchWeb(function () {
            $types = $this->documentService->list(['paginate' => 0]);
            return view("pages.document.index", [
                'types' => $types,
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
        return $this->catchWeb(function () {});
    }

    public function store(StoreRequest $request)
    {
        return $this->catchWeb(function () use ($request) {});
    }

    public function edit(EditRequest $request)
    {
        return $this->catchWeb(function () use ($request) {});
    }

    public function update(UpdateRequest $request)
    {
        return $this->catchWeb(function () use ($request) {});
    }

    public function destroy(DestroyRequest $request)
    {
        return $this->catchWeb(function () use ($request) {});
    }
}
