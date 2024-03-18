<?php

namespace App\Repositories\Notification;

use App\Http\Requests\Notification\NotificationRequest;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Collection;

interface NotificationRepositoryInterface
{
    /**
     * Get all notifications function
     *
     * @param integer $userId
     * @return Collection
     */
    public function get(int $userId): Collection;
    
    /**
     * Send email or sms function
     *
     * @param NotificationRequest $request
     * @return Notification
     */
    public function send(NotificationRequest $request): Notification;

    /**
     * Update to sent status function
     *
     * @param integer $id
     * @return boolean
     */
    public function updateStatusSent(int $id): Notification;

    /**
     * Update to not send status function
     *
     * @param integer $id
     * @return boolean
     */
    public function updateStatusNotSend(int $id): Notification;
}
