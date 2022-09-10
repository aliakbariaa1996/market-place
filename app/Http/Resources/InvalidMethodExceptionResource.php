<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvalidMethodExceptionResource extends BaseResource
{
    public function code(): int
    {
        return 405;
    }
}
