<?php
namespace App\Services;

use App\Repositories\Eloquent\OrderRepository;

class OrderService extends BaseService{
    protected $orderRepository;
    public function __construct(){
        $this->orderRepository = app(OrderRepository::class);
    }

    public function list(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $records = $this->orderRepository->list($request);
            if ($request["paginate"] == 1)
                $records = $this->paginate($records, $request["per_page"], $request["page"]);
            return $records;
        });
    }

    public function store(array $request)
    {
        return $this->transaction(function () use ($request) {
            $record = $this->orderRepository->store($request);
            return $record;
        });
    }

    public function update(array $request)
    {
        return $this->transaction(function () use ($request) {
            $record = $this->orderRepository->update($request);
            return $record;
        });
    }

    public function destroy(array $request)
    {
        return $this->transaction(function () use ($request) {
            return $this->orderRepository->destroy($request);
        });
    }

    public function findById(int $id)
    {
        return $this->tryThrow(function () use ($id) {
            return $this->orderRepository->findById($id);
        });
    }
}