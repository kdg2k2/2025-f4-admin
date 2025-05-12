<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function list(array $request): array
    {
        $query = Order::orderByDesc("id")->with('payments');

        if (isset($request['from']) && isset($request['to']))
            $query->whereHas('payments', function ($q) use ($request) {
                $q->whereDate('created_at', '>=', $request['from'])
                    ->whereDate('created_at', '<=', $request['to']);
            });

        $records = $query->get()->toArray();
        return $records;
    }

    public function store(array $request): array
    {
        $record = Order::create($request);
        return $record->toArray();
    }

    public function update(array $request): array
    {
        $record = Order::find($request["id"]);
        $record->update($request);
        return $record->toArray();
    }

    public function destroy(array $request): bool
    {
        return Order::find($request["id"])->delete();
    }

    public function findById(int $id)
    {
        return Order::find($id);
    }
} 