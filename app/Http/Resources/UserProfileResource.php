<?php

namespace App\Http\Resources;

class UserProfileResource extends BaseResource
{

    public function data($request): array
    {
        return [
            "name" => $this->name,
            "email" => $this->email
        ];
    }
}
