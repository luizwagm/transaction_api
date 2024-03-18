<?php

namespace App\Repositories\FinancialDeposit;

use App\Http\Requests\FinancialDeposit\FinancialDepositRequest;
use App\Models\FinancialDeposit;
use Exception;
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
     * @return FinancialDeposit|Exception
     */
    public function deposit(FinancialDepositRequest $request): FinancialDeposit|Exception;

    /**
     * Update to completed status function
     *
     * @param integer $id
     * @return boolean
     */
    public function updateCompleted(int $id): FinancialDeposit;

    /**
     * Update to failed status function
     *
     * @param integer $id
     * @return boolean
     */
    public function updateFailed(int $id): FinancialDeposit;
}
