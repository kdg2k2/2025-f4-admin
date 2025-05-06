<?php

namespace App\Services;

use App\Traits\AssetPathTraits;
use App\Traits\CheckLocalTraits;
use App\Traits\PaginateTraits;
use App\Traits\TryCatchTraits;

class BaseService
{
    use TryCatchTraits, AssetPathTraits, CheckLocalTraits, PaginateTraits;
}