<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;

trait PaginateTraits
{
    public function paginate($data, $perPage, $page)
    {
        $perPage = $perPage ?? config("paginate.per_page");
        $page = $page ?? 1;

        return new LengthAwarePaginator(
            collect($data)->forPage($page, $perPage)->values(),
            count($data),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }
}
