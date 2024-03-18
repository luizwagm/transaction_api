<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetTransactionResource extends JsonResource
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
                "id" => $res?->id,
                "wallet_id" => $res?->wallet_id,
                "destination_wallet_id" => $res?->destination_wallet_id,
                "description" => $res?->description,
                "value" => $res?->value,
                "status" => $res?->status,
                "created_at" => $res?->created_at,
            ];
        })->toArray();
    }
}
