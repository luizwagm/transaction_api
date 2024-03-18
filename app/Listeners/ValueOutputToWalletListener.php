<?php

namespace App\Listeners;

use App\Repositories\Wallet\WalletRepositoryInterface;

class ValueOutputToWalletListener
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
     *
     * @return void
     */
    public function handle($event): void
    {
        $this->repository->valueOutput($event->request->wallet_id, $event->request->value);
    }
}
