<?php

namespace App\Repositories;

use App\Models\Package;

class PackageRepository
{
    public function list(array $request)
    {
        $query = Package::orderByDesc("id");
        if (!empty($request['search']))
            $query->where('name', 'like', '%' . $request['search'] . '%');
        return $query->get()->toArray();
    }

    public function store(array $request)
    {
        $record = Package::create($request);
        return $record->toArray();
    }

    public function update(array $request)
    {
        $record = Package::find($request["id"]);
        $record->update($request);
        return $record->toArray();
    }

    public function destroy(array $request)
    {
        return Package::find($request["id"])->delete();
    }

    public function findById(int $id)
    {
        return Package::find($id);
    }
}
