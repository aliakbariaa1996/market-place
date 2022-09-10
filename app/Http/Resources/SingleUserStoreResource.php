<?php

namespace App\Http\Resources;

use App\Services\StoreService;

class SingleUserStoreResource extends BaseResource
{

    public function data($request): array
    {
        return [
            'store' => $this->resource,
            "products" => app()->make(StoreService::class)->storeProducts($this->id)->paginate()
        ];
    }
}
