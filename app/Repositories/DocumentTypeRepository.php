<?php

namespace App\Repositories;

use App\Models\DocumentType;

class DocumentTypeRepository
{
    public function list(array $request)
    {
        return DocumentType::orderByDesc('id')->get()->toArray();
    }
}
