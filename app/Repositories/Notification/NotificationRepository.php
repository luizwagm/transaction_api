<?php

namespace App\Repositories\Notification;

use App\Http\Requests\Notification\NotificationRequest;
use App\Models\Notification;

class NotificationRepository implements NotificationRepositoryInterface
{
    /**
     * $model variable
     *
     * @var Notification
     */
    protected Notification $model;

    /**
     * Construct function
     *
     * @param Notification $notificatio
     */
    public function __construct(Notification $notificatio)
    {
        $this->model = $notificatio;
    }

    /**
     * Send email or sms function
     *
     * @param NotificationRequest $request
     * @return Notification
     */
    public function send(NotificationRequest $request): Notification
    {
        return $this->model->create(
                [
                    'user_id' => $request?->user_id,
                    'notification_type' => $request?->notification_type,
                    'title' => $request?->title,
                    'message' => $request?->message,
                    'status' => Notification::STATUS_SENDING,
                ]
            );
    }

    /**
     * Update to sent status function
     *
     * @param integer $id
     * @return boolean
     */
    public function updateStatusSent(int $id): bool
    {
        $get = $this->model->find($id);

        $get->status = Notification::STATUS_SENT;
        $get->save();

        return $get;
    }

    /**
     * Update to not send status function
     *
     * @param integer $id
     * @return boolean
     */
    public function updateStatusNotSend(int $id): bool
    {
        $get = $this->model->find($id);

        $get->status = Notification::STATUS_NOT_SENT;
        $get->save();

        return $get;
    }
}
