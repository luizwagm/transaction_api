<?php

namespace App\Listeners;

use App\Http\Requests\Notification\NotificationRequest;
use App\Repositories\Notification\NotificationRepositoryInterface;
use App\Repositories\Wallet\WalletRepositoryInterface;
use App\Services\Others\SendEmailServiceInterface;

class CreateNotificationsListener
{
    public function __construct(
        protected SendEmailServiceInterface $service,
        protected NotificationRepositoryInterface $notificationRepository,
        protected WalletRepositoryInterface $walletRepository
    ) {}

    /**
     * Handle to event function
     *S
     * @return void
     */
    public function handle($event)
    {
        $wallet = $this->walletRepository->find($event?->request?->destination_wallet_id);

        $notificationRequestSms = new NotificationRequest(
            [
                'user_id' => $wallet?->user?->id,
                'notification_type' => 'sms',
                'title' => 'Status',
                'message' => 'Financial transaction sending',
            ]
        );

        $notificationRequestEmail = new NotificationRequest(
            [
                'user_id' => $wallet?->user?->id,
                'notification_type' => 'email',
                'title' => 'Status',
                'message' => 'Financial transaction sending',
            ]
        );

        $event->setSms($this->notificationRepository->send($notificationRequestSms));
        $event->setEmail($this->notificationRepository->send($notificationRequestEmail));
    }
}
