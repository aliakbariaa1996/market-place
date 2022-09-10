<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "data" => $this->data($request),
            "code" => $this->code(),
            "messages" => $this->messages(),
            "errors" => $this->errors()
        ];
    }

    public function data($request): array
    {
        return [];
    }

    public function code(): int
    {
        return 200;
    }

    public function messages(): array
    {
        return [];
    }

    public function errors(): array
    {
        return [];
    }
}
