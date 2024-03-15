<?php

namespace App\Repositories\FinancialDeposit;

use App\Http\Requests\FinancialDeposit\FinancialDepositRequest;
use App\Models\FinancialDeposit;
use Illuminate\Database\Eloquent\Collection;

interface FinancialDepositRepositoryInterface
{
    /**
     * Get deposits function
     *
     * @param integer $walletId
     * @return Collection
     */
    public function get(int $walletId): Collection;

    /**
     * Deposit to wallet function
     *
     * @param FinancialDepositRequest $request
     * @return FinancialDeposit
     */
    public function deposit(FinancialDepositRequest $request): FinancialDeposit;

    /**
     * Update to completed status function
     *
     * @param integer $id
     * @return boolean
     */
    public function updateCompleted(int $id): bool;

    /**
     * Update to failed status function
     *
     * @param integer $id
     * @return boolean
     */
    public function updateFailed(int $id): bool;
}
