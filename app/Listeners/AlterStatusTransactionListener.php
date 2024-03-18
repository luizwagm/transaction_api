<?php

namespace App\Listeners;

use App\Events\CreateTransactionEvent;
use App\Repositories\Transaction\TransactionRepositoryInterface;

class AlterStatusTransactionListener
{
    /**
     * construct to create listener function
     *
     * @param TransactionRepositoryInterface $repository
     */
    public function __construct(
        protected TransactionRepositoryInterface $repository
    ) {}

    /**
     * Handle to event function
     *
     * @param CreateTransactionEvent $event
     * @return void
     */
    public function handle(CreateTransactionEvent $event): void
    {
        $this->repository->updateCompleted($event->id);
    }
}
