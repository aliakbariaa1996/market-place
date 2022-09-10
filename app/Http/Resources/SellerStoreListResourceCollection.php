<?php

namespace App\Http\Resources;

class SellerStoreListResourceCollection extends BaseResourceCollection
{

    public function data($request): array
    {
        return $this->resource->toArray();
    }

}
