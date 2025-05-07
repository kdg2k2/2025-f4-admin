<?php

namespace App\Repositories;

use App\Models\Admin;

class AdminRepository
{
    public function list(array $request)
    {
        return Admin::orderByDesc("id")->get()->toArray();
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
