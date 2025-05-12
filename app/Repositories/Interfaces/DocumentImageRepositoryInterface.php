<?php

namespace App\Repositories\Interfaces;

interface DocumentImageRepositoryInterface
{
    /**
     * Insert multiple records
     * @param array $request
     * @return bool
     */
    public function insert(array $request): bool;

    /**
     * Delete records by document ID
     * @param int $id
     * @return bool
     */
    public function deleteByIdDocument(int $id): bool;
} 