<?php

namespace App\Repositories\Interfaces;

interface PackageUserRepositoryInterface
{
    /**
     * Find newest record by user ID
     * @param int $userId
     * @return mixed
     */
    public function findNewestByUserId(int $userId);
} 