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
        $notificationRequestSms = new NotificationRequest($this->payload($event, 'sms'));
        $notificationRequestEmail = new NotificationRequest($this->payload($event, 'email'));

        $event->setSms($this->notificationRepository->send($notificationRequestSms));
        $event->setEmail($this->notificationRepository->send($notificationRequestEmail));
    }

    /**
     * Create a body of payload function
     *
     * @param [type] $event
     * @param string $type
     * @return array
     */
    private function payload($event, $type = 'email')
    {
        $walletPayee = $this->walletRepository->find($event?->request?->destination_wallet_id);
        $walletPayer = $this->walletRepository->find($event?->request?->wallet_id);

        return [
                'user_id' => $walletPayee?->user?->id,
                'notification_type' => $type,
                'title' => 'Status',
                'message' => 'Financial transaction received by ' . $walletPayer?->user?->fullname,
            ];
    }
}
