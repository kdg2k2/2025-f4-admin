<?php

namespace App\Repositories\Eloquent;

use App\Models\DocumentImage;
use App\Repositories\Interfaces\DocumentImageRepositoryInterface;

class DocumentImageRepository implements DocumentImageRepositoryInterface
{
    public function insert(array $request): bool
    {
        return DocumentImage::insert($request);
    }

    public function deleteByIdDocument(int $id): bool
    {
        return DocumentImage::where('document_id', $id)->delete();
    }
} 