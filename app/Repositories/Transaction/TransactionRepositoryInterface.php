<?php

namespace App\Repositories\Transaction;

use App\Http\Requests\Transaction\TransactionRequest;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;

interface TransactionRepositoryInterface
{
    /**
     * Get function
     *
     * @param integer $walletId
     * @param string $user
     * @return Collection
     */
    public function get(int $walletId, string $user = Transaction::PAYER): Collection;

    /**
     * Create function
     *
     * @param TransactionRequest $request
     * @return Transaction
     */
    public function create(TransactionRequest $request): Transaction;

    /**
     * Update to completed status function
     *
     * @param integer $id
     * @return Transaction
     */
    public function updateCompleted(int $id): Transaction;

    /**
     * Update to reversed status function
     *
     * @param integer $id
     * @return Transaction
     */
    public function updateReversed(int $id): Transaction;

    /**
     * Update to waiting status function
     *
     * @param integer $id
     * @return Transaction
     */
    public function updateWaiting(int $id): Transaction;
}
