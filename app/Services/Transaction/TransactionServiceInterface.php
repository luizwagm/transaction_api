<?php

namespace App\Services\Transaction;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;

interface TransactionServiceInterface
{
    /**
     * Get transactions function
     *
     * @param integer $walletId
     * @return Collection
     */
    public function get(int $walletId): Collection;

    /**
     * Execute creation transaction function
     *
     * @param [type] $request
     * @return Transaction
     */
    public function execute($request): Transaction;
}
