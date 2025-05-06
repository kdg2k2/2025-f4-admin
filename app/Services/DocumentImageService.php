<?php

namespace App\Services;

use App\Repositories\DocumentImageRepository;

class DocumentImageService extends BaseService
{
    protected $documentImageRepository;
    public function __construct()
    {
        $this->documentImageRepository = app(DocumentImageRepository::class);
    }

    public function insert(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->documentImageRepository->insert($request);
        });
    }

    public function deleteByIdDocument(int $id)
    {
        return $this->tryThrow(function () use ($id) {
            return $this->documentImageRepository->deleteByIdDocument($id);
        });
    }
}
