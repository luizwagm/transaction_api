<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetNotificationsResource extends JsonResource
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
                "notification_type" => $res?->notification_type,
                "title" => $res?->title,
                "message" => $res?->message,
                "status" => $res?->status,
                "created_at" => $res?->created_at,
            ];
        })->toArray();
    }
}
