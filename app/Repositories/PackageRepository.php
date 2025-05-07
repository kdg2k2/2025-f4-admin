<?php

namespace App\Repositories;

use App\Models\Package;

class PackageRepository
{
    public function list(array $request)
    {
        return Package::orderByDesc("id")->get()->toArray();
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
