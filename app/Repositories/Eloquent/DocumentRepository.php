<?php

namespace App\Repositories\Eloquent;

use App\Models\Document;
use App\Repositories\Interfaces\DocumentRepositoryInterface;

class DocumentRepository implements DocumentRepositoryInterface
{
    public function list(array $request): array
    {
        $query = Document::orderByDesc("id")->with([
            'type.field',
            'uploader',
        ]);

        if (!empty($request["field_id"]))
            $query->whereHas("type.field", function ($q) use ($request) {
                $q->where("field_id", $request["field_id"]);
            });

        if (!empty($request["type_id"]))
            $query->where("type_id", $request["type_id"]);

        if (!empty($request["search"]))
            $query->where("title", "like", "%" . $request["search"] . "%");

        $records = $query->get()->toArray();
        return $records;
    }

    public function store(array $request): array
    {
        return Document::create($request)->toArray();
    }

    public function update(array $request): array
    {
        $record = Document::find($request["id"]);
        $record->update($request);
        return $record->toArray();
    }

    public function destroy(array $request): bool
    {
        return Document::find($request["id"])->delete();
    }

    public function findById(int $id)
    {
        return Document::find($id)->load([
            'type',
            'uploader',
        ]);
    }
} 