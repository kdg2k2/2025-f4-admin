<?php

namespace App\Services;

use App\Repositories\Eloquent\PackageRepository;
use Exception;

class PackageService extends BaseService
{
    protected $PackageRepository;
    public function __construct()
    {
        $this->PackageRepository = app(PackageRepository::class);
    }

    public function list(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $records = $this->PackageRepository->list($request);
            if ($request["paginate"] == 1)
                $records = $this->paginate($records, $request["per_page"], $request["page"]);
            return $records;
        });
    }

    public function store(array $request)
    {
        return $this->transaction(function () use ($request) {
            $record = $this->PackageRepository->store($request);
            return $record;
        });
    }

    public function update(array $request)
    {
        return $this->transaction(function () use ($request) {
            $record = $this->PackageRepository->update($request);
            return $record;
        });
    }

    public function destroy(array $request)
    {
        return $this->transaction(function () use ($request) {
            return $this->PackageRepository->destroy($request);
        });
    }

    public function findById(int $id)
    {
        return $this->tryThrow(function () use ($id) {
            return $this->PackageRepository->findById($id);
        });
    }
}
