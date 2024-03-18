<?php

namespace App\Listeners;

use App\Repositories\Notification\NotificationRepositoryInterface;

class SendNotificationListener
{
    public function __construct(
        protected NotificationRepositoryInterface $notificationRepository
    ) {}

    public function handle($event): void
    {
        $this->notificationRepository->updateStatusSent($event->sms->id);
        $this->notificationRepository->updateStatusSent($event->email->id);
    }
}
