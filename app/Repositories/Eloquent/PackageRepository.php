<?php

namespace App\Repositories\Eloquent;

use App\Models\Package;
use App\Repositories\Interfaces\PackageRepositoryInterface;

class PackageRepository implements PackageRepositoryInterface
{
    public function list(array $request): array
    {
        $query = Package::orderByDesc("id");
        if (!empty($request['search']))
            $query->where('name', 'like', '%' . $request['search'] . '%');
        return $query->get()->toArray();
    }

    public function store(array $request): array
    {
        $record = Package::create($request);
        return $record->toArray();
    }

    public function update(array $request): array
    {
        $record = Package::find($request["id"]);
        $record->update($request);
        return $record->toArray();
    }

    public function destroy(array $request): bool
    {
        return Package::find($request["id"])->delete();
    }

    public function findById(int $id)
    {
        return Package::find($id);
    }
} 