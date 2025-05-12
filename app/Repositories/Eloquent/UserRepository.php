<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function list(array $request): array
    {
        $q = User::orderByDesc("id");

        if (!empty($request['search']))
            $q->where('email', 'like', '%' . $request['search'] . '%')->orWhere('name', 'like', '%' . $request['search'] . '%');

        return $q->get()->toArray();
    }

    public function store(array $request): array
    {
        $record = User::create($request);
        return $record->toArray();
    }

    public function update(array $request): array
    {
        $record = User::find($request["id"]);
        $record->update($request);
        return $record->toArray();
    }

    public function destroy(array $request): bool
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