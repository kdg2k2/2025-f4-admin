<?php

namespace App\Repositories;

use App\Models\Admin;

class AdminRepository
{
    public function list(array $request)
    {
        $query = Admin::orderByDesc("id");
        if (!empty($request['search']))
            $query->where('name', 'like', '%' . $request['search'] . '%');
        return $query->get()->toArray();
    }

    public function store(array $request)
    {
        $record = Admin::create($request);
        return $record->toArray();
    }

    public function update(array $request)
    {
        $record = Admin::find($request["id"]);
        $record->update($request);
        return $record->toArray();
    }

    public function destroy(array $request)
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
