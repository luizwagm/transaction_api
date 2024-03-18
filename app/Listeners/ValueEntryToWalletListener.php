<?php

namespace App\Listeners;

use App\Repositories\Wallet\WalletRepositoryInterface;

class ValueEntryToWalletListener
{
    /**
     * construct to create listener function
     *
     * @param WalletRepositoryInterface $repository
     */
    public function __construct(
        protected WalletRepositoryInterface $repository
    ) {}

    /**
     * Handle to event function
     *S
     * @return void
     */
    public function handle($event): void
    {
        $this->repository->valueEntry($event->request->wallet_id, $event->request->value);
    }
}
