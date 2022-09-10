<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServerErrorExceptionResource extends BaseResource
{
    public function code(): int
    {
        return 500;
    }
}
