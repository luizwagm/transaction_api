<?php

namespace App\Listeners;

use App\Http\Requests\Notification\NotificationRequest;
use App\Repositories\Notification\NotificationRepositoryInterface;
use App\Services\Others\SendEmailServiceInterface;

class CheckSendNotificationListener
{
    public function __construct(
        protected SendEmailServiceInterface $service,
        protected NotificationRepositoryInterface $notificationRepository
    ) {}

    /**
     * Handle to event function
     *S
     * @return void
     */
    public function handle($event)
    {
        if (! $this->service->handle()->message) {
            $this->notificationRepository->updateStatusNotSend($event->sms->id);
            $this->notificationRepository->updateStatusNotSend($event->email->id);

            return false;
        }
    }
}
