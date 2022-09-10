<?php

namespace App\Http\Resources;

class CreateSellerResource extends BaseResource
{

    public function data($request): array
    {
        return $this->resource;
    }
}
