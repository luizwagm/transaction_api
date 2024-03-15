<?php

namespace App\Listeners;

use App\Events\CreateUserEvent;
use App\Http\Requests\Wallet\WalletRequest;
use App\Repositories\Wallet\WalletRepositoryInterface;

class CreateWalletListener
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected WalletRepositoryInterface $repository
    ) {}

    /**
     * Handle the event.
     */
    public function handle(CreateUserEvent $event): void
    {
        $wallet = new WalletRequest([
            'user_id' => $event->userId,
        ]);

        $this->repository->create($wallet);
    }
}
