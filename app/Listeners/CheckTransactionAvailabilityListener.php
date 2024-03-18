<?php

namespace App\Listeners;

use App\Repositories\Transaction\TransactionRepositoryInterface;
use App\Repositories\Wallet\WalletRepositoryInterface;
use App\Services\Others\AuthorizationTransactionServiceInterface;

class CheckTransactionAvailabilityListener
{
    public function __construct(
        protected AuthorizationTransactionServiceInterface $service,
        protected WalletRepositoryInterface $repository,
        protected TransactionRepositoryInterface $transactionRepository
    ) {}

    /**
     * Handle to event function
     *S
     * @return void
     */
    public function handle($event)
    {       
        if ($this->service->handle()->message != 'Autorizado') {
            $this->repository->valueEntry($event->request->wallet_id, $event->request->value);
            $this->transactionRepository->updateReversed($event->id);

            return false;
        }
    }
}
