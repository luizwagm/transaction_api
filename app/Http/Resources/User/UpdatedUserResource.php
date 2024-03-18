<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdatedUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "fullname" => $this->fullname,
            "document" => $this->document,
            "email" => $this->email,
            "user_type" => $this->user_type,
            "message" => 'User updated successfully',
        ];
    }
}
