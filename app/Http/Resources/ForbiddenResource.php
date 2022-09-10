<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ForbiddenResource extends BaseResource
{

    public function code(): int
    {
        return 403;
    }
}
