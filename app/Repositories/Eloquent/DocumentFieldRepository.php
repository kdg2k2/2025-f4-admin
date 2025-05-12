<?php

namespace App\Repositories\Eloquent;

use App\Models\DocumentField;
use App\Repositories\Interfaces\DocumentFieldRepositoryInterface;

class DocumentFieldRepository implements DocumentFieldRepositoryInterface
{
    public function list(array $request): array
    {
        $query = DocumentField::orderByDesc("id")->with('types');
        if (!empty($request['search']))
            $query->where('name', 'like', '%' . $request['search'] . '%');
        return $query->get()->toArray();
    }

    public function store(array $request): array
    {
        return DocumentField::create($request)->toArray();
    }

    public function update(array $request): array
    {
        $record = DocumentField::find($request["id"]);
        $record->update($request);
        return $record->toArray();
    }

    public function destroy(array $request): bool
    {
        return DocumentField::find($request["id"])->delete();
    }

    public function findById(int $id)
    {
        return DocumentField::find($id);
    }
} 