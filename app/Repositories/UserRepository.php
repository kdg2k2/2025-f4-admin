<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function list(array $request)
    {
        return User::orderByDesc("id")->get()->toArray();
    }

    public function store(array $request)
    {
        $record = User::create($request);
        return $record->toArray();
    }

    public function update(array $request)
    {
        $record = User::find($request["id"]);
        $record->update($request);
        return $record->toArray();
    }

    public function destroy(array $request)
    {
        return User::find($request["id"])->delete();
    }

    public function findById(int $id)
    {
        return User::find($id);
    }

    public function findByEmail(string $email)
    {
        return User::where("email", $email)->first();
    }
}
