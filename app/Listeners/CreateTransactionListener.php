<?php

namespace App\Listeners;

use App\Events\CreateTransactionEvent;
use App\Services\Transaction\TransactionServiceInterface;

class CreateTransactionListener
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected TransactionServiceInterface $service
    ) {}

    /**
     * Handle the event.
     */
    public function handle(CreateTransactionEvent $event)
    {
        $create = $this->service->execute($event->request);

        if (! $create) {
            return false;
        }

        $event->setTransactionId($create?->id);
    }
}
