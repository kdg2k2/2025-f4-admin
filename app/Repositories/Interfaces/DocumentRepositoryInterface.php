<?php

namespace App\Repositories\Interfaces;

interface DocumentRepositoryInterface
{
    /**
     * Get all records with optional search and filters
     * @param array $request
     * @return array
     */
    public function list(array $request): array;

    /**
     * Create a new record
     * @param array $request
     * @return array
     */
    public function store(array $request): array;

    /**
     * Update an existing record
     * @param array $request
     * @return array
     */
    public function update(array $request): array;

    /**
     * Delete a record
     * @param array $request
     * @return bool
     */
    public function destroy(array $request): bool;

    /**
     * Find a record by ID
     * @param int $id
     * @return mixed
     */
    public function findById(int $id);
} 