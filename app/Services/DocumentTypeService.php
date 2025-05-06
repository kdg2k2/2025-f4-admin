<?php

namespace App\Services;

use App\Repositories\DocumentTypeRepository;

class DocumentTypeService extends BaseService
{
    protected $documentTypeRepository;
    public function __construct()
    {
        $this->documentTypeRepository = app(DocumentTypeRepository::class);
    }

    public function list(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $records = $this->documentTypeRepository->list($request);
            if ($request["paginate"] == 1)
                $records = $this->paginate($records, $request["per_page"], $request["page"]);
            return $records;
        });
    }
}
