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

    public function update(array $request, $removeOldPath)
    {
        $record = Admin::find($request["id"]);

        if ($removeOldPath == true && !empty($record->path))
            if (file_exists(public_path($record->path)))
                unlink(public_path($record->path));

        $record->update($request);
        return $record->toArray();
    }

    public function delete(array $request)
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
