<?php

namespace App\Services;

use App\Repositories\Eloquent\DocumentFieldRepository;
use Illuminate\Support\Str;

class DocumentFieldService extends BaseService
{
    protected $documentFieldRepository;
    public function __construct()
    {
        $this->documentFieldRepository = app(DocumentFieldRepository::class);
    }

    public function list(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $records = $this->documentFieldRepository->list($request);
            if ($request["paginate"] == 1)
                $records = $this->paginate($records, $request["per_page"], $request["page"]);
            return $records;
        });
    }

    public function store(array $request)
    {
        return $this->transaction(function () use ($request) {
            $request['slug'] = Str::slug($request['name']);
            return $this->documentFieldRepository->store($request);
        });
    }

    public function update(array $request)
    {
        return $this->transaction(function () use ($request) {
            $request['slug'] = Str::slug($request['name']);
            return $this->documentFieldRepository->update($request);
        });
    }

    public function destroy(array $request)
    {
        return $this->transaction(function () use ($request) {
            $this->documentFieldRepository->destroy($request);
        });
    }

    public function findById(int $id)
    {
        return $this->tryThrow(function () use ($id) {
            return $this->documentFieldRepository->findById($id);
        });
    }
}
