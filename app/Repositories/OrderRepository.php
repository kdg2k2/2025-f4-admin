<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    public function list(array $request)
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

    public function store(array $request)
    {
        $record = Order::create($request);
        return $record->toArray();
    }

    public function update(array $request)
    {
        $record = Order::find($request["id"]);
        $record->update($request);
        return $record->toArray();
    }

    public function destroy(array $request)
    {
        return Order::find($request["id"])->delete();
    }

    public function findById(int $id)
    {
        return Order::find($id);
    }
}
