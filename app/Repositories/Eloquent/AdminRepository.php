<?php

namespace App\Repositories\Eloquent;

use App\Models\Admin;
use App\Repositories\Interfaces\AdminRepositoryInterface;

class AdminRepository implements AdminRepositoryInterface
{
    public function list(array $request): array
    {
        $query = Admin::orderByDesc("id");
        if (!empty($request['search']))
            $query->where('name', 'like', '%' . $request['search'] . '%');
        return $query->get()->toArray();
    }

    public function store(array $request): array
    {
        $record = Admin::create($request);
        return $record->toArray();
    }

    public function update(array $request): array
    {
        $record = Admin::find($request["id"]);
        $record->update($request);
        return $record->toArray();
    }

    public function destroy(array $request): bool
    {
        return Admin::find($request["id"])->delete();
    }

    public function findById(int $id)
    {
        return Admin::find($id);
    }

    public function findByEmail(string $email)
    {
        return Admin::where("email", $email)->first();
    }
} 