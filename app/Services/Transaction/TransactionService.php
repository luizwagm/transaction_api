<?php

namespace App\Services\Transaction;

use App\Exceptions\CreateTransactionFailedException;
use App\Exceptions\WalletNotAmountException;
use App\Models\Transaction;
use App\Models\User;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use App\Repositories\Wallet\WalletRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TransactionService implements TransactionServiceInterface
{
    /**
     * Construct function
     *
     * @param TransactionRepositoryInterface $repository
     * @param WalletRepositoryInterface $walletRepository
     */
    public function __construct(
        protected TransactionRepositoryInterface $repository,
        protected WalletRepositoryInterface $walletRepository
    ) {}

    /**
     * Get transactions function
     *
     * @param integer $walletId
     * @return Collection
     */
    public function get(int $walletId): Collection
    {
        return $this->repository->get($walletId);
    }

    /**
     * Execute creation transaction function
     *
     * @param [type] $request
     * @return Transaction
     */
    public function execute($request): Transaction
    {
        $walletPayer = $this->walletRepository->find($request->wallet_id);
        
        if ($walletPayer->user->user_type == User::USER_TYPE_SHOPMAN) {
            throw new CreateTransactionFailedException();
        }

        if ($walletPayer->amount == 0.00) {
            throw new WalletNotAmountException();
        }

        return $this->repository->create($request);
    }
}
