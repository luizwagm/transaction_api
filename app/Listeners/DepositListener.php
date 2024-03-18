<?php

namespace App\Listeners;

use App\Events\DepositEvent;
use App\Repositories\FinancialDeposit\FinancialDepositRepositoryInterface;

class DepositListener
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected FinancialDepositRepositoryInterface $repository
    ) {}

    /**
     * Handle the event.
     */
    public function handle(DepositEvent $event): void
    {
        $deposit = $this->repository->deposit($event->request);

        $event->setId($deposit->id);
    }
}
