<?php

namespace App\Http\Resources;

class UnauthenticatedResource extends BaseResource
{

    public function code(): int
    {
        return 401;
    }

}
