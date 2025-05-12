<?php

namespace App\Services;

use App\Models\PackageUser;
use App\Repositories\Eloquent\PackageUserRepository;

class PackageUserService extends BaseService
{
    protected $packageUserRepository;
    public function __construct()
    {
        $this->packageUserRepository = app(PackageUserRepository::class);
    }

    public function findNewestByUserId(int $userId)
    {
        return $this->tryThrow(function () use ($userId) {
            return $this->packageUserRepository->findNewestByUserId($userId);
        });
    }
}
