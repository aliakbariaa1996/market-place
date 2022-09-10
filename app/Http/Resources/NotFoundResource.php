<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotFoundResource extends BaseResource
{

    public function code(): int
    {
        return 404;
    }
}
