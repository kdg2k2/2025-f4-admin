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
    protected const txs = [
        [
            "text" => "text-primary",
            "value" => "tx-primary",
        ],
        [
            "text" => "text-secondary",
            "value" => "tx-secondary",
        ],
        [
            "text" => "text-success",
            "value" => "tx-success",
        ],
        [
            "text" => "text-purple",
            "value" => "tx-purple",
        ],
        [
            "text" => "text-info",
            "value" => "tx-info",
        ],
        [
            "text" => "text-pink",
            "value" => "tx-pink",
        ],
        [
            "text" => "text-danger",
            "value" => "tx-danger",
        ],
        [
            "text" => "text-warning",
            "value" => "tx-warning",
        ],
        [
            "text" => "text-teal",
            "value" => "tx-teal",
        ],
        [
            "text" => "text-primary",
            "value" => "tx-primary",
        ],
    ];
    protected const bgs = [
        [
            "text" => "bg-secondary-transparent",
            "value" => "bg-secondary-transparent",
        ],
        [
            "text" => "bg-success-transparent",
            "value" => "bg-success-transparent",
        ],
        [
            "text" => "bg-purple-transparent",
            "value" => "bg-purple-transparent",
        ],
        [
            "text" => "bg-info-transparent",
            "value" => "bg-info-transparent",
        ],
        [
            "text" => "bg-pink-transparent",
            "value" => "bg-pink-transparent",
        ],
        [
            "text" => "bg-danger-transparent",
            "value" => "bg-danger-transparent",
        ],
        [
            "text" => "bg-warning-transparent",
            "value" => "bg-warning-transparent",
        ],
        [
            "text" => "bg-teal-transparent",
            "value" => "bg-teal-transparent",
        ],
        [
            "text" => "bg-primary-transparent",
            "value" => "bg-primary-transparent",
        ],
    ];
    public function __construct()
    {
        $this->documentFieldService = app(DocumentFieldService::class);
    }

    public function index()
    {
        return $this->catchWeb(function () {
            $data = $this->documentFieldService->list(['paginate' => 0]);
            return view('pages.document-field.index', [
                'data' => $data
            ]);
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
            $txs = self::txs;
            $bgs = self::bgs;
            return view('pages.document-field.create', [
                'txs' => $txs,
                'bgs' => $bgs,
            ]);
        });
    }

    public function store(StoreRequest $request)
    {
        return $this->catchWeb(function () use ($request) {
            $this->documentFieldService->store($request->validated());
            return redirect()->route('document.field.index')->with('success', 'Thêm mới thành công!');
        });
    }

    public function edit(EditRequest $request)
    {
        return $this->catchWeb(function () use ($request) {
            $data = $this->documentFieldService->findById($request->validated()['id']);
            $txs = self::txs;
            $bgs = self::bgs;
            return view('pages.document-field.edit', [
                'data' => $data,
                'txs' => $txs,
                'bgs' => $bgs,
            ]);
        });
    }

    public function update(UpdateRequest $request)
    {
        return $this->catchWeb(function () use ($request) {
            $this->documentFieldService->update($request->validated());
            return redirect()->route('document.field.index')->with('success', 'Cập nhật thành công!');
        });
    }

    public function destroy(DestroyRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
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
