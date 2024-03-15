<?php

namespace App\Repositories\Notification;

use App\Http\Requests\Notification\NotificationRequest;
use App\Models\Notification;

interface NotificationRepositoryInterface
{
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
    public function updateStatusSent(int $id): bool;

    /**
     * Update to not send status function
     *
     * @param integer $id
     * @return boolean
     */
    public function updateStatusNotSend(int $id): bool;
}
