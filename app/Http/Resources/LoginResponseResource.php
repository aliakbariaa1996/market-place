<?php

namespace App\Http\Resources;

class LoginResponseResource extends BaseResource
{

    public function data($request): array
    {
        return [
            'token' => $this['token'],
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}
