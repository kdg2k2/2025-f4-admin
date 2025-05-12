<?php

namespace App\Repositories\Eloquent;

use App\Models\PackageUser;
use App\Repositories\Interfaces\PackageUserRepositoryInterface;

class PackageUserRepository implements PackageUserRepositoryInterface
{
    public function findNewestByUserId(int $userId)
    {
        return PackageUser::orderByDesc('id')->where('user_id', $userId)->first();
    }
} 