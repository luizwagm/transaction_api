<?php

namespace App\Http\Resources\FinancialDeposit;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetDepositsResource extends JsonResource
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
                "wallet_id" => $res->wallet_id,
                "value" => $res->value,
                "status" => $res->status,
                "created_at" => $res->created_at,
            ];
        })->toArray();
    }
}
