<?php

namespace App\Repositories;

use App\Models\DocumentImage;

class DocumentImageRepository
{
    public function insert(array $request)
    {
        return DocumentImage::insert($request);
    }

    public function deleteByIdDocument(int $id)
    {
        return DocumentImage::where('id_document', $id)->delete();
    }
}
