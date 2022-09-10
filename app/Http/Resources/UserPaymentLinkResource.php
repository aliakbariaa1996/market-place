<?php

namespace App\Http\Resources;

class UserPaymentLinkResource extends BaseResource
{

    public function data($request): array
    {
        return $this->resource;
    }
}
