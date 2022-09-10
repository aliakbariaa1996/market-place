<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BadInputExceptionResource extends BaseResource
{

    public function code(): int
    {
        return 422;
    }
}
