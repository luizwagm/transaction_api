<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AllUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->map(function ($res) {
            return [
                "id" => $res->id,
                "fullname" => $res->fullname,
                "document" => $res->document,
                "email" => $res->email,
                "user_type" => $res->user_type,
                "wallet_id" => $res->wallet->id,
                "wallet_amount" => $res->wallet->amount,
            ];
        })->toArray();
    }
}
