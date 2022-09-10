<?php

namespace App\Http\Resources;

class UserPurchasesResourceCollection extends BaseResourceCollection
{

    public function data($request): array
    {
        return $this->resource->toArray();
    }
}
