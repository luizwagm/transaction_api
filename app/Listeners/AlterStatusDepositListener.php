<?php

namespace App\Listeners;

use App\Events\DepositEvent;
use App\Repositories\FinancialDeposit\FinancialDepositRepositoryInterface;

class AlterStatusDepositListener
{
    /**
     * construct to create listener function
     *
     * @param FinancialDepositRepositoryInterface $repository
     */
    public function __construct(
        protected FinancialDepositRepositoryInterface $repository
    ) {}

    /**
     * Handle to event function
     *
     * @param DepositEvent $event
     * @return void
     */
    public function handle(DepositEvent $event): void
    {
        $this->repository->updateCompleted($event->id);
    }
}
