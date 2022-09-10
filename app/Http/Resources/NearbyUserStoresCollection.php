<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NearbyUserStoresCollection extends BaseResourceCollection
{

    public function data($request): array
    {
        return $this->resource->toArray();
    }
}
