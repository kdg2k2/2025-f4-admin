<?php

namespace App\Repositories\Eloquent;

use App\Models\DocumentType;
use App\Repositories\Interfaces\DocumentTypeRepositoryInterface;

class DocumentTypeRepository implements DocumentTypeRepositoryInterface
{
    public function list(array $request): array
    {
        $query = DocumentType::orderByDesc("id")->with('field');
        if (!empty($request['field_id']))
            $query->where('field_id', $request['field_id']);
        if (!empty($request['search']))
            $query->where('name', 'like', '%' . $request['search'] . '%');
        return $query->get()->toArray();
    }

    public function store(array $request): array
    {
        return DocumentType::create($request)->toArray();
    }

    public function update(array $request): array
    {
        $record = DocumentType::find($request["id"]);
        $record->update($request);
        return $record->toArray();
    }

    public function destroy(array $request): bool
    {
        return DocumentType::find($request["id"])->delete();
    }

    public function findById(int $id)
    {
        return DocumentType::find($id);
    }
} 