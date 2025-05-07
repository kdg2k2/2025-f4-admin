<?php

namespace App\Repositories;

use App\Models\PackageUser;

class PackageUserRepository
{
    public function findNewestByUserId(int $userId)
    {
        return PackageUser::orderByDesc('id')->where('user_id', $userId)->first();
    }
}
