<?php

namespace App\Repositories;

use App\Models\DocumentType;

class DocumentTypeRepository
{
    public function list(array $request)
    {
        $query = DocumentType::orderByDesc("id")->with('field');
        if (!empty($request['field_id']))
            $query->where('field_id', $request['field_id']);
        if (!empty($request['search']))
            $query->where('name', 'like', '%' . $request['search'] . '%');
        return $query->get()->toArray();
    }

    public function store(array $request)
    {
        return DocumentType::create($request);
    }

    public function update(array $request)
    {
        $record = DocumentType::find($request["id"]);
        $record->update($request);
        return $record;
    }

    public function destroy(array $request)
    {
        return DocumentType::find($request["id"])->delete();
    }

    public function findById(int $id)
    {
        return DocumentType::find($id);
    }
}
