<?php

namespace App\Http\Resources;

class UnauthorizedResource extends BaseResource
{

    public function code(): int
    {
        return 401;
    }

}
