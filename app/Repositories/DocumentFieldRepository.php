<?php

namespace App\Repositories;

use App\Models\DocumentField;

class DocumentFieldRepository
{
    public function list(array $request)
    {
        $query = DocumentField::orderByDesc("id")->with('types');
        if (!empty($request['search']))
            $query->where('name', 'like', '%' . $request['search'] . '%');
        return $query->get()->toArray();
    }

    public function store(array $request)
    {
        return DocumentField::create($request);
    }

    public function update(array $request)
    {
        $record = DocumentField::find($request["id"]);
        $record->update($request);
        return $record;
    }

    public function destroy(array $request)
    {
        return DocumentField::find($request["id"])->delete();
    }

    public function findById(int $id)
    {
        return DocumentField::find($id);
    }
}
