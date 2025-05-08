<?php

namespace App\Repositories;

use App\Models\Document;

class DocumentRepository
{
    public function list(array $request)
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

    public function store(array $request)
    {
        return Document::create($request);
    }

    public function update(array $request)
    {
        $record = Document::find($request["id"]);
        $record->update($request);
        return $record;
    }

    public function destroy(array $request)
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
