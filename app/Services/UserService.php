<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Exception;

class UserService extends BaseService
{
    protected $userRepository;
    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
    }

    public function list(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $records = $this->userRepository->list($request);
            $records = $this->transformRecords($records);
            if ($request["paginate"] == 1)
                $records = $this->paginate($records, $request["per_page"], $request["page"]);
            return $records;
        });
    }

    public function store(array $request)
    {
        return $this->transaction(function () use ($request) {
            $request["password"] = bcrypt($request["password"]);
            if (!empty($request["path"]))
                $request["path"] = $this->imageUpload($request["path"]);
            $record = $this->userRepository->store($request);
            $record = $this->transformRecord($record);
            return $record;
        });
    }

    public function update(array $request)
    {
        return $this->transaction(function () use ($request) {
            if (!empty($request["password"]))
                $request["password"] = bcrypt($request["password"]);

            if (!empty($request["path"])) {
                $request["path"] = $this->imageUpload($request["path"]);

                $record = $this->findById($request['id']);
                if (!empty($record->path))
                    if (file_exists(public_path($record->path)))
                        unlink(public_path($record->path));
            }
            $record = $this->userRepository->update($request);
            $record = $this->transformRecord($record);
            return $record;
        });
    }

    public function destroy(array $request)
    {
        return $this->transaction(function () use ($request) {
            return $this->userRepository->destroy($request);
        });
    }

    protected function imageUpload($path)
    {
        return (new FileUploadService())->storeImage($path, false);
    }

    protected function transformRecords($records)
    {
        return array_map([$this, 'transformRecord'], $records);
    }

    protected function transformRecord($record)
    {
        $record['path'] = $this->getAssetImage($record['path']);
        return $record;
    }

    public function findById(int $id)
    {
        return $this->tryThrow(function () use ($id) {
            return $this->userRepository->findById($id);
        });
    }

    public function findByEmail(string $email)
    {
        return $this->tryThrow(function () use ($email) {
            return $this->userRepository->findByEmail($email);
        });
    }
}
