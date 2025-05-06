<?php

namespace App\Repositories;

use App\Models\Document;

class DocumentRepository
{
    public function list(array $request)
    {
        $query = Document::orderByDesc("id")->with([
            'type',
            'uploader',
        ]);

        // lọc theo loại văn bản
        if (!empty($request["type_id"]))
            $query->where("type_id", $request["type_id"]);

        // lọc theo người đăng tải
        if (!empty($request["uploader_id"]))
            $query->where("uploader_id", $request["uploader_id"]);

        // tìm kiếm theo tên tài liệu hoặc tác giả
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

    public function delete(array $request)
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
